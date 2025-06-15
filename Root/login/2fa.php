<?php
session_start();
require_once 'conexao.php';

// Garante que o usuário passou pelo login e está em processo de 2FA
if (!isset($_SESSION['usuario_temp'])) {
    header("Location: login.php");
    exit;
}

// Busca a data de nascimento do usuário logado temporariamente
$idUsuario = $_SESSION['usuario_temp']['idUsuario'];

$stmt = $conn->prepare("SELECT dataNascimento FROM usuario WHERE idUsuario = ?");
$stmt->bind_param("i", $idUsuario);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows !== 1) {
    header("Location: login.php");
    exit;
}

$dados = $result->fetch_assoc();
$respostaCorreta = date("d/m/Y", strtotime($dados['dataNascimento']));

// Define pergunta e resposta na sessão se ainda não estiverem
if (!isset($_SESSION['pergunta_2fa'])) {
    $_SESSION['pergunta_2fa'] = "Qual sua data de nascimento? (formato DD/MM/AAAA)";
    $_SESSION['tentativas_2fa'] = 0;
}

$pergunta = $_SESSION['pergunta_2fa'];
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificação de Segurança - Lion King</title>
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

        .security-container {
            background: rgba(15, 15, 15, 0.95);
            border: 1px solid #ff2a2a;
            border-radius: 12px;
            padding: 40px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 10px 30px rgba(255, 0, 0, 0.15),
                        0 0 0 1px rgba(255, 50, 50, 0.3);
            position: relative;
            overflow: hidden;
            animation: fadeIn 0.6s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .security-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 40, 40, 0.1) 0%, transparent 70%);
            animation: pulse 8s infinite alternate;
            z-index: -1;
        }

        @keyframes pulse {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        .security-header {
            text-align: center;
            margin-bottom: 30px;
            position: relative;
        }

        .security-header h1 {
            color: #ff2a2a;
            font-size: 28px;
            font-weight: 700;
            letter-spacing: 1px;
            margin-bottom: 15px;
            text-transform: uppercase;
        }

        .security-header p {
            color: #aaa;
            font-size: 16px;
            line-height: 1.6;
        }

        .security-form {
            display: flex;
            flex-direction: column;
            gap: 25px;
        }

        .question-container {
            background: rgba(30, 30, 30, 0.7);
            border-radius: 8px;
            padding: 20px;
            border-left: 3px solid #ff2a2a;
        }

        .security-question {
            font-size: 18px;
            color: #e0e0e0;
            line-height: 1.5;
            margin-bottom: 5px;
        }

        .input-group {
            position: relative;
        }

        .input-field {
            width: 100%;
            background: rgba(25, 25, 25, 0.8);
            border: 1px solid #333;
            border-radius: 6px;
            padding: 14px 20px;
            font-size: 16px;
            color: #fff;
            transition: all 0.3s ease;
        }

        .input-field:focus {
            outline: none;
            border-color: #ff2a2a;
            box-shadow: 0 0 0 2px rgba(255, 42, 42, 0.3);
            background: rgba(40, 40, 40, 0.8);
        }

        .verify-btn {
            background: linear-gradient(135deg, #ff2a2a 0%, #cc0000 100%);
            color: white;
            border: none;
            padding: 15px;
            border-radius: 6px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-top: 10px;
            position: relative;
            overflow: hidden;
        }

        .verify-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 42, 42, 0.4);
            background: linear-gradient(135deg, #ff3a3a 0%, #dd0000 100%);
        }

        .verify-btn:active {
            transform: translateY(0);
        }

        .security-footer {
            text-align: center;
            margin-top: 25px;
            color: #888;
            font-size: 14px;
        }

        .attempts-warning {
            color: #ff5c5c;
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }

        .security-badge {
            display: inline-block;
            background: rgba(255, 42, 42, 0.2);
            color: #ff2a2a;
            padding: 8px 15px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
            margin-top: 25px;
            border: 1px solid rgba(255, 42, 42, 0.5);
        }

        @media (max-width: 600px) {
            .security-container {
                padding: 30px 20px;
            }
            
            .security-header h1 {
                font-size: 24px;
            }
            
            .security-question {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <div class="security-container">
        <div class="security-header">
            <h1>Verificação de Segurança</h1>
            <p>Por favor, responda à pergunta abaixo para confirmar sua identidade</p>
        </div>
        
        <form class="security-form" method="POST" action="processa_2fa.php">
            <div class="question-container">
                <p class="security-question"><?= $pergunta ?></p>
            </div>
            
            <div class="input-group">
                <input type="text" class="input-field" name="resposta" placeholder="Digite sua resposta..." required>
            </div>
            
            <?php if (isset($_SESSION['erro_2fa'])): ?>
                <div class="attempts-warning">
                    <?= $_SESSION['erro_2fa'] ?>
                </div>
                <?php unset($_SESSION['erro_2fa']); ?>
            <?php endif; ?>
            
            <button type="submit" class="verify-btn">Verificar Identidade</button>
        </form>
        
        <div class="security-footer">
            <div class="security-badge">Sistema Seguro</div>
            <p style="margin-top: 15px;">Esta medida adicional protege sua conta contra acesso não autorizado</p>
        </div>
    </div>
<script>
document.querySelector('.input-field').addEventListener('input', function (e) {
    let v = e.target.value.replace(/\D/g, '');
    if (v.length >= 2) v = v.slice(0,2) + '/' + v.slice(2);
    if (v.length >= 5) v = v.slice(0,5) + '/' + v.slice(5,9);
    e.target.value = v.slice(0, 10);
});
</script>

</body>
</html>
