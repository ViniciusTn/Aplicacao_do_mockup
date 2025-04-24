function validarLogin(){
    const usuario = document.getElementById('usuario').value.trim();
    const senha = document.getElementById('senha').value.trim();

    if(!usuario) {
        alert('Por favor, preencha o usuário.');
        return;
    }

    if (!senha) {
        alert('Por favor, preencha a senha.');
        return;
    }
}