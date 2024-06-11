CREATE DATABASE ligasdefutebol;
USE ligasdefutebol;

CREATE TABLE tipo_user (
    id_tipo INT NOT NULL AUTO_INCREMENT,
    descritivo VARCHAR(255),
    PRIMARY KEY(id_tipo)
);

CREATE TABLE user (
    id_user INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255),
    email VARCHAR(255),
    password VARCHAR(255),
    tipo INT,
    PRIMARY KEY(id_user), 
    FOREIGN KEY (tipo) REFERENCES tipo_user(id_tipo)
);

CREATE TABLE liga (
    id_liga INT NOT NULL AUTO_INCREMENT,
    nome VARCHAR(255),
    pais VARCHAR(255),
    logotipo VARCHAR(255),
    PRIMARY KEY(id_liga)
);

CREATE TABLE clubes (
    id_clube INT NOT NULL AUTO_INCREMENT,
    liga INT,
    nome VARCHAR(255),
    cidade VARCHAR(255),
    logotipo VARCHAR(255),
    PRIMARY KEY(id_clube),
    FOREIGN KEY (liga) REFERENCES liga(id_liga)
);

CREATE TABLE clubes_favoritos (
    id INT NOT NULL AUTO_INCREMENT,
    user INT,
    clube INT,
    PRIMARY KEY(id),
    FOREIGN KEY (user) REFERENCES user(id_user),
    FOREIGN KEY (clube) REFERENCES clubes(id_clube)
);

INSERT INTO tipo_user
VALUES 
(0,'Admin'),
(1,'Utilizador');

INSERT INTO user (id_user, nome, email, password, tipo)
VALUES
(1, "administrador", "admin@admin.admin", "admin", 0),
(2, "Hugo Diniz", "hugodinis2001@gmail.com", "hugodiniz", 0),
(3, "Paulo Novo", "paulonovo@gmail.com", "joaopaulo", 1);

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

