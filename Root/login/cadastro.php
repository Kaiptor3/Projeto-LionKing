<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Usuário</title>
    <link rel="stylesheet" href="cadastro.css">
</head>

<body>

    <section>
        <div class="background-section">
            <video src="../vds/Video.mp4" autoplay loop muted></video>
        </div>

        <button id="darkModeToggle" class="dark-mode-toggle">🌙</button>

        <div class="container box">
            <h1>Cadastro de Usuário</h1>

            <?php if (!empty($erro)): ?>
            <div class="error"><?= htmlspecialchars($erro) ?></div>
            <?php endif; ?>

            <?php if (!empty($sucesso)): ?>
            <div class="success"><?= htmlspecialchars($sucesso) ?></div>
            <?php endif; ?>

            <form method="POST" action="processa_cadastro.php">
                <div class="name">
                    <input type="text" name="nomeCompleto" placeholder="Nome Completo" required>
                </div>
                <div class="nascimento">
                    <input type="date" name="dataNascimento" required>
                </div>
                <div class="cpf">
                    <input type="text" name="cpf" placeholder="CPF" required>
                </div>
                <div class="name">
                    <input type="text" name="nomeMae" placeholder="Nome da Mãe" required>
                </div>
                <div class="emails">
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="name">
                    <input type="text" name="telefone" placeholder="Telefone" required>
                </div>
                <div class="name">
                    <input type="text" name="estado" placeholder="Estado">
                </div>
                <div class="name">
                    <input type="text" name="cidade" placeholder="Cidade">
                </div>
                <div class="name">
                    <input type="text" name="rua" placeholder="Rua">
                </div>
                <div class="numero">
                    <input type="text" name="numero" placeholder="Número">
                </div>
                <div class="name">
                    <input type="text" name="bairro" placeholder="Bairro">
                </div>
                <div class="name">
                    <input type="text" name="login" placeholder="Login" maxlength="50" required>
                </div>
                <div class="senhas">
                    <input type="password" name="senha" placeholder="Senha" maxlength="255" required>
                </div>

                <div class="logar">
                    <input id="cadastro" type="submit" value="Cadastrar">
                    <input id="limpa" type="reset" value="Limpar">
                </div>
            </form>
        </div>

        <script src=""></script>
</body>

</html>