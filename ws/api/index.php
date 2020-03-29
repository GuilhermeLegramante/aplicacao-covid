<?php
require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

$app->get('/', function () {
    echo "Bem-vindo a API do Sistema COVID19";
});

$app->post('/login-voluntario', function () use ($app) {
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

    $cpf = $req->post('cpf');
    $senha = $req->post('senha');

    $sql = $pdo->prepare("SELECT * FROM voluntarios WHERE cpf = :cpf AND senha = :s");
    $sql->bindValue(":cpf", $cpf);
    $sql->bindValue(":s", md5($senha));
    $sql->execute();

    if ($sql->rowCount() > 0) {
        $dados = $sql->fetch();
        $registro = array(
            "TOKEN" => $dados['cpf'],
            "SUCESSO" => "1",
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

$app->post('/login-vulneravel', function () use ($app) {
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

    $cpf = $req->post('cpf');
    $senha = $req->post('senha');

    $sql = $pdo->prepare("SELECT * FROM vulneraveis WHERE cpf = :cpf AND senha = :s");
    $sql->bindValue(":cpf", $cpf);
    $sql->bindValue(":s", md5($senha));
    $sql->execute();

    if ($sql->rowCount() > 0) {
        $dados = $sql->fetch();
        $registro = array(
            "TOKEN" => $dados['cpf'],
            "SUCESSO" => "1",
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


$app->post('/cadastro-voluntario', function () use ($app) {

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

    $nome = $req->post('nome');
    $cpf = $req->post('cpf');
    $senha = $req->post('senha');
    $email = $req->post('email');
    $senhaCrip = md5($senha);
    $telefone = $req->post('telefone');
    $cep = $req->post('cep');
    $rua = $req->post('rua');
    $numero = $req->post('numero');
    $bairro = $req->post('bairro');
    $cidade = $req->post('cidade');
    $uf = $req->post('uf');
    $raioAtuacao = $req->post('raioAtuacao');
    $identidade = $req->post('identidade');
    $latitude = $req->post('latitude');
    $longitude = $req->post('longitude');


    try {
        $stmt = $pdo->prepare("INSERT INTO voluntarios (cadValidado, nome, cpf, email, senha, telefone, cep, rua, numero, bairro,
        cidade, uf, raioAtuacao, identidade, latitude, longitude) VALUES(:cadValidado, :nome, :cpf, :email, :senha, :telefone, 
        :cep, :rua, :numero, :bairro, :cidade, :uf, :raioAtuacao, :identidade, :latitude, :longitude)");
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
        $stmt->bindValue(":raioAtuacao", $raioAtuacao);
        $stmt->bindValue(":identidade", $identidade);
        $stmt->bindValue(":latitude", $latitude);
        $stmt->bindValue(":longitude", $longitude);
        $stmt->execute();

        $registro = array(
            "SUCESSO" => "1",
        ); // inseriu com sucesso
        $retorno[] = $registro;
    } catch (PDOException $e) {
        $registro = array(
            "SUCESSO" => "2",
        );
        $retorno[] = $registro;
    }

    echo json_encode($retorno);
});


$app->post('/cadastro-vulneravel', function () use ($app) {

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

    $nome = $req->post('nome');
    $cpf = $req->post('cpf');
    $senha = $req->post('senha');
    $email = $req->post('email');
    $senhaCrip = md5($senha);
    $telefone = $req->post('telefone');
    $cep = $req->post('cep');
    $rua = $req->post('rua');
    $numero = $req->post('numero');
    $bairro = $req->post('bairro');
    $cidade = $req->post('cidade');
    $uf = $req->post('uf');
    $identidade = $req->post('identidade');
    $latitude = $req->post('latitude');
    $longitude = $req->post('longitude');


    try {
        $stmt = $pdo->prepare("INSERT INTO voluntarios (cadValidado, nome, cpf, email, senha, telefone, cep, rua, numero, bairro,
        cidade, uf, identidade, latitude, longitude) VALUES(:cadValidado, :nome, :cpf, :email, :senha, :telefone, 
        :cep, :rua, :numero, :bairro, :cidade, :uf, :identidade, :latitude, :longitude)");
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
        $stmt->bindValue(":latitude", $latitude);
        $stmt->bindValue(":longitude", $longitude);
        $stmt->execute();

        $registro = array(
            "SUCESSO" => "1",
        ); // inseriu com sucesso
        $retorno[] = $registro;
    } catch (PDOException $e) {
        $registro = array(
            "SUCESSO" => "2",
        );
        $retorno[] = $registro;
    }

    echo json_encode($retorno);
});


$app->run();
