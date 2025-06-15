<?php
session_start();
require_once 'conexao.php';
require_once 'log_helper.php'; // <- adicione essa linha

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $stmt = $conn->prepare("SELECT idUsuario, nomeCompleto, email, idPermissao, senha, dataNascimento FROM usuario WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        if (password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario_temp'] = [
                'idUsuario'     => $usuario['idUsuario'],
                'nomeCompleto'  => $usuario['nomeCompleto'],
                'email'         => $usuario['email'],
                'idPermissao'   => $usuario['idPermissao']
            ];

            $_SESSION['resposta_correta'] = $usuario['dataNascimento'];

            header("Location: 2fa.php");
            exit();
        }
    }

    header("Location: login.php?erro=1");
    exit();
}
?>