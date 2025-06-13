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
    
    if ($tipo === 'cep' || $tipo === 'data_nascimento') {
        return preg_replace('/[^\d]/', '', $resposta);
    }
    
    return preg_replace('/[^\w\s]/u', '', $resposta);
}

// Processar formulário
$erro = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validar confirmação de senha
    if ($_POST['senha'] !== $_POST['confirmacao_senha']) {
        $erro = "As senhas não coincidem!";
    } else {
        // Gerar hashes seguros
        $nomeMae = gerarHashSeguro($_POST['nome_mae'], 'nome_mae');
        $dataNasc = gerarHashSeguro($_POST['data_nascimento'], 'data_nascimento');
        $cep = gerarHashSeguro($_POST['cep'], 'cep');

        try {
            // Inserir usuário
            $stmt = $pdo->prepare("INSERT INTO usuarios (
                nome_completo, data_nascimento, cpf, email, telefone, endereco,
                login, senha,
                hash_nome_mae, salt_nome_mae,
                hash_data_nascimento, salt_data_nascimento,
                hash_cep, salt_cep
            ) VALUES (
                :nome_completo, :data_nascimento, :cpf, :email, :telefone, :endereco,
                :login, :senha,
                :hash_nome_mae, :salt_nome_mae,
                :hash_data_nasc, :salt_data_nasc,
                :hash_cep, :salt_cep
            )");

            $stmt->execute([
                ':nome_completo' => $_POST['nome_completo'],
                ':data_nascimento' => $_POST['data_nascimento'],
                ':cpf' => preg_replace('/[^\d]/', '', $_POST['cpf']), // Remover formatação
                ':email' => $_POST['email'],
                ':telefone' => preg_replace('/[^\d]/', '', $_POST['telefone']), // Remover formatação
                ':endereco' => $_POST['endereco'],
                ':login' => $_POST['login'],
                ':senha' => password_hash($_POST['senha'], PASSWORD_BCRYPT),
                ':hash_nome_mae' => $nomeMae['hash'],
                ':salt_nome_mae' => $nomeMae['salt'],
                ':hash_data_nasc' => $dataNasc['hash'],
                ':salt_data_nasc' => $dataNasc['salt'],
                ':hash_cep' => $cep['hash'],
                ':salt_cep' => $cep['salt']
            ]);

            $_SESSION['usuario_id'] = $pdo->lastInsertId();
            header("Location: 2fa.php");
            exit;

        } catch (PDOException $e) {
            $erro = "Erro no cadastro: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Lion King</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #0a0a0a 0%, #1a1a1a 100%);
            color: #f0f0f0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background: rgba(15, 15, 15, 0.95);
            border: 1px solid #ff2a2a;
            border-radius: 12px;
            padding: 40px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 10px 30px rgba(255, 0, 0, 0.15),
                        0 0 0 1px rgba(255, 50, 50, 0.3);
        }

        h1 {
            color: #ff2a2a;
            text-align: center;
            margin-bottom: 30px;
            font-size: 28px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: #e0e0e0;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="password"],
        input[type="tel"] {
            width: 100%;
            padding: 14px;
            background: rgba(25, 25, 25, 0.8);
            border: 1px solid #333;
            border-radius: 6px;
            color: #fff;
            font-size: 16px;
        }

        input:focus {
            outline: none;
            border-color: #ff2a2a;
            box-shadow: 0 0 0 2px rgba(255, 42, 42, 0.3);
        }

        .btn {
            background: linear-gradient(135deg, #ff2a2a 0%, #cc0000 100%);
            color: white;
            border: none;
            padding: 15px;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 42, 42, 0.4);
        }

        .error {
            color: #ff5c5c;
            text-align: center;
            margin: 15px 0;
        }
    </style>
    <script>
        function formatarCPF(campo) {
            // Remove caracteres não numéricos
            let valor = campo.value.replace(/\D/g, '');
            
            // Formata o CPF: 000.000.000-00
            if (valor.length > 3) valor = valor.replace(/^(\d{3})/, '$1.');
            if (valor.length > 7) valor = valor.replace(/^(\d{3})\.(\d{3})/, '$1.$2.');
            if (valor.length > 11) valor = valor.replace(/^(\d{3})\.(\d{3})\.(\d{3})/, '$1.$2.$3-');
            
            campo.value = valor.substring(0, 14);
        }

        function formatarTelefone(campo) {
            // Remove caracteres não numéricos
            let valor = campo.value.replace(/\D/g, '');
            
            // Formata o telefone: (00)00000-0000
            if (valor.length > 0) valor = '(' + valor;
            if (valor.length > 3) valor = valor.replace(/^(\d{2})/, '$1)');
            if (valor.length > 10) valor = valor.replace(/^(\d{2})\)(\d{5})/, '$1)$2-');
            
            campo.value = valor.substring(0, 15);
        }

        function formatarCEP(campo) {
            // Remove caracteres não numéricos
            let valor = campo.value.replace(/\D/g, '');
            
            // Formata o CEP: 00000-000
            if (valor.length > 5) valor = valor.replace(/^(\d{5})/, '$1-');
            
            campo.value = valor.substring(0, 9);
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Cadastro</h1>
        
        <?php if (!empty($erro)): ?>
            <div class="error"><?= $erro ?></div>
        <?php endif; ?>
        
       <form method="POST" action="processa_cadastro.php">

            <div class="form-group">
                <label>Nome Completo</label>
                <input type="text" name="nome_completo" required>
            </div>
            
            <div class="form-group">
                <label>Data de Nascimento</label>
                <input type="date" name="data_nascimento" required>
            </div>
            
            <div class="form-group">
                <label>CPF</label>
                <input type="text" name="cpf" placeholder="000.000.000-00" 
                       oninput="formatarCPF(this)" required>
            </div>
            
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" required>
            </div>
            
            <div class="form-group">
                <label>Telefone</label>
                <input type="tel" name="telefone" placeholder="(00)00000-0000" 
                       oninput="formatarTelefone(this)" required>
            </div>
            
            <div class="form-group">
                <label>Endereço</label>
                <input type="text" name="endereco" required>
            </div>
            
            <div class="form-group">
                <label>Nome Completo da Mãe</label>
                <input type="text" name="nome_mae" required>
            </div>
            
            <div class="form-group">
                <label>CEP</label>
                <input type="text" name="cep" placeholder="00000-000" 
                       oninput="formatarCEP(this)" required>
            </div>
            
            <div class="form-group">
                <label>Login  (máx: 6 caracteres)</label>
                <input type="text" name="login" maxlength="6" required>
            </div>
            
            <div class="form-group">
                <label>Senha (máx: 8 caracteres)</label>
                <input type="password" name="senha" maxlength="8" required>
            </div>
            
            <div class="form-group">
                <label>Confirme sua Senha (máx: 8 caracteres)</label>
                <input type="password" name="confirmacao_senha" maxlength="8" required>
            </div>
            
            <button type="submit" class="btn">Cadastrar</button>
        </form>
    </div>
</body>
</html>
