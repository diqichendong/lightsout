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
</head>

<body class="bg-dark min-vh-100">

  <?php
  //Importar cabecera
  require_once "templates/header.php";
  ?>

  <!-- MAIN CONTENT -->
  <div class="container-fluid d-flex justify-content-center gap-2 text-light my-5">
    <!-- POSTS -->
    <section class="col-12 col-md-6 rounded overflow-hidden d-flex flex-column gap-1" id="posts">
      <!-- Post -->
      <div class="row p-2 border-2 bg-secondary">
        <!-- Poster -->
        <div class="col-3 col-md-2">
          <a href="ficha.html">
            <img src="img/poster.jpg" alt="poster" class="container p-0 rounded border border-warning" />
          </a>
        </div>
        <!-- Fin Poster -->
        <!-- Post body -->
        <div class="col-9 col-md-10 d-flex flex-wrap">
          <!-- Título -->
          <h3 class="col-9 text-warning">Babylon</h3>
          <!-- Fin Título -->
          <!-- Fecha -->
          <span class="col-3 text-white-50 text-end"><small>06/02/23</small></span>
          <!-- Fin Fecha -->
          <!-- Texto -->
          <p class="col-12">
            Entera, grandiosa, descomunal, extravagante, salvaje…, sin ninguna
            duda, un peliculón al que no sirve, solo, tentarle una parte.
            (...) No, no ha buscado un ‘buen trabajo’ Chazelle, ha buscado lo
            sublime.
          </p>
          <!-- Fin Texto -->
        </div>
        <!-- Fin Post body -->
        <!-- Post footer -->
        <div class="d-flex">
          <!-- Comentarios -->
          <div class="col-2 py-2 d-flex align-items-center justify-content-center gap-2">
            <a href="" class="link-warning">
              <i class="bi bi-chat"></i>
            </a>
            <span>0</span>
          </div>
          <!-- Fin Comentarios -->
          <!-- Lights -->
          <div class="col-2 py-2 d-flex align-items-center justify-content-center gap-2">
            <a href="" class="link-warning">
              <i class="bi bi-lightbulb"></i>
            </a>
            <span>0</span>
          </div>
          <!-- Fin Lights -->
          <!-- Usuario -->
          <div class="col-8 d-flex text-warning">
            <div class="col-10 col-lg-11 d-flex flex-column justify-content-center align-items-end px-2">
              <span class="lead">Oti Rodríguez</span>
              <span class="fw-bold">
                <small class="text-end">@oti</small>
              </span>
            </div>
            <div class="col-2 col-lg-1 d-flex align-items-center">
              <div class="ratio ratio-1x1">
                <img src="img/logo.png" alt="user" class="rounded-circle" />
              </div>
            </div>
          </div>
          <!-- Fin usuario -->
        </div>
        <!-- Fin Post footer -->
      </div>
      <!-- Fin Post -->
      <!-- Post -->
      <div class="row p-2 border-2 bg-secondary">
        <!-- Poster -->
        <div class="col-3 col-md-2">
          <a href="ficha.html">
            <img src="img/poster2.jpg" alt="poster" class="container p-0 rounded border border-warning" />
          </a>
        </div>
        <!-- Fin Poster -->
        <!-- Post body -->
        <div class="col-9 col-md-10 d-flex flex-wrap">
          <!-- Título -->
          <h3 class="col-9 text-warning">Ant-man y la Avispa: Quantumanía</h3>
          <!-- Fin Título -->
          <!-- Fecha -->
          <span class="col-3 text-white-50 text-end"><small>06/02/23</small></span>
          <!-- Fin Fecha -->
          <!-- Texto -->
          <p class="col-12">
            Solo se puede hablar bien del entretenimiento, sorpresa visual y
            ritmo despiadado que ofrece esta película tan hábil para llenar un
            par de horas con luchas, viajes, acción, tensión…, y sin que
            apenas necesites saber nada de física cuántica
          </p>
          <!-- Fin Texto -->
        </div>
        <!-- Fin Post body -->
        <!-- Post footer -->
        <div class="d-flex">
          <!-- Comentarios -->
          <div class="col-2 py-2 d-flex align-items-center justify-content-center gap-2">
            <a href="" class="link-warning">
              <i class="bi bi-chat"></i>
            </a>
            <span>0</span>
          </div>
          <!-- Fin Comentarios -->
          <!-- Lights -->
          <div class="col-2 py-2 d-flex align-items-center justify-content-center gap-2">
            <a href="" class="link-warning">
              <i class="bi bi-lightbulb"></i>
            </a>
            <span>0</span>
          </div>
          <!-- Fin Lights -->
          <!-- Usuario -->
          <div class="col-8 d-flex text-warning">
            <div class="col-10 col-lg-11 d-flex flex-column justify-content-center align-items-end px-2">
              <span class="lead">Javier Ocaña</span>
              <span class="fw-bold">
                <small class="text-end">@jocana</small>
              </span>
            </div>
            <div class="col-2 col-lg-1 d-flex align-items-center">
              <div class="ratio ratio-1x1">
                <img src="img/logo.png" alt="user" class="rounded-circle" />
              </div>
            </div>
          </div>
          <!-- Fin usuario -->
        </div>
        <!-- Fin Post footer -->
      </div>
      <!-- Fin Post -->
      <!-- Post -->
      <div class="row p-2 bg-secondary">
        <!-- Poster -->
        <div class="col-3 col-md-2">
          <a href="ficha.html">
            <img src="img/poster3.jpg" alt="poster" class="container p-0 rounded border border-warning" />
          </a>
        </div>
        <!-- Fin Poster -->
        <!-- Post body -->
        <div class="col-9 col-md-10 d-flex flex-wrap">
          <!-- Título -->
          <h3 class="col-9 text-warning">
            El Gato con Botas: El último deseo
          </h3>
          <!-- Fin Título -->
          <!-- Fecha -->
          <span class="col-3 text-white-50 text-end"><small>06/02/23</small></span>
          <!-- Fin Fecha -->
          <!-- Texto -->
          <p class="col-12">
            Apuesta por escapar de la fealdad digital original llevando el
            estilo de la película hacia el anime más de los años 70 (...) Para
            quienes no esperaban una nueva vida en el universo
            Dreamworks/Shrek
          </p>
          <!-- Fin Texto -->
        </div>
        <!-- Fin Post body -->
        <!-- Post footer -->
        <div class="d-flex">
          <!-- Comentarios -->
          <div class="col-2 py-2 d-flex align-items-center justify-content-center gap-2">
            <a href="" class="link-warning">
              <i class="bi bi-chat"></i>
            </a>
            <span>0</span>
          </div>
          <!-- Fin Comentarios -->
          <!-- Lights -->
          <div class="col-2 py-2 d-flex align-items-center justify-content-center gap-2">
            <a href="" class="link-warning">
              <i class="bi bi-lightbulb"></i>
            </a>
            <span>0</span>
          </div>
          <!-- Fin Lights -->
          <!-- Usuario -->
          <div class="col-8 d-flex text-warning">
            <div class="col-10 col-lg-11 d-flex flex-column justify-content-center align-items-end px-2">
              <span class="lead">Fausto Fernández</span>
              <span class="fw-bold">
                <small class="text-end">@faustofer</small>
              </span>
            </div>
            <div class="col-2 col-lg-1 d-flex align-items-center">
              <div class="ratio ratio-1x1">
                <img src="img/logo.png" alt="user" class="rounded-circle" />
              </div>
            </div>
          </div>
          <!-- Fin usuario -->
        </div>
        <!-- Fin Post footer -->
      </div>
      <!-- Fin Post -->

      <!-- Paginación -->
      <nav class="my-2">
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
      </nav>
      <!-- Fin paginación -->
    </section>
    <!-- Final POSTS -->

    <!-- ASIDE -->
    <aside class="d-none d-md-inline col-md-4">
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

    <!-- Crear post -->
    <div class="container position-fixed bottom-0 end-0 d-flex justify-content-end p-3">
      <button class="btn btn-warning btn-lg" id="crear-post" data-bs-toggle="modal" data-bs-target="#modal-crear-post">
        <i class="bi bi-pencil-square"></i>
      </button>
    </div>
    <!-- Fin Crear post -->
  </div>
  <!-- Final MAIN CONTENT -->

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
        <div class="modal-body bg-secondary">
          <form>
            <div class="mb-3">
              <label for="ficha-crear-post" class="col-form-label text-warning">
                Ficha:
              </label>
              <input type="text" class="form-control" id="ficha-crear-post" placeholder="Busca la pelicula, serie, ..."
                autofocus />
            </div>
            <div class="mb-3">
              <label for="contenido-crear-post" class="col-form-label text-warning">
                Contenido:
              </label>
              <textarea class="form-control" id="contenido-crear-post" rows="5"
                placeholder="Cuéntame algo..."></textarea>
            </div>
          </form>
        </div>
        <div class="modal-footer border-0">
          <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
            Cancelar
          </button>
          <button type="button" class="btn btn-outline-warning">POST</button>
        </div>
      </div>
    </div>
  </div>
  <!-- Fin Modal Crear post -->

  <?php
  //Importar footer
  require_once "templates/footer.php";
  ?>

  <!-- Bootstrap JS -->
  <script src="js/bootstrap.bundle.min.js"></script>

  <script src="js/inicio.js"></script>
</body>

</html>