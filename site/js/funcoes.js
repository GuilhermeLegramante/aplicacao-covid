$(document).ready(function() {
    $('#form-login-voluntario').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "http://" + window.location.host + "/aplicacao-covid/ws/api/login-voluntario",
            data: { cpf: $("#inputCPF").val(), senha: $("#inputSenha").val() },
            beforeSend: function() {
                var p = document.createElement("p");
                p.innerHTML = "<h2>Aguarde...</h2>";
                swal({
                    content: p,
                });
            },
            success: function(result, jqXHR) {
                var usuarios = JSON.parse(result);
                $.each(usuarios, function(i, usuario) {
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

    $('#form-login-vulneravel').submit(function(e) {
        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "http://" + window.location.host + "/aplicacao-covid/ws/api/login-vulneravel",
            data: { cpf: $("#inputCPF").val(), senha: $("#inputSenha").val() },
            beforeSend: function() {
                var p = document.createElement("p");
                p.innerHTML = "<h2>Aguarde...</h2>";
                swal({
                    content: p,
                });
            },
            success: function(result, jqXHR) {
                var usuarios = JSON.parse(result);
                $.each(usuarios, function(i, usuario) {
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

function verificaLogin() {
    var token = localStorage.getItem("token");
    if (token == null) {
        window.location = 'index.php';
    }
}