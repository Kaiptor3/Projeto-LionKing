<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// ✅ Só usuário comum (idPermissao == 2) pode acessar
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['idPermissao'] != 2) {
    header('Location: /Projeto-LionKing-main/Root/login/login.php');
    exit;
}

// ✅ Conexão PDO
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

// ✅ Classe usuário
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

    public function atualizarDados($idUsuario, $dados) {
        $sql = "UPDATE usuario 
                SET nomeCompleto = ?, email = ?, telefone = ?, estado = ?, cidade = ?, bairro = ?, rua = ?, numero = ?, cpf = ?, login = ? 
                WHERE idUsuario = ?";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            $dados['nomeCompleto'],
            $dados['email'],
            $dados['telefone'],
            $dados['estado'],
            $dados['cidade'],
            $dados['bairro'],
            $dados['rua'],
            $dados['numero'],
            $dados['cpf'],
            $dados['login'],
            $idUsuario
        ]);
    }
}

// ✅ Instância e lógica
$db = new Database();
$pdo = $db->getConnection();
$usuario = new Usuario($pdo);
$idUsuario = $_SESSION['usuario']['idUsuario'];

$mensagem = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($usuario->atualizarDados($idUsuario, $_POST)) {
        $mensagem = "✅ Dados atualizados com sucesso!";
    } else {
        $mensagem = "❌ Erro ao atualizar dados.";
    }
}

$dados = $usuario->buscarDados($idUsuario);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Meu Perfil - Usuário</title>
    <link rel="stylesheet" href="perfil.css">
</head>
<body>

    <h1>Meu Perfil (Usuário)</h1>

    <?php if ($mensagem): ?>
        <p><?= htmlspecialchars($mensagem) ?></p>
    <?php endif; ?>

    <form method="POST">
        <label>Nome: <input type="text" name="nomeCompleto" value="<?= htmlspecialchars($dados['nomeCompleto']) ?>" required></label><br>
        <label>Email: <input type="email" name="email" value="<?= htmlspecialchars($dados['email']) ?>" required></label><br>
        <label>Telefone: <input type="text" name="telefone" value="<?= htmlspecialchars($dados['telefone']) ?>"></label><br>
        <label>Estado: <input type="text" name="estado" value="<?= htmlspecialchars($dados['estado']) ?>"></label><br>
        <label>Cidade: <input type="text" name="cidade" value="<?= htmlspecialchars($dados['cidade']) ?>"></label><br>
        <label>Bairro: <input type="text" name="bairro" value="<?= htmlspecialchars($dados['bairro']) ?>"></label><br>
        <label>Rua: <input type="text" name="rua" value="<?= htmlspecialchars($dados['rua']) ?>"></label><br>
        <label>Número: <input type="text" name="numero" value="<?= htmlspecialchars($dados['numero']) ?>"></label><br>
        <label>CPF: <input type="text" name="cpf" value="<?= htmlspecialchars($dados['cpf']) ?>" required></label><br>
        <label>Login: <input type="text" name="login" value="<?= htmlspecialchars($dados['login']) ?>" required></label><br>
        <br>
        <button type="submit">Salvar</button>
    </form>

</body>
</html>