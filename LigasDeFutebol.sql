DROP DATABASE IF EXISTS LigasDeFutebol;
CREATE DATABASE LigasDeFutebol;
USE LigasDeFutebol;

CREATE TABLE tipo_user (
    id_tipo INT PRIMARY KEY,
    descritivo VARCHAR(255)
);

CREATE TABLE user (
    id_user INT PRIMARY KEY,
    username VARCHAR(255),
    nome VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255),
    foto VARCHAR(255),
    tipo INT,
    FOREIGN KEY (tipo) REFERENCES tipo_user(id_tipo)
);

CREATE TABLE liga (
    id_liga INT PRIMARY KEY,
    nome VARCHAR(255),
    pais VARCHAR(255),
    logotipo VARCHAR(255)
);

CREATE TABLE clubes (
    id_clube INT PRIMARY KEY,
    liga INT,
    nome VARCHAR(255),
    cidade VARCHAR(255),
    logotipo VARCHAR(255),
    FOREIGN KEY (liga) REFERENCES liga(id_liga)
);

CREATE TABLE clubes_favoritos (
    id INT PRIMARY KEY,
    user INT,
    clube INT,
    FOREIGN KEY (user) REFERENCES user(id_user),
    FOREIGN KEY (clube) REFERENCES clubes(id_clube)
);

INSERT INTO tipo_user
VALUES 
(0,'Admin'),
(1,'Utilizador');

INSERT INTO user
VALUES
(0, "administrador", "administrador", "admin@admin.admin", "admin", "admin.png", 0),
(1, "hugodiniz", "Hugo Diniz", "hugodinis2001@gmail.com", "hugodiniz", "hugo.png", 0),
(2, "paulo", "Paulo Novo", "paulonovo@gmail.com", "joaopaulo", "joao.png", 1);

INSERT INTO liga
VALUES
(0, "Liga Portugal", "Portugal", "LigaPortugal.png"),
(1, "LaLiga", "Espanha", "LaLiga.png"),
(2, "Premier League", "Inglaterra", "PremierLeague.png"),
(3, "Ligue 1", "França", "Ligue1.png"),
(4, "Bundesliga", "Alemanha", "Bundesliga.png");

INSERT INTO clubes
VALUES
(0, 0, "Sporting CP", "Lisbon", "Sporting.png"),
(1, 0, "SL Benfica", "Lisbon", "Benfica.png"),
(2, 0, "FC Porto", "Oporto", "Porto.png"),
(3, 1, "Real Madrid", "Madrid", "RealMadrid.png"),
(4, 1, "FC Barcelona", "Barcelona", "Barcelona.png"),
(5, 1, "Atlético Madrid", "Madrid", "AtleticoMadrid.png"),
(6, 2, "Manchester City", "Manchester", "City.png"),
(7, 2, "Liverpool FC", "Liverpool", "Liverpool.png"),
(8, 2, "Chelsea", "London", "Chelsea.png"),
(9, 3, "Paris SG", "Paris", "PSG.png"),
(10, 3, "Olympique de Marseille", "Marseille", "Marseille.png"),
(11, 3, "AS Monaco", "Monaco", "Monaco.png"),
(12, 4, "FC Bayern", "Munich", "Bayern.png"),
(13, 4, "Borussia Dortmund", "Dortmund", "Dortmund.png"),
(14, 4, "Bayer Leverkusen", "Leverkusen", "Leverkusen.png");

