<?php
session_start();
require_once '../controllers/UsuarioController.php';
require_once 'conexao.php';
require_once 'log_helper.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: ../login/login.php");
    exit;
}

$idUsuarioLogado = $_SESSION['usuario']['idUsuario'];

// Busca os dados do usuário logado
$usuario = UsuarioController::buscarPorId($idUsuarioLogado);

if (!$usuario) {
    // Usuário não encontrado, logout forçado
    session_destroy();
    header("Location: ../login/login.php");
    exit;
}

$mensagemErro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coleta dados do POST
    $dadosAtualizados = [
        'cpf'           => $_POST['cpf'] ?? '',
        'nomeCompleto'  => $_POST['nomeCompleto'] ?? '',
        'dataNascimento'=> $_POST['dataNascimento'] ?? '',
        'nomeMae'       => $_POST['nomeMae'] ?? '',
        'email'         => $_POST['email'] ?? '',
        'telefone'      => $_POST['telefone'] ?? '',
        'estado'        => $_POST['estado'] ?? '',
        'cidade'        => $_POST['cidade'] ?? '',
        'bairro'        => $_POST['bairro'] ?? '',
        'rua'           => $_POST['rua'] ?? '',
        'numero'        => $_POST['numero'] ?? '',
        'login'         => $_POST['login'] ?? '',
        'senha'         => $_POST['senha'] ?? '', // Senha pode ser vazia para não alterar
        'idPermissao'   => $usuario['idPermissao'], // Mantém a permissão atual
    ];

    try {
        // Atualiza usuário via controller
        UsuarioController::atualizarUsuario($idUsuarioLogado, $dadosAtualizados);

         registrarLog($conn, $idUsuarioLogado, 'Usuário atualizou seus dados');

        // Atualiza dados da sessão para refletir as alterações
        $_SESSION['usuario']['nomeCompleto'] = $dadosAtualizados['nomeCompleto'];
        $_SESSION['usuario']['email'] = $dadosAtualizados['email'];

        // Redireciona para index com sucesso
        header("Location: ../index.php?msg=Dados atualizados com sucesso");
        exit;

    } catch (Exception $e) {
        $mensagemErro = $e->getMessage();
    }
}
?>

<?php


if (!isset($_SESSION['usuario'])) {
    // Redireciona para a página de login
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <title>Editar Meus Dados</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body class="container mt-4">

    <h1>Editar Meus Dados</h1>

    <?php if ($mensagemErro): ?>
        <div class="alert alert-danger"><?= htmlspecialchars($mensagemErro) ?></div>
    <?php endif; ?>

    <form method="post" action="" class="mt-3">
        <div class="mb-3">
            <label for="nomeCompleto" class="form-label">Nome Completo</label>
            <input type="text" id="nomeCompleto" name="nomeCompleto" class="form-control" required
                value="<?= htmlspecialchars($usuario['nomeCompleto']) ?>">
        </div>

        <div class="mb-3">
            <label for="cpf" class="form-label">CPF</label>
            <input type="text" id="cpf" name="cpf" class="form-control" required
                value="<?= htmlspecialchars($usuario['cpf']) ?>">
        </div>

        <div class="mb-3">
            <label for="dataNascimento" class="form-label">Data de Nascimento</label>
            <input type="date" id="dataNascimento" name="dataNascimento" class="form-control" required
                value="<?= htmlspecialchars($usuario['dataNascimento']) ?>">
        </div>

        <div class="mb-3">
            <label for="nomeMae" class="form-label">Nome da Mãe</label>
            <input type="text" id="nomeMae" name="nomeMae" class="form-control" required
                value="<?= htmlspecialchars($usuario['nomeMae']) ?>">
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" id="email" name="email" class="form-control" required
                value="<?= htmlspecialchars($usuario['email']) ?>">
        </div>

        <div class="mb-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="text" id="telefone" name="telefone" class="form-control"
                value="<?= htmlspecialchars($usuario['telefone']) ?>">
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <input type="text" id="estado" name="estado" class="form-control"
                value="<?= htmlspecialchars($usuario['estado']) ?>">
        </div>

        <div class="mb-3">
            <label for="cidade" class="form-label">Cidade</label>
            <input type="text" id="cidade" name="cidade" class="form-control"
                value="<?= htmlspecialchars($usuario['cidade']) ?>">
        </div>

        <div class="mb-3">
            <label for="bairro" class="form-label">Bairro</label>
            <input type="text" id="bairro" name="bairro" class="form-control"
                value="<?= htmlspecialchars($usuario['bairro']) ?>">
        </div>

        <div class="mb-3">
            <label for="rua" class="form-label">Rua</label>
            <input type="text" id="rua" name="rua" class="form-control"
                value="<?= htmlspecialchars($usuario['rua']) ?>">
        </div>

        <div class="mb-3">
            <label for="numero" class="form-label">Número</label>
            <input type="text" id="numero" name="numero" class="form-control"
                value="<?= htmlspecialchars($usuario['numero']) ?>">
        </div>

        <div class="mb-3">
            <label for="login" class="form-label">Login</label>
            <input type="text" id="login" name="login" class="form-control" required
                value="<?= htmlspecialchars($usuario['login']) ?>">
        </div>

        <div class="mb-3">
            <label for="senha" class="form-label">Nova Senha (deixe vazio para manter a atual)</label>
            <input type="password" id="senha" name="senha" class="form-control" autocomplete="new-password">
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
        <a href="../index.php" class="btn btn-secondary">Cancelar</a>
    </form>

</body>
</html>
