<?php
require_once '../../controllers/CarroController.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $excluiu = CarroController::excluirCarro($id);

    if ($excluiu) {
        // Exclusão OK, redireciona de volta pro painel
        header("Location: painel_carros.php?msg=deletado");
        exit;
    } else {
        echo "Erro ao deletar o carro.";
    }
} else {
    echo "ID inválido.";
}
?>
