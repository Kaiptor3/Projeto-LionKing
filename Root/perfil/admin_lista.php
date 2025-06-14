<?php
session_start();

// Só admin pode acessar (idPermissao == 2)
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['idPermissao'] != 2) {
    header('Location: ../login/login.html');
    exit;
}

// Classe de Conexão
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

// Classe de Relatório
class Relatorio {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function listarComprasUsuarios() {
        $sql = "
            SELECT 
                u.nomeCompleto AS nome,
                u.email,
                u.telefone,
                u.estado,
                u.cidade,
                u.bairro,
                u.rua,
                u.numero,
                u.cpf,
                u.login,
                c.modelo AS carro,
                c.preco,
                co.dataCompra
            FROM usuario u
            JOIN compra co ON u.idUsuario = co.idUsuario
            JOIN compraCarro cc ON co.idCompra = cc.idCompra
            JOIN carro c ON cc.idCarro = c.idCarro
        ";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll();
    }
}

$db = new Database();
$pdo = $db->getConnection();
$relatorio = new Relatorio($pdo);
$dados = $relatorio->listarComprasUsuarios();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Lista de Compras</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.3.0/js/dataTables.js"></script>
</head>

<body>

    <h1>Lista de Compras - Painel Administrativo</h1>

    <table id="example" class="display">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Estado</th>
                <th>Cidade</th>
                <th>Bairro</th>
                <th>Rua</th>
                <th>Número</th>
                <th>CPF</th>
                <th>Login</th>
                <th>Modelo do Carro</th>
                <th>Preço</th>
                <th>Data da Compra</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($dados as $linha): ?>
            <tr>
                <td><?= htmlspecialchars($linha['nome']) ?></td>
                <td><?= htmlspecialchars($linha['email']) ?></td>
                <td><?= htmlspecialchars($linha['telefone']) ?></td>
                <td><?= htmlspecialchars($linha['estado']) ?></td>
                <td><?= htmlspecialchars($linha['cidade']) ?></td>
                <td><?= htmlspecialchars($linha['bairro']) ?></td>
                <td><?= htmlspecialchars($linha['rua']) ?></td>
                <td><?= htmlspecialchars($linha['numero']) ?></td>
                <td><?= htmlspecialchars($linha['cpf']) ?></td>
                <td><?= htmlspecialchars($linha['login']) ?></td>
                <td><?= htmlspecialchars($linha['carro']) ?></td>
                <td data-order="<?= $linha['preco'] ?>">R$ <?= number_format($linha['preco'], 2, ',', '.') ?></td>
                <td><?= date('d/m/Y', strtotime($linha['dataCompra'])) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
    $(document).ready(function() {
        $('#example').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json'
            }
        });
    });
    </script>

</body>

</html>