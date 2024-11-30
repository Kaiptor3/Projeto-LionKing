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
    const paginaAtual = window.location.pathname;

    if (paginaAtual.includes("login.html")) {
        // Se a página for login.html, redireciona para a página inicial
        window.location.href = "../index.html";
    } else {
        // Se a página for qualquer outra, recarrega a página
        window.location.reload();
    }
});

window.onload = function () {
  const usuario = JSON.parse(localStorage.getItem("usuario"));
  const navUsuarios = document.querySelectorAll(".nav-usuario");
  const bemVindos = document.querySelectorAll(".bem-vindo-usuario");

  if (usuario && usuario.estaLogado) {
    bemVindos.forEach((bemVindo) => {
      bemVindo.textContent = usuario.nome;
    });
    navUsuarios.forEach((navUsuario) => {
      navUsuario.display = "inline"; // Mostra o elemento
    });
    login.style.display = "none"; // Oculta o formulário de login
  } else {
    navUsuarios.forEach((navUsuario) => {
      navUsuario.style.display = "none"; // Oculta o elemento
    });
  }
};


// Função de logout
function logout() {
  const usuario = JSON.parse(localStorage.getItem("usuario"));
  if (usuario) {
    usuario.estaLogado = false;
    localStorage.setItem("usuario", JSON.stringify(usuario));
    window.location.reload();
  }
}