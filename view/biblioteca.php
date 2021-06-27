<?php include "cabecalho.php" ?>

<?php
session_start();
require "./util/Mensagem.php";

$controller = new LivrosController();
$livros = $controller->index();
?>

<body>
  <nav class="nav-extended amber darken-1">
    <div class="nav-wrapper">
      <ul id="nav-mobile" class="right">
        <li class="active"><a href="/">Biblioteca</a></li>
        <li><a href="/novo">Cadastrar</a></li>
      </ul>
    </div>
    <div class="nav-header center">
    <img src="../imagens/logo.png" width="250px" >
    </div>
    <div class="nav-content">
      <ul class="tabs tabs-transparent amber darken-4">
        <li class="tab"><a class="active" href="#test1">Todos</a></li>
      </ul>
    </div>
  </nav>

  <div class="container">
    <div class="row pt2">

      <?php if (!$livros) echo "<p class='card-panel red lighten-4'>Nenhum livro cadastrado</p>" ?>

      <?php foreach ($livros as $livro) : ?>
        <div class="col s7 m4 l4 xl3">
          <div class="card hoverable card-serie limit">
            <div class="card-image">
              <img src="<?= $livro->capa ?>" class="activator bookImgLimitHeight" />
            </div>
            <div class="card-content">
              <p class="valign-wrapper">
                <i class="material-icons amber-text">star</i> <?= $livro->nota ?>
              </p>
              <span class="card-title activator truncate">
                <?= $livro->titulo ?>
              </span>

              <!-- Modal Structure -->
              <a class="waves-effect waves-light btn modal-trigger" href="#modal1">Ler Livro</a>

              <div id="modal1" class="modal">
                <div class="modal-content">
                  <h5>Boa leitura!</h5>
                  <div>

                    <iframe width="300" height="300" src="../arquivos/livros/exemplo.pdf"></iframe>

                    <iframe src="../arquivos/videos/exemplo.mp4" frameborder="0" allowfullscreen></iframe>

                  </div>
                </div>
                <div class="modal-footer">
                  <a href="#" class="modal-close waves-effect waves-green btn-flat">Fechar</a>
                </div>
              </div>

            </div>
            <div class="card-reveal">
              <span class="card-title grey-text text-darken-4"><?= $livro->titulo ?><i class="material-icons right">close</i></span>
              <p><?= substr($livro->descricao, 0, 500) . "..." ?></p>
              <button class="waves-effect waves-light btn-small right red accent-2 btn-delete" data-id="<?= $livro->id ?>"><i class="material-icons">delete</i></button>

            </div>
          </div>
        </div>
      <?php endforeach ?>
    </div>
  </div>

  <?= Mensagem::mostrar(); ?>

  <script>
    document.querySelectorAll(".btn-fav").forEach(btn => {
      btn.addEventListener("click", (e) => {
        const id = btn.getAttribute("data-id")
        fetch(`/favoritar/${id}`)
          .then(response => response.json())
          .then(response => {
            if (response.success === "ok") {
              if (btn.querySelector("i").innerHTML === "favorite") {
                btn.querySelector("i").innerHTML = "favorite_border"
              } else {
                btn.querySelector("i").innerHTML = "favorite"
              }
            }
          })
          .catch(error => {
            M.toast({
              html: 'Erro ao favoritar'
            })
          })
      });
    });

    document.querySelectorAll(".btn-delete").forEach(btn => {
      btn.addEventListener("click", (e) => {
        const id = btn.getAttribute("data-id")
        const requestConfig = {
          method: "DELETE",
          headers: new Headers()
        }
        fetch(`/livros/${id}`, requestConfig)
          .then(response => response.json())
          .then(response => {
            if (response.success === "ok") {
              const card = btn.closest(".col")
              card.classList.add("fadeOut")
              setTimeout(() => card.remove(), 1000)
            }
          })
          .catch(error => {
            M.toast({
              html: 'Erro ao favoritar'
            })
          })

      });
    });

    const elemsModal = document.querySelectorAll(".modal");
    const instancesModal = M.Modal.init(elemsModal);
  </script>

</body>

</html>