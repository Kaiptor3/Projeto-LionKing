<?php
session_start();
require_once '../controllers/UsuarioController.php';
$usuarios = UsuarioController::listarUsuarios();

if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['idPermissao'] != 1) {
    header('Location: /Projeto-LionKing-main/Root/login/login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Lista de Usuários</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.0/css/dataTables.dataTables.css">
</head>
<body class="p-4">

    <h1 class="mb-4">Lista de Usuários - Painel Administrativo</h1>

    <table id="example" class="table table-striped">
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
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?= htmlspecialchars($usuario['nomeCompleto']) ?></td>
                <td><?= htmlspecialchars($usuario['email']) ?></td>
                <td><?= htmlspecialchars($usuario['telefone']) ?></td>
                <td><?= htmlspecialchars($usuario['estado']) ?></td>
                <td><?= htmlspecialchars($usuario['cidade']) ?></td>
                <td><?= htmlspecialchars($usuario['bairro']) ?></td>
                <td><?= htmlspecialchars($usuario['rua']) ?></td>
                <td><?= htmlspecialchars($usuario['numero']) ?></td>
                <td><?= htmlspecialchars($usuario['cpf']) ?></td>
                <td><?= htmlspecialchars($usuario['login']) ?></td>
                <td>
                    <div class="d-flex gap-2">
                        <a href="../admin_log.php?id=<?= $usuario['idUsuario'] ?>" class="btn btn-sm btn-primary">
                            Ver Log
                        </a>
                        <a href="excluir_usuario.php?id=<?= $usuario['idUsuario'] ?>"
                         class="btn btn-sm btn-danger"
                         onclick="return confirm('Tem certeza que deseja excluir este usuário?');">
                            Excluir
                        </a>
    </div>
</td>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- jQuery + DataTables JS -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.3.0/js/dataTables.js"></script>

    <script>
    $(document).ready(function() {
        $('#example').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json'
            }
        });
    });
    </script>

    <!-- Bootstrap JS Bundle (opcional, apenas se for usar componentes JS do Bootstrap futuramente) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
