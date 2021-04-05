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

insert into usuarios (nome,email,usuario,senha) 
values('AdminWap','admin@mundowap.com.br','Admin','$2y$10$ja8cwOH5fDxT0Zaz3k0tVe0tGBt60vdlQhxK6xyH7zuRakCxrdpAm');