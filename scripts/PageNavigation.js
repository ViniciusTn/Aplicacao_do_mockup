// PageNavigation.js
// Contains functions to navigate to different pages using window.location.href

/**
 * Navigates to the specified URL.
 * @param {string} url - The URL to navigate to.
 */
function navigateTo(url) {
    window.location.href = url;
}

/**
 * Adds click event listeners to buttons with data-url attribute to navigate on click.
 */
function setupNavigationButtons() {
    const buttons = document.querySelectorAll('button[data-url]');
    buttons.forEach(button => {
        button.addEventListener('click', () => {
            const url = button.getAttribute('data-url');
            if (url) {
                navigateTo(url);
            }
        });
    });
}

// Automatically setup navigation buttons on DOMContentLoaded
document.addEventListener('DOMContentLoaded', () => {
    setupNavigationButtons();
});

// Export functions for use in modules or global scope
if (typeof module !== 'undefined') {
    module.exports = {
        navigateTo,
        setupNavigationButtons
    };
}
