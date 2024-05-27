--Créer une base de données nommée "linkedin" et une table nommée "users" pour accueuillir les données genre mail et mot de passe avec un ID unique qui s'incrémente et un token pour la session cookie
CREATE DATABASE IF NOT EXISTS linkedin;
USE linkedin;
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    token VARCHAR(255) NOT NULL
);

INSERT INTO users (email, password, token) VALUES ('email@exemple.com', 'password', 'token');

-- Path: SQL/insert.sql