<?php
session_start();
require 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    
    $conn = 'conectaPDO'();
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($usuario && password_verify($senha, $usuario['senha'])) {
        $_SESSION['usuario'] = $usuario['nome'];
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Email ou senha incorretos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de login</title>
    <link rel="icon" type="image" href="/Root/imgs/favicon.png" sizes="16x16 16x16">
    <link rel="stylesheet" href="/Root/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Montserrat:wght@400&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
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
<script src="../fonte.js"></script>

        <a href="cadastro.html"><button type="button" class="botao-voltar">←</button></a>
    <form id="login">
        </body>
</html>