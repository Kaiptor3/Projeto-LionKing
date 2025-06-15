<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de login</title>
    <link rel="icon" type="image" href="/Root/imgs/favicon.png" sizes="16x16">
    <link rel="stylesheet" href="login.css">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Montserrat:wght@400&display=swap"
        rel="stylesheet">
</head>

<body>
    <section>
        <div class="background-section">
            <video src="../vds/Video.mp4" autoplay loop muted></video>
        </div>

        <a href="../login/cadastro.php"><button type="button" class="botao-voltar">←</button></a>
        <form id="login" action="processa_login.php" method="POST">
            <div class="box2">
                <img id="logo2" src="./imgs/LK - Logo preta.png" alt="logo">
                <h1>Faça Login na sua conta!</h1>
                <div class="emails">
                    <input type="text" id="email" name="email" placeholder="Email" required>
                </div>
                <div class="senhas">
                    <input type="password" id="senha" name="senha" placeholder="Senha" required>
                    <?php if (isset($_GET['erro'])): ?>
                    <p id="mensagem-erro" class="error">Email ou senha inválidos.</p>
                    <?php endif; ?>
                </div>
                <div class="logar">
                    <p>Ainda não tem uma conta?<a href="cadastro.html">Crie uma.</a></p>
                    <input type="submit" class="entrar" id="entrar" value="Entrar" />
                </div>
            </div>
        </form>
    </section>
</body>

</html>