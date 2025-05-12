<?php
// Conexão com o banco de dados
$host = 'localhost';
$db   = 'lion_king';
$user = 'root';
$pass = ''; // senha do seu MySQL
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
            c.modelo AS carro,
            u.telefone,
            u.cidade,
            u.rua,
            u.cpf,
            c.preco
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
    <title>Lion King</title>
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

<table id="example" class="display">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Compra</th>
            <th>Telefone</th>
            <th>Cidade</th>
            <th>Logradouro</th>
            <th>CPF</th>
            <th>Valor do carro</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($dados as $linha): ?>
            <tr>
                <td><?= htmlspecialchars($linha['nome']) ?></td>
                <td><?= htmlspecialchars($linha['carro']) ?></td>
                <td><?= htmlspecialchars($linha['telefone']) ?></td>
                <td><?= htmlspecialchars($linha['cidade']) ?></td>
                <td><?= htmlspecialchars($linha['rua']) ?></td>
                <td><?= htmlspecialchars($linha['cpf']) ?></td>
                <td>R$ <?= number_format($linha['preco'], 2, ',', '.') ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- JS Pessoal -->
<script src="roll.js"></script>

<script>
    $(document).ready(function () {
        $('#example').DataTable();
    });
</script>

</body>
</html>
