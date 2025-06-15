<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="cd.css">
</head>

<body>
    <section>
        <div class="background-section">
            <video src="../vds/Video.mp4" autoplay loop muted></video>
        </div>

        <button id="darkModeToggle" class="dark-mode-toggle">🌓</button>

        <div class="container">
            <h1>Cadastro de Usuário</h1>

            <?php if (isset($_SESSION['msg'])): ?>
            <p class="<?= $_SESSION['msg_type'] ?>"><?= $_SESSION['msg'] ?></p>
            <?php unset($_SESSION['msg'], $_SESSION['msg_type']); ?>
            <?php endif; ?>

            <form action="processa_cadastro.php" method="POST">
                <!-- Dados Pessoais -->
                <div class="linha-inputs">
                    <div>
                        <label>Nome Completo</label>
                        <input type="text" name="nomeCompleto" placeholder="Nome completo" required>
                    </div>
                    <div>
                        <label>CPF</label>
                        <input type="text" name="cpf" placeholder="Somente números" required>
                    </div>
                </div>

                <div class="linha-inputs">
                    <div>
                        <label>Data de Nascimento</label>
                        <input type="date" name="dataNascimento" required>
                    </div>
                    <div>
                        <label>Nome da Mãe</label>
                        <input type="text" name="nomeMae" placeholder="Nome da mãe" required>
                    </div>
                </div>

                <div class="linha-inputs">
                    <div>
                        <label>Email</label>
                        <input type="email" name="email" placeholder="Ex: seuemail@email.com" required>
                    </div>
                    <div>
                        <label>Telefone</label>
                        <input type="text" name="telefone" placeholder="(00) 00000-0000">
                    </div>
                </div>

                <div class="linha-inputs">
                    <div>
                        <label>Estado</label>
                        <input type="text" name="estado" placeholder="UF">
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
                        <input type="text" name="login" placeholder="Usuário" required>
                    </div>
                </div>

                <!-- Senha e confirmação -->
                <div class="linha-inputs">
                    <div>
                        <label>Senha</label>
                        <input type="password" name="senha" placeholder="Senha" required>
                    </div>
                    <div>
                        <label>Confirmar Senha</label>
                        <input type="password" name="confirmar_senha" placeholder="Repita a senha" required>
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
    </script>
</body>

</html>