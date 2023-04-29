<!DOCTYPE html>
<?php

$perfil = $_SESSION["perfil"];

?>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>
    <?= $perfil->nombre . " (@" . $perfil->username . ")" ?>
  </title>
  <link rel="shortcut icon" href="/assets/img/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="/css/bootstrap.min.css" />
  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
  <script src="/js/jquery-3.6.4.min.js"></script>
</head>

<body class="bg-dark min-vh-100 d-flex flex-column justify-content-between">
  <?php
  // Header
  require_once "templates/header.php";

  // Funciones
  require_once "utils/funciones.php";
  ?>

  <!-- Main -->
  <div class="container flex-fill">
    <div class="row justify-content-center">
      <!-- Info perfil -->
      <div class="col-9 col-lg-4 mb-3">
        <div class="card bg-secondary">
          <div class="card-body text-center">
            <img src="/assets/perfil/<?= $perfil->foto ?>" alt="Foto de perfil"
              class="img-fluid rounded-circle mb-3 col-6" />
            <div class="d-flex flex-column mb-3">
              <h4 class="text-warning lead fs-3">
                <?= $perfil->nombre ?>
              </h4>
              <div>
                <span class="text-white-50 fw-bold">
                  <?= "@" . $perfil->username ?>
                </span>
              </div>
            </div>
            <p class="text-light mb-3">
              <?= $perfil->sobre_mi ?>
            </p>
            <div class="container text-light d-flex">
              <p class="col-6 text-warning">
                <span class="text-light">
                  <?= $perfil->numero_seguidores() ?>
                </span> Seguidores
              </p>
              <p class="col-6 text-warning">
                <span class="text-light">
                  <?= $perfil->numero_siguiendo() ?>
                </span> Siguiendo
              </p>
            </div>
            <div class="container">
              <?php if ($perfil->id == $_SESSION["usuario"]->id) { ?>
                <a class="btn btn-outline-warning" href="/editar_perfil">Editar perfil</a>
              <?php } else if ($_SESSION["siguiendo"]) { ?>
                  <form action="/index.php?c=perfil&m=dejar_seguir" method="post">
                    <input type="hidden" name="id" value="<?= $perfil->id ?>">
                    <button type="submit" class="btn btn-warning">Siguiendo</button>
                  </form>
              <?php } else { ?>
                  <form action="/index.php?c=perfil&m=seguir" method="post">
                    <input type="hidden" name="id" value="<?= $perfil->id ?>">
                    <button type="submit" class="btn btn-outline-warning">Seguir</button>
                  </form>
              <?php } ?>
            </div>
          </div>
        </div>
      </div>
      <!-- Fin Info perfil -->

      <!-- Contenido perfil -->
      <div class="col-lg-8 mb-2">
        <!-- Pills -->
        <ul class="nav nav-pills nav-fill p-2 mb-3 bg-secondary rounded lead">
          <li class="nav-item">
            <a class="nav-link link-warning active" data-bs-toggle="pill" href="#tab-posts">
              Posts
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link link-warning" data-bs-toggle="pill" href="#tab-series">
              Series
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link link-warning" data-bs-toggle="pill" href="#tab-peliculas">
              Películas
            </a>
          </li>
        </ul>
        <!-- Fin Pills -->

        <!-- Contenido tabs -->
        <div class="tab-content">
          <!-- Contenido tab posts -->
          <div class="tab-pane fade show active" id="tab-posts">
            <!-- Posts -->
            <section class="col-12 rounded overflow-hidden d-flex flex-column gap-1 text-light my-2" id="posts">
              <?php if (sizeof($_SESSION["posts_perfil"]) == 0) { ?>
                <div class="container bg-secondary rounded">
                  <p class="lead text-warning text-center py-5">Todavía no tiene posts este perfil.</p>
                </div>
                <?php
              } else {
                foreach ($_SESSION["posts_perfil"] as $post) {
                  ?>
                  <!-- Post -->
                  <div class="row p-2 border-2 bg-secondary">
                    <!-- Poster -->
                    <div class="col-3 col-md-2">
                      <a href="ficha/<?= $post["ficha_tipo"] ?>/<?= $post["id_ficha"] ?>">
                        <img src="http://image.tmdb.org/t/p/original<?= $post["imagen"] ?>" alt="poster"
                          class="container p-0 rounded border border-warning" />
                      </a>
                    </div>
                    <!-- Fin Poster -->
                    <!-- Post body -->
                    <div class="col-9 col-md-10 d-flex flex-wrap">
                      <!-- Título -->
                      <a href="ficha/<?= $post["ficha_tipo"] ?>/<?= $post["id_ficha"] ?>"
                        class="text-decoration-none col-8">
                        <h3 class="text-warning">
                          <?= $post["titulo"] ?>
                          <?= $post["ficha_tipo"] == "tv" ? "[TV]" : "" ?>
                        </h3>
                      </a>
                      <!-- Fin Título -->
                      <!-- Fecha -->
                      <span class="col-4 text-white-50 text-end">
                        <small>
                          <?= formatear_fecha($post["fecha"]) ?>
                        </small>
                      </span>
                      <!-- Fin Fecha -->
                      <!-- Texto -->
                      <p class="col-12 contenido">
                        <?= $post["contenido"] ?>
                      </p>
                      <!-- Fin Texto -->
                    </div>
                    <!-- Fin Post body -->
                    <!-- Post footer -->
                    <div class="d-flex">
                      <!-- Comentarios -->
                      <div class="col-3 py-2 d-flex align-items-center justify-content-center gap-2">
                        <button class="btn btn-link link-warning btn-comentario px-1" data-bs-toggle="modal"
                          data-bs-target="#modal-comentarios">
                          <i class="bi bi-chat" data-id="<?= $post[0] ?>"></i>
                        </button>
                        <span class="contador-comentarios" data-id="<?= $post[0] ?>"></span>
                      </div>
                      <!-- Fin Comentarios -->
                      <!-- Lights -->
                      <div class="col-3 py-2 d-flex align-items-center justify-content-center gap-2">
                        <input type="checkbox" id="light-<?= $post[0] ?>" class="light-checkbox"
                          data-idusuario="<?= $_SESSION["usuario"]->id ?>">
                        <label class="text-warning px-1" for="light-<?= $post[0] ?>">
                          <i></i>
                        </label>
                        <span class="contador-lights" data-id="<?= $post[0] ?>"></span>
                      </div>
                      <!-- Fin Lights -->
                    </div>
                    <!-- Fin Post footer -->
                  </div>
                  <!-- Fin Post -->
                  <?php
                }
              }
              ?>
            </section>
            <!-- Fin Posts -->

            <!-- Paginación -->
            <!-- <nav class="my-2">
          <ul class="pagination justify-content-center">
            <li class="page-item disabled">
              <span class="page-link">Anterior</span>
            </li>
            <li class="page-item active">
              <a class="page-link" href="#">1</a>
            </li>
            <li class="page-item">
              <span class="page-link">2</span>
            </li>
            <li class="page-item">
              <a class="page-link" href="#">3</a>
            </li>
            <li class="page-item">
              <a class="page-link" href="#">Siguiente</a>
            </li>
          </ul>
        </nav> -->
            <!-- Fin paginación -->
          </div>
          <!-- Fin Contenido tab posts -->

          <!-- Contenido tab trailer -->
          <div class="tab-pane fade" id="tab-series">
            <section class="col-12 rounded overflow-hidden d-flex flex-column gap-1 text-light my-2">

            </section>
          </div>
          <!-- Fin Contenido tab trailer -->

          <!-- Contenido tab películas -->
          <div class="tab-pane fade" id="tab-peliculas">

          </div>
          <!-- Fin Contenido tab películas -->
        </div>
        <!-- Fin Contenido tabs -->
      </div>
      <!-- Fin Contenido perfil -->
    </div>
  </div>
  <!-- Fin Main -->

  <?php
  // Modal Comentarios
  require_once "templates/comentarios.php";

  // Footer
  require_once "templates/footer.php";
  ?>

  <!-- Bootstrap JS -->
  <script src="/js/bootstrap.bundle.min.js"></script>

  <script type="module" src="/js/perfil.js"></script>
  <script type="module" src="/js/comentario.js"></script>
  <script src="/js/light.js"></script>
</body>

</html>