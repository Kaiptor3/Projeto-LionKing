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
    $respostaNormalizada = normalizarResposta($resposta, $tipo);
    $hash = hash('sha256', $respostaNormalizada . $salt);
    return ['hash' => $hash, 'salt' => $salt];
}

function normalizarResposta($resposta, $tipo = null) {
    $resposta = mb_strtolower(trim($resposta), 'UTF-8');
    
    if ($tipo === 'cep') {
        return preg_replace('/[^\d]/', '', $resposta);
    }
    
    // Remove caracteres especiais mas mantém espaços para nomes
    return preg_replace('/[^\w\s]/u', '', $resposta);
}

// Processar formulário
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Gerar hashes seguros para os dados sensíveis
    $hashNomeMae = gerarHashSeguro($_POST['nome_mae'], 'nome_mae');
    $hashCep = gerarHashSeguro($_POST['cep'], 'cep');

    try {
        // Inserir usuário
        $stmt = $pdo->prepare("INSERT INTO usuarios (
            nome_completo, data_nascimento, cpf, email, telefone, endereco,
            nome_mae, cep, login, senha,
            hash_nome_mae, salt_nome_mae, hash_cep, salt_cep
        ) VALUES (
            :nome_completo, :data_nascimento, :cpf, :email, :telefone, :endereco,
            :nome_mae, :cep, :login, :senha,
            :hash_nome_mae, :salt_nome_mae, :hash_cep, :salt_cep
        )");

        $stmt->execute([
            ':nome_completo' => $_POST['nome_completo'],
            ':data_nascimento' => $_POST['data_nascimento'],
            ':cpf' => $_POST['cpf'],
            ':email' => $_POST['email'],
            ':telefone' => $_POST['telefone'],
            ':endereco' => $_POST['endereco'],
            ':nome_mae' => $_POST['nome_mae'],  // Armazenamos o texto também para exibição
            ':cep' => $_POST['cep'],            // Armazenamos o texto também
            ':login' => $_POST['login'],
            ':senha' => password_hash($_POST['senha'], PASSWORD_BCRYPT),
            ':hash_nome_mae' => $hashNomeMae['hash'],
            ':salt_nome_mae' => $hashNomeMae['salt'],
            ':hash_cep' => $hashCep['hash'],
            ':salt_cep' => $hashCep['salt']
        ]);

if ($stmt->rowCount() > 0) {
    $_SESSION['usuario_id'] = $pdo->lastInsertId();
    $_SESSION['cadastro_sucesso'] = true;
    header("Location: 2fa.php");
    exit;
} else {
    $_SESSION['erro_cadastro'] = "Falha ao cadastrar. Tente novamente.";
    header("Location: cadastro.php");
    exit;
}

    } catch (PDOException $e) {
        // Tratamento de erros específicos
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
        header("Location: index.html");
        exit;
    }
} else {
    header("Location: cadastro.php");
    exit;
}

if (!isset($_SESSION['usuario_id'])) {
    header("Location: cadastro.php");
    exit;
}
?>
