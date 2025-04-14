<?php
$page = $_GET['page'] ?? 'home';

if ($page === 'home') {
    include 'home.php'; // Agora inclui o HTML da home
} else {
    include '404.php';  // Página de erro
    exit;
}
?>
