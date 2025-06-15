<?php
session_start();
require_once '../controllers/CarroController.php'; // ajuste o caminho conforme necessário
$carros = CarroController::listarCarros();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lion King</title>
    <link rel="icon" type="image" href="./imgs/favicon.png" sizes="16x16 16x16">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="catalogo.css">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Montserrat:wght@400&display=swap" rel="stylesheet">
    <script src="catalogo.js"></script>
    <title>catalogo</title>
</head>
<header>
    <div class="container">
      <div class="logo">
        <img class="logo" src="imgs/LK- Menu.png" alt="Logo">
      </div>
      <div class="logodark" src="imgs/LK-Menu-Dark.png" alt="logodark">
      </div>
      <nav class="navbar">
        <div class="nav-links">
          <a href="../index.php">Home</a>
          <a href="catalogo.php">Carros</a>
          <a href="../login/cadastro.php">Cadastrar</a>
          <a href="../login/login.php">Login</a>
        </div>
        <nav class="navbar texto-M">
          <div class="nav-links">
            <p>Lion King Motors</p>
          </div>
        </nav>
              <?php if (isset($_SESSION['usuario'])): ?>
              <div class="login-form nav-usuario">
              <a href="../perfil/user_perfil.php" title="Editar Perfil">
              <img dark-mode-user src="../imgs/user-placeholder.png" alt="Usuário" style="cursor:pointer;" />
              </a>
               <span class="bem-vindo-usuario"><?= htmlspecialchars($_SESSION['usuario']['login'] ?? $_SESSION['usuario']['nomeCompleto'] ?? '') ?></span>
              <a href="login/logout.php" class="btn btn-danger">
                <button>Logout</button>
              </a>
              </div>
              <?php endif; ?>

      <!-- Botão Dark Mode -->
      <button id="darkModeToggle" class="dark-mode-toggle">🌙</button>
      <button id="increaseFont"><i class="fas fa-plus"></i></button>
<button id="decreaseFont"><i class="fas fa-minus"></i></button>
<script src="../fonte.js"></script>

      <button onclick="animarMenu()" id="btn-menu" class="btn-menu">
        <span class="linha"></span>
        <span class="linha"></span>
        <span class="linha"></span>
      </button>
    </div>

    <div class="menu-mobile" id="menu-mobile" style="z-index: 9999999999999999;">
      <nav>
        <a href="../index.php">Home</a>
        <a href="catalogo.php">Carros</a>
        <a href="../login/cadastro.php">Cadastrar</a>
        <a href="../login/login.php">Login</a>
        <div class="login-form nav-usuario">
          <?php if (isset($_SESSION['usuario'])): ?>
                <a href="../perfil/user_perfil.php" title="Editar Perfil">
              <img dark-mode-user src="../imgs/user-placeholder.png" alt="Usuário" style="cursor:pointer;" />
              </a>
               <span class="bem-vindo-usuario"><?= htmlspecialchars($_SESSION['usuario']['login'] ?? $_SESSION['usuario']['nomeCompleto'] ?? '') ?></span>
              <a href="login/logout.php" class="btn btn-danger">
                <button>Logout</button>
              </a>
                <?php endif; ?>
        </div>
      </nav>
    </div>
  </header>

  <script src="../animar.js"></script>
        <script src="/root/login/login.js"></script>
        <script src="../darkmode.js"></script>
</header>
<body>
<div class="bmw">
  <div class="container-car">
    <?php foreach ($carros as $carro): ?>
      <div class="car">
        <div class="image-container">
          <img src="../<?= htmlspecialchars($carro['imagem1']) ?>" alt="<?= htmlspecialchars($carro['modelo']) ?>">
        </div>
        <h2><?= htmlspecialchars($carro['modelo']) ?></h2>
        <p>A partir de R$ <?= number_format($carro['preco'], 2, ',', '.') ?></p>
        <a href="detalhes.php?id=<?= $carro['idCarro'] ?>">
        <div class="butao-comprar"><button>Comprar</button></div>
        </a>
      </div>
    <?php endforeach; ?>
  </div>
</div>
  <footer>
    <footer>
        <div class="footer-container">
          <div class="footer-logo">
            <img
              src="imgs/LK- Menu.png"
              alt="Logomarcafooter"
            />
          </div>
          <div class="footer-links">
            <ul>
              <li>
                <a href="../login/cadastro.html"target="_top"
                  >Cadastro</a
                >
              </li>
              <li>
                <a href="../catálogo/catalogo.html"target="_top"
                  >Catálogo</a
                >
              </li>
            </ul>
          </div>
          <div class="footer-socials">
            <img class="facebook" src="imgs/facebook.png" alt="Logo" />
            <img class="linkedin" src="imgs/linkedlin.png" alt="Logo" />
            <img class="x" src="imgs/x.png" alt="Logo" />
          </div>
          <div class="footer-search">
            <input type="text" placeholder="Pesquisar..." />
            <button class="pesquisa">Buscar</button>
          </div>
        </div>
        <!-- Copyright Section -->
        <div class="footer-copyright">
          <p>&copy; 2024 Lion King Motors. Todos os direitos reservados.</p>
        </div>
    
    </html>
    <div id="button-up">
        <button class="button-up-box" onclick="voltarAoTopo()">
          <div class="button-up-arrow"></div>
        </button>
        </div>
</footer>
    </script>
</body>
</html>
