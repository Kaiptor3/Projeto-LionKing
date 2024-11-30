// Tamanho base da fonte
let currentFontSize = 16;

// Função para ajustar o tamanho da fonte
function adjustFontSize(increase) {
  // Ajuste do tamanho da fonte
  const adjustment = increase ? 2 : -2; // Aumentar ou diminuir em 2px
  currentFontSize += adjustment;

  // Limitar o tamanho da fonte
  if (currentFontSize < 10) {
    currentFontSize = 10; // Tamanho mínimo da fonte
  } else if (currentFontSize > 30) {
    currentFontSize = 30; // Tamanho máximo da fonte
  }

  // Aplicar o novo tamanho da fonte em todos os elementos
  document.body.style.fontSize = currentFontSize + "px";
}

// Evento para aumentar a fonte
document.getElementById("increaseFont").addEventListener("click", () => {
  adjustFontSize(true); // Aumenta a fonte
});

// Evento para diminuir a fonte
document.getElementById("decreaseFont").addEventListener("click", () => {
  adjustFontSize(false); // Diminui a fonte
});
