<?php
session_start();

// Verifica se o usuário está logado e se é admin (idPermissao == 2)
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['idPermissao'] != 2) {
    header('Location: ../login/login.html'); // Ajuste o caminho para sua página de login
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#000" />
    <link rel="stylesheet" href="style.css" />

    <title>Painel de administração</title>
  </head>
  <body>
    <div id="content">
      <header>
        <div class="busca">
          <form action="">
            <input type="text" placeholder="Pesquisar" />
            <button type="submit" title="Buscar">
              <i class="bi bi-search"></i>
            </button>
          </form>
          <button title="Notificações"><i class="bi bi-bell"></i></button>
          <div class="perfil">
            <img src="/1.jpg" alt="Sua foto de perfil" />
            <p>Fulano Silva</p>
          </div>
        </div>
        <div class="saudacao">
          <div class="perfil">
            <img src="" alt="Sua foto de perfil" />
            <span>Olá,</span>
            <p>Fulano Silva (@fulano)</p>
          </div>
          <div class="acoes">
            <button>Novo</button>
            <button>Enviar</button>
            <button>Compartilhar</button>
          </div>
        </div>
      </header>
      <aside>
        <div class="logo">
          <i class="bi bi-speedometer2"></i>
          <h1>Painel</h1>
        </div>
        <ul class="menu">
          <li class="selecionado">
            <a href="#"><i class="bi bi-house"></i>Início</a>
          </li>
          <li>
            <a href="#"><i class="bi bi-person"></i>Perfil</a>
          </li>
          <li>
            <a href="#"><i class="bi bi-chat"></i>Mensagens</a>
          </li>
          <li>
            <a href="#"><i class="bi bi-clock-history"></i>Histórico</a>
          </li>
          <li>
            <a href="#"><i class="bi bi-journals"></i>Tarefas</a>
          </li>
          <li>
            <a href="#"><i class="bi bi-people"></i>Comunidades</a>
          </li>
        </ul>
        <ul class="menu">
          <li>
            <a href="#"><i class="bi bi-gear"></i>Ajustes</a>
          </li>
          <li>
            <a href="#"><i class="bi bi-info-circle"></i>Ajuda</a>
          </li>
          <li>
            <a href="#"><i class="bi bi-shield-check"></i>Privacidade</a>
          </li>
        </ul>
       </aside>
      <main>
        <section class="projetos">
          <h2>Adicione ou retire dados do site:</h2>
          <div>
            <div class="card">
              <div class="barra"></div>
              <div class="conteudo">
                <h3>Projeto super legal</h3>
                <p>
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic
                  qui magni libero sunt quisquam quia!
                </p>
                <div class="acoes">
                  <button title="Favoritar"><i class="bi bi-star"></i></button>
                  <button title="Visualizar"><i class="bi bi-eye"></i></button>
                  <button title="Compartilhar">
                    <i class="bi bi-share"></i>
                  </button>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="barra"></div>
              <div class="conteudo">
                <h3>Projeto menos legal</h3>
                <p>
                  Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                  Eveniet adipisci incidunt nulla. Dolorem repellat error alias
                  corporis cupiditate, dolorum natus iusto eveniet aliquid
                  temporibus nam quaerat.
                </p>
                <div class="acoes">
                  <button title="Favoritar"><i class="bi bi-star"></i></button>
                  <button title="Visualizar"><i class="bi bi-eye"></i></button>
                  <button title="Compartilhar">
                    <i class="bi bi-share"></i>
                  </button>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="barra"></div>
              <div class="conteudo">
                <h3>App impossível</h3>
                <p>
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Ea
                  culpa unde non voluptas ut!
                </p>
                <div class="acoes">
                  <button title="Favoritar"><i class="bi bi-star"></i></button>
                  <button title="Visualizar"><i class="bi bi-eye"></i></button>
                  <button title="Compartilhar">
                    <i class="bi bi-share"></i>
                  </button>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="barra"></div>
              <div class="conteudo">
                <h3>App super fácil</h3>
                <p>
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. Esse
                  reiciendis quam quis vitae amet, numquam expedita, in ratione,
                  repellendus facilis ea architecto!
                </p>
                <div class="acoes">
                  <button title="Favoritar"><i class="bi bi-star"></i></button>
                  <button title="Visualizar"><i class="bi bi-eye"></i></button>
                  <button title="Compartilhar">
                    <i class="bi bi-share"></i>
                  </button>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="barra"></div>
              <div class="conteudo">
                <h3>Bloqueador de anúncios</h3>
                <p>
                  Lorem ipsum dolor sit, amet consectetur adipisicing elit.
                  Tenetur odio eaque praesentium excepturi magni temporibus
                  architecto quasi doloribus.
                </p>
                <div class="acoes">
                  <button title="Favoritar"><i class="bi bi-star"></i></button>
                  <button title="Visualizar"><i class="bi bi-eye"></i></button>
                  <button title="Compartilhar">
                    <i class="bi bi-share"></i>
                  </button>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="barra"></div>
              <div class="conteudo">
                <h3>Fazedor de dinheiro</h3>
                <p>
                  Lorem ipsum dolor sit amet consectetur adipisicing elit. A
                  nam, voluptatibus et temporibus distinctio id deleniti qui
                  eius placeat delectus? Nemo, quibusdam nihil?
                </p>
                <div class="acoes">
                  <button title="Favoritar"><i class="bi bi-star"></i></button>
                  <button title="Visualizar"><i class="bi bi-eye"></i></button>
                  <button title="Compartilhar">
                    <i class="bi bi-share"></i>
                  </button>
                </div>
              </div>
            </div>
          </div>
        </section>
        <section class="anuncios">
          <h2>Anúncios importantes</h2>
          <div class="card">
            <div>
              <h4>Pendências</h4>
              <p>
                Aqui aparecem as pendências do dia <p id="data"></p>
                <script>
        // Função para formatar a data
        function formatarData() {
            const hoje = new Date();
            const opcoes = { year: 'numeric', month: 'long', day: 'numeric' };
            return hoje.toLocaleDateString('pt-BR', opcoes);
        }

        // Exibe a data formatada
        document.getElementById("data").innerHTML = formatarData();
    </script>
              </p>
            </div>
            <div>
              <h4>Lucro em vendas no mês:</h4>
              <p>
                Já lucrou R$0 Reais no mês. 
              </p>
            </div>
            <div>
              <h4>Política de privacidade atualizada</h4>
              <p>
                As informações fornecidas para a venda do seu veículo serão usadas exclusivamente para avaliar, processar e concluir a transação. Garantimos que seus dados pessoais não serão compartilhados com terceiros, exceto quando necessário para concluir a venda. Seus dados serão tratados com segurança e conforme as leis de privacidade vigentes.
              </p>
            </div>
          </div>
        </section>
        <section class="em-alta">
          <h2>Carros mais vendidos do mês!</h2>
          <div>
            <div class="perfil">
              <img src="/catálogo/imagem/bmw ix m60.jpg" alt="Foto de perfil" />
              <p>BMW IX M60</p>
              <span>Mais de 3k de vendas!</span>
            </div>
            <div class="perfil">
              <img src="/catálogo/imagem/saiba+cayane.jpg" alt="Foto de perfil" />
              <p>CAYANE</p>
              <span>Mais de 2k de vendas!</span>
            </div>
            <div class="perfil">
              <img src="/catálogo/imagem/Porsche-911_Turbo_S-2021-1024-02.jpg" alt="Foto de perfil" />
              <p>PORSHE 911</p>
              <span>Mais de 1.3k de vendas!</span>
            </div>
            <div class="perfil">
              <img src="/catálogo/imagem/jaguare-pace.avif" alt="Foto de perfil" />
              <p>JAGUARE PACE</p>
              <span>Mais de 1k de vendas!</span>
            </div>
          </div>
        </section>
      </main>
    </div>

    <script>
      const footer = document.getElementById("texto-footer");
      footer.innerText = `Adriel Faria, ${new Date().getFullYear()}`;
    </script>
  </body>
</html>
