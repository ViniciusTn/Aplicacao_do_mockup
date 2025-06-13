
    @param {string} buttonId 

function setupBackToMenu(buttonId) {
    const button = document.getElementById(buttonId);

    if (!button) {
        console.warn(`Botão com ID "${buttonId}" não foi encontrado.`);
        return;
    }

    button.addEventListener('click', () => {
        window.location.href = "menuInicial.html";
    });
}
