<?php
session_start();
$erros = $_SESSION['erros'] ?? [];
unset($_SESSION['erros']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cadastro</title>
    <link rel="stylesheet" href="cadastro.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        function validarFormulario() {
            const nome = document.getElementById('nome_completo').value;
            const login = document.getElementById('login').value;
            const senha = document.getElementById('senha').value;
            const confirmacao = document.getElementById('confirmacao_senha').value;
            
            // Validação do nome
            if (nome.length < 15 || nome.length > 80 || !/^[a-zA-Z\s]+$/.test(nome)) {
                alert('Nome deve ter 15-80 caracteres alfabéticos');
                return false;
            }
            
            // Validação do login
            if (login.length !== 6 || !/^[a-zA-Z]+$/.test(login)) {
                alert('Login deve ter exatamente 6 letras');
                return false;
            }
            
            // Validação da senha
            if (senha.length !== 8 || !/^[a-zA-Z]+$/.test(senha)) {
                alert('Senha deve ter exatamente 8 letras');
                return false;
            }
            
            // Confirmação de senha
            if (senha !== confirmacao) {
                alert('Senhas não coincidem');
                return false;
            }
            
            return true;
        }
    </script>
</head>
<body>
    <h1>Cadastro de Usuário</h1>
    
    <?php foreach ($erros as $erro): ?>
        <p style="color:red;"><?= $erro ?></p>
    <?php endforeach; ?>
    
    <form method="POST" action="processa_cadastro.php" onsubmit="return validarFormulario()">
        Nome Completo: <input type="text" name="nome_completo" required><br>
        Data Nascimento: <input type="date" name="data_nascimento" required><br>
        CPF: <input type="text" name="cpf" placeholder="000.000.000-00" required><br>
        Email: <input type="email" name="email" required><br>
        Telefone: <input type="text" name="telefone" placeholder="(00)00000-0000" required><br>
        Endereço: <input type="text" name="endereco" required><br>
        Login: <input type="text" name="login" maxlength="6" required><br>
        Senha: <input type="password" name="senha" maxlength="8" required><br>
        Confirmação Senha: <input type="password" name="confirmacao_senha" maxlength="8" required><br>
        <input type="submit" value="Enviar">
        <input type="reset" value="Limpar">
    </form>
</body>
</html>
