<?php
session_start();

function validarCPF($cpf) {
    $cpf = preg_replace('/[^0-9]/', '', $cpf);
    
    if (strlen($cpf) != 11 || preg_match('/(\d)\1{10}/', $cpf)) {
        return false;
    }

    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$c] != $d) {
            return false;
        }
    }
    return true;
}

$dados = filter_input_array(INPUT_POST, [
    'nome_completo' => FILTER_SANITIZE_STRING,
    'data_nascimento' => FILTER_SANITIZE_STRING,
    'cpf' => FILTER_SANITIZE_STRING,
    'email' => FILTER_SANITIZE_EMAIL,
    'telefone' => FILTER_SANITIZE_STRING,
    'endereco' => FILTER_SANITIZE_STRING,
    'login' => FILTER_SANITIZE_STRING,
    'senha' => FILTER_SANITIZE_STRING,
    'confirmacao_senha' => FILTER_SANITIZE_STRING
]);

// Validações
$erros = [];

if (strlen($dados['nome_completo']) < 15 || strlen($dados['nome_completo']) > 80 || !preg_match('/^[a-zA-Z\s]+$/', $dados['nome_completo'])) {
    $erros[] = "Nome inválido (15-80 caracteres alfabéticos)";
}

if (!validarCPF($dados['cpf'])) {
    $erros[] = "CPF inválido";
}

if (strlen($dados['login']) !== 6 || !ctype_alpha($dados['login'])) {
    $erros[] = "Login deve ter 6 caracteres alfabéticos";
}

if (strlen($dados['senha']) !== 8 || !ctype_alpha($dados['senha'])) {
    $erros[] = "Senha deve ter 8 caracteres alfabéticos";
}

if ($dados['senha'] !== $dados['confirmacao_senha']) {
    $erros[] = "Senhas não coincidem";
}

if (!empty($erros)) {
    $_SESSION['erros'] = $erros;
    header("Location: cadastro.php");
    exit;
}

// Conexão com banco de dados
$pdo = new PDO('mysql:host=localhost;dbname=seu_banco;charset=utf8', 'usuario', 'senha');

// Verifica se CPF ou login já existem
$stmt = $pdo->prepare("SELECT id FROM usuarios WHERE cpf = ? OR login = ?");
$stmt->execute([$dados['cpf'], $dados['login']]);

if ($stmt->fetch()) {
    $_SESSION['erros'] = ["CPF ou Login já cadastrados"];
    header("Location: cadastro.php");
    exit;
}

// Insere no banco
$stmt = $pdo->prepare("INSERT INTO usuarios (nome_completo, data_nascimento, cpf, email, telefone, endereco, login, senha) 
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

$senhaHash = password_hash($dados['senha'], PASSWORD_DEFAULT);
$sucesso = $stmt->execute([
    $dados['nome_completo'],
    $dados['data_nascimento'],
    $dados['cpf'],
    $dados['email'],
    $dados['telefone'],
    $dados['endereco'],
    $dados['login'],
    $senhaHash
]);

if ($sucesso) {
    $_SESSION['usuario_id'] = $pdo->lastInsertId();
    header("Location: 2fa.php");
} else {
    $_SESSION['erros'] = ["Erro no cadastro"];
    header("Location: cadastro.php");
}
