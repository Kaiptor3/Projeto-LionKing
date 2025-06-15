<?php
session_start();
require_once 'conexao.php';
require_once 'log_helper.php';

// Impede acesso direto sem POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['resposta'])) {
    header("Location: 2fa.php");
    exit;
}

// Função para converter dd/mm/yyyy → yyyy-mm-dd
function formatarParaDataISO($data) {
    $partes = explode('/', trim($data));
    if (count($partes) === 3) {
        list($dia, $mes, $ano) = $partes;
        return "$ano-$mes-$dia";
    }
    return null;
}

// Verifica se o usuário está na etapa de 2FA
if (!isset($_SESSION['usuario_temp']) || !isset($_SESSION['resposta_correta'])) {
    header("Location: login.php");
    exit;
}

$resposta = $_POST['resposta'];
$respostaISO = formatarParaDataISO($resposta);
$respostaCorreta = $_SESSION['resposta_correta'];

if ($respostaISO && $respostaISO === $respostaCorreta) {
    $_SESSION['usuario'] = $_SESSION['usuario_temp'];
    $idUsuario = $_SESSION['usuario']['idUsuario'];

    // Limpa dados temporários
    unset($_SESSION['usuario_temp'], $_SESSION['resposta_correta'], $_SESSION['pergunta_2fa'], $_SESSION['tentativas_2fa']);

    // Registra login no log
    registrarLog($conn, $idUsuario, 'Login realizado');

    header("Location: ../index.php");
    exit;
} else {
    // Controle de tentativas
    $_SESSION['tentativas_2fa'] = ($_SESSION['tentativas_2fa'] ?? 0) + 1;

    if ($_SESSION['tentativas_2fa'] >= 3) {
        unset($_SESSION['usuario_temp'], $_SESSION['resposta_correta'], $_SESSION['pergunta_2fa'], $_SESSION['tentativas_2fa']);
        header("Location: login.php?erro=2fa");
        exit;
    }

    $_SESSION['erro_2fa'] = "Resposta incorreta. Tentativa {$_SESSION['tentativas_2fa']} de 3.";
    header("Location: 2fa.php");
    exit;
}
