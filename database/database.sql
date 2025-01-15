CREATE DATABASE youdemy;
USE youdemy;
CREATE TABLE user (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(20) UNIQUE ,
    prenom VARCHAR(20) UNIQUE ,
    email VARCHAR(150) UNIQUE,
    passworde VARCHAR(300) UNIQUE,
    rolee ENUM('Etudiant','Enseignant'),
    statut ENUM('active', 'suspended', 'pending') DEFAULT 'pending'
);
CREATE Table admin(
    ID INT AUTO_INCREMENT PRIMARY KEY,
     email VARCHAR(150) UNIQUE,
    passworde VARCHAR(300) UNIQUE
);
CREATE TABLE cours(
    ID INT AUTO_INCREMENT PRIMARY KEY,
    titre VARCHAR(20),
    descriptione VARCHAR(500),
    Enseignant INT,
    contenu LONGBLOB,
    Foreign Key (Enseignant) REFERENCES user(ID)
);
CREATE TABLE tag(
    ID INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(20)
);
CREATE TABLE tag_cours(
    id_cours INT,
    id_tag INT,
    Foreign Key (id_cours) REFERENCES cours(ID),
    Foreign Key (id_tag) REFERENCES tag(ID)
);
CREATE TABLE categorie(
    ID INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(20)
);
CREATE TABLE inscriptions(
    ID INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    cours_id INT,
    Foreign Key (user_id) REFERENCES user(ID),
    Foreign Key (cours_id) REFERENCES cours(ID)
);