<?php
require_once "classes/Conexao.php";

class LogUsuario {
    private $pdo;

    public function __construct() {
        $this->pdo = Conexao::conectar();
    }

    public function listarLogs() {
        $sql = "
            SELECT lu.dataHora, u.nomeCompleto, lu.acao
            FROM log_usuario lu
            JOIN usuario u ON lu.idUsuario = u.idUsuario
            ORDER BY lu.dataHora DESC
        ";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}