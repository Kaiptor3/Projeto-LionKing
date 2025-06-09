<?php
require_once '../../controllers/CarroController.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: painel_carros.php');
    exit;
}

$id = (int)$_GET['id'];

$carro = CarroController::buscarPorId($id);

if (!$carro) {
    // Carro não encontrado, redireciona
    header('Location: painel_carros.php');
    exit;
}

$mensagemErro = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        CarroController::atualizarCarro($id, $_POST, $_FILES);
        header('Location: painel_carros.php?success_update=1');
        exit;
    } catch (Exception $e) {
        $mensagemErro = $e->getMessage();
    }
}
?>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const precoInput = document.getElementById("preco");

    precoInput.addEventListener("input", function () {
        let valor = precoInput.value;

        // Remove tudo que não for número
        valor = valor.replace(/\D/g, "");

        // Converte para formato de moeda (2 casas decimais)
        valor = (valor / 100).toFixed(2).replace(".", ",");

        // Adiciona pontos como separadores de milhar
        valor = valor.replace(/\B(?=(\d{3})+(?!\d))/g, ".");

        precoInput.value = valor;
    });

    // Antes de enviar o form, converte de volta para o formato correto
    const form = document.querySelector("form");
    form.addEventListener("submit", function () {
        let valor = precoInput.value;

        // Remove os pontos e troca vírgula por ponto
        valor = valor.replace(/\./g, "").replace(",", ".");
        precoInput.value = valor; // Agora está pronto para o banco
    });
});
</script>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Carro</title>
    <style>
        /* Seu CSS aqui */
        .mensagem-erro { color: red; }
    </style>
</head>
<body>

<h1>Editar Carro</h1>

<?php if ($mensagemErro): ?>
    <p class="mensagem-erro"><?= htmlspecialchars($mensagemErro) ?></p>
<?php endif; ?>

<form action="editar_carro.php?id=<?= $id ?>" method="POST" enctype="multipart/form-data">
    <label for="modelo">Modelo:</label><br />
    <input type="text" id="modelo" name="modelo" required value="<?= htmlspecialchars($carro['modelo']) ?>" /><br /><br />

    <label for="preco">Preço (ex: 55000.50):</label><br />
    <input type="text" id="preco" name="preco" step="0.01" min="0" required value="<?= htmlspecialchars($carro['preco']) ?>" /><br /><br />

    <label for="velocidadeMaxima">Velocidade Máxima (km/h):</label><br />
    <input type="number" id="velocidadeMaxima" name="velocidadeMaxima" min="0" required value="<?= htmlspecialchars($carro['velocidadeMaxima']) ?>" /><br /><br />

    <label for="potencia">Potência (cv):</label><br />
    <input type="number" id="potencia" name="potencia" min="0" required value="<?= htmlspecialchars($carro['potencia']) ?>" /><br /><br />

    <label for="numeroPortas">Número de Portas:</label><br />
    <input type="number" id="numeroPortas" name="numeroPortas" min="1" required value="<?= htmlspecialchars($carro['numeroPortas']) ?>" /><br /><br />

    <label for="aceleracao">Aceleração 0-100 km/h (segundos):</label><br />
    <input type="number" id="aceleracao" name="aceleracao" step="0.01" min="0" required value="<?= htmlspecialchars($carro['aceleracao']) ?>" /><br /><br />

    <label for="numeroAssentos">Número de Assentos:</label><br />
    <input type="number" id="numeroAssentos" name="numeroAssentos" min="1" required value="<?= htmlspecialchars($carro['numeroAssentos']) ?>" /><br /><br />

    <label for="pesoTotal">Peso Total (kg):</label><br />
    <input type="number" id="pesoTotal" name="pesoTotal" min="0" required value="<?= htmlspecialchars($carro['pesoTotal']) ?>" /><br /><br />

    <label for="consumoMedio">Consumo Médio (km/l):</label><br />
    <input type="number" id="consumoMedio" name="consumoMedio" step="0.01" min="0" required value="<?= htmlspecialchars($carro['consumoMedio']) ?>" /><br /><br />
    
    <label for="capacidadePortaMalas">Capacidade do Porta-Malas (litros):</label><br />
    <input type="number" id="capacidadePortaMalas" name="capacidadePortaMalas" min="0" required value="<?= htmlspecialchars($carro['capacidadePortaMalas']) ?>" /><br /><br />

    <label>Imagem Atual 1:</label><br />
    <img src="../../<?= htmlspecialchars($carro['imagem1']) ?>" alt="Imagem 1" style="width:150px;"><br />
    <label for="imagem1">Alterar Imagem 1 (opcional):</label><br />
    <input type="file" id="imagem1" name="imagem1" accept="image/*" /><br /><br />

    <label>Imagem Atual 2:</label><br />
    <img src="../../<?= htmlspecialchars($carro['imagem2']) ?>" alt="Imagem 2" style="width:150px;"><br />
    <label for="imagem2">Alterar Imagem 2 (opcional):</label><br />
    <input type="file" id="imagem2" name="imagem2" accept="image/*" /><br /><br />

    <button type="submit">Salvar Alterações</button>
</form>

</body>
</html>
