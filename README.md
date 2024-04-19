# Installation SQL
Pour créer la base de donnée, exécuter les requêtes SQL

```
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

```
