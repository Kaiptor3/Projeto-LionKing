<?php
session_start();

if (!isset($_SESSION['usuario_id']) || !isset($_SESSION['pergunta_2fa'])) {
    header("Location: cadastro.php");
    exit;
}

// Conexão com banco
$pdo = new PDO('mysql:host=localhost;dbname=seu_banco;charset=utf8', 'usuario', 'senha');

// Busca dados do usuário
$stmt = $pdo->prepare("SELECT * FROM usuarios WHERE id = ?");
$stmt->execute([$_SESSION['usuario_id']]);
$usuario = $stmt->fetch(PDO::FETCH_ASSOC);

$resposta = $_POST['resposta'] ?? '';
$campo = $_SESSION['pergunta_2fa'];
$valorCorreto = $usuario[$campo];

// Valida resposta
if (strtolower(trim($resposta)) === strtolower(trim($valorCorreto))) {
    // Autenticação completa
    unset($_SESSION['pergunta_2fa']);
    $_SESSION['autenticado'] = true;
    header("Location: area_restrita.php");
} else {
    // Tentativas
    $_SESSION['tentativas_2fa'] = ($_SESSION['tentativas_2fa'] ?? 0) + 1;
    
    if ($_SESSION['tentativas_2fa'] >= 3) {
        session_unset();
        session_destroy();
        header("Location: login.php?erro=3+tentativas+sem+sucesso!+Favor+realizar+Login+novamente");
    } else {
        header("Location: 2fa.php");
    }
}
