<!DOCTYPE html>
<html lang="en">

<head>
    <title>Cadastro de Voluntário</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <script src="js/funcoes.js"></script>
    <script src="js/sweetalert.min.js"></script>

    <!-- Adicionando Javascript -->
    <script type="text/javascript">
        $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#rua").val("");
                $("#bairro").val("");
                $("#cidade").val("");
                $("#uf").val("");
                $("#ibge").val("");
            }

            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if (validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#rua").val("...");
                        $("#bairro").val("...");
                        $("#cidade").val("...");
                        $("#uf").val("...");
                        $("#ibge").val("...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("https://viacep.com.br/ws/" + cep + "/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#rua").val(dados.logradouro);
                                $("#bairro").val(dados.bairro);
                                $("#cidade").val(dados.localidade);
                                $("#uf").val(dados.uf);
                                $("#ibge").val(dados.ibge);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                swal({
                                    text: "CEP não encontrado.",
                                    icon: "error",
                                    closeOnClickOutside: false,
                                    closeOnEsc: false,
                                });

                            }
                        });
                    } //end if.
                    else {
                        //cep é inválido.
                        limpa_formulário_cep();
                        swal({
                            text: "Formato de CEP inválido.",
                            icon: "error",
                            closeOnClickOutside: false,
                            closeOnEsc: false,
                        });

                    }
                } //end if.
                else {
                    //cep sem valor, limpa formulário.
                    limpa_formulário_cep();
                }
            });
        });
    </script>

</head>

<body>

    <div class="container">
        <br>
        <h2 style="text-align: center;">Cadastro de Voluntário</h2>
        <br>
        <form id="form-voluntario" method="POST" action="controller/CadastroVoluntarioController.php">
            <div class="">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="usuario">Nome completo</label>
                            <input type="text" class="form-control" id="inputNome" placeholder="Nome completo" name="nome" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="usuario">Email</label>
                            <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="senha">Senha</label>
                            <input type="password" class="form-control" id="inputSenha" placeholder="Senha" name="senha" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="confirmaSenha">Confirme a senha</label>
                            <input type="password" class="form-control" id="inputConfirmaSenha" placeholder="Confirme a senha" name="confirmaSenha" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cep">CEP</label>
                            <input class="form-control" name="cep" placeholder="CEP" type="text" id="cep" value="" size="10" maxlength="9" required />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="rua">Rua</label>
                            <input class="form-control" placeholder="Rua" name="rua" type="text" id="rua" size="60" required />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="bairro">Bairro</label>
                            <input class="form-control" placeholder="Bairro" name="bairro" type="text" id="bairro" size="40" required />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cidade">Cidade</label>
                            <input class="form-control" placeholder="Cidade" name="cidade" type="text" id="cidade" size="40" required />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="uf">UF</label>
                            <input class="form-control" placeholder="UF" name="uf" type="text" id="uf" size="2" required />
                        </div>
                    </div>
                </div>
                <label for="1km">Raio de atuação</label>
                <div class="row">
                    <div class="col-md-2">
                        <label class="radio-inline"><input type="radio" name="raioAtuacao" value="1" checked> Até 1km</label>
                    </div>
                    <div class="col-md-2">
                        <label class="radio-inline"><input type="radio" name="raioAtuacao" value="3"> De 1 a 3km</label>
                    </div>
                    <div class="col-md-2">
                        <label class="radio-inline"><input type="radio" name="raioAtuacao" value="5"> De 3 a 5km</label>
                    </div>
                    <div class="col-md-2">
                        <label class="radio-inline"><input type="radio" name="raioAtuacao" value="10"> De 5 a 10km</label>
                    </div>
                    <div class="col-md-2">
                        <label class="radio-inline"><input type="radio" name="raioAtuacao" value="max"> Mais de 10km</label>
                    </div>
                </div>

                <br>
                <a href="index.php" class="btn btn-primary" role="button">Voltar</a>
                <button type="submit" class="btn btn-success">Cadastrar</button>
            </div>
    </div>


    </form>
    </div>


</body>

</html>