<?php
session_start();
require_once __DIR__ . '/../controllers/UsuarioController.php';

try {
    $dados = [
        'cpf' => $_POST['cpf'],
        'nomeCompleto' => $_POST['nomeCompleto'],
        'dataNascimento' => $_POST['dataNascimento'],
        'nomeMae' => $_POST['nomeMae'],
        'email' => $_POST['email'],
        'telefone' => $_POST['telefone'],
        'estado' => $_POST['estado'],
        'cidade' => $_POST['cidade'],
        'rua' => $_POST['rua'],
        'numero' => $_POST['numero'],
        'bairro' => $_POST['bairro'],
        'login' => $_POST['login'],
        'senha' => $_POST['senha'],
        'idPermissao' => 2 // ou qualquer valor padrão
    ];

    UsuarioController::inserirUsuario($dados);

    $_SESSION['sucesso_cadastro'] = 'Usuário cadastrado com sucesso!';
    header('Location: cadastro.php');
    exit;

} catch (Exception $e) {
    $_SESSION['erro_cadastro'] = 'Erro ao cadastrar: ' . $e->getMessage();
    header('Location: cadastro.php');
    exit;
}
