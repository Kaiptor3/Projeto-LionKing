// Tamanho base da fonte
let currentFontSize = parseInt(localStorage.getItem("fontSize")) || 16;

// Aplica o tamanho de fonte ao carregar a página
document.addEventListener("DOMContentLoaded", () => {
  document.body.style.fontSize = currentFontSize + "px";

  // Seleciona todos os elementos dentro de #carromatriz
  const carromatrizElements = document.querySelectorAll('#carromatriz *');
  carromatrizElements.forEach(element => {
    if (element.tagName === 'H2' || element.tagName === 'FONT') {
      element.style.fontSize = (currentFontSize + 40) + "px";
    } else {
      element.style.fontSize = currentFontSize + "px";
    }
  });
});

function adjustFontSize(increase) {
  const adjustment = increase ? 2 : -2;
  currentFontSize += adjustment;

  // Limitar o tamanho da fonte
  if (currentFontSize < 10) {
    currentFontSize = 10;
  } else if (currentFontSize > 30) {
    currentFontSize = 30;
  }

  // Salva o tamanho no localStorage
  localStorage.setItem("fontSize", currentFontSize);

  // Aplica o novo tamanho de fonte ao body e aos filhos de #carromatriz
  document.body.style.fontSize = currentFontSize + "px";
  
  // Seleciona todos os elementos dentro de #carromatriz
  const carromatrizElements = document.querySelectorAll('#carromatriz *');
  carromatrizElements.forEach(element => {
    if (element.tagName === 'H2' || element.tagName === 'FONT') {
      element.style.fontSize = (currentFontSize + 40) + "px";
    } else {
      element.style.fontSize = currentFontSize + "px";
    }
  });
}

// Evento para aumentar a fonte
document.getElementById("increaseFont").addEventListener("click", () => {
  adjustFontSize(true); // Aumenta a fonte
});

// Evento para diminuir a fonte
document.getElementById("decreaseFont").addEventListener("click", () => {
  adjustFontSize(false); // Diminui a fonte
});
