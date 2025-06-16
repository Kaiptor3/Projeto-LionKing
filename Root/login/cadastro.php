<?php
session_start();

$erro = '';
$sucesso = '';

if (isset($_SESSION['erro_cadastro'])) {
    $erro = $_SESSION['erro_cadastro'];
    unset($_SESSION['erro_cadastro']);
}

if (isset($_SESSION['sucesso_cadastro'])) {
    $sucesso = $_SESSION['sucesso_cadastro'];
    unset($_SESSION['sucesso_cadastro']);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="cd.css">
    <style>
        .botao-voltar {
            position: fixed;
            top: 20px;
            left: 20px;
            background-color: transparent;
            color: #FFF;
            padding: 10px 15px;
            font-size: 30px;
            border: 2px solid white;
            border-radius: 15px;
            z-index: 1000;
            cursor: pointer;
            transition: transform 0.2s ease;
        }

        .botao-voltar:hover {
            transform: scale(1.1);
        }
    </style>
</head>

<body>
    <section>
        <div class="background-section">
            <video src="../vds/Video.mp4" autoplay loop muted></video>
        </div>

        <button id="darkModeToggle" class="dark-mode-toggle">🌓</button>
        <a href="../index.php"><button type="button" class="botao-voltar">←</button></a>
        <div class="container">
            <h1>Cadastro de Usuário</h1>

            <?php if (isset($_SESSION['msg'])): ?>
            <p class="<?= $_SESSION['msg_type'] ?>"><?= $_SESSION['msg'] ?></p>
            <?php unset($_SESSION['msg'], $_SESSION['msg_type']); ?>
            <?php endif; ?>

            <form action="processa_cadastro.php" method="POST" id="formCadastro" novalidate>
                <!-- Dados Pessoais -->
                <div class="linha-inputs">
                    <div>
                        <label>Nome Completo</label>
                        <input type="text" name="nomeCompleto" placeholder="Nome completo" required minlength="15" maxlength="80" pattern="[A-Za-zÀ-ú\s]+" title="Somente letras e espaços, 15 a 80 caracteres">
                    </div>
                    <div>
                        <label>CPF</label>
                        <input type="text" name="cpf" placeholder="Somente números" required maxlength="14" pattern="\d{14}" title="CPF deve conter 11 números">
                    </div>
                </div>

                <div class="linha-inputs">
                    <div>
                        <label>Data de Nascimento</label>
                        <input type="date" name="dataNascimento" required>
                    </div>
                    <div>
                        <label>Nome da Mãe</label>
                        <input type="text" name="nomeMae" placeholder="Nome da mãe" required pattern="[A-Za-zÀ-ú\s]+" title="Somente letras e espaços">
                    </div>
                </div>

                <div class="linha-inputs">
                    <div>
                        <label>Email</label>
                        <input type="email" name="email" placeholder="Ex: seuemail@email.com" required>
                    </div>
                    <div>
                        <label>Telefone</label>
                        <input type="text" name="telefone" placeholder="(00) 00000-0000" maxlength="15" pattern="\(\d{2}\) \d{4,5}-\d{4}" title="Formato: (00) 00000-0000">
                    </div>
                </div>

                <div class="linha-inputs">
                    <div>
                        <label>CEP</label>
                        <input type="text" name="cep" placeholder="Ex: 12345678" required maxlength="8" pattern="\d{8}" title="CEP deve conter 8 números">
                    </div>
                </div>

                <div class="linha-inputs">
                    <div>
                        <label>Estado</label>
                        <input type="text" name="estado" placeholder="UF" maxlength="2" pattern="[A-Za-z]{2}" title="Sigla do estado com 2 letras">
                    </div>
                    <div>
                        <label>Cidade</label>
                        <input type="text" name="cidade" placeholder="Cidade">
                    </div>
                </div>

                <div class="linha-inputs">
                    <div>
                        <label>Rua</label>
                        <input type="text" name="rua" placeholder="Nome da rua">
                    </div>
                    <div>
                        <label>Número</label>
                        <input type="text" name="numero" placeholder="Número">
                    </div>
                </div>

                <div class="linha-inputs">
                    <div>
                        <label>Bairro</label>
                        <input type="text" name="bairro" placeholder="Bairro">
                    </div>
                    <div>
                        <label>Login</label>
                        <input type="text" name="login" placeholder="Usuário" required pattern="[A-Za-z]{6}" maxlength="6" title="Login com exatamente 6 letras">
                    </div>
                </div>

                <!-- Senha e confirmação -->
                <div class="linha-inputs">
                    <div>
                        <label>Senha</label>
                        <input type="password" name="senha" id="senha" placeholder="Senha" required pattern="[A-Za-z]{8}" maxlength="8" title="Senha com exatamente 8 letras">
                    </div>
                    <div>
                        <label>Confirmar Senha</label>
                        <input type="password" name="confirmar_senha" id="confirmar_senha" placeholder="Repita a senha" required pattern="[A-Za-z]{8}" maxlength="8" title="Senha com exatamente 8 letras">
                    </div>
                </div>

                <div class="logar">
                    <input type="submit" value="Cadastrar" id="cadastro">
                    <input type="reset" value="Limpar" id="limpa">
                </div>
            </form>
        </div>
    </section>

    <script>
        const toggle = document.getElementById("darkModeToggle");
        toggle.onclick = () => document.body.classList.toggle("dark-mode");

        // Validação de senha igual
        document.getElementById("formCadastro").addEventListener("submit", function (e) {
            const senha = document.getElementById("senha").value;
            const confirmarSenha = document.getElementById("confirmar_senha").value;
            if (senha !== confirmarSenha) {
                e.preventDefault();
                alert("As senhas não coincidem. Verifique e tente novamente.");
                return;
            }

            // Email já é validado pelo type=email, mas reforçando:
            const email = this.email.value.trim();
            const emailRegex = /^\S+@\S+\.\S+$/;
            if (!emailRegex.test(email)) {
                e.preventDefault();
                alert("Email inválido.");
                return;
            }

            // Login (exatamente 6 letras)
            const login = this.login.value.trim();
            if (!/^[A-Za-z]{6}$/.test(login)) {
                e.preventDefault();
                alert("Login deve conter exatamente 6 letras.");
                return;
            }

        });

        // Busca endereço via CEP usando API ViaCEP
        const cepInput = document.querySelector('input[name="cep"]');
        cepInput.addEventListener("blur", () => {
            const cep = cepInput.value.trim();
            if (!/^\d{8}$/.test(cep)) {
                alert("CEP inválido. Deve conter 8 números.");
                return;
            }

            fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then(response => response.json())
                .then(data => {
                    if (data.erro) {
                        alert("CEP não encontrado. Preencha os dados manualmente.");
                        return;
                    }
                    document.querySelector('input[name="estado"]').value = data.uf || "";
                    document.querySelector('input[name="cidade"]').value = data.localidade || "";
                    document.querySelector('input[name="rua"]').value = data.logradouro || "";
                    document.querySelector('input[name="bairro"]').value = data.bairro || "";
                })
                .catch(() => {
                    alert("Erro ao buscar CEP. Preencha os dados manualmente.");
                });
        });

        // Máscaras para CPF, telefone e CEP
function mascaraCPF(input) {
    let v = input.value.replace(/\D/g, ''); // Remove tudo que não é número
    if (v.length > 11) v = v.slice(0, 11);
    v = v.replace(/(\d{3})(\d)/, '$1.$2');
    v = v.replace(/(\d{3})(\d)/, '$1.$2');
    v = v.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
    input.value = v;
}

function mascaraTelefone(input) {
    let v = input.value.replace(/\D/g, '');
    if (v.length > 11) v = v.slice(0, 11);
    v = v.replace(/^(\d{2})(\d)/g, '($1) $2');
    if (v.length <= 13) {
        v = v.replace(/(\d{4})(\d)/, '$1-$2');
    } else {
        v = v.replace(/(\d{5})(\d)/, '$1-$2');
    }
    input.value = v;
}
// Seleciona os inputs e aplica máscara no evento input
document.querySelector('input[name="cpf"]').addEventListener('input', function () {
    mascaraCPF(this);
});

document.querySelector('input[name="telefone"]').addEventListener('input', function () {
    mascaraTelefone(this);
});

    </script>
</body>

</html>
