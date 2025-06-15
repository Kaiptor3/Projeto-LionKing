<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Proteção: exige login
if (!isset($_SESSION['usuario'])) {
    header("Location: login/login.php"); // redireciona para o login
    exit();
}

// Nome do usuário logado
$nomeUsuario = $_SESSION['usuario']['nomeCompleto'];

// Caminho do arquivo de log
$logFile = "log.txt";

// Lê o arquivo se existir e inverte a ordem para mostrar os mais recentes primeiro
$logs = file_exists($logFile) ? array_reverse(file($logFile)) : [];

// Função para registrar log
function registrarLog($nome, $acao) {
    $data = date("Y-m-d H:i:s");
    $linha = "$data - $nome - $acao\n";
    file_put_contents("log.txt", $linha, FILE_APPEND);
}

// Registra que acessou o painel
registrarLog($nomeUsuario, "Acessou o painel de logs");
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
            <a href="#">Dashboard</a>
            <a href="#">Usuários</a>
            <a href="#">Configurações</a>
            <a href="login/logout.php">Sair</a>
        </div>
    </div>
    <div class="container">
        <h1><?php echo htmlspecialchars($nomeUsuario); ?></h1>
        <div class="log-box">
            <h2>Log</h2>
            <?php if (empty($logs)): ?>
            <p class="log-entry">Nenhum log encontrado.</p>
            <?php else: ?>
            <?php foreach ($logs as $linha): ?>
            <div class="log-entry">
                <?php
                        $linha = trim($linha);
                        $partes = explode(" - ", $linha, 3);
                        if (count($partes) === 3) {
                            echo "<time>{$partes[0]}</time><strong>{$partes[1]}</strong>: {$partes[2]}";
                        } else {
                            echo htmlspecialchars($linha);
                        }
                        ?>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>