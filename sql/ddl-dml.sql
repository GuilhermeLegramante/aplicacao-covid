CREATE SCHEMA IF NOT EXISTS `covid19` DEFAULT CHARACTER SET utf8;
USE `covid19` ;

CREATE TABLE usuarios(
    idusuario INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(30),
    senha VARCHAR(32)
);
CREATE TABLE voluntarios(
    idvoluntario int AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(45),
    email VARCHAR(30),
    senha VARCHAR(32),
    telefone VARCHAR(20),
    cep VARCHAR(10),
    rua VARCHAR(45),
    numero VARCHAR(10),
    bairro VARCHAR(30),
    cidade VARCHAR(30),
    uf VARCHAR(2),
    raioAtuacao VARCHAR(3),
    identidade VARCHAR(15),
    fotoDoc VARCHAR(45),
    fotoVerificacao VARCHAR(45)
);
CREATE TABLE vulneraveis(
    idvoluntario int AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(45),
    email VARCHAR(30),
    senha VARCHAR(32),
    telefone VARCHAR(20),
    cep VARCHAR(10),
    rua VARCHAR(45),
    numero VARCHAR(10),
    bairro VARCHAR(30),
    cidade VARCHAR(30),
    uf VARCHAR(2),
    identidade VARCHAR(15),
    fotoDoc VARCHAR(45),
    fotoVerificacao VARCHAR(45)
);


INSERT INTO `usuarios` (`idusuario`, `usuario`, `senha`) VALUES (NULL, 'teste', '202cb962ac59075b964b07152d234b70');