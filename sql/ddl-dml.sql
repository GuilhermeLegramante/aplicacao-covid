CREATE DATABASE covid19; USE
    covid19;
CREATE TABLE usuarios(
    idusuario INT AUTO_INCREMENT PRIMARY KEY,
    usuario VARCHAR(30),
    senha VARCHAR(32)
);

INSERT INTO `usuarios` (`idusuario`, `usuario`, `senha`) VALUES (NULL, 'teste', '202cb962ac59075b964b07152d234b70');