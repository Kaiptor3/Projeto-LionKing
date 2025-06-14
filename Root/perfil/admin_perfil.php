<?php
session_start();

// Só admin pode acessar (idPermissao == 2)
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['idPermissao'] != 2) {
    header('Location: ../login/login.html');
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

<h1>Meu Perfil (Admin)</h1>
<ul>
    <li>Nome: <?= htmlspecialchars($dados['nomeCompleto']) ?></li>
    <li>Email: <?= htmlspecialchars($dados['email']) ?></li>
    <li>Telefone: <?= htmlspecialchars($dados['telefone']) ?></li>
    <li>Estado: <?= htmlspecialchars($dados['estado']) ?></li>
    <li>Cidade: <?= htmlspecialchars($dados['cidade']) ?></li>
    <li>Bairro: <?= htmlspecialchars($dados['bairro']) ?></li>
    <li>Rua: <?= htmlspecialchars($dados['rua']) ?></li>
    <li>Número: <?= htmlspecialchars($dados['numero']) ?></li>
    <li>CPF: <?= htmlspecialchars($dados['cpf']) ?></li>
    <li>Login: <?= htmlspecialchars($dados['login']) ?></li>
</ul>