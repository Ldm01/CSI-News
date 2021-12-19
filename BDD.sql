-- Database: GestionNews

-- DROP DATABASE "GestionNews";

CREATE DATABASE "GestionNews"
    WITH 
    OWNER = postgres
    ENCODING = 'UTF8'
    LC_COLLATE = 'French_France.1252'
    LC_CTYPE = 'French_France.1252'
    TABLESPACE = pg_default
    CONNECTION LIMIT = -1;

-- Table: public.Abonne

-- DROP TABLE public."Abonne";

CREATE TABLE IF NOT EXISTS public."Abonne"
(
    nom "char" NOT NULL,
    prenom "char" NOT NULL,
    email "char" NOT NULL,
    telephone integer,
    "dateInscription" date NOT NULL,
    admin boolean NOT NULL,
    confiance boolean NOT NULL,
    "idAbonne" integer NOT NULL DEFAULT nextval('"Abonne_idAbonne_seq"'::regclass)
)

TABLESPACE pg_default;

ALTER TABLE public."Abonne"
    OWNER to postgres;

-- Table: public.Archive_News

-- DROP TABLE public."Archive_News";

CREATE TABLE IF NOT EXISTS public."Archive_News"
(
    "idArchive" integer NOT NULL DEFAULT nextval('"Archive_News_idArchive_seq"'::regclass),
    titre "char" NOT NULL,
    contenu text COLLATE pg_catalog."default" NOT NULL,
    "datePublication" date NOT NULL,
    "dateArchivage" date NOT NULL,
    "etatA" "char" NOT NULL,
    CONSTRAINT "Archive_News_pkey" PRIMARY KEY ("idArchive")
)

TABLESPACE pg_default;

ALTER TABLE public."Archive_News"
    OWNER to postgres;

-- Table: public.Compte

-- DROP TABLE public."Compte";

CREATE TABLE IF NOT EXISTS public."Compte"
(
    pseudo character(1) COLLATE pg_catalog."default" NOT NULL,
    mdp "char" NOT NULL,
    CONSTRAINT "Compte_pkey" PRIMARY KEY (pseudo)
)

TABLESPACE pg_default;

ALTER TABLE public."Compte"
    OWNER to postgres;

-- Table: public.Domaine

-- DROP TABLE public."Domaine";

CREATE TABLE IF NOT EXISTS public."Domaine"
(
    "idDomaine" integer NOT NULL DEFAULT nextval('"Domaine_idDomaine_seq"'::regclass),
    libelle "char" NOT NULL,
    "estAccepte" boolean,
    CONSTRAINT "Domaine_pkey" PRIMARY KEY ("idDomaine")
)

TABLESPACE pg_default;

ALTER TABLE public."Domaine"
    OWNER to postgres;

-- Table: public.Etude

-- DROP TABLE public."Etude";

CREATE TABLE IF NOT EXISTS public."Etude"
(
    justification "char",
    "dateEtude" date
)

TABLESPACE pg_default;

ALTER TABLE public."Etude"
    OWNER to postgres;

-- Table: public.Interet

-- DROP TABLE public."Interet";

CREATE TABLE IF NOT EXISTS public."Interet"
(
)

TABLESPACE pg_default;

ALTER TABLE public."Interet"
    OWNER to postgres;

-- Table: public.Mot_cle

-- DROP TABLE public."Mot_cle";

CREATE TABLE IF NOT EXISTS public."Mot_cle"
(
    libelle "char" NOT NULL,
    "idMotCle" integer NOT NULL DEFAULT nextval('"Mot_cle_idMotCle_seq"'::regclass),
    CONSTRAINT "Mot_cle_pkey" PRIMARY KEY ("idMotCle")
)

TABLESPACE pg_default;

ALTER TABLE public."Mot_cle"
    OWNER to postgres;

-- Table: public.News

-- DROP TABLE public."News";

CREATE TABLE IF NOT EXISTS public."News"
(
    "idNews" integer NOT NULL DEFAULT nextval('"News_idNews_seq"'::regclass),
    titre "char" NOT NULL,
    contenu text COLLATE pg_catalog."default" NOT NULL,
    "datePublication" date NOT NULL,
    "etatN" character(1) COLLATE pg_catalog."default" NOT NULL,
    CONSTRAINT "News_pkey" PRIMARY KEY ("idNews")
)

TABLESPACE pg_default;

ALTER TABLE public."News"
    OWNER to postgres;

-- Table: public.Parametre

-- DROP TABLE public."Parametre";

CREATE TABLE IF NOT EXISTS public."Parametre"
(
    "dureeAffichage" time without time zone NOT NULL,
    "nbEtudeSansRepMax" integer NOT NULL,
    "nbNewsMinAboConf" integer NOT NULL,
    "dureeEtude" time without time zone NOT NULL
)

TABLESPACE pg_default;

ALTER TABLE public."Parametre"
    OWNER to postgres;
