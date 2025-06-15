<?php
$servername = "localhost";
$username = "root";  // altere se seu MySQL for diferente
$password = "";      // altere se tiver senha
$database = "lion_king";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>
