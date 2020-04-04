<!DOCTYPE html>
<html lang="en">

<head>
    <title>Rede de solidadariedade - COVID-19</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <script src="js/funcoes.js"></script>
    <script src="js/sweetalert.min.js"></script>

</head>

<body>

    <div class="container" style="padding-top: 5%;text-align: center;">
        <h1>Rede de solidadariedade - COVID-19</h1>
    </div>

    <div class="container" style="margin-top: 5%; max-width: 40%; align-items: center;">
        <h2 style="text-align: center;">Login - Voluntário</h2>

        <br>
        <form id="form-login-voluntario" onclick="#">
            <div class="form-group">
                <input type="text" class="form-control" id="inputCPF" placeholder="CPF (apenas números)" maxlength="14" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" id="inputSenha" placeholder="Sua senha" required>
            </div>
            <button class="btn btn-primary btn-block">Acessar</button>
            <br><br>
            <div class="col-md-12 align-self-center text-center">
                <a href="index.php">Voltar</a>
            </div>
            <br><br><br><br>
            <div class="form-group">
                <img src="img/logo-lesse.png" alt="logo" style="width:25%; margin-left:10%; margin-right: 10%;">
                <img src="img/unipampa.jpg" alt="logo" style=" width:50%;">
            </div>
        </form>
    </div>

</body>

</html>