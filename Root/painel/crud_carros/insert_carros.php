<?php
require_once __DIR__ . '/../../controllers/CarroController.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    CarroController::inserirCarro($_POST, $_FILES);
    header("Location: painel_carros.php"); // redireciona após inserção
    exit;
}
?>