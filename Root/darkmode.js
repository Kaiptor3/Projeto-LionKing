// Função para alternar entre Dark Mode e Light Mode
const toggleDarkMode = () => {
    document.body.classList.toggle('dark-mode');
};

// Adiciona um evento de clique no botão de Dark Mode
document.getElementById('darkModeToggle').addEventListener('click', toggleDarkMode);
