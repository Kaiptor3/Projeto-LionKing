<?php
session_start();
require_once 'conexao.php';
require_once 'log_helper.php'; // Se usar para logs, mantenha aqui

// Limpa variáveis temporárias 2FA
unset($_SESSION['usuario_temp'], $_SESSION['resposta_correta'], $_SESSION['pergunta_2fa'], $_SESSION['tentativas_2fa']);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = trim($_POST['email'] ?? '');
    $senha = $_POST['senha'] ?? '';

    if (empty($email) || empty($senha)) {
        $_SESSION['msg'] = "Email e senha são obrigatórios.";
        $_SESSION['msg_type'] = "error";
        header("Location: login.php");
        exit();
    }

    // Preparar e executar consulta segura
    $stmt = $conn->prepare("SELECT idUsuario, nomeCompleto, email, idPermissao, senha, dataNascimento, login FROM usuario WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows === 1) {
        $usuario = $resultado->fetch_assoc();

        // Verifica se a senha no banco é hash (obrigatório)
        $senhaBanco = $usuario['senha'];
        $infoHash = password_get_info($senhaBanco);

        if ($infoHash['algo'] === 0) {
            // Senha armazenada não é hash válido - bloquear login por segurança
            $_SESSION['msg'] = "Erro no sistema: senha armazenada inválida. Contate o suporte.";
            $_SESSION['msg_type'] = "error";
            header("Location: login.php");
            exit();
        }

        // Verifica senha com password_verify
        if (password_verify($senha, $senhaBanco)) {
            // Login OK: salva dados na sessão para 2FA
            $_SESSION['usuario_temp'] = [
                'idUsuario'     => $usuario['idUsuario'],
                'nomeCompleto'  => $usuario['nomeCompleto'],
                'email'         => $usuario['email'],
                'idPermissao'   => $usuario['idPermissao'],
                'login'   => $usuario['login'],
                
            ];

            $_SESSION['resposta_correta'] = $usuario['dataNascimento'];

            header("Location: 2fa.php");
            exit();
        } else {
            // Senha incorreta
            $_SESSION['msg'] = "Email ou senha incorretos.";
            $_SESSION['msg_type'] = "error";
            header("Location: login.php");
            exit();
        }

    } else {
        // Usuário não encontrado
        $_SESSION['msg'] = "Email ou senha incorretos.";
        $_SESSION['msg_type'] = "error";
        header("Location: login.php");
        exit();
    }

} else {
    // Acesso via GET ou outro método não permitido
    header("Location: login.php");
    exit();
}
