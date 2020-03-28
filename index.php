<!DOCTYPE html>
<html lang="en">

<head>
    <title>Sistema de Colaboração</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/login.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <script src="js/funcoes.js"></script>
    <script src="js/sweetalert.min.js"></script>
</head>

<body>

    <div class="corpo-form">
        <div class="container">
            <h2 style="text-align: center;">Login</h2>
            <br>
            <form id="form-login" onclick="#">
                <div class="form-group">
                    <input type="text" class="form-control" id="inputUsuario" placeholder="Seu nome de usuário" name="usuario" required>
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" id="inputSenha" placeholder="Sua senha" name="senha" required>
                </div>
                <button class="btn btn-primary btn-block">Acessar</button>
                <br><br>
                <div class="form-group">
                    <h3>Ainda não é cadastrado?</h3>
                    <a style="margin-right: 5%;" href="cadastro-voluntario.php">Cadastrar voluntário</a>
                    <a href="cadastro-vulneravel.php">Cadastrar vulnerável</a>
                </div>
                <div class="form-group">
                </div>
            </form>
        </div>

    </div>

</body>

</html>