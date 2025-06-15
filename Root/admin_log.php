<?php
session_start();
require_once 'login/conexao.php';

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['idPermissao'] != 1) {
    header("Location: /Projeto-LionKing-main/Root/login/login.php");
    exit;
}

// Pega o id do usuário via GET, ex: ver_log.php?id=5
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    echo "ID do usuário inválido.";
    exit;
}

$idUsuario = (int) $_GET['id'];

// Busca o nome do usuário (opcional, pra mostrar no título)
$stmtUser = $conn->prepare("SELECT nomeCompleto FROM usuario WHERE idUsuario = ?");
$stmtUser->bind_param("i", $idUsuario);
$stmtUser->execute();
$resultUser = $stmtUser->get_result();
if ($resultUser->num_rows === 0) {
    echo "Usuário não encontrado.";
    exit;
}
$usuario = $resultUser->fetch_assoc();

// Busca os logs desse usuário
$stmtLog = $conn->prepare("SELECT dataHora, acao FROM log_usuario WHERE idUsuario = ? ORDER BY dataHora DESC");
$stmtLog->bind_param("i", $idUsuario);
$stmtLog->execute();
$resultLog = $stmtLog->get_result();

?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Admin - Log</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        margin: 0;
        background-color: #f5f5f5;
    }

    .navbar {
        background-color: rgb(0, 0, 0);
        color: white;
        padding: 15px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .navbar a {
        color: white;
        margin-left: 15px;
        text-decoration: none;
        font-weight: bold;
    }

    .container {
        padding: 30px;
    }

    h1 {
        font-size: 28px;
        margin-bottom: 20px;
    }

    .log-box {
        background: white;
        border-radius: 8px;
        box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        max-width: 700px;
    }

    .log-box h2 {
        margin-top: 0;
        font-size: 20px;
        border-bottom: 1px solid #ccc;
        padding-bottom: 10px;
    }

    .log-entry {
        padding: 6px 0;
        border-bottom: 1px solid #eee;
        font-family: monospace;
    }

    .log-entry:last-child {
        border-bottom: none;
    }

    .log-entry time {
        color: #888;
        font-size: 12px;
        display: block;
    }
    </style>
</head>

<body>
    <div class="navbar">
        <div><strong>Admin</strong></div>
        <div>
            <a href="/Projeto-LionKing-main/Root/">Home</a>
            <a href="perfil/admin_lista.php">Usuários</a>
            <a href="perfil/admin_perfil.php">Configurações</a>
            <a href="login/logout.php">Sair</a>
        </div>
    </div>
    <div class="container">
        <h1><?= htmlspecialchars($usuario['nomeCompleto']) ?></h1>
        <div class="log-box">
            <h2>Log</h2>
            <?php if ($resultLog->num_rows === 0): ?>
            <p class="log-entry">Nenhum log encontrado.</p>
            <?php else: ?>
             <?php while ($log = $resultLog->fetch_assoc()): ?>
                <div class="log-entry">
                    <time><?= htmlspecialchars($log['dataHora']) ?></time>
                    <strong><?= htmlspecialchars($usuario['nomeCompleto']) ?></strong>: 
                    <?= htmlspecialchars($log['acao']) ?>
                    </div>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>
