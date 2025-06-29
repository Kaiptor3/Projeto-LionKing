<?php
require_once '../controllers/CarroController.php';

$idCarro = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
if (!$idCarro) {
    die("ID inválido.");
}

$carro = CarroController::buscarCarroPorId($idCarro);
if (!$carro) {
    die("Carro não encontrado.");
}

?>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= htmlspecialchars($carro['modelo']) ?></title>
    <link rel="stylesheet" href="saibamais.css" />
    <link
      href="https://fonts.googleapis.com/css2?family=Pacifico&family=Montserrat:wght@400&display=swap"
      rel="stylesheet"
    />
    <link
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
      rel="stylesheet"
    />
  </head>
  <body>
    <div class="site">
      <a href="catalogo.php"><button class="botao-voltar">←</button></a>
      <button id="increaseFont"><i class="fas fa-plus"></i></button>
      <button id="decreaseFont"><i class="fas fa-minus"></i></button>
      <script src="../fonte.js"></script>
      <div class="titulo">
        <h3>DESIGN E PERFORMANCE</h3>
        <h4><?= htmlspecialchars($carro['modelo']) ?></h4>
      </div>
      <div class="image-car">
        <div class="botoes">
          <button class="fazer-compra">Fazer compra</button>
        </div>
        <img src="../<?= htmlspecialchars($carro['imagem2']) ?>" alt="" />
      </div>
      <div class="content">
        <div class="combustivel">
          <img
            src="imagem2/icons8-bateria-pela-metade-100.png"
            alt="Ícone de Bateria"
          />
          <h2>ELÉTRICO</h2>
        </div>
        <div class="ficha">
          <div class="ficha-item">
            <img
              src="imagem2/icons8-velocímetro-64.png"
              alt="Velocidade Máxima"
            />
            <div class="balao">
              <div class="balao-texto"><p>Velocidade Máxima</p></div>
            </div>
            <h2><?= htmlspecialchars($carro['velocidadeMaxima']) ?> Km/H</h2>
          </div>
          <div class="ficha-item">
            <img src="imagem2/icons8-relâmpago-64.png" alt="Potência" />
            <div class="balao">
              <div class="balao-texto"><p>Potência</p></div>
            </div>
            <h2><?= htmlspecialchars($carro['potencia']) ?> kW</h2>
          </div>
          <div class="ficha-item">
            <img
              src="imagem2/icons8-porta-de-carro-64.png"
              alt="Número de Portas"
            />
            <div class="balao">
              <div class="balao-texto"><p>Número de Portas</p></div>
            </div>
            <h2><?= htmlspecialchars($carro['numeroPortas']) ?> Portas</h2>
          </div>
          <div class="ficha-item">
            <img
              src="imagem2/icons8-mala-64.png"
              alt="Capacidade do Porta-Malas"
            />
            <div class="balao">
              <div class="balao-texto"><p>Capacidade do Porta-Malas</p></div>
            </div>
            <h2><?= htmlspecialchars($carro['capacidadePortaMalas']) ?>L</h2>
          </div>
          <div class="ficha-item">
            <img src="imagem2/icons8-cronômetro-64.png" alt="Aceleração" />
            <div class="balao">
              <div class="balao-texto"><p>Aceleração do carro</p></div>
            </div>
            <h2><?= htmlspecialchars($carro['aceleracao']) ?> seg</h2>
          </div>
          <div class="ficha-item">
            <img
              src="imagem2/icons8-posto-de-gasolina-64.png"
              alt="Consumo"
            />
            <div class="balao">
              <div class="balao-texto">
                <p>Consumo do meio de combustivel</p>
              </div>
            </div>
            <h2><?= htmlspecialchars($carro['consumoMedio']) ?> l/100Km</h2>
          </div>
          <div class="ficha-item">
            <img
              src="imagem2/icons8-assento-de-carro-64.png"
              alt="Número de Assentos"
            />
            <div class="balao">
              <div class="balao-texto"><p>Número de Assentos</p></div>
            </div>
            <h2><?= htmlspecialchars($carro['numeroAssentos']) ?> Assentos</h2>
          </div>
          <div class="ficha-item">
            <img src="imagem2/icons8-peso-kg-64.png" alt="Peso" />
            <div class="balao">
              <div class="balao-texto"><p>Peso total do carro</p></div>
            </div>
            <h2><?= htmlspecialchars($carro['pesoTotal']) ?> kg</h2>
          </div>
        </div>
      </div>
    </div>
    <button id="contrast-toggle" class="contrast-button">☀️</button>
    <script src="whitemode.js"></script>
  </body>
</html>
