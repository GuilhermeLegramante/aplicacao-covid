<?php
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

$app->get('/', function () {
    echo "Bem-vindo a API do Sistema COVID19";
});

$GLOBALS["db"] = "covid19";

$app->post('/login', function () use ($app) {
    $req = $app->request();

    $retorno = array();
    global $pdo;
    $nomeDb = "covid19";
    $host = "localhost";
    $user = "root";
    $pass = "";

    try {
        $pdo = new PDO("mysql:dbname=" . $nomeDb . ";host=" . $host, $user, $pass);
    } catch (PDOException $e) {
        $msgErro = $e->getMessage();
    }

    $email = $req->post('email');
    $senha = $req->post('senha');

    $sql = $pdo->prepare("SELECT * FROM voluntarios WHERE email = :e AND senha = :s");
    $sql->bindValue(":e", $email);
    $sql->bindValue(":s", $senha);
    $sql->execute();

    if ($sql->rowCount() > 0) {
        $dados = $sql->fetch();
        session_start();
        $_SESSION['logado'] = $dados['nome'];

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

    echo json_encode($retorno);
});


$app->run();
