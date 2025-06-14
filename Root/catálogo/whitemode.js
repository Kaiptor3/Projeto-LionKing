// Aplica o estado do contraste ao carregar a página
document.addEventListener("DOMContentLoaded", () => {
    const body = document.body;
  
    // Verifica o estado salvo no localStorage
    const isHighContrast = localStorage.getItem("highContrast") === "true";
  
    // Aplica a classe de alto contraste se necessário
    if (isHighContrast) {
      body.classList.add("high-contrast");
    }
  });
  
  // Evento para alternar o tema
  document.getElementById("contrast-toggle").addEventListener("click", function () {
    const body = document.body;
  
    // Alterna a classe de alto contraste
    body.classList.toggle("high-contrast");
  
    // Salva o estado atual no localStorage
    const isHighContrast = body.classList.contains("high-contrast");
    localStorage.setItem("highContrast", isHighContrast);
  });
  