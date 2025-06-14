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
    <style>
        body {
            background: #1a1a1a;
            color: #f0f0f0;
            font-family: Arial, sans-serif;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: #2b2b2b;
            padding: 20px;
            border-radius: 10px;
        }

        h1 {
            color: #ff2a2a;
            text-align: center;
        }

        label {
            display: block;
            margin-top: 10px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-top: 4px;
            border-radius: 4px;
            border: 1px solid #555;
            background: #333;
            color: #fff;
        }

        .btn {
            background: #ff2a2a;
            padding: 10px;
            margin-top: 15px;
            border: none;
            border-radius: 5px;
            width: 100%;
            cursor: pointer;
        }

        .error {
            color: #ff5c5c;
            text-align: center;
            margin-top: 10px;
        }

        .success {
            color: #6cf26c;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Cadastro de Usuário</h1>

        <?php if (!empty($erro)): ?>
            <div class="error"><?= htmlspecialchars($erro) ?></div>
        <?php endif; ?>

        <?php if (!empty($sucesso)): ?>
            <div class="success"><?= htmlspecialchars($sucesso) ?></div>
        <?php endif; ?>

        <form method="POST" action="processa_cadastro.php">
            <label>Nome Completo:</label>
            <input type="text" name="nomeCompleto" required>

            <label>Data de Nascimento:</label>
            <input type="date" name="dataNascimento" required>

            <label>CPF:</label>
            <input type="text" name="cpf" required>

            <label>Nome da Mãe:</label>
            <input type="text" name="nomeMae" required>

            <label>Email:</label>
            <input type="email" name="email" required>

            <label>Telefone:</label>
            <input type="text" name="telefone" required>

            <label>Estado:</label>
            <input type="text" name="estado">

            <label>Cidade:</label>
            <input type="text" name="cidade">

            <label>Rua:</label>
            <input type="text" name="rua">

            <label>Número:</label>
            <input type="text" name="numero">

            <label>Bairro:</label>
            <input type="text" name="bairro">

            <label>Login:</label>
            <input type="text" name="login" maxlength="50" required>

            <label>Senha:</label>
            <input type="password" name="senha" maxlength="255" required>

            <button type="submit" class="btn">Cadastrar</button>
        </form>
    </div>
</body>

</html>
