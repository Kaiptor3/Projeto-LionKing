<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (!isset($_SESSION['usuario'])) {
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
    <title>Perfil do Usuário</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
    body {
        background: rgb(0, 0, 0)
    }

    .form-control:focus {
        box-shadow: none;
        border-color: rgb(0, 0, 0)
    }

    .profile-button {
        background: rgb(0, 0, 0);
        box-shadow: none;
        border: none
    }

    .profile-button:hover,
    .profile-button:focus,
    .profile-button:active {
        background: rgb(2, 2, 2);
        box-shadow: none
    }

    .back:hover {
        color: rgb(0, 0, 0);
        cursor: pointer
    }

    .labels {
        font-size: 11px
    }

    .add-experience:hover {
        background: rgb(0, 0, 0);
        color: #fff;
        cursor: pointer;
        border: solid 1pxrgb(0, 0, 0)
    }
    </style>
</head>

<body>
    <div class="container rounded bg-white mt-5 mb-5">
        <div class="row">
            <div class="col-md-3 border-right">
                <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                    <img class="rounded-circle mt-5" width="150px"
                        src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                    <span class="font-weight-bold"><?= htmlspecialchars($dados['nomeCompleto']) ?></span>
                    <span class="text-black-50"><?= htmlspecialchars($dados['email']) ?></span>
                </div>
            </div>
            <div class="col-md-5 border-right">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="text-right">Informações do Perfil</h4>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12"><label class="labels">Nome Completo</label><input type="text"
                                class="form-control" value="<?= htmlspecialchars($dados['nomeCompleto']) ?>" readonly>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-12"><label class="labels">Telefone</label><input type="text"
                                class="form-control" value="<?= htmlspecialchars($dados['telefone']) ?>" readonly></div>
                                <div class="col-md-12"><label class="labels">Cep</label><input type="text"
                                class="form-control" value="<?= htmlspecialchars($dados['cep']) ?>" readonly></div>
                        <div class="col-md-12"><label class="labels">Rua</label><input type="text" class="form-control"
                                value="<?= htmlspecialchars($dados['rua']) ?>" readonly></div>
                        <div class="col-md-12"><label class="labels">Número</label><input type="text"
                                class="form-control" value="<?= htmlspecialchars($dados['numero']) ?>" readonly></div>
                        <div class="col-md-12"><label class="labels">Bairro</label><input type="text"
                                class="form-control" value="<?= htmlspecialchars($dados['bairro']) ?>" readonly></div>
                        <div class="col-md-12"><label class="labels">Cidade</label><input type="text"
                                class="form-control" value="<?= htmlspecialchars($dados['cidade']) ?>" readonly></div>
                        <div class="col-md-12"><label class="labels">Estado</label><input type="text"
                                class="form-control" value="<?= htmlspecialchars($dados['estado']) ?>" readonly></div>
                        <div class="col-md-12"><label class="labels">Email</label><input type="text"
                                class="form-control" value="<?= htmlspecialchars($dados['email']) ?>" readonly></div>
                        <div class="col-md-12"><label class="labels">CPF</label><input type="text" class="form-control"
                                value="<?= htmlspecialchars($dados['cpf']) ?>" readonly></div>
                    </div>
                    <div class="mt-5 text-center">
                        <a href="../login/editar_usuario.php" class="btn btn-primary profile-button">Editar Perfil</a>
                        <a href="../index.php" class="btn btn-primary profile-button">Home</a>

                        <?php if ($_SESSION['usuario']['idPermissao'] == 1): ?>
                        <a href="./admin_dashboard.php" class="btn btn-primary profile-button">Painel</a>
                        <?php endif; ?>
                    </div>

                </div>
            </div>
            <div class="col-md-4">
                <div class="p-3 py-5">
                    <div class="d-flex justify-content-between align-items-center experience">
                        <span>Outras Informações</span>
                    </div><br>
                    <div class="col-md-12"><label class="labels">Login</label><input type="text" class="form-control"
                            value="<?= htmlspecialchars($dados['login']) ?>" readonly></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
