<?php
require_once '../../controllers/CarroController.php';

$mensagemErro = '';
$mensagemSucesso = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        CarroController::inserirCarro($_POST, $_FILES);
        // Mensagem de sucesso via query string para evitar reenvio no F5
        header("Location: painel_carros.php?success=1");
        exit;
    } catch (Exception $e) {
        $mensagemErro = $e->getMessage();
    }
}

$carros = CarroController::listarCarros();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Painel de Carros</title>
    <style>
        /* Seu CSS aqui */
        .thumbnail {
            width: 100px;
            height: auto;
        }
        /* Estilos extras para mensagens */
        .mensagem-erro { color: red; }
        .mensagem-sucesso { color: green; }
    </style>
</head>
<body>

<h1>Cadastro de Carro</h1>

<?php if (isset($_GET['msg']) && $_GET['msg'] === 'deletado'): ?>
    <p style="color: green; font-weight: bold;">Carro deletado com sucesso.</p>
<?php endif; ?>


<?php if (!empty($_GET['success'])): ?>
    <p class="mensagem-sucesso">Carro cadastrado com sucesso!</p>
<?php endif; ?>

<?php if ($mensagemErro): ?>
    <p class="mensagem-erro"><?= htmlspecialchars($mensagemErro) ?></p>
<?php endif; ?>

<form action="painel_carros.php" method="POST" enctype="multipart/form-data">
    <label for="modelo">Modelo:</label><br />
    <input type="text" id="modelo" name="modelo" required /><br /><br />

    <label for="preco">Preço (ex: 55000.50):</label><br />
    <input type="number" id="preco" name="preco" step="0.01" min="0" required /><br /><br />

    <label for="velocidadeMaxima">Velocidade Máxima (km/h):</label><br />
    <input type="number" id="velocidadeMaxima" name="velocidadeMaxima" min="0" required /><br /><br />

    <label for="potencia">Potência (cv):</label><br />
    <input type="number" id="potencia" name="potencia" min="0" required /><br /><br />

    <label for="numeroPortas">Número de Portas:</label><br />
    <input type="number" id="numeroPortas" name="numeroPortas" min="1" required /><br /><br />

    <label for="aceleracao">Aceleração 0-100 km/h (segundos):</label><br />
    <input type="number" id="aceleracao" name="aceleracao" step="0.01" min="0" required /><br /><br />

    <label for="numeroAssentos">Número de Assentos:</label><br />
    <input type="number" id="numeroAssentos" name="numeroAssentos" min="1" required /><br /><br />

    <label for="pesoTotal">Peso Total (kg):</label><br />
    <input type="number" id="pesoTotal" name="pesoTotal" min="0" required /><br /><br />

    <label for="consumoMedio">Consumo Médio (km/l):</label><br />
    <input type="number" id="consumoMedio" name="consumoMedio" step="0.01" min="0" required /><br /><br />

    <label for="imagem1">Imagem 1:</label><br />
    <input type="file" id="imagem1" name="imagem1" accept="image/*" required /><br /><br />

    <label for="imagem2">Imagem 2:</label><br />
    <input type="file" id="imagem2" name="imagem2" accept="image/*" required /><br /><br />

    <button type="submit">Cadastrar Carro</button>
</form>

<hr>

<h2>Carros Cadastrados</h2>

<table>
    <tr>
        <th>Imagem</th>
        <th>Modelo</th>
        <th>Preço</th>
        <th>Ações</th>
    </tr>
    <?php foreach ($carros as $carro): ?>
        <tr>
            <td><img src="../../<?= htmlspecialchars($carro['imagem1']) ?>" class="thumbnail"></td>
            <td><?= htmlspecialchars($carro['modelo']) ?></td>
            <td>R$ <?= number_format($carro['preco'], 2, ',', '.') ?></td>
            <td>
                <button onclick="location.href='editar_carro.php?id=<?= $carro['idCarro'] ?>'">Alterar</button>
                <button onclick="if(confirm('Tem certeza que deseja deletar este carro?')) { location.href='excluir_carro.php?id=<?= $carro['idCarro'] ?>'; }">Deletar</button>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
