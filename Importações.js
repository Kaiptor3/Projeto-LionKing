// loadAssets.js
function loadCSS(filename) {
    const link = document.createElement("link");
    link.rel = "stylesheet";
    link.type = "text/css";
    link.href = filename;
    document.head.appendChild(link);
}

function loadJS(filename) {
    return new Promise((resolve, reject) => {
        const script = document.createElement("script");
        script.src = filename;
        script.onload = () => resolve();
        script.onerror = () => reject(new Error(`Erro ao carregar o script: ${filename}`));
        document.body.appendChild(script);
    });
}

// Carregar arquivos CSS, JavaScript e o menu
loadCSS("home.css");
loadJS("script.js")
    .then(() => {
        console.log("Script carregado com sucesso!");
    })
    .catch(error => {
        console.error(error);
    });
