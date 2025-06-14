// Função para alternar entre Dark Mode e Light Mode
const toggleDarkMode = () => {
    // Alterna a classe 'dark-mode' no body
    document.body.classList.toggle('dark-mode');

    // Verifica se o modo escuro está ativo e armazena essa preferência no localStorage
    if (document.body.classList.contains('dark-mode')) {
        localStorage.setItem('darkMode', 'enabled');
    } else {
        localStorage.setItem('darkMode', 'disabled');
    }
};

// Adiciona um evento de clique no botão de Dark Mode
document.getElementById('darkModeToggle').addEventListener('click', toggleDarkMode);

// Verifica o estado do Dark Mode ao carregar a página
window.addEventListener('load', () => {
    const darkModeStatus = localStorage.getItem('darkMode');
    
    // Se o modo escuro estiver ativado no localStorage, aplica a classe 'dark-mode'
    if (darkModeStatus === 'enabled') {
        document.body.classList.add('dark-mode');
    }
});
