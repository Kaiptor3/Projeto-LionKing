<?php
require_once "dados_acesso.php";

function conectaPDO() {
    try {
        $conn = new PDO(DSN . ":host=" . SERVIDOR . ";dbname=" . BANCODEDADOS, USUARIO, SENHA);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        die("Erro ao conectar com o banco de dados: " . $e->getMessage());
    }
}

?>
