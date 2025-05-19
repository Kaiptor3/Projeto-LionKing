<?php
define('SERVIDOR', 'localhost');
define('USUARIO', 'root');
define('SENHA', '');
define('BANCODEDADOS', 'exemplo_criptografia');

function conectaPDO() {
    try {
        $conn = new PDO("mysql:host=".SERVIDOR.";dbname=".BANCODEDADOS, USUARIO, SENHA);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        echo 'Erro ao conectar: ' . $e->getMessage();
        exit;
    }
}
?>
