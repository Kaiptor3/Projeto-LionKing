
<?php
session_start();
require_once '../controllers/UsuarioController.php';

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
    <meta charset="UTF-8">
    <title>Perfil do Usuário</title>
    <link rel="stylesheet" href="perfil.css">
</head>

<body>

    <h1>Meu Perfil</h1>
    <ul>
        <li>Nome: <?= htmlspecialchars($usuario['nomeCompleto']) ?></li>
        <li>Email: <?= htmlspecialchars($usuario['email']) ?></li>
        <li>Telefone: <?= htmlspecialchars($usuario['telefone']) ?></li>
        <li>Estado: <?= htmlspecialchars($usuario['estado']) ?></li>
        <li>Cidade: <?= htmlspecialchars($usuario['cidade']) ?></li>
        <li>Bairro: <?= htmlspecialchars($usuario['bairro']) ?></li>
        <li>Rua: <?= htmlspecialchars($usuario['rua']) ?></li>
        <li>Número: <?= htmlspecialchars($usuario['numero']) ?></li>
        <li>CPF: <?= htmlspecialchars($usuario['cpf']) ?></li>
        <li>Login: <?= htmlspecialchars($usuario['login']) ?></li>
    </ul>
    <a href="../login/editar_usuario.php" class="btn btn-danger">
                <button>Logout</button>
    </a>

</body>

</html>
