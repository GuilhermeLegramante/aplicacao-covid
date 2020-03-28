$(document).ready(function() {
    $('#form-login').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "http://" + window.location.host + "/covid19/covid19/ws/api/login",
            data: { usuario: $("#inputUsuario").val(), senha: $("#inputSenha").val() },
            beforeSend: function() {
                var p = document.createElement("p");
                p.innerHTML = "<h2>Aguarde...</h2>";
                swal({
                    content: p,
                });
            },
            success: function(result, jqXHR) {
                var usuario = JSON.parse(result);
                $.each(usuario, function(i, cliente) {
                    var item = usuario.SUCESSO;
                    if (item == '2') {
                        swal({
                            text: "Dados inválidos",
                            icon: "error",
                            closeOnClickOutside: false,
                            closeOnEsc: false,
                        });
                    } else {
                        localStorage.setItem("token", usuario.TOKEN);
                        localStorage.setItem("usuario", usuario.USUARIO);
                        window.location = "painel.php";
                    }
                });
            },
            error: function(jqXHR, status) {
                swal({
                    text: "Não foi possível contatar o servidor",
                    icon: "error",
                    closeOnClickOutside: false,
                    closeOnEsc: false,
                });
            },
        });
    });

    var password = document.getElementById("inputSenha"),
        confirm_password = document.getElementById("inputConfirmaSenha");

    function validatePassword() {
        if (password.value != confirm_password.value) {
            confirm_password.setCustomValidity("Senhas diferentes!");
        } else {
            confirm_password.setCustomValidity('');
        }
    }

    password.onchange = validatePassword;
    confirm_password.onkeyup = validatePassword;

});

function buscaCep() {
    $.ajax({
        type: "POST",
        url: "http://" + window.location.host + "/webpatrimonio/sistemacontracheque/api/carregadadosempresa",
        success: function(result, jqXHR) {
            var clientes = JSON.parse(result);
            $.each(clientes, function(i, cliente) {
                var item = cliente.SUCESSO;
                if (item == "0") {
                    swal({
                        text: "Os dados da empresa não foram encontrados",
                        icon: "error",
                        closeOnClickOutside: false,
                        closeOnEsc: false,
                    });
                } else {
                    $("#nomeempresa").html(cliente.NOMEEMPRESA);
                }
            });
        },
        error: function(jqXHR, status) {
            swal({
                text: "Não foi possível contatar o servidor",
                icon: "error",
                closeOnClickOutside: false,
                closeOnEsc: false,
            });
        },
    });
}

function verificaLogin() {
    var token = localStorage.getItem("token");
    if (token == null) {
        window.location = 'index.php';
    }
}