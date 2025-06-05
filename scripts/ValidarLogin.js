document.addEventListener("DOMContentLoaded", function(){
    const formulario = document.getElementById("loginFormulario");
    
    formulario.addEventListener("submit", function(e){
    e.preventDefault();

    let valido = true;

    // para limpar os erros
    document.getElementById("erroUsuario").textContent = "";
    document.getElementById("erroSenha").textContent = "";

    const usuario = document .getElementById("nome").value.trim();
    const senha = document .getElementById("senha").value.trim();

    console.log(usuario);
    console.log(senha);

    if (usuario.length < 3){
        document.getElementById("erroUsuario").textContent = "Nome de usuário inválido";
        valido = false;
    }

    if (senha.length < 6){
        document.getElementById("erroSenha").textContent = "Senha inválida";
        valido = false;
    }

    
    if(valido) {
        alert("Formulário enviado com sucesso!");
        formulario.reset();
        window.location.href= "Dashboard.html";
    }


    });
});