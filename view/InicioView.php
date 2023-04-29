<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Inicio</title>
  <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
  <script src="js/jquery-3.6.4.min.js"></script>
</head>

<body class="bg-dark d-flex flex-column justify-content-between min-vh-100">

  <?php

  // Importar funciones
  require_once "utils/funciones.php";

  //Importar cabecera
  require_once "templates/header.php";
  ?>

  <!-- MAIN CONTENT -->
  <div class="container d-flex justify-content-center text-light mb-2 flex-fill flex-wrap">
    <!-- POSTS -->
    <section class="container col-12 col-lg-8 m-0">
      <h1 class="text-warning fw-bold border-bottom border-top border-warning text-center">
        POSTS
      </h1>
      <div class="col-12 rounded overflow-hidden d-flex flex-column gap-1" id="posts">
        <?php if (sizeof($_SESSION["posts_inicio"]) == 0) { ?>
          <p class="lead text-warning text-center py-5">¡Bienvenido a LightsOUT!</p>
        <?php } else {
          foreach ($_SESSION["posts_inicio"] as $row) { ?>
            <!-- Post -->
            <div class="row p-2 border-2 bg-secondary" id="post-<?= $row[0] ?>">
              <!-- Poster -->
              <div class="col-3 col-md-2">
                <a href="ficha/<?= $row[7] ?>/<?= $row["id_ficha"] ?>">
                  <img src="http://image.tmdb.org/t/p/original<?= $row["imagen"] ?>" alt="poster"
                    class="container p-0 rounded border border-warning" />
                </a>
              </div>
              <!-- Fin Poster -->
              <!-- Post body -->
              <div class="col-9 col-md-10 d-flex flex-wrap">
                <!-- Título -->
                <a href="ficha/<?= $row[7] ?>/<?= $row["id_ficha"] ?>"
                  class="text-decoration-none col-8 col-md-9 col-lg-10">
                  <h3 class="text-warning">
                    <?= $row["titulo"] ?>
                    <?= $row[7] == "tv" ? "[TV]" : "" ?>
                  </h3>
                </a>
                <!-- Fin Título -->
                <!-- Fecha -->
                <span class="col-4 col-md-3 col-lg-2 text-white-50 text-end">
                  <small>
                    <?= formatear_fecha($row["fecha"]) ?>
                  </small>
                </span>
                <!-- Fin Fecha -->
                <!-- Texto -->
                <p class="col-12 contenido">
                  <?= $row["contenido"] ?>
                </p>
                <!-- Fin Texto -->
              </div>
              <!-- Fin Post body -->
              <!-- Post footer -->
              <div class="d-flex">
                <!-- Comentarios -->
                <div class="col-2 py-2 d-flex align-items-center justify-content-center gap-2">
                  <button class="btn btn-link link-warning btn-comentario px-1" data-bs-toggle="modal"
                    data-bs-target="#modal-comentarios">
                    <i class="bi bi-chat" data-id="<?= $row[0] ?>"></i>
                  </button>
                  <span class="contador-comentarios" data-id="<?= $row[0] ?>"></span>
                </div>
                <!-- Fin Comentarios -->
                <!-- Lights -->
                <div class="col-2 py-2 d-flex align-items-center justify-content-center gap-2">
                  <input type="checkbox" id="light-<?= $row[0] ?>" class="light-checkbox"
                    data-idusuario="<?= $_SESSION["usuario"]->id ?>">
                  <label class="text-warning px-1" for="light-<?= $row[0] ?>">
                    <i></i>
                  </label>
                  <span class="contador-lights" data-id="<?= $row[0] ?>"></span>
                </div>
                <!-- Fin Lights -->
                <!-- Usuario -->
                <div class="col-8 d-flex text-warning">
                  <div class="col-10 col-lg-11 d-flex flex-column justify-content-center align-items-end px-2">
                    <a href="/perfil/<?= $row[10] ?>" class="text-decoration-none link-warning">
                      <span class="lead">
                        <?= $row["nombre"] ?>
                      </span>
                    </a>
                    <span class="fw-bold">
                      <small class="text-end">@
                        <?= $row["username"] ?>
                      </small>
                    </span>
                  </div>
                  <div class="col-2 col-lg-1 d-flex align-items-center">
                    <a href="/perfil/<?= $row[10] ?>" class="ratio ratio-1x1">
                      <img src="assets/perfil/<?= $row["foto"] ?>" alt="user" class="rounded-circle" />
                    </a>
                  </div>
                </div>
                <!-- Fin usuario -->
              </div>
              <!-- Fin Post footer -->
            </div>
            <!-- Fin Post -->
          <?php }
        } ?>

      </div>

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
            <a class="page-link" href="#">2</a>
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

    </section>
    <!-- Final POSTS -->

    <!-- ASIDE -->
    <aside class="d-none d-lg-inline col-lg-4">
      <!-- Tracker -->
      <div class="container bg-secondary rounded py-2">
        <!-- Pills -->
        <ul class="nav nav-pills nav-justified d-flex align-items-center border-bottom border-warning py-2"
          role="tablist">
          <li class="nav-item">
            <a class="nav-link active link-warning" data-bs-toggle="pill" href="#siguiendo">
              Siguiendo
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link link-warning" data-bs-toggle="pill" href="#series-pendientes">
              Series pendientes
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link link-warning" data-bs-toggle="pill" href="#peliculas-pendientes">
              Peliculas pendientes
            </a>
          </li>
        </ul>
        <!-- Fin Pills -->
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Panel siguiendo -->
          <div class="tab-pane container active my-2" id="siguiendo">
            <p class="text-end">
              <a href="" class="link link-warning">
                <small>Ver todos</small>
              </a>
            </p>
            <div class="container-fluid row justify-content-center gap-2 p-0 m-0">
              <a href="ficha.html" class="col-md-5 col-lg-3 p-0">
                <img src="img/poster.jpg" alt="poster" class="rounded border border-warning p-0 col-12" />
              </a>
              <a href="ficha.html" class="col-md-5 col-lg-3 p-0">
                <img src="img/poster2.jpg" alt="poster" class="rounded border border-warning p-0 col-12" />
              </a>
              <a href="ficha.html" class="col-md-5 col-lg-3 p-0">
                <img src="img/poster3.jpg" alt="poster" class="rounded border border-warning p-0 col-12" />
              </a>
              <a href="ficha.html" class="col-md-5 col-lg-3 p-0">
                <img src="img/poster3.jpg" alt="poster" class="rounded border border-warning p-0 col-12" />
              </a>
              <a href="ficha.html" class="col-md-5 col-lg-3 p-0">
                <img src="img/poster.jpg" alt="poster"
                  class="rounded border border-warning p-0 d-none d-lg-inline col-12" />
              </a>
              <a href="ficha.html" class="col-md-5 col-lg-3 p-0">
                <img src="img/poster2.jpg" alt="poster"
                  class="rounded border border-warning p-0 d-none d-lg-inline col-12" />
              </a>
            </div>
          </div>
          <!-- Fin Panel siguiendo -->
          <!-- Panel series pendientes -->
          <div class="tab-pane container fade my-2" id="series-pendientes">
            <p class="text-end">
              <a href="" class="link link-warning">
                <small>Ver todos</small>
              </a>
            </p>
            <div class="container-fluid row justify-content-center gap-2 p-0 m-0">
              <a href="ficha.html" class="col-md-5 col-lg-3 p-0">
                <img src="img/poster2.jpg" alt="poster" class="rounded border border-warning p-0 col-12" />
              </a>
              <a href="ficha.html" class="col-md-5 col-lg-3 p-0">
                <img src="img/poster.jpg" alt="poster" class="rounded border border-warning p-0 col-12" />
              </a>
              <a href="ficha.html" class="col-md-5 col-lg-3 p-0">
                <img src="img/poster3.jpg" alt="poster" class="rounded border border-warning p-0 col-12" />
              </a>
              <a href="ficha.html" class="col-md-5 col-lg-3 p-0">
                <img src="img/poster.jpg" alt="poster" class="rounded border border-warning p-0 col-12" />
              </a>
              <a href="ficha.html" class="col-md-5 col-lg-3 p-0">
                <img src="img/poster3.jpg" alt="poster"
                  class="rounded border border-warning p-0 d-none d-lg-inline col-12" />
              </a>
              <a href="ficha.html" class="col-md-5 col-lg-3 p-0">
                <img src="img/poster2.jpg" alt="poster"
                  class="rounded border border-warning p-0 d-none d-lg-inline col-12" />
              </a>
            </div>
          </div>
          <!-- Fin Panel series pendientes -->
          <!-- Panel peliculas pendientes -->
          <div class="tab-pane container fade my-2" id="peliculas-pendientes">
            <p class="text-end">
              <a href="" class="link link-warning">
                <small>Ver todos</small>
              </a>
            </p>
            <div class="container-fluid row justify-content-center gap-2 p-0 m-0">
              <a href="ficha.html" class="col-md-5 col-lg-3 p-0">
                <img src="img/poster3.jpg" alt="poster" class="rounded border border-warning p-0 col-12" />
              </a>
              <a href="ficha.html" class="col-md-5 col-lg-3 p-0">
                <img src="img/poster2.jpg" alt="poster" class="rounded border border-warning p-0 col-12" />
              </a>
              <a href="ficha.html" class="col-md-5 col-lg-3 p-0">
                <img src="img/poster.jpg" alt="poster" class="rounded border border-warning p-0 col-12" />
              </a>
              <a href="ficha.html" class="col-md-5 col-lg-3 p-0">
                <img src="img/poster2.jpg" alt="poster" class="rounded border border-warning p-0 col-12" />
              </a>
              <a href="ficha.html" class="col-md-5 col-lg-3 p-0">
                <img src="img/poster.jpg" alt="poster"
                  class="rounded border border-warning p-0 d-none d-lg-inline col-12" />
              </a>
              <a href="ficha.html" class="col-md-5 col-lg-3 p-0">
                <img src="img/poster3.jpg" alt="poster"
                  class="rounded border border-warning p-0 d-none d-lg-inline col-12" />
              </a>
            </div>
          </div>
          <!-- Fin Panel peliculas pendientes -->
        </div>
        <!-- Fin Tab panes -->
      </div>
      <!-- Fin Tracker -->
    </aside>
    <!-- Fin ASIDE -->
  </div>
  <!-- Final MAIN CONTENT -->

  <!-- Crear post -->
  <div class="position-sticky bottom-0 float-end p-3 w-auto pe-none">
    <button class="btn btn-warning btn-lg pe-auto float-end" id="crear-post" data-bs-toggle="modal"
      data-bs-target="#modal-crear-post">
      <i class="bi bi-pencil-square"></i>
    </button>
  </div>
  <!-- Fin Crear post -->

  <!-- Modal Crear post -->
  <div class="modal fade" id="modal-crear-post" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content bg-dark">
        <div class="modal-header border-0">
          <h5 class="modal-title text-warning">Crear Post</h5>
          <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
            <i class="bi bi-x-lg fw-bold"></i>
          </button>
        </div>
        <form method="post" action="index.php?c=inicio&m=crear_post">
          <div class="modal-body bg-secondary">
            <div class="container d-flex align-items-center gap-3 mb-3 p-0">
              <div class="col-3 col-sm-2">
                <img src="assets/img/default-poster.png" alt="poster" id="crear-post-poster"
                  class="container p-0 rounded border border-warning" />
              </div>
              <div class="container col-9 col-sm-10">
                <label for="ficha-crear-post" class="col-form-label text-warning">
                  Ficha:
                </label>
                <input class="form-control" id="crear-post-buscador" placeholder="Buscar película o serie">
                <select class="form-select" id="crear-post-fichas" name="id-ficha"></select>
                <input type="hidden" name="poster" id="poster">
                <input type="hidden" name="tipo" id="tipo">
                <input type="hidden" name="titulo" id="titulo">
              </div>
            </div>
            <div class="mb-3">
              <label for="contenido-crear-post" class="col-form-label text-warning">
                Contenido:
              </label>
              <textarea class="form-control" id="contenido-crear-post" name="contenido" rows="5"
                placeholder="Cuéntame algo..." required></textarea>
            </div>
          </div>
          <div class="modal-footer border-0">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
              Cancelar
            </button>
            <button id="post" type="submit" class="btn btn-outline-warning">POST</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Fin Modal Crear post -->



  <?php
  // Modal comentarios
  require_once "templates/comentarios.php";

  //Importar footer
  require_once "templates/footer.php";

  ?>

  <!-- Bootstrap JS -->
  <script src="js/bootstrap.bundle.min.js"></script>

  <script type="module" src="js/inicio.js"></script>
  <script type="module" src="js/comentario.js"></script>
  <script src="js/light.js"></script>
</body>

</html>