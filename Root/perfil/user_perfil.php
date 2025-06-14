<?php
session_start();

// Só usuário comum pode acessar (idPermissao == 1)
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['idPermissao'] != 1) {
    header('Location: ../login/login.html');
    exit;
}

// Banco orientado a objetos
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

    public function atualizarDados($idUsuario, $dados) {
        $sql = "UPDATE usuario SET nomeCompleto = ?, email = ?, telefone = ?, estado = ?, cidade = ?, bairro = ?, rua = ?, numero = ?, cpf = ?, login = ? WHERE idUsuario = ?";
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

$db = new Database();
$pdo = $db->getConnection();
$usuario = new Usuario($pdo);
$idUsuario = $_SESSION['usuario']['idUsuario'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario->atualizarDados($idUsuario, $_POST);
    echo "<p>Dados atualizados com sucesso!</p>";
}

$dados = $usuario->buscarDados($idUsuario);
?>

<h1>Meu Perfil (Usuário)</h1>
<form method="POST">
    Nome: <input type="text" name="nomeCompleto" value="<?= htmlspecialchars($dados['nomeCompleto']) ?>"><br>
    Email: <input type="email" name="email" value="<?= htmlspecialchars($dados['email']) ?>"><br>
    Telefone: <input type="text" name="telefone" value="<?= htmlspecialchars($dados['telefone']) ?>"><br>
    Estado: <input type="text" name="estado" value="<?= htmlspecialchars($dados['estado']) ?>"><br>
    Cidade: <input type="text" name="cidade" value="<?= htmlspecialchars($dados['cidade']) ?>"><br>
    Bairro: <input type="text" name="bairro" value="<?= htmlspecialchars($dados['bairro']) ?>"><br>
    Rua: <input type="text" name="rua" value="<?= htmlspecialchars($dados['rua']) ?>"><br>
    Número: <input type="text" name="numero" value="<?= htmlspecialchars($dados['numero']) ?>"><br>
    CPF: <input type="text" name="cpf" value="<?= htmlspecialchars($dados['cpf']) ?>"><br>
    Login: <input type="text" name="login" value="<?= htmlspecialchars($dados['login']) ?>"><br>
    <button type="submit">Salvar</button>
</form>