CREATE DATABASE meetic;
USE meetic;
CREATE TABLE meetic (
    id              INT             NOT NULL AUTO_INCREMENT,
    name            VARCHAR(255)    NOT NULL UNIQUE,
    lastname        VARCHAR(255)    NOT NULL,
    password        VARCHAR(255)    NOT NULL UNIQUE,
    email           VARCHAR(255)    NOT NULL UNIQUE,
    date            DATETIME        NOT NULL DEFAULT NOW(),
    genre           VARCHAR(255)    NOT NULL,
    hobbies         VARCHAR(255)    NOT NULL,
    PRIMARY KEY (id)
);

-- SQL utile:
-- Supprimer la table: DROP TABLE utilisateur;
-- Supprimer les données de la table: TRUNCATE TABLE utilisateur;
-- Créer la table utilisateur: CREATE TABLE meetic (id INT AUTO_INCREMENT PRIMARY KEY, email VARCHAR(255), password VARCHAR(255), genre VARCHAR(255))
-- AUTO_INCREMENT pour que l'id increment tout seul (1, 2, 3....)
-- Ajouter un champ en SQL: ALTER TABLE utilisateur ADD lastname VARCHAR(255);
