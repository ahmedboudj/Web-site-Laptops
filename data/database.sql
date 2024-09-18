drop database if exists Laptop;
create database Laptop;
use Laptop;

# Role
create table Role 
(
    id_role     int primary key auto_increment not null,
    description varchar(30)
);

INSERT INTO `role` (`id_role`, `description`) VALUES
(1, 'admin'),
(2, 'client');

# Adresse
create table Adresse
(
    id_adresse  int primary key auto_increment not null,
    rue         int                            not null,
    code_postal varchar(10)                    not null,
    ville       varchar(50)                    not null,
    numero      varchar(10),
    province    varchar(20)                    not null
);

# Utilisateur
create table Utilisateur
(
    id_utilisateur   int primary key auto_increment not null,
    nom              varchar(50)                    not null,
    prenom           varchar(50),
    email            varchar(100)                   not null,
    numero_telephone varchar(50)                    not null,
    adresse          varchar(50)                    not null,
    code_postal      varchar(50)                    not null,
    id_role          int,
    mot_de_passe     varchar(255)                   not null
);

INSERT INTO `Utilisateur` (`id_utilisateur`, `nom`, `prenom`, `email`, `numero_telephone`, `adresse` , `code_postal` , `id_role`,`mot_de_passe`)
VALUES(1, 'BOUDJEMAA', 'AHMED', 'lamimoza01@hotmail.fr', '0555','Boul Rosemont', 'H1X 5BX' , 1, '$2y$10$42CRGqRWUpPwG7vz7jPQZ.gbuRcI5uwAlvLvP7mlSF6g9a4pbfKiO');

# UtilisateurAdresse
create table UtilisateurAdresse
(
    id_utilisateur int,
    id_adresse     int
);

# laptop
create table laptop
(
    id_laptop          int primary key auto_increment not null,
    nom                varchar(255)                   not null,
    description        text,
    courte_description varchar(255),
    quantite           int                            not null,
    prix               varchar(7)                     not null
);

# Image
CREATE TABLE Image (
    id_image INT PRIMARY KEY AUTO_INCREMENT NOT NULL,
    id_laptop INT,
    chemin_image VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_laptop) REFERENCES laptop(id_laptop) ON DELETE CASCADE ON UPDATE CASCADE
);


# Commande
create table Commande
(
    id_commande    int primary key auto_increment not null,
    quantite       int                            not null,
    prix           varchar(10)                    not null,
    date_creation  date                           not null,
    status         varchar(50)                    not null,
    id_utilisateur int,
    foreign key (id_utilisateur) references Utilisateur (id_utilisateur) on delete cascade on update cascade
);

# ProduitCommande
create table ProduitCommande
(
    id_commande int,
    id_laptop     int,
    foreign key (id_commande) references Commande (id_commande),
    foreign key (id_laptop) references Laptop (id_laptop)
);

# modification des tables

# UtilisateurAdresse
alter table UtilisateurAdresse
    add constraint fk_utilisateur_adresse
        foreign key (id_utilisateur) references Utilisateur (id_utilisateur),
    add constraint fk_adresse_utilisateur
        foreign key (id_adresse) references Adresse (id_adresse);

