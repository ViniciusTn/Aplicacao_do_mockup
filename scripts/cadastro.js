document.addEventListener('DOMContentLoaded', function() {
  const btnProximo = document.getElementById('btnProximo');
  if (btnProximo) {
    btnProximo.addEventListener('click', function(event) {
      event.preventDefault();

      const dia = document.getElementById('dia').value.trim();
      const mes = document.getElementById('mes').value.trim();
      const ano = document.getElementById('ano').value.trim();
      const usuario = document.getElementById('usuario').value.trim();
      const email = document.getElementById('email').value.trim();
      const senha = document.getElementById('senha').value.trim();

      if (!dia || !mes || !ano || !usuario || !email || !senha) {
        alert('Por favor, preencha todos os campos.');
        return;
      }

      window.location.href = 'cadastro2.html';
    });
  }

  const btnCadastrar = document.querySelector('.btn-proximo');
  if (btnCadastrar && window.location.pathname.includes('cadastro2.html')) {
    btnCadastrar.addEventListener('click', function(event) {
      event.preventDefault();

      const inputs = document.querySelectorAll('.cadastro-box input');
      for (let input of inputs) {
        if (!input.value.trim()) {
          alert('Por favor, preencha todos os campos.');
          return;
        }
      }

      window.location.href = 'menuInicial.html';
    });
  }
});
