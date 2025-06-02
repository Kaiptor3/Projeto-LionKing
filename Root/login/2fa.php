<?php
session_start();

if (!isset($_SESSION['usuario_id'])) {
    header("Location: cadastro.php");
    exit;
}

// Perguntas de segurança
$perguntas = [
    'nome_mae' => "Qual o nome da sua mãe?",
    'data_nascimento' => "Qual a data do seu nascimento? (AAAA-MM-DD)",
    'cep' => "Qual o CEP do seu endereço?"
];

// Seleciona pergunta aleatória
$chave = array_rand($perguntas);
$pergunta = $perguntas[$chave];

$_SESSION['pergunta_2fa'] = $chave;
$_SESSION['tentativas_2fa'] = 0;
?>

<!DOCTYPE html>
<html>
<head>
    <title>Autenticação em 2 Fatores</title>
</head>
<body>
    <h1>Verificação de Segurança</h1>
    <form method="POST" action="processa_2fa.php">
        <p><?= $pergunta ?></p>
        Resposta: <input type="text" name="resposta" required><br>
        <input type="submit" value="Verificar">
    </form>
</body>
</html>
