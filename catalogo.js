window.addEventListener("DOMContentLoaded", () => {
    const elementosParaAnimar = document.querySelectorAll(".titulo, .combustivel, .ficha-text h2");
    elementosParaAnimar.forEach(elemento => {
        const observer = new IntersectionObserver(entries => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    elemento.classList.add("show"); // Adiciona a classe quando o elemento entra na tela
                }
            });
        });
        observer.observe(elemento);
    });
});

const searchInput = document.querySelector('.footer-search input');
const searchButton = document.querySelector('.footer-search button');

searchButton.addEventListener('click', function () {
    const query = searchInput.value.trim();
    if (query) {
        alert(`Você pesquisou: ${query}`); // Substitua isso pela lógica de pesquisa que você desejar
        searchInput.value = ''; // Limpa o campo de entrada
    }
});

function voltarAoTopo() {
  window.scrollTo({ top: 0, behavior: 'smooth' });
}
searchButton.addEventListener('click', function () {
    const query = searchInput.value.trim().toLowerCase();
    if (query) {
        // Supondo que você tenha elementos com a classe 'item' para filtrar
        const items = document.querySelectorAll('.item');
        items.forEach(item => {
            const text = item.textContent.toLowerCase();
            item.style.display = text.includes(query) ? 'block' : 'none';
        });
        searchInput.value = ''; // Limpa o campo de entrada
    }
});


