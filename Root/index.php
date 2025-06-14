<?php
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lion King</title>
    <link rel="icon" type="image" href="./imgs/favicon.png" sizes="16x16 16x16">
    <link rel="stylesheet" href="index.css">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Montserrat:wght@400&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link
      href="https://fonts.googleapis.com/css2?family=Pacifico&family=Montserrat:wght@400&display=swap"
      rel="stylesheet"
    />
</head>
<header>
        <div class="container">
            <div class="logo">
              <img class="logo" src="imgs/LK- Menu.png" alt="Logo">
            </div>
            <nav class="navbar">
              <div class="nav-links">
                <a href="/Root/">Home</a>
                <a href="/Root/catálogo/catalogo.php">Carros</a>
                <a href="login/cadastro.php">Cadastrar</a>
              </div>
              <nav class="navbar texto-M">
                <div class="nav-links">
                  <p>Lion King Motors</p>
                </div>
              </nav>
              <form id="login" class="login-form">
                <input type="text" id="email" name="email" placeholder="Email" required />
                <input type="password" id="senha" name="senha" placeholder="Senha" required />
                <p id="mensagem-erro" style="font-size: 17px; color: red;"></p>
                <button type="submit" class="cadastro" id="entrar" value="Entrar">Login</button>
              </form>
              <div class="login-form nav-usuario">
                <img dark-mode-user src="imgs/user-placeholder.png" />
                <span class="bem-vindo-usuario"></span>
                <button onclick="logout()">Logout</button>
              </div>
            </nav>
            <!-- Botão Dark Mode -->
            <button id="darkModeToggle" class="dark-mode-toggle" >🌙</button>
            <button onclick="animarMenu()" id="btn-menu" class="btn-menu">
              <span class="linha"></span>
              <span class="linha"></span>
              <span class="linha"></span>
            </button>
          </div>
    
          <div class="menu-mobile" id="menu-mobile">
            <nav>
              <a href="/Root/">Home</a>
              <a href="/Root/catálogo/catalogo.php">Carros</a>
              <a href="/login/cadastro.php">Cadastrar</a>
              <a href="/login/login.php">Login</a>
              <div class="login-form nav-usuario">
                <img src="imgs/user-placeholder.png" />
                <span class="bem-vindo-usuario"></span>
                <button onclick="logout()">Logout</button>
              </div>
            </nav>
          </div>
          <button id="increaseFont"><i class="fas fa-plus"></i></button>
          <button id="decreaseFont"><i class="fas fa-minus"></i></button>
<script src="fonte.js"></script>
</header>
<body>    
        <script src="/Root/partes/animar.js"></script>
        <script src="/Root/login/login.js"></script>
        <script src="darkmode.js"></script>
    <section>
        <div class="background-section">
            <video src="./vds/Video.mp4" autoplay loop muted></video>
        </div>
        <div class="box">
            <div class="conteudo">
                <h1>LUXO SOBRE RODAS</h1>
                <p>Explore a excelência automotiva com nossa coleção exclusiva de veículos de luxo. Atendimento personalizado e sofisticação em cada detalhe. Encontre o seu próximo sonho sobre rodas!</p>
            </div>
            <div class="botão meio">
                <a href="./catálogo/catalogo.html"class="modelo">Todos os nossos modelos</a>
            </div>
        </div>
    </section>
</select>
<div id="carromatriz" class="content-container">

    <div class="img-container">
      <a onClick="document.getElementById('modal-wrapper').style.display='block'"><img src="./imgs/CAR.png"></a>
    
    <button class="venda"  onClick="document.getElementById('modal-wrapper').style.display='block'"
    >3D View</button>
    </div>
    
    <div class="text-container">
    <h2><font color="#f44e52">911</font> Porche 911</h2>
    <p2> onde o legado encontra a velocidade, e cada curva se transforma em arte sobre rodas!</p2>
    </div>
    <a href="./catálogo/carros/porsche911turboS.html" class="carrinho"> Saiba mais!</a>
</div>
</script>
    
    
    </div>
    
    </div>
    
    <!--3d modal-->

    <div id="modal-wrapper"  class="modal">
    <div class="center">
    <span onClick="document.getElementById('modal-wrapper').style.display='none'" class="close">&times;</span>
    <div class="rotation">
    
    
<img src="./360/2.png">
<img src="./360/3.png">
<img src="./360/4.png">
<img src="./360/5.png">
<img src="./360/6.png">
<img src="./360/7.png">
<img src="./360/8.png">
<img src="./360/9.png">
<img src="./360/10.png">
<img src="./360/11.png">
<img src="./360/12.png">
<img src="./360/13.png">
<img src="./360/14.png">
<img src="./360/15.png">
<img src="./360/16.png">
<img src="./360/17.png">
<img src="./360/18.png">
<img src="./360/19.png">
<img src="./360/20.png">
<img src="./360/21.png">
<img src="./360/22.png">
<img src="./360/23.png">
<img src="./360/24.png">
<img src="./360/25.png">
<img src="./360/26.png">
<img src="./360/26.png">
<img src="./360/27.png">
<img src="./360/28.png">
<img src="./360/29.png">
<img src="./360/30.png">
<img src="./360/31.png">
<img src="./360/32.png">
<img src="./360/33.png">
<img src="./360/34.png">
<img src="./360/35.png">
<img src="./360/36.png">
<img src="./360/37.png">
<img src="./360/38.png">
<img src="./360/39.png">
<img src="./360/40.png">
<img src="./360/41.png">
<img src="./360/42.png">
<img src="./360/43.png">
<img src="./360/44.png">
<img src="./360/45.png">





</div>
</div>
</div>  
<section id="slideshow">
  <div class="entire-content">
      <div class="content-carrousel">
          <figure class="shadow">
              <a href="catálogo/carros/bmwx6m.html" target="_top">
                  <img src="imgs/Carro1.webp" alt="bmwx6m"/>
              </a>
          </figure>
          <figure class="shadow">
              <a href="catálogo/carros/jaguarf-typer.html" target="_top">
                  <img src="imgs/Carro2.jpeg" alt="jaguar-f-typer"/>
              </a>
          </figure>
          <figure class="shadow">
              <a href="catálogo/carros/jaguare-pace.html" target="_top">
                  <img src="imgs/Carro3.jpg" alt="jaguar-e-pace"/> 
              </a>    
          </figure>
          <figure class="shadow">
              <a href="catálogo/carros/porschemacan.html" target="_top">
                  <img src="imgs/carro4.avif" alt="porsche-macan"/>
              </a>
          </figure>
          <figure class="shadow">
              <a href="catálogo/carros/bmwixm60.html" target="_top">
                  <img src="imgs/Carro5.jpg" alt="bmw-ixm-60"/>
              </a>
          </figure>
          <figure class="shadow">
              <a href="catálogo/carros/porschecayenne.html" target="_top">
                  <img src="imgs/Carro6.jpg" alt="porsche-cayenne"/>
              </a>    
          </figure>
          <figure class="shadow">
              <a href="catálogo/carros/porschetaycan.html" target="_top">
                  <img src="../Root/catálogo/imagem/saiba+porschetaycan1.jpg" alt="porsche-taycan">
              </a>
          </figure>
          <figure class="shadow">
              <a href="catálogo/carros/porschepanamera.html" target="_top">
                  <img src="./catálogo/imagem/saiba+porschepanamera.jpg" alt="porshce-panamera">
              </a>
          </figure>
          <figure class="shadow">
              <a href="catálogo/carros/jaguari-pace.html" target="_top">
                  <img src="./catálogo/imagem/saiba+jaguari-pace.jpg" alt="jaguar-i-pace"/>
              </a>
          </figure>
</div>
</div>
</section>
<script>
      let currentIndex = 0;
const images = document.querySelectorAll('.image-column');
const totalImages = images.length;

function showImage(index) {
  images.forEach((img, i) => {
      img.classList.remove('show'); // Remove a classe 'show' de todas as imagens
      if (i === index) {
          img.classList.add('show'); // Adiciona a classe 'show' para a imagem atual
      }
  });
}

function nextImage() {
  currentIndex += 1;
  if (currentIndex >= totalImages) {
      currentIndex = 0; // Reinicia o índice
  }
  showImage(currentIndex);
}

function prevImage() {
  currentIndex -= 1;
  if (currentIndex < 0) {
      currentIndex = totalImages - 1; // Limita o índice
  }
  showImage(currentIndex);
}

// Inicializa a primeira imagem
showImage(currentIndex);
</script>
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
                <a href="/login/cadastro.php"
                  >Cadastro</a
                >
              </li>
              <li>
                <a href="/Root/catálogo/catalogo.html"
                  >Catálogo</a
                >
              </li>
            </ul>
          </div>
          <div class="footer-socials">
              <a href="https://www.facebook.com" target="_blank">
              <img class="facebook" src="imgs/facebook.png" alt="Logo" />
              </a>
              <a href="https://br.linkedin.com" target="_blank">
              <img class="linkedin" src="imgs/linkedlin.png" alt="Logo" />
              </a>
              <a href="https://x.com" target="_blank">
              <img class="x" src="imgs/x.png" alt="Logo" />
          </div>
          <div class="footer-search">
            <input type="text" placeholder="Pesquisar..." />
            <button class="pesquisa botao">Buscar</button>
          </div>
        </div>
        <!-- Copyright Section -->
        <div class="footer-copyright">
          <p>&copy; 2024 Lion King Motors. Todos os direitos reservados.</p>
        </div>
    <script src="/Projeto-LionKing-main/Root/script.js"></script>
                   <!-- Pop-up de Cookies -->
    <div id="cookiePopup" class="cookie-popup">
        <p>Este site utiliza cookies para melhorar sua experiência. Ao continuar navegando, você aceita nossa <a href="#">Política de Cookies</a>.</p>
        <button onclick="aceitarCookies()">Aceitar</button>
    </div>
    <div id="button-up">
        <button class="button-up-box" onclick="voltarAoTopo()">
          <div class="button-up-arrow"></div>
        </button>
        </div>
</footer>
    <script src="script.js"></script>
    <script src="animar.js"></script>
</body>
</html>


<?php if (isset($_SESSION['nome'])): ?>
    <p>Bem-vindo, <?= htmlspecialchars($_SESSION['nome']) ?>!</p>
    <a href="login/logout.php">Sair</a>
<?php else: ?>
    <a href="login/login.php">Login</a>
<?php endif; ?>
