const $ = (elemento) => document.querySelector(elemento);

console.log(localStorage.getItem("usuario"));

$("#login").addEventListener("submit", (ev) => {
    ev.preventDefault();

    const string = localStorage.getItem("usuario");
    const usuarioCadastrado = JSON.parse(string);

    if (!usuarioCadastrado) {
        alert("Nenhum usuário cadastrado!");
        return;
    }

    const { email, senha } = usuarioCadastrado;

    const dadosCorretos =
        email === $("#email").value && senha === $("#senha").value;

    if (!dadosCorretos) {
        alert("Dados inválidos!");
        return;
    }

    window.location.href = "index.html";
});
