<?php
// Verifica se usuário está logado e se é admin (idPermissao == 2)
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['idPermissao'] != 2) {
    // Redireciona para página de login, por exemplo
    header('Location: ../login/login.html');
    exit;
}

// Ativar erros para debug
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Conexão com o banco de dados
$host = 'localhost';
$db   = 'lion_king';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);

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

    $stmt = $pdo->query($sql);
    $dados = $stmt->fetchAll();
} catch (PDOException $e) {
    echo "Erro ao conectar: " . $e->getMessage();
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lion King - Administração</title>
    <link rel="icon" type="image/png" href="./imgs/favicon.png" sizes="16x16">

    <!-- CSS Pessoal -->
    <link rel="stylesheet" href="adm.css">

    <!-- Google Fonts e FontAwesome -->
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Montserrat:wght@400&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.dataTables.css">

    <!-- jQuery e DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.3.0/js/dataTables.js"></script>
</head>
<body>

<h1>Lista de Compras - Lion King</h1>

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
    $(document).ready(function () {
        if (!$.fn.DataTable.isDataTable('#example')) {
            $('#example').DataTable({
                language: {
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json'
                }
            });
        }
    });
</script>


</body>
</html>
