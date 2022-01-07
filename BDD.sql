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

CREATE TYPE etat AS ENUM ('validé','nonvalidé','fausse');


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
    idInteret serial NOT NULL,
    idAbonne integer,
    idDomaine integer,
    FOREIGN KEY(idAbonne) REFERENCES abonne(idAbonne),
    FOREIGN KEY(idDomaine) REFERENCES domaine(idDomaine),
    PRIMARY KEY (idInteret)
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
    dureeAffichage varchar(30) NOT NULL,
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
    idEtude serial NOT NULL,
    idAbonne integer,
    idNews integer,
    FOREIGN KEY(idAbonne) REFERENCES abonne(idAbonne),
    FOREIGN KEY(idNews) REFERENCES news(idNews),
    justification varchar(255),
    dateEtude date,
    PRIMARY KEY (idEtude)
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
GRANT SELECT ON compte, abonne, domaine, news, mot_cle, archive_news, interet, etude, parametre TO abonne;
GRANT INSERT ON compte, abonne, domaine, etude, news, mot_cle, interet, etude TO abonne;
GRANT DELETE ON interet, news TO abonne;
GRANT UPDATE on news, etude TO abonne;
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

--- Verification des identifiants de connexion ---
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

--- Obtenir l'id d'un abonné de confiance ---

CREATE OR REPLACE FUNCTION selectTrusted ()
    RETURNS INT as $$
	DECLARE
idTrustedAbo INT;
		random_numb INT;
BEGIN
select idabonne
from abonne
where confiance = TRUE
    into idTrustedAbo
ORDER BY random()
    LIMIT 1;

return idTrustedAbo;
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


CREATE OR REPLACE FUNCTION publication_aft() RETURNS trigger AS $publication$
    DECLARE
      idAbonConf abonne.idabonne%type;
    BEGIN
    IF NEW.idnews IS  NOT NULL THEN
      SELECT idabonne INTO idAbonConf FROM abonne WHERE confiance = TRUE ORDER BY random() LIMIT 1;
      INSERT INTO etude (idabonne, idnews) VALUES (idAbonConf, NEW.idnews);
    END IF;
    RETURN NEW;
    END;
  $publication$ LANGUAGE plpgsql;
CREATE TRIGGER publication_aft AFTER INSERT ON news
    FOR EACH ROW EXECUTE FUNCTION publication_aft();

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


CREATE OR REPLACE PROCEDURE modifier_parametres(PdureeAffichageMax integer,
											   PnbEtudeSansRepMax integer,
											   PnbNewsMinAboConf integer,
											   PdureeEtude integer)
    LANGUAGE plpgsql
AS $$
DECLARE
currentDureeAffichageMax integer;
	currentNbEtudeSansRepMax integer;
	currentNbNewsMinAboConf integer;
	currentDureeEtude integer;
BEGIN
SELECT dureeaffichagemaximale INTO currentDureeAffichageMax FROM parametre;
SELECT nbetudesansrepmax INTO currentNbEtudeSansRepMax FROM parametre;
SELECT nbnewsminaboconf INTO currentNbNewsMinAboConf FROM parametre;
SELECT dureeetude INTO currentDureeEtude FROM parametre;

IF currentDureeAffichageMax <> PdureeAffichageMax THEN
UPDATE parametre SET dureeaffichagemaximale = PdureeAffichageMax;
END IF;

	IF currentNbEtudeSansRepMax <> PnbEtudeSansRepMax THEN
UPDATE parametre SET nbetudesansrepmax = PnbEtudeSansRepMax;
END IF;

	IF currentNbNewsMinAboConf <> PnbNewsMinAboConf THEN
UPDATE parametre SET nbnewsminaboconf = PnbNewsMinAboConf;
END IF;

	IF currentDureeEtude <> PdureeEtude THEN
UPDATE parametre SET dureeetude = PdureeEtude;
END IF;
END;
$$;

CREATE OR REPLACE PROCEDURE archiver() LANGUAGE plpgsql AS $$
DECLARE
n record;
  dateFin news.datePublication%type;
  idAE etude.idAbonne%type;
BEGIN
FOR n IN SELECT * FROM news
                           LOOP
    dateFin=n.datePublication + n.dureeAffichage::interval;
IF (dateFin < now()) THEN
    IF EXISTS (SELECT * FROM etude WHERE idNews = n.idNews) THEN
SELECT idAbonne INTO idAE FROM etude WHERE idNews = n.idNews;
INSERT INTO archive_news(titre, contenu, datePublication, dateArchivage, etatA, idDomaine, idAbonneP, idAbonneE, idMotCle1, idMotCle2, idMotCle3)
VALUES (n.titre, n.contenu, n.datePublication, dateFin, n.etatN, n.idDomaine, n.idAbonne, idAE, n.idMotCle1, n.idMotCle2, n.idMotCle3);
ELSE
      INSERT INTO archive_news(titre, contenu, datePublication, dateArchivage, etatA, idDomaine, idAbonneP, idMotCle1, idMotCle2, idMotCle3)
      VALUES (n.titre, n.contenu, n.datePublication, dateFin, n.etatN, n.idDomaine, n.idAbonne, n.idMotCle1, n.idMotCle2, n.idMotCle3);
END IF;
DELETE FROM etude WHERE idNews=n.idNews;
DELETE FROM news WHERE idNews=n.idNews;
END IF;
END LOOP;
END $$;

CREATE OR REPLACE PROCEDURE devAboConf() LANGUAGE plpgsql AS $$
DECLARE
a record;
  nbN integer;
  nbNV integer;
  currentNbNewsMinAboConf integer;
BEGIN
SELECT nbnewsminaboconf INTO currentNbNewsMinAboConf FROM parametre;
FOR a IN SELECT * FROM abonne
                           LOOP
SELECT COUNT(*) INTO nbN FROM news WHERE idAbonne = a.idAbonne;
IF (nbN >= currentNbNewsMinAboConf) THEN
SELECT COUNT(*) INTO nbNV FROM news WHERE idAbonne = a.idAbonne AND etatN = 'validé';
IF (nbNV>=nbN*0.8) THEN
UPDATE abonne SET confiance = TRUE WHERE idAbonne = a.idAbonne;
ELSE
UPDATE abonne SET confiance = FALSE WHERE idAbonne = a.idAbonne;
END IF;
END IF;
END LOOP;
END $$;

CREATE OR REPLACE PROCEDURE SoumettreDomaine(idAbo integer, nomDomaine varchar(30))
AS $$
BEGIN
	IF (SELECT COUNT(*) FROM abonne WHERE abonne.idabonne = idAbo) = 0  THEN
		RAISE EXCEPTION 'idAbonne est introuvable';
END IF;
    IF (SELECT COUNT(*) FROM domaine WHERE domaine.libelle = nomDomaine) <> 0  THEN
        RAISE EXCEPTION 'Ce nom de domaine a déjà été proposé';
END IF;
	IF nomDomaine = '' THEN
		RAISE EXCEPTION 'Le nom du domaine est obligatoire';
END IF;
INSERT INTO domaine (idabonnepropo, libelle) VALUES (idAbo, nomDomaine);
END;
$$
LANGUAGE plpgsql;

CREATE OR REPLACE FUNCTION RechercheMotCle(keyword varchar(30), archive boolean)
RETURNS TABLE(idNews integer,
    titre varchar(30),
    contenu text,
    datePublication date,
    etatN etat,
	pseudo varchar(30))
AS $$
DECLARE
MC integer;
BEGIN
	IF (SELECT COUNT(*) FROM mot_cle WHERE mot_cle.libelle = keyword) = 0  THEN
		RAISE EXCEPTION 'Le mot clÃ© est introuvable';
END IF;
SELECT idmotcle INTO MC FROM mot_cle WHERE libelle = keyword;
IF archive = TRUE THEN
	RETURN QUERY(SELECT n.idarchive,
        n.titre,
        n.contenu,
        n.datePublication,
        n.etata,
		ab.pseudo
            FROM archive_news n
			INNER JOIN abonne ab ON n.idabonnep = ab.idabonne
				 WHERE MC = n.idMotCle1
				 OR MC = n.idMotCle2
				 OR MC = n.idMotCle3);
ELSE
	RETURN QUERY(SELECT n.idNews,
        n.titre,
        n.contenu,
        n.datePublication,
        n.etatN,
		ab.pseudo
            FROM news n
			INNER JOIN abonne ab ON n.idabonne = ab.idabonne
				 WHERE MC = n.idMotCle1
				 OR MC = n.idMotCle2
				 OR MC = n.idMotCle3);
END IF;
END;
$$
LANGUAGE plpgsql;

--- Jeu de données ---

-- Comptes
INSERT into compte(pseudo,mdp)
VALUES
    ('MrGalila','6cc100db94bd48ecae0941f8da2c6528b1867af37047ccfad60c2b9d15bb5449'),
    ('doriantLeDodo','d67d2e60f5c2b245a0b7295e532fba3b79e4568cb4c8397448a2adfeebd11afd'),
    ('chouchou','9416e44ec417b731d19f58af13bde42653504ea1640ab5a235926ee0b1ab4503'),
    ('MonPereCDieu','e911010bc1050c52a42b645bad31e60ba2029384ef919603ab48adea2fae2a6c'),
    ('admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918');

INSERT into abonne(nom,prenom,email,telephone,dateInscription,admin,confiance,pseudo)
VALUES
    ('Admin','Admin','admin@mail.com',0612345678,'2019-07-23',true,true,'admin'),
    ('Ziehl','Benjamin','TauraPasMonMail@Lustucru.com',0349586547,'2020-05-11',false,true,'MrGalila'),
    ('Doriant','Bourade','doriantBourade@Lustucru.com',0232145685,'2020-06-13',false,true,'doriantLeDodo'),
    ('Michel','Poiret','michelPoiret@Lustucru.com',0345689574,'1787-07-09',false,false,'chouchou'),
    ('Christ','Jesus','FukLesCroix@Hippie.com',0101010101,'0001-01-01',false,true,'MonPereCDieu');

-- Domaines
INSERT into domaine(idAbonnePropo, libelle, estAccepte)
VALUES
    (2,'Sciences',true),
    (4,'Technologie',true),
    (1,'Sport',true),
    (2,'Jeux vidéo',false),
    (2,'Politique',true),
    (5,'Environnement',null),
    (4,'Transport',false),
    (3,'Nourriture',null);

-- Interet
INSERT into interet(idAbonne, idDomaine)
VALUES
    (2, 1),
    (4, 2),
    (2, 4),
    (1, 3),
    (3, 2),
    (5, 1),
    (3, 3),
    (2, 5),
    (5, 4),
    (4, 3),
    (4, 2),
    (1, 5),
    (2, 2);

-- Mots clés
INSERT INTO mot_cle (libelle) VALUES ('chat')
                                   ,('chien')
                                   ,('cuisine')
                                   ,('etudiant')
                                   ,('famille')
                                   ,('loi')
                                   ,('vaccin')
                                   ,('maladie')
                                   ,('monnaie virtuel')
                                   ,('chasse');

-- News
INSERT into news(idAbonne, idDomaine, idMotCle1, idMotCle2, idMotCle3, titre, contenu, datePublication, dureeAffichage, etatN)
VALUES
    (2,1,2,null,null,'pourquoi le feminisme moderne est rejeté','Aujourd''hui, les féministes ne se battent plus pour les femme, mais pour une égalité de résultat injuste et un musèlement sévère et toxique de la personnalité masculine, résultat, la majorité des femme ne veulent pas être associés à ce mouvement qui n''a plus rien à voir avec son identité originel', '2022-01-05', '2 day', 'nonvalidé'),
    (5,2,5,null,null,'Pourquoi voter Zemmour','Il a de bonnes punchline et il dit Ben voyons', '2022-01-03', '4 day', 'validé'),
    (4,2,4,5,null,'Nouveau jeu vidéo de l''année','Le nouveau jeu vidéo créé par les studios californiens est en train de devenir le nouveau jeu de la décennie avec ses 100 milliards de ventes physiques. C''est incroyable !','2022-01-09','10 day','fausse'),
    (4, 4, 5 , null, null, 'La mort de la créativité dans le monde du jeu vidéo', 'La créativité dans le monde du jeu vidéo est en déclin, aujourd''hui seul les studios indépendants essayent des styles de jeux et idées nouvelles et innovantes. Ce mouvement a été lancé par le studio de jeux vidéo breton Ubisoft qui est resté sur ses acquis en sortant uniquement des suites à leurs jeux... <a href="autres/hehe.mp4">Appuyer pour voir plus...</a>', '2021-12-22', '5 day', 'validé');

-- News archivées
INSERT into archive_news(idAbonneP, idAbonneE, idDomaine, idMotCle1, idMotCle2, idMotCle3, titre, contenu, datePublication, dureeAffichage, etatA)
VALUES
    (3,2,2,4,null,null,'Robot qui aide les étudiants', 'Elon Musk, le célébre entrepreneur américain vient de dévoiler au monde entier son nouveau robot complétement autonome. En effet, celui-ci va permettre d''aider la plupart des étudiants dans leur tâches ménagères. Ils auront donc plus de temps pour étudier tels des étudiants sérieux...','2021-09-12','12 day','validé');


-- Paramètres
INSERT INTO parametre VALUES (14,3,5,1);
