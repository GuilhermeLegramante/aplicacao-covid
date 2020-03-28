<?php
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

$app->get('/', function () {
    echo "Bem-vindo a API do Sistema de Clientes";
});

$GLOBALS["db"] = "covid19";

$app->post('/login', function () use ($app) {
    $req = $app->request();

    $retorno = array();
    global $pdo;
    $nome = "covid19";
    $host = "localhost";
    $user = "root";
    $pass = "";

    try {
        $pdo = new PDO("mysql:dbname=" . $nome . ";host=" . $host, $user, $pass);
    } catch (PDOException $e) {
        $msgErro = $e->getMessage();
    }

    $usuario = $req->post('usuario');
    $senha = $req->post('senha');

    $sql = $pdo->prepare("SELECT * FROM usuarios WHERE usuario = :u AND senha = :s");
    $sql->bindValue(":u", $usuario);
    $sql->bindValue(":s", $senha);
    $sql->execute();

    if ($sql->rowCount() > 0) {
        $dados = $sql->fetch();
        session_start();
        $_SESSION['logado'] = $dados['usuario'];

        $registro = array(
            "TOKEN" => $dados['idusuario'],
            "RETORNO" => "1",
        ); // logado com sucesso
        $retorno[] = $registro;
    } else {
        $registro = array(
            "SUCESSO" => "2",
        );
        $retorno[] = $registro;
    }
    //$pdo->close();
    echo json_encode($retorno);
});





$app->run();
