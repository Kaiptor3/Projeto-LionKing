<?php
session_start();
require_once 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $stmt = $conn->prepare("SELECT idUsuario, senha, nomeCompleto FROM usuario WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();
        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['idUsuario'] = $usuario['idUsuario'];
            $_SESSION['nome'] = $usuario['nomeCompleto'];
            
            // ✅ Redireciona para o index desejado
            header("Location: http://localhost/Projeto-LionKing-main/Root/");
            exit();
        }
    }

    // ❌ Redireciona para login com erro
    header("Location: login.php?erro=1");
    exit();
}
?>
