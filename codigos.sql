CREATE DATABASE wapDB;

USE wapDB;

CREATE TABLE tabelaup (
    id int NOT NULL AUTO_INCREMENT,
    ean int NOT NULL,
    nome_produto varchar(100) NOT NULL,
    preco float NOT NULL,
    estoque int NOT NULL,
    data_fabricacao Date DEFAULT NULL,
    PRIMARY KEY (id)
);

CREATE TABLE usuarios (
    id int NOT NULL AUTO_INCREMENT,
    nome varchar(200) NOT NULL,
    email varchar(200) NOT NULL,
    usuario varchar(200) NOT NULL,
    senha varchar(200) NOT NULL,
    PRIMARY KEY (id)
);