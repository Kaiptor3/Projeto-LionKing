<?php
require_once '../controllers/UsuarioController.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    UsuarioController::excluirUsuario($id);
    header('Location: admin_lista.php');
    exit;
} else {
    echo "ID inválido.";
}
?>