const $ = (elemento) => document.querySelector(elemento);

$("#login").addEventListener("submit", (ev) => {
    ev.preventDefault();

    const string = localStorage.getItem("usuario");
    const usuarioCadastrado = JSON.parse(string);

    const emailInput = $("#email");
    const senhaInput = $("#senha");
    const mensagemErro = $("#mensagem-erro"); // Certifique-se de que existe um elemento no HTML para exibir a mensagem de erro.

    // Reseta o estado dos campos e da mensagem de erro
    mensagemErro.textContent = "";

    if (!usuarioCadastrado) {
        mensagemErro.textContent = "Nenhum usuário cadastrado!";
        return;
    }

    const { email, senha } = usuarioCadastrado;

    const emailValido = email === emailInput.value;
    const senhaValida = senha === senhaInput.value;

    if (!emailValido || !senhaValida) {
        mensagemErro.textContent = "Email ou senha inválidos!";
        return;
    }

    // Atualiza a propriedade `estaLogado` para true antes de salvar no localStorage
    usuarioCadastrado.estaLogado = true;
    localStorage.setItem("usuario", JSON.stringify(usuarioCadastrado));

    const caminhoIndex = window.location.pathname.includes("/login/") ? "../index.html" : "index.html";
    window.location.href = caminhoIndex;
});
window.onload = function() {
  const usuario = JSON.parse(localStorage.getItem("usuario"));
  const navUsuario = document.getElementById("nav-usuario");
  const bemVindoUsuario = document.getElementById("bem-vindo-usuario");

  if (usuario && usuario.estaLogado) {
    bemVindoUsuario.textContent = `${usuario.nome}`;
    navUsuario.display = "inline"; // Elemento aparece
    login.style.display = "none";
  } else {
    navUsuario.style.display = "none";
  }
};

// Função de logout
function logout() {
  const usuario = JSON.parse(localStorage.getItem("usuario"));
  if (usuario) {
    usuario.estaLogado = false;
    localStorage.setItem("usuario", JSON.stringify(usuario));
    window.location.href = "/index.html";
  }
}