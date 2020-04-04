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
    <div class="container" style="padding-top: 5%;text-align: center;">
        <h1>Rede de solidariedade - COVID-19</h1>
    </div>

    <div class="container">
        <br>
        <h2 style="text-align: center;">Cadastro de Vulnerável</h2>
        <br>
        <form id="form-voluntario" method="POST" action="controller/CadastroVulneravelController.php" enctype="multipart/form-data">
            <div class="">
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="nome">Nome completo</label>
                            <input type="text" class="form-control" id="inputNome" placeholder="Nome completo" name="nome" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cpf">CPF</label>
                            <input type="number" class="form-control" id="inputCpf" placeholder="CPF" name="cpf" required>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="senha">Senha</label>
                            <input type="password" class="form-control" id="inputSenha" placeholder="Senha" name="senha" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="confirmaSenha">Confirme a senha</label>
                            <input type="password" class="form-control" id="inputConfirmaSenha" placeholder="Confirme a senha" name="confirmaSenha" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="telefone">Telefone</label>
                            <input class="form-control" placeholder="telefone" name="telefone" type="number" id="telefone" required />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="cep">CEP</label>
                            <input class="form-control" name="cep" placeholder="CEP" type="text" id="cep" value="" size="10" maxlength="9" required />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="rua">Rua</label>
                            <input class="form-control" placeholder="Rua" name="rua" type="text" id="rua" size="60" required />
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="numero">Número</label>
                            <input class="form-control" placeholder="Número" name="numero" type="text" id="numero" size="40" required />
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
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Identidade</label>
                            <input type="number" value="Procurar" class="form-control" placeholder="número identidade" name="identidade" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Foto da Identidade*</label>
                            <input type="file" value="Procurar" class="form-control" placeholder="foto da identidade" name="fotoIdentidade" required>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Foto de verificação**</label>
                            <input type="file" value="Procurar" class="form-control" placeholder="foto de verificação" name="fotoVerificacao" required>
                        </div>
                    </div>
                </div>
                <br>
                <h6>* Envie uma foto legível do seu documento de identidade.</h6>
                <h6>** Envie uma foto sua segurando seu documento de identidade.</h6>
                <br>
                <a href="index.php" class="btn btn-primary" role="button">Voltar</a>
                <button type="submit" class="btn btn-success">Cadastrar</button>
                <br><br><br><br>
                <div class="form-group">
                    <img src="img/logo-lesse.png" alt="logo" style="width:15%; margin-left:10%; margin-right: 30%;">
                    <img src="img/unipampa.jpg" alt="logo" style=" width:30%;">
                </div>
            </div>
            </form>
    </div>
    
    </div>


</body>

</html>