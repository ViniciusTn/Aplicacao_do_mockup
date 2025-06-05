/**
 * Configura um botão para redirecionar para "menuInicial.html" ao ser clicado.
 *
 * @param {string} buttonId - O ID do botão HTML.
 */
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

// Exporta a função para ambientes com módulos (Node.js ou bundlers)
if (typeof module !== 'undefined') {
    module.exports = {
        setupBackToMenu
    };
}