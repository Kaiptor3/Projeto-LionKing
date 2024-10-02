const $ = (elemento) => document.querySelector(elemento);

$("#entrar").addEventListener("click", (ev) => {
  ev.preventDefault();

  const string = localStorage.getItem("usuario");
  const usuarioCadastrado = JSON.parse(string);

  const { email, senha } = usuarioCadastrado;

  const dadosCorretos =
    email === $("#email").value && senha === $("#senha").value;
  console.log(dadosCorretos);

  if (!dadosCorretos) {
    alert("Dados inválidos!");
    return;
  }

  window.location.href = "home.html";
});
