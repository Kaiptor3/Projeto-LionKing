<?php
session_start();
require_once __DIR__ . '/../controllers/UsuarioController.php';

// Função para limpar máscara (mantém apenas números)
function limparNumero($valor) {
    return preg_replace('/\D/', '', $valor);
}

// Função para validar CPF
function validarCPF($cpf) {
    $cpf = limparNumero($cpf);
    if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    for ($t = 9; $t < 11; $t++) {
        $soma = 0;
        for ($c = 0; $c < $t; $c++) {
            $soma += $cpf[$c] * (($t + 1) - $c);
        }
        $digito = (10 * $soma) % 11;
        $digito = $digito == 10 ? 0 : $digito;
        if ($cpf[$t] != $digito) return false;
    }

    return true;
}

// Verifica se senha e confirmação batem
if ($_POST['senha'] !== $_POST['confirmar_senha']) {
    $_SESSION['msg'] = 'As senhas não coincidem!';
    $_SESSION['msg_type'] = 'error';
    header('Location: cadastro.php');
    exit;
}

// Limpa dados com máscara
$cpf = limparNumero($_POST['cpf']);
$telefone = limparNumero($_POST['telefone']);
$cep = limparNumero($_POST['cep']);
$senha = $_POST['senha'];
$login = $_POST['login'];
$email = trim($_POST['email']);
$nomeCompleto = trim($_POST['nomeCompleto']);

// Validações
if (strlen($nomeCompleto) < 15 || strlen($nomeCompleto) > 80 || !preg_match('/^[A-Za-zÀ-ú\s]+$/', $nomeCompleto)) {
    $_SESSION['msg'] = 'Nome inválido. Use apenas letras e entre 15 e 80 caracteres.';
    $_SESSION['msg_type'] = 'error';
    header('Location: cadastro.php');
    exit;
}

if (!validarCPF($cpf)) {
    $_SESSION['msg'] = 'CPF inválido.';
    $_SESSION['msg_type'] = 'error';
    header('Location: cadastro.php');
    exit;
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $_SESSION['msg'] = 'Email inválido.';
    $_SESSION['msg_type'] = 'error';
    header('Location: cadastro.php');
    exit;
}

if (!preg_match('/^\d{11}$/', $telefone)) {
    $_SESSION['msg'] = 'Telefone inválido. Deve conter 11 números.';
    $_SESSION['msg_type'] = 'error';
    header('Location: cadastro.php');
    exit;
}

if (!preg_match('/^[A-Za-z]{1,6}$/', $login)) {
    $_SESSION['msg'] = 'Login inválido. Deve conter exatamente 6 letras.';
    $_SESSION['msg_type'] = 'error';
    header('Location: cadastro.php');
    exit;
}

if (!preg_match('/^[A-Za-z]{8}$/', $senha)) {
    $_SESSION['msg'] = 'Senha inválida. Deve conter exatamente 8 letras.';
    $_SESSION['msg_type'] = 'error';
    header('Location: cadastro.php');
    exit;
}

$dataNascimento = $_POST['dataNascimento'];

// Se estiver no formato dd/mm/yyyy, converte para yyyy-mm-dd
if (preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $dataNascimento)) {
    $partes = explode('/', $dataNascimento);
    $dataNascimento = "{$partes[2]}-{$partes[1]}-{$partes[0]}";
}

// Valida data
$dataNasc = date_create($dataNascimento);

if (!$dataNasc) {
    $_SESSION['msg'] = 'Data de nascimento inválida.';
    $_SESSION['msg_type'] = 'error';
    header('Location: cadastro.php');
    exit;
}

$dataFormatada = $dataNasc->format('Y-m-d');

// Se chegou até aqui, tudo está válido
try {
    $dados = [
        'cpf' => $cpf,
        'nomeCompleto' => $nomeCompleto,
        'dataNascimento' => $dataFormatada,
        'nomeMae' => $_POST['nomeMae'],
        'email' => $email,
        'telefone' => $telefone,
        'cep' => $cep,
        'estado' => $_POST['estado'],
        'cidade' => $_POST['cidade'],
        'rua' => $_POST['rua'],
        'numero' => $_POST['numero'],
        'bairro' => $_POST['bairro'],
        'login' => $login,
        'senha' => $senha, // <-- senha salva em texto puro (não recomendado, mas conforme pedido)
        'idPermissao' => 2
    ];

    UsuarioController::inserirUsuario($dados);

    $_SESSION['sucesso_cadastro'] = 'Usuário cadastrado com sucesso!';
    header('Location: login.php');
    exit;

} catch (Exception $e) {
    $mensagem = $e->getMessage();

    if (str_contains($mensagem, 'já cadastrado') || str_contains($mensagem, 'Duplicate')) {
        $_SESSION['msg'] = 'CPF ou e-mail já está em uso. Use outros dados.';
    } else {
        $_SESSION['msg'] = 'Erro ao cadastrar: ' . $mensagem;
    }

    $_SESSION['msg_type'] = 'error';
    header('Location: cadastro.php');
    exit;
}
