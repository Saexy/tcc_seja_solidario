CREATE DATABASE db_sejasolidario;

USE db_sejasolidario;

CREATE TABLE doacao_doador(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_doador INT NOT NULL,
    tipo VARCHAR(25) NOT NULL,
    datadoacao DATE NOT NULL,
    detalhes TEXT NOT NULL 
);

CREATE TABLE doacao_donatario(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    id_donatario INT NOT NULL,
    tipo VARCHAR(25) NOT NULL,
    datadoacao DATE NOT NULL,
    detalhes TEXT NOT NULL 
);

CREATE TABLE usuario_admin(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(125) NOT NULL,
    senha VARCHAR(80) NOT NULL
);

INSERT INTO usuario_admin(id, email, senha) VALUES('sejasolidario@admin.com', 'adminseja');

CREATE TABLE usuario_doador(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(150) NOT NULL,
    celular VARCHAR(15) NOT NULL,
    email VARCHAR(125) NOT NULL,
    senha VARCHAR(80) NOT NULL,
    endereco VARCHAR(150) NOT NULL,
    numerocasa VARCHAR(10) NOT NULL,
    sexo VARCHAR(15) NOT NULL
);

CREATE TABLE usuario_donatario(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(150) NOT NULL,
    celular VARCHAR(15) NOT NULL,
    email VARCHAR(125) NOT NULL,
    senha VARCHAR(80) NOT NULL,
    endereco VARCHAR(150) NOT NULL,
    numerocasa VARCHAR(10) NOT NULL,
    sexo VARCHAR(15) NOT NULL
);