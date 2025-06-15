<?php
session_start();

require_once 'conexao.php';
require_once 'log_helper.php'; // <- adicione essa linha

if (!isset($_SESSION['usuario_temp'])) {
    header("Location: login.php");
    exit;
}

// Normaliza entrada do usuário (dd/mm/yyyy para Y-m-d)
function formatarParaDataISO($data) {
    $partes = explode('/', trim($data));
    if (count($partes) === 3) {
        list($dia, $mes, $ano) = $partes;
        return "$ano-$mes-$dia"; // yyyy-mm-dd
    }
    return null;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $resposta = $_POST['resposta'];
    $respostaISO = formatarParaDataISO($resposta); // 2004-11-19
    $resposta_correta = $_SESSION['resposta_correta']; // também 2004-11-19

    if ($respostaISO && $respostaISO === $resposta_correta) {
        $_SESSION['usuario'] = $_SESSION['usuario_temp'];
        $idUsuario = $_SESSION['usuario']['idUsuario'];

        unset($_SESSION['usuario_temp'], $_SESSION['resposta_correta'], $_SESSION['pergunta_2fa'], $_SESSION['tentativas_2fa']);

        registrarLog($conn, $idUsuario, 'Login realizado');

        header("Location: ../index.php");
        exit;
    } else {
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
}
?>
