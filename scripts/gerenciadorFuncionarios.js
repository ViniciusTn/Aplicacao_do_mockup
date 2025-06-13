function buscar() {
    const termoBusca = document.getElementById("inputBusca").value.toLowerCase();
    const funcionarios = document.querySelectorAll(".Gerenciador > .nav");

    funcionarios.forEach(func => {
        const nome = func.textContent.toLowerCase();
        func.style.display = nome.includes(termoBusca) ? "flex" : "none";
    });
}

/* precisa ser validado no backend  :)

window.addEventListener("DOMContentLoaded", () => {
  const listaDiv = document.getElementById("listaFuncionarios");
  let funcionarios = JSON.parse(localStorage.getItem("funcionarios")) || [];

  function salvarFuncionarios() {
    localStorage.setItem("funcionarios", JSON.stringify(funcionarios));
  }

  function render() {
    listaDiv.innerHTML = "";
    if (funcionarios.length === 0) {
      listaDiv.innerHTML = "<p>Nenhum funcionário cadastrado.</p>";
      return;
    }

    funcionarios.forEach((func, index) => {
      const container = document.createElement("div");
      container.classList.add("nav");


      const btnEditar = container.querySelector(".editar");
      const btnSalvar = container.querySelector(".salvar");
      const btnRemover = container.querySelector(".remover");
      const titulo = container.querySelector(".nome-funcionario");

      btnEditar.addEventListener("click", () => {
        titulo.contentEditable = true;
        titulo.focus();
        btnEditar.style.display = "none";
        btnSalvar.style.display = "inline-block";
      });

      btnSalvar.addEventListener("click", () => {
        titulo.contentEditable = false;
        btnEditar.style.display = "inline-block";
        btnSalvar.style.display = "none";

        const texto = titulo.textContent.trim();
        const partes = texto.split(":");
        if (partes.length < 2) {
          alert("Formato inválido. Use: Nome: Função");
          return;
        }
        funcionarios[index].nome = partes[0].trim();
        funcionarios[index].funcao = partes.slice(1).join(":").trim();

        salvarFuncionarios();
        render();
      });

      btnRemover.addEventListener("click", () => {
        if (confirm(`Remover funcionário ${func.nome}?`)) {
          funcionarios.splice(index, 1);
          salvarFuncionarios();
          render();
        }
      });

      listaDiv.appendChild(container);
    });
  }

  render();
});
*/