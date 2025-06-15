<?php
session_start();
session_unset();     // limpa variáveis da sessão
session_destroy();   // destrói a sessão atual

// Impede cache da página antiga após logout
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 1 Jan 2000 00:00:00 GMT");

// Redireciona para tela de login (ajuste se necessário)
header("Location: login.php");
exit();