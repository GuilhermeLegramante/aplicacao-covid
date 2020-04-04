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

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$senha = $_POST['senha'];
$senhaCrip = md5($senha);
$telefone = $_POST['telefone'];
$cep = $_POST['cep'];
$rua = $_POST['rua'];
$numero = $_POST['numero'];
$bairro = $_POST['bairro'];
$cidade = $_POST['cidade'];
$uf = $_POST['uf'];
//$raioAtuacao = $_POST['raioAtuacao'];
$identidade = $_POST['identidade'];

/*
    if (isset($_FILES['fotoIdentidade']) && isset($_FILES['fotoVerificacao'])) {
    date_default_timezone_set("Brazil/East"); //Definindo timezone padrão

    $extIdt = strtolower(substr($_FILES['fotoIdentidade']['name'], -4)); //Pegando extensão do arquivo
    $extVer = strtolower(substr($_FILES['fotoVerificacao']['name'], -4)); //Pegando extensão do arquivo

    $new_name_idt = "voluntario_idt_" . $identidade . $extIdt; //Definindo um novo nome para o arquivo
    $new_name_ver = "voluntario_ver_" . $identidade . $extVer; //Definindo um novo nome para o arquivo

    $fotoIdentidade = $new_name_idt;
    $fotoVerificacao = $new_name_ver;

    $dir = '../uploads/'; //Diretório para uploads

    move_uploaded_file($_FILES['fotoIdentidade']['tmp_name'], $dir . $new_name_idt); //Fazer upload do arquivo
    move_uploaded_file($_FILES['fotoVerificacao']['tmp_name'], $dir . $new_name_ver); //Fazer upload do arquivo

}

*/

if (isset($_FILES['fotoIdentidade'])) {
    date_default_timezone_set("Brazil/East"); //Definindo timezone padrão

    $extIdt = strtolower(substr($_FILES['fotoIdentidade']['name'], -4)); //Pegando extensão do arquivo

    $new_name_idt = "gp_risco_idt_" . $identidade . $extIdt; //Definindo um novo nome para o arquivo

    $fotoIdentidade = $new_name_idt;

    $dir = '../uploads/'; //Diretório para uploads

    move_uploaded_file($_FILES['fotoIdentidade']['tmp_name'], $dir . $new_name_idt); //Fazer upload do arquivo

}

try {
    $stmt = $pdo->prepare("INSERT INTO vulneraveis (cadValidado, nome, cpf, email, senha, telefone, cep, rua, numero, bairro,
    cidade, uf, identidade, fotoDoc, fotoVerificacao) VALUES(:cadValidado, :nome, :cpf, :email, :senha, :telefone, 
    :cep, :rua, :numero, :bairro, :cidade, :uf, :identidade, :fotoDoc, :fotoVerificacao)");
    $stmt->bindValue(":cadValidado", 0);
    $stmt->bindValue(":cpf", $cpf);
    $stmt->bindValue(":nome", $nome);
    $stmt->bindValue(":email", $email);
    $stmt->bindValue(":senha", $senhaCrip);
    $stmt->bindValue(":telefone", $telefone);
    $stmt->bindValue(":cep", $cep);
    $stmt->bindValue(":rua", $rua);
    $stmt->bindValue(":numero", $numero);
    $stmt->bindValue(":bairro", $bairro);
    $stmt->bindValue(":cidade", $cidade);
    $stmt->bindValue(":uf", $uf);
    $stmt->bindValue(":identidade", $identidade);
    $stmt->bindValue(":fotoDoc", $fotoIdentidade);
    $stmt->bindValue(":fotoVerificacao", "");
    $stmt->execute();

    header("location: ../sucesso.php");

} catch (PDOException $e) {
    echo 'Error: ' . $e->getMessage();

    header("location: ../erro.php");
} 
