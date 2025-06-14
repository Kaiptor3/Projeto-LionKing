<?php
session_start();

// Conexão com banco de dados
$host = 'localhost';
$dbname = 'lion_king';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}

// Funções de segurança
function gerarHashSeguro($resposta, $tipo = null) {
    $salt = bin2hex(random_bytes(16));
    $respostaNormalizada = mb_strtolower(trim($resposta), 'UTF-8');

    if ($tipo === 'cep') {
        $respostaNormalizada = preg_replace('/[^\d]/', '', $respostaNormalizada);
    }

    return [
        'hash' => hash('sha256', $respostaNormalizada . $salt),
        'salt' => $salt
    ];
}

// Processar formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Gerar hashes para os dados sensíveis
    $hashNomeMae = gerarHashSeguro($_POST['nome_mae'], 'nome_mae');
    $hashCep = gerarHashSeguro($_POST['cep'] ?? '', 'cep');

    try {
        $stmt = $pdo->prepare("INSERT INTO usuario (
            cpf, nomeCompleto, dataNascimento, nomeMae, email, telefone,
            estado, cidade, rua, numero, bairro,
            login, senha, idPermissao,
            hash_nome_mae, salt_nome_mae, hash_cep, salt_cep
        ) VALUES (
            :cpf, :nomeCompleto, :dataNascimento, :nomeMae, :email, :telefone,
            :estado, :cidade, :rua, :numero, :bairro,
            :login, :senha, :idPermissao,
            :hash_nome_mae, :salt_nome_mae, :hash_cep, :salt_cep
        )");

        $stmt->execute([
            ':cpf' => preg_replace('/[^\d]/', '', $_POST['cpf']),
            ':nomeCompleto' => $_POST['nome_completo'],
            ':dataNascimento' => $_POST['data_nascimento'],
            ':nomeMae' => $_POST['nome_mae'],
            ':email' => $_POST['email'],
            ':telefone' => $_POST['telefone'],
            ':estado' => $_POST['estado'] ?? null,
            ':cidade' => $_POST['cidade'] ?? null,
            ':rua' => $_POST['rua'] ?? null,
            ':numero' => $_POST['numero'] ?? null,
            ':bairro' => $_POST['bairro'] ?? null,
            ':login' => $_POST['login'],
            ':senha' => password_hash($_POST['senha'], PASSWORD_BCRYPT),
            ':idPermissao' => 1, // Todo mundo entra como usuário comum
            ':hash_nome_mae' => $hashNomeMae['hash'],
            ':salt_nome_mae' => $hashNomeMae['salt'],
            ':hash_cep' => $hashCep['hash'],
            ':salt_cep' => $hashCep['salt']
        ]);

        $_SESSION['usuario_id'] = $pdo->lastInsertId();
        $_SESSION['cadastro_sucesso'] = true;
        header("Location: 2fa.php");
        exit;

    } catch (PDOException $e) {
        if ($e->errorInfo[1] == 1062) {
            $erro = "Erro: ";
            if (strpos($e->getMessage(), 'email') !== false) {
                $erro .= "Este e-mail já está cadastrado.";
            } elseif (strpos($e->getMessage(), 'cpf') !== false) {
                $erro .= "Este CPF já está cadastrado.";
            } elseif (strpos($e->getMessage(), 'login') !== false) {
                $erro .= "Este login já está em uso.";
            } else {
                $erro .= "Dados duplicados.";
            }
            $_SESSION['erro_cadastro'] = $erro;
        } else {
            $_SESSION['erro_cadastro'] = "Erro no cadastro: " . $e->getMessage();
        }
        header("Location: cadastro.php");
        exit;
    }
} else {
    header("Location: cadastro.php");
    exit;
}
?>