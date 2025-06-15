<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['idPermissao'] != 1) {
    header('Location: /Projeto-LionKing-main/Root/login/login.php');
    exit;
}

class Database {
    private $pdo;
    public function __construct() {
        $this->pdo = new PDO('mysql:host=localhost;dbname=lion_king;charset=utf8mb4', 'root', '', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
        ]);
    }
    public function getConnection() {
        return $this->pdo;
    }
}

class Usuario {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function buscarDados($idUsuario) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuario WHERE idUsuario = ?");
        $stmt->execute([$idUsuario]);
        return $stmt->fetch();
    }
}

$db = new Database();
$pdo = $db->getConnection();
$usuario = new Usuario($pdo);

$idUsuario = $_SESSION['usuario']['idUsuario'];
$dados = $usuario->buscarDados($idUsuario);
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Perfil do Administrador</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block"><a href="admin_dashboard.php"
                        class="nav-link">Dashboard</a></li>
                <li class="nav-item d-none d-sm-inline-block"><a href="admin_perfil.php" class="nav-link">Perfil</a>
                </li>
            </ul>
        </nav>
        <!-- Sidebar -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="#" class="brand-link">
                <span class="brand-text font-weight-light">Lion King</span>
            </a>
            <div class="sidebar">
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" role="menu">
                        <li class="nav-item">
                            <a href="admin_dashboard.php" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="admin_perfil.php" class="nav-link">
                                <i class="nav-icon fas fa-user"></i>
                                <p>Perfil do Admin</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../painel/crud_carros/painel_carros.php" class="nav-link">
                                <i class="nav-icon fas fa-car"></i>
                                <p>Carros</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="admin_lista.php" class="nav-link">
                                <i class="nav-icon fas fa-users"></i>
                                <p>Users</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../admin_log.php?id=<?= $_SESSION['usuario']['idUsuario'] ?>" class="nav-link">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>Logs</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>
        <!-- Conteúdo -->
        <div class="content-wrapper">
            <div class="content-header">
                <div class="container-fluid">
                    <h1 class="m-0">Perfil do Administrador</h1>
                </div>
            </div>

            <section class="content">
                <div class="container-fluid">
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Nome:</strong>
                                    <?= htmlspecialchars($dados['nomeCompleto']) ?></li>
                                <li class="list-group-item"><strong>Email:</strong>
                                    <?= htmlspecialchars($dados['email']) ?></li>
                                <li class="list-group-item"><strong>Telefone:</strong>
                                    <?= htmlspecialchars($dados['telefone']) ?></li>
                                <li class="list-group-item"><strong>Estado:</strong>
                                    <?= htmlspecialchars($dados['estado']) ?></li>
                                <li class="list-group-item"><strong>Cidade:</strong>
                                    <?= htmlspecialchars($dados['cidade']) ?></li>
                                <li class="list-group-item"><strong>Bairro:</strong>
                                    <?= htmlspecialchars($dados['bairro']) ?></li>
                                <li class="list-group-item"><strong>Rua:</strong> <?= htmlspecialchars($dados['rua']) ?>
                                </li>
                                <li class="list-group-item"><strong>Número:</strong>
                                    <?= htmlspecialchars($dados['numero']) ?></li>
                                <li class="list-group-item"><strong>CPF:</strong> <?= htmlspecialchars($dados['cpf']) ?>
                                </li>
                                <li class="list-group-item"><strong>Login:</strong>
                                    <?= htmlspecialchars($dados['login']) ?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>

</html>
