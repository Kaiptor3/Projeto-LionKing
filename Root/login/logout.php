<?php
session_start();
require_once 'conexao.php';
require_once 'log_helper.php';

if (isset($_SESSION['usuario']['idUsuario'])) {
    $idUsuario = $_SESSION['usuario']['idUsuario'];
    registrarLog($conn, $idUsuario, 'Logout realizado');
}

session_unset();
session_destroy();
header("Location: login.php");
exit();

?>
