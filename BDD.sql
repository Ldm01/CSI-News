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




-- Table: public.Compte

-- DROP TABLE public."Compte";

CREATE TABLE IF NOT EXISTS compte
(
    pseudo char NOT NULL,
    mdp char NOT NULL,
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
    pseudo char NOT NULL,
    nom char NOT NULL,
    prenom char NOT NULL,
    email char NOT NULL,
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
    idAbonnePropo serial,
    libelle char NOT NULL,
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
    idAbonne serial,
    idDomaine serial,
    FOREIGN KEY(idAbonne) REFERENCES abonne(idAbonne),
    FOREIGN KEY(idDomaine) REFERENCES domaine(idDomaine),
    PRIMARY KEY (idAbonne)
    )

    TABLESPACE pg_default;

ALTER TABLE interet
    OWNER to postgres;





-- Table: public.Mot_cle

-- DROP TABLE public."Mot_cle";

CREATE TABLE IF NOT EXISTS mot_cle
(
    idMotCle serial NOT NULL,
    libelle char NOT NULL,
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
    idAbonne serial,
    idDomaine serial,
    idMotCle1 serial,
    idMotCle2 serial,
    idMotCle3 serial,
    titre char NOT NULL,
    contenu text COLLATE pg_catalog."default" NOT NULL,
    datePublication date NOT NULL,
    etatN character(1) COLLATE pg_catalog."default" NOT NULL,
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
    idAbonneP serial,
    idAbonneE serial,
    idDomaine serial,
    idMotCle1 serial,
    idMotCle2 serial,
    idMotCle3 serial,
    titre "char" NOT NULL,
    contenu text COLLATE pg_catalog."default" NOT NULL,
    datePublication date NOT NULL,
    dateArchivage date NOT NULL,
    etatA char NOT NULL,
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
    idAbonne serial,
    idNews serial,
    FOREIGN KEY(idAbonne) REFERENCES abonne(idAbonne),
    FOREIGN KEY(idNews) REFERENCES news(idNews),
    justification "char",
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
    dureeAffichage time without time zone NOT NULL,
    nbEtudeSansRepMax integer NOT NULL,
    nbNewsMinAboConf integer NOT NULL,
    dureeEtude time without time zone NOT NULL
)

    TABLESPACE pg_default;

ALTER TABLE parametre
    OWNER to postgres;

CREATE ROLE administrateur;
GRANT ALL PRIVILEGES ON ALL TABLES IN SCHEMA public TO administrateur;
ALTER ROLE administrateur WITH LOGIN;


CREATE ROLE abonne;
GRANT SELECT ON domaine, news, mot_cle, archive_news TO abonne;
GRANT INSERT ON domaine, news, mot_cle TO abonne;
ALTER ROLE abonne WITH LOGIN;

CREATE ROLE utilisateur;
GRANT SELECT ON news, mot_cle TO utilisateur;
GRANT INSERT ON compte TO utilisateur;
ALTER ROLE utilisateur WITH LOGIN;