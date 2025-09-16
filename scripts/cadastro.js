document.addEventListener('DOMContentLoaded', function() {
  const btnProximo = document.querySelector('.btn-proximo');
  if (btnProximo) {
    btnProximo.addEventListener('click', function(event) {
      const dia = document.getElementById('dia').value.trim();
      const mes = document.getElementById('mes').value.trim();
      const ano = document.getElementById('ano').value.trim();
      const usuario = document.getElementById('usuario').value.trim();
      const email = document.getElementById('email').value.trim();
      const senha = document.getElementById('senha').value.trim();

      if (!dia || !mes || !ano || !usuario || !email || !senha) {
        alert('Por favor, preencha todos os campos.');
        event.preventDefault();
        return;
      }
    });
  }
});
