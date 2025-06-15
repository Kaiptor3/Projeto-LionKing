<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ✅ Verifica se o usuário está logado
if (!isset($_SESSION['usuario'])) {
    header('Location: /Projeto-LionKing-main/Root/login/login.php');
    exit;
}

// ✅ Conexão com o banco
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

// ✅ Classe de usuário
class Usuario {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function buscar($id) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuario WHERE idUsuario = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function atualizar($dados) {
        $stmt = $this->pdo->prepare("UPDATE usuario SET nomeCompleto = ?, email = ?, telefone = ?, estado = ?, cidade = ?, bairro = ?, rua = ?, numero = ? WHERE idUsuario = ?");
        return $stmt->execute([
            $dados['nomeCompleto'], $dados['email'], $dados['telefone'],
            $dados['estado'], $dados['cidade'], $dados['bairro'],
            $dados['rua'], $dados['numero'], $dados['idUsuario']
        ]);
    }
}

$db = new Database();
$pdo = $db->getConnection();
$usuario = new Usuario($pdo);

// ✅ ID do usuário da sessão
$idUsuario = $_SESSION['usuario']['idUsuario'];
$dados = $usuario->buscar($idUsuario);

// ✅ Se formulário enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $atualizados = [
        'nomeCompleto' => $_POST['nomeCompleto'],
        'email' => $_POST['email'],
        'telefone' => $_POST['telefone'],
        'estado' => $_POST['estado'],
        'cidade' => $_POST['cidade'],
        'bairro' => $_POST['bairro'],
        'rua' => $_POST['rua'],
        'numero' => $_POST['numero'],
        'idUsuario' => $idUsuario
    ];

    if ($usuario->atualizar($atualizados)) {
        header("Location: ../perfil/user_perfil.php?atualizado=1");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Editar Perfil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background: rgb(0, 0, 0);
    }

    .form-control:focus {
        box-shadow: none;
        border-color: rgb(0, 0, 0);
    }

    .profile-button {
        background: rgb(0, 0, 0);
        box-shadow: none;
        border: none;
    }

    .profile-button:hover {
        background: rgb(30, 30, 30);
    }

    .labels {
        font-size: 13px;
        color: #555;
    }
    </style>
</head>

<body>
    <div class="container rounded bg-white mt-5 mb-5">
        <form method="POST">
            <div class="row">
                <div class="col-md-3 border-right">
                    <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                        <img class="rounded-circle mt-5" width="150px"
                            src="https://st3.depositphotos.com/15648834/17930/v/600/depositphotos_179308454-stock-illustration-unknown-person-silhouette-glasses-profile.jpg">
                        <span class="font-weight-bold"><?= htmlspecialchars($dados['nomeCompleto']) ?></span>
                        <span class="text-black-50"><?= htmlspecialchars($dados['email']) ?></span>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="p-3 py-5">
                        <h4 class="text-right mb-4">Edite seu Perfil</h4>
                        <div class="row mt-2">
                            <div class="col-md-6">
                                <label class="labels">Nome Completo</label>
                                <input type="text" class="form-control" name="nomeCompleto"
                                    value="<?= htmlspecialchars($dados['nomeCompleto']) ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Telefone</label>
                                <input type="text" class="form-control" name="telefone"
                                    value="<?= htmlspecialchars($dados['telefone']) ?>">
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <label class="labels">Email</label>
                                <input type="email" class="form-control" name="email"
                                    value="<?= htmlspecialchars($dados['email']) ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Estado</label>
                                <input type="text" class="form-control" name="estado"
                                    value="<?= htmlspecialchars($dados['estado']) ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Cidade</label>
                                <input type="text" class="form-control" name="cidade"
                                    value="<?= htmlspecialchars($dados['cidade']) ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Bairro</label>
                                <input type="text" class="form-control" name="bairro"
                                    value="<?= htmlspecialchars($dados['bairro']) ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Rua</label>
                                <input type="text" class="form-control" name="rua"
                                    value="<?= htmlspecialchars($dados['rua']) ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="labels">Número</label>
                                <input type="text" class="form-control" name="numero"
                                    value="<?= htmlspecialchars($dados['numero']) ?>">
                            </div>
                        </div>
                        <div class="mt-4 text-center">
                            <button class="btn btn-primary profile-button" type="submit">Salvar Alterações</button>
                            <a href="../perfil/user_perfil.php" class="btn btn-primary profile-button">Cancelar</a>
                            <a href="../index.php" class="btn btn-primary profile-button">Home</a>

                            <?php if (isset($_SESSION['usuario'])): ?>
                            <?php if ($_SESSION['usuario']['idPermissao'] == 2): ?>
                            <a href="../perfil/user_perfil.php" class="btn btn-primary profile-button">Voltar</a>
                            <?php elseif ($_SESSION['usuario']['idPermissao'] == 1): ?>
                            <a href="../perfil/admin_dashboard.php" class="btn btn-primary profile-button">Voltar</a>
                            <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
