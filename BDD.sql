-- Database: GestionNews

-- DROP DATABASE "GestionNews";

CREATE DATABASE GestionNews
    WITH
    OWNER = postgres
    ENCODING = 'UTF8';




DROP TABLE IF EXISTS parametre;
DROP TABLE IF EXISTS etude;
DROP TABLE IF EXISTS news;
DROP TABLE IF EXISTS archive_News;
DROP TABLE IF EXISTS interet;
DROP TABLE IF EXISTS domaine;
DROP TABLE IF EXISTS abonne;
DROP TABLE IF EXISTS mot_cle;
DROP TABLE IF EXISTS compte;

CREATE TYPE etat AS ENUM ('validé','nonvalidé','echec');


-- Table: public.Compte

-- DROP TABLE public."Compte";

CREATE TABLE IF NOT EXISTS compte
(
    pseudo varchar(30) NOT NULL,
    mdp varchar(256)NOT NULL,
    PRIMARY KEY (pseudo)
    )

    TABLESPACE pg_default;

ALTER TABLE compte
    OWNER to postgres;





-- Table: public.Abonne

-- DROP TABLE public."Abonne";

CREATE TABLE IF NOT EXISTS abonne
(
    idAbonne serial NOT NULL,
    pseudo varchar(30) NOT NULL,
    nom varchar(50) NOT NULL,
    prenom varchar(50) NOT NULL,
    email varchar(70) NOT NULL,
    telephone integer,
    dateInscription date NOT NULL,
    admin boolean NOT NULL,
    confiance boolean NOT NULL,
    PRIMARY KEY (idAbonne),
    CONSTRAINT fk_compte FOREIGN KEY(pseudo) REFERENCES compte(pseudo)
    )

    TABLESPACE pg_default;

ALTER TABLE abonne
    OWNER to postgres;





-- Table: public.Domaine

-- DROP TABLE public."Domaine";

CREATE TABLE IF NOT EXISTS domaine
(
    idDomaine serial NOT NULL,
    idAbonnePropo integer,
    libelle varchar(30) NOT NULL,
    estAccepte boolean,
    PRIMARY KEY (idDomaine),
    FOREIGN KEY(idAbonnePropo) REFERENCES abonne(idAbonne)
    )

    TABLESPACE pg_default;

ALTER TABLE domaine
    OWNER to postgres;





-- Table: public.Interet

-- DROP TABLE public."Interet";

CREATE TABLE IF NOT EXISTS interet
(
    idAbonne integer,
    idDomaine integer,
    FOREIGN KEY(idAbonne) REFERENCES abonne(idAbonne),
    FOREIGN KEY(idDomaine) REFERENCES domaine(idDomaine)
)

    TABLESPACE pg_default;

ALTER TABLE interet
    OWNER to postgres;





-- Table: public.Mot_cle

-- DROP TABLE public."Mot_cle";

CREATE TABLE IF NOT EXISTS mot_cle
(
    idMotCle serial NOT NULL,
    libelle varchar(30) NOT NULL,
    PRIMARY KEY (idMotCle)
    )

    TABLESPACE pg_default;

ALTER TABLE mot_cle
    OWNER to postgres;





-- Table: public.News

-- DROP TABLE public."News";

CREATE TABLE IF NOT EXISTS news
(
    idNews serial NOT NULL,
    idAbonne integer,
    idDomaine integer,
    idMotCle1 integer,
    idMotCle2 integer,
    idMotCle3 integer,
    titre varchar(30) NOT NULL,
    contenu text COLLATE pg_catalog."default" NOT NULL,
    datePublication date NOT NULL,
    dureeAffichage integer NOT NULL,
    etatN etat NOT NULL,
    FOREIGN KEY(idAbonne) REFERENCES abonne(idAbonne),
    FOREIGN KEY(idDomaine) REFERENCES domaine(idDomaine),
    FOREIGN KEY(idMotCle1) REFERENCES mot_cle(idMotCle),
    FOREIGN KEY(idMotCle2) REFERENCES mot_cle(idMotCle),
    FOREIGN KEY(idMotCle3) REFERENCES mot_cle(idMotCle),
    PRIMARY KEY (idNews)
    )

    TABLESPACE pg_default;

ALTER TABLE news
    OWNER to postgres;




-- Table: public.Archive_News

-- DROP TABLE public."Archive_News";

CREATE TABLE IF NOT EXISTS archive_news
(
    idArchive serial NOT NULL,
    idAbonneP integer,
    idAbonneE integer,
    idDomaine integer,
    idMotCle1 integer,
    idMotCle2 integer,
    idMotCle3 integer,
    titre varchar(30) NOT NULL,
    contenu text COLLATE pg_catalog."default" NOT NULL,
    datePublication date NOT NULL,
    dateArchivage date NOT NULL,
    etatA etat NOT NULL,
    FOREIGN KEY(idAbonneP) REFERENCES abonne(idAbonne),
    FOREIGN KEY(idAbonneE) REFERENCES abonne(idAbonne),
    FOREIGN KEY(idDomaine) REFERENCES domaine(idDomaine),
    FOREIGN KEY(idMotCle1) REFERENCES mot_cle(idMotCle),
    FOREIGN KEY(idMotCle2) REFERENCES mot_cle(idMotCle),
    FOREIGN KEY(idMotCle3) REFERENCES mot_cle(idMotCle),
    PRIMARY KEY (idArchive)
    )

    TABLESPACE pg_default;

ALTER TABLE archive_news
    OWNER to postgres;





-- Table: public.Etude

-- DROP TABLE public."Etude";

CREATE TABLE IF NOT EXISTS etude
(
    idAbonne integer,
    idNews integer,
    FOREIGN KEY(idAbonne) REFERENCES abonne(idAbonne),
    FOREIGN KEY(idNews) REFERENCES news(idNews),
    justification varchar(255),
    dateEtude date,
    PRIMARY KEY (idAbonne)
    )

    TABLESPACE pg_default;

ALTER TABLE etude
    OWNER to postgres;







-- Table: public.Parametre

-- DROP TABLE public."Parametre";

CREATE TABLE IF NOT EXISTS parametre
(
    dureeAffichageMaximale integer NOT NULL,
    nbEtudeSansRepMax integer NOT NULL,
    nbNewsMinAboConf integer NOT NULL,
    dureeEtude integer  NOT NULL
)

    TABLESPACE pg_default;

ALTER TABLE parametre
    OWNER to postgres;

--- Rôles et droits des différents comptes ---
CREATE ROLE administrateur;
GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO administrateur;
GRANT ALL ON ALL SEQUENCES IN SCHEMA public TO administrateur;
CREATE USER adminUser;
GRANT administrateur TO adminUser;

CREATE ROLE abonne;
GRANT SELECT ON compte, abonne, domaine, news, mot_cle, archive_news, interet, parametre TO abonne;
GRANT INSERT ON compte, abonne, domaine, etude, news, mot_cle, interet TO abonne;
GRANT DELETE ON interet, news TO abonne;
GRANT ALL ON ALL SEQUENCES IN SCHEMA public TO abonne;
CREATE USER abonneUser;
GRANT abonne TO abonneUser;

CREATE ROLE utilisateur;
GRANT SELECT ON domaine, compte, abonne, news, mot_cle TO utilisateur;
GRANT INSERT ON abonne, compte TO utilisateur;
GRANT ALL ON ALL SEQUENCES IN SCHEMA public TO utilisateur;
CREATE USER notConnectedUser;
GRANT utilisateur TO notConnectedUser;

--- Procédures et fonctions ---
CREATE OR REPLACE PROCEDURE Inscription(Ppseudo varchar(30),
                                        Pmdp varchar(30),
                                        Pnom varchar(50),
                                        Pprenom varchar(50),
                                        Pemail varchar(70),
                                        Ptelephone integer)
    LANGUAGE plpgsql
AS $$
DECLARE
PdateInscription date = current_date;
BEGIN
    IF (SELECT COUNT(*) FROM compte WHERE compte.pseudo = Ppseudo) <> 0 THEN
        RAISE EXCEPTION 'Pseudo déjà existant';
END IF;
    IF (SELECT COUNT(*) FROM abonne WHERE abonne.email = Pemail) <> 0 THEN
        RAISE EXCEPTION 'Email déjà existant';
END IF;
    IF Ppseudo = '' THEN
        RAISE EXCEPTION 'Le pseudo est obligatoire';
END IF;
    IF Pmdp = '' THEN
        RAISE EXCEPTION 'Le mot de passe est obligatoire';
END IF;
    IF Pnom = '' THEN
        RAISE EXCEPTION 'Le nom est obligatoire';
END IF;
    IF Pprenom = '' THEN
        RAISE EXCEPTION 'Le prenom est obligatoire';
END IF;
    IF Pemail = '' THEN
        RAISE EXCEPTION 'Le mail est obligatoire';
END IF;


INSERT INTO compte VALUES(Ppseudo, Pmdp);
INSERT INTO abonne (nom, pseudo, prenom, email, telephone, dateInscription, admin, confiance)
VALUES(Pnom, Ppseudo, Pprenom, Pemail, Ptelephone, PdateInscription, false, false);
END;
$$;

CREATE OR REPLACE FUNCTION connexion (pseudonyme char, passwd char)
    RETURNS boolean as $$
DECLARE ok boolean;
BEGIN
SELECT (mdp = $2) into ok
FROM compte
Where pseudo = $1;

RETURN ok;
END;
$$ LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION publication_bef() RETURNS trigger AS $publication$
  BEGIN
    IF NEW.titre IS NULL THEN
      RAISE EXCEPTION 'titre ne peut pas être vide';
    END IF;
    IF NEW.contenu IS NULL THEN
      RAISE EXCEPTION 'contenu ne peut pas être vide';
    END IF;
    NEW.datePublication := current_timestamp;
    NEW.etatN := 'nonvalidé';
    IF NEW.dureeAffichage IS NULL THEN
      RAISE EXCEPTION 'dureeAffichage ne peut pas être vide';
    END IF;
    IF NEW.idAbonne IS NULL THEN
      RAISE EXCEPTION 'idAbonne ne peut pas être vide';
    END IF;
    IF NEW.idDomaine IS NULL THEN
      RAISE EXCEPTION 'idDomaine ne peut pas être vide';
    END IF;
    IF NEW.idMotCle1 IS NULL THEN
      RAISE EXCEPTION 'idMotCle1 ne peut pas être vide';
    END IF;
    RETURN NEW;
  END;
$publication$ LANGUAGE plpgsql;

CREATE TRIGGER publication_bef BEFORE INSERT ON news
    FOR EACH ROW EXECUTE FUNCTION publication_bef();

/*
NE MARCHE PAS POUR LE MOMENT !
                CHOISIR ABONNE DE CONFIANCE AU HASARD POUR ETUDIER L'ARTICLE

CREATE OR REPLACE FUNCTION publication_aft() RETURNS trigger AS $publication$
    DECLARE
      idAbonConf abonne.idabonne%type;
    BEGIN
    IF NEW.idnews IS  NOT NULL THEN
      SELECT MIN(idabonne) INTO idAbonConf FROM abonne WHERE confiance = TRUE;
      INSERT INTO etude (idabonne, idnews) VALUES (idAbonConf, NEW.idnews);
    END IF;
    END;
  $publication$ LANGUAGE plpgsql;

CREATE TRIGGER publication_aft AFTER INSERT ON news
    FOR EACH ROW EXECUTE FUNCTION publication_aft();

*/

CREATE OR REPLACE FUNCTION publier(idAuthor integer,
                                   title varchar(30),
                                   contentNews text,
                                   dureeAffichage integer,
                                   cat integer,
                                   keyword1 integer,
                                   keyword2 integer default null,
                                   keyword3 integer default null)
    RETURNS integer as $$
DECLARE idarticle integer;
BEGIN
INSERT INTO news(idAbonne, idDomaine, idMotCle1, idMotCle2, idMotCle3, titre, contenu, datePublication, dureeAffichage, etatN)
VALUES (idAuthor, cat, keyword1, keyword2, keyword3, title, contentNews, current_date, dureeAffichage, 'nonvalidé') RETURNING idnews INTO idarticle;
RETURN idarticle;
END;
$$ LANGUAGE plpgsql;
