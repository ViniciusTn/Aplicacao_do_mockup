document.addEventListener('DOMContentLoaded', () => {
  const rotaForm = document.getElementById('rotaForm');
  const listaRotas = document.getElementById('listaRotas');

  function getRotas() {
    const rotas = localStorage.getItem('rotas');
    return rotas ? JSON.parse(rotas) : [];
  }

  function saveRotas(rotas) {
    localStorage.setItem('rotas', JSON.stringify(rotas));
  }

  function renderRotas() {
    const rotas = getRotas();
    listaRotas.innerHTML = '';

    rotas.forEach((rota, index) => {
      const li = document.createElement('li');
      li.textContent = `${rota.nome} - ${rota.descricao} `;

      const editButton = document.createElement('button');
      editButton.textContent = 'Editar';
      editButton.addEventListener('click', () => {
        const novoNome = prompt('Novo nome da rota:', rota.nome);
        const novaDescricao = prompt('Nova descrição da rota:', rota.descricao);
        if (novoNome && novaDescricao) {
          rotas[index] = { nome: novoNome, descricao: novaDescricao };
          saveRotas(rotas);
          renderRotas();
        }
      });

      const deleteButton = document.createElement('button');
      deleteButton.textContent = 'Excluir';
      deleteButton.addEventListener('click', () => {
        if (confirm('Tem certeza que deseja excluir esta rota?')) {
          rotas.splice(index, 1);
          saveRotas(rotas);
          renderRotas();
        }
      });

      li.appendChild(editButton);
      li.appendChild(deleteButton);
      listaRotas.appendChild(li);
    });
  }

  rotaForm.addEventListener('submit', (e) => {
    e.preventDefault();
    const nomeRota = document.getElementById('nomeRota').value.trim();
    const descricaoRota = document.getElementById('descricaoRota').value.trim();

    if (!nomeRota || !descricaoRota) {
      alert('Por favor, preencha todos os campos.');
      return;
    }

    const rotas = getRotas();
    rotas.push({ nome: nomeRota, descricao: descricaoRota });
    saveRotas(rotas);
    renderRotas();
    rotaForm.reset();
  });

  renderRotas();
});
