<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de Controle</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .usuario {
            position: absolute;
            top: 10px;
            right: 10px;
        }
        .conteudo {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="usuario">
        Usuário: <?php echo $_SESSION['usuario']; ?>
    </div>

    <div class="conteudo">
        <h1>Bem-vindo ao Sistema!</h1>
        <p>Esta é uma área exclusiva para usuários autenticados. Aqui você encontra recursos e informações importantes.</p>
        <img src="logo.png" alt="Imagem de exemplo" style="width:300px;height:auto;">
    </div>
</body>
</html>
