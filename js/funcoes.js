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

});

function verificaLogin() {
    var token = localStorage.getItem("token");
    if (token == null) {
        window.location = 'index.php';
    }
}