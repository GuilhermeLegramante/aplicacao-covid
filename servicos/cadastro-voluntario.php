<?php


define("SERVER", "localhost");
define("USER", "root");
define("PASSWORD", "");
define("DB", "covid19");

if(isset($_POST['nome'])){
  $nome = $_POST['nome'];
} else {
  $nome = "";
}

if(isset($_POST['cpf'])){
  $cpf = $_POST['cpf'];
} else {
  $cpf = "";
}

if(isset($_POST['email'])){
  $email = $_POST['email'];
} else {
  $email = "";
}

if(isset($_POST['senha'])){
  $senha = $_POST['senha'];
  $senhaCrip = md5($senha);
} else {
  $senha = "";
  $senhaCrip = md5($senha);
}

if(isset($_POST['telefone'])){
  $telefone = $_POST['telefone'];
} else {
  $telefone = "";
}

if(isset($_POST['cep'])){
  $cep = $_POST['cep'];
} else {
  $cep = "";
}

if(isset($_POST['rua'])){
  $rua = $_POST['rua'];
} else {
  $rua = "";
}

if(isset($_POST['numero'])){
  $numero = $_POST['numero'];
} else {
  $numero = "";
}

if(isset($_POST['bairro'])){
  $bairro = $_POST['bairro'];
} else {
  $bairro = "";
}

if(isset($_POST['cidade'])){
  $cidade = $_POST['cidade'];
} else {
  $cidade = "";
}

if(isset($_POST['uf'])){
  $uf = $_POST['uf'];
} else {
  $uf = "";
}

if(isset($_POST['raioAtuacao'])){
  $raioAtuacao = $_POST['raioAtuacao'];
} else {
  $raioAtuacao = "";
}

if(isset($_POST['longitude'])){
  $longitude = $_POST['longitude'];
} else {
  $longitude = "";
}

if(isset($_POST['latitude'])){
  $latitude = $_POST['latitude'];
} else {
  $latitude = "";
}

if(isset($_POST['identidade'])){
  $identidade = $_POST['identidade'];
} else {
  $identidade = "";
}

$mysql = new mysqli(SERVER, USER, PASSWORD, DB);
$response = array();

if ($mysql->connect_error) {

  $response["MESSAGE"] = "Erro no servidor";
  $response["STATUS"] = 500;
} else {
  if (is_uploaded_file($_FILES["fotoDoc"]["tmp_name"])) {

    $tmp_file = $_FILES["fotoDoc"]["tmp_name"];

    $fotoDoc_path = $_FILES["fotoDoc"]["name"];
    $upload_dir_idt = "../uploads/" . $fotoDoc_path;

    $sql = "INSERT INTO voluntarios (nome,cpf,email,senha,telefone,cep,rua,numero,bairro,cidade,uf,raioAtuacao,identidade,fotoDoc,fotoVerificacao,latitude,longitude) 
    VALUES ('{$nome}','{$cpf}','{$email}','{$senhaCrip}','{$telefone}','{$cep}','{$rua}','{$numero}','{$bairro}','{$cidade}','{$uf}','{$raioAtuacao}',
    '{$identidade}','{$fotoDoc_path}','{$latitude}','{$longitude}')";

    if (move_uploaded_file($tmp_file, $upload_dir_idt) && $mysql->query($sql)) {

      $response["MESSAGE"] = "Sucesso no upload.";
      $response["STATUS"] = 200;

    } else {

      $response["MESSAGE"] = "Falha no upload";
      $response["STATUS"] = 404;
    }
  } else {

    $response["MESSAGE"] = "Requisição inválida";
    $response["STATUS"] = 400;

  }
}

echo json_encode($response);
