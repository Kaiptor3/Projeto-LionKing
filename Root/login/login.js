const $ = (elemento) => document.querySelector(elemento);


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
    navUsuario.display = "inline";
    login.style.display = "none";
  } else {
    navUsuario.display = "none";
  }
};

// Função de logout
function logout() {
  const usuario = JSON.parse(localStorage.getItem("usuario"));
  if (usuario) {
    usuario.estaLogado = false;
    localStorage.setItem("usuario", JSON.stringify(usuario));
    window.location.href = "index.html";
  }
}