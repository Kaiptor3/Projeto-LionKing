<?php
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
    $senha_criptografada = password_hash($senha, PASSWORD_DEFAULT);
    
    $conn = conectaPDO();
    $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)");
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha_criptografada);
    
    if ($stmt->execute()) {
        echo "Usuário cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar usuário.";
    }
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Cadastro</title>
    <link rel="icon" type="image" href="/Root/imgs/favicon.png" sizes="16x16 16x16">
    <link rel="stylesheet" href="/Root/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Montserrat:wght@400&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Montserrat:wght@400&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <link
      href="https://fonts.googleapis.com/css2?family=Pacifico&family=Montserrat:wght@400&display=swap"
      rel="stylesheet"
    />
</head>
<body>

    <section>
        <div class="background-section">
            <video src="../vds/Video.mp4" autoplay loop muted></video>
        </div>

        <button id="darkModeToggle" class="dark-mode-toggle" >🌙</button>
        <button id="increaseFont"><i class="fas fa-plus"></i></button>
<button id="decreaseFont"><i class="fas fa-minus"></i></button>
<script src="/Root/fonte.js"></script>

        <a href="/Root/index.html"><button type="button" class="botao-voltar">←</button></a>
    <form id="login">
        <div class="box">
            <img id="logo" src="imgs/LK - Logo preta.png" alt="logo">


    <script src="/Root/cadastro.js"></script>
    <script src="/Root/darkmode.js"></script>
</body>
</html>