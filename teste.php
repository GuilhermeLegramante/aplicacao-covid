<?php

global $pdo;
$nome_bd = "covid19";
$host = "localhost";
$user = "root";
$pass = "";

try {
  $pdo = new PDO("mysql:dbname=" . $nome_bd . ";host=" . $host, $user, $pass);
} catch (PDOException $e) {
  $msgErro = $e->getMessage();
}

$email = "guilhermelegramante@gmail.com";

$sql = $pdo->prepare("SELECT bairro FROM voluntarios WHERE email = :e");
$sql->bindValue(":e", $email);
$sql->execute();

if ($sql->rowCount() > 0) {
  $dados = $sql->fetch();
  $bairro = $dados['bairro'];

  print_r($bairro);
  
}
