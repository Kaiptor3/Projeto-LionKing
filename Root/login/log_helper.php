<?php
function registrarLog($conn, $idUsuario, $acao) {
    $stmt = $conn->prepare("INSERT INTO log_usuario (idUsuario, acao) VALUES (?, ?)");
    $stmt->bind_param("is", $idUsuario, $acao);
    $stmt->execute();
}
?>