drop table if exists offre;
drop table if exists personne;
drop table if exists postuler;
drop table if exists sauvegarder;
drop table if exists est_dispo;

create table offre (
    offre_id integer not null primary key auto_increment,
    type varchar(255) not null,
    titre varchar(255) not null,
    entreprise varchar(255) not null,
    valide boolean not null DEFAULT 0,
    secteur varchar(255) not null,
    lieu varchar(255) not null,
    remuneration float not null,
    contact varchar(255) not null,
    fichier varchar(255),
    offre_code varchar(255) not null,
    description varchar(4095) not null,
    date_creation integer not null,
    date_validation integer not null,
    nom_contact varchar(255) not null
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table personne (
    personne_id integer not null primary key auto_increment,
    role varchar(255) not null,
    adherent boolean not null DEFAULT 0,
    login varchar(255) not null,
    password varchar(255) not null,
    nom varchar(255) not null,
    prenom varchar(255) not null,
    mail varchar(255) not null,
    promotion integer not null,
    adresse varchar(255) not null,
    telephone varchar(255) not null,
    site varchar(255) not null,
    photo varchar(255) not null,
    bio varchar(4095) not null
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table postuler (
    postuler_id integer not null primary key auto_increment,
    offre_id integer not null,
    personne_id integer not null
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table sauvegarder (
    sauvegarder_id integer not null primary key auto_increment,
    offre_id integer not null,
    personne_id integer not null
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table creer (
    creer_id integer not null primary key auto_increment,
    offre_id integer not null,
    personne_id integer not null
) engine=innodb character set utf8 collate utf8_unicode_ci;

create table est_indispo (
    est_indispo_id integer not null primary key auto_increment,
    offre_id integer not null,
    personne_id integer not null
) engine=innodb character set utf8 collate utf8_unicode_ci;
