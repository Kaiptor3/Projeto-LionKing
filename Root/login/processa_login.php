<?php
session_start();
require_once 'conexao.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Atualizado: incluindo idPermissao e email no SELECT
    $stmt = $conn->prepare("SELECT idUsuario, nomeCompleto, email, idPermissao, senha FROM usuario WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        if (password_verify($senha, $usuario['senha'])) {
            // Organizando tudo dentro de $_SESSION['usuario']
            $_SESSION['usuario'] = [
                'idUsuario'     => $usuario['idUsuario'],
                'nomeCompleto'  => $usuario['nomeCompleto'],
                'email'         => $usuario['email'],
                'idPermissao'   => $usuario['idPermissao']
            ];

            // Redireciona para a página inicial
            header("Location: http://localhost/Projeto-LionKing-main/Root/");
            exit();
        }
    }

    // Redireciona com erro
    header("Location: login.php?erro=1");
    exit();
}
?>