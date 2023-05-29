<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>
    Administrador
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

  <!-- Mensaje -->
  <?php if (isset($_SESSION["mensaje"])) { ?>
    <div class="container alert alert-success alert-dismissible fade show" role="alert">
      <span>
        <?= $_SESSION["mensaje"] ?>
      </span>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION["mensaje"]);
  } ?>

  <!-- Main -->
  <div class="container flex-fill">
    <!-- Pills -->
    <ul class="nav nav-pills nav-fill p-2 mb-3 bg-secondary rounded lead">
      <li class="nav-item">
        <a class="nav-link link-warning <?= $_SESSION["tab"] == "gestion_usuarios" ? "active" : "" ?>"
          data-bs-toggle="pill" href="#tab-usuarios">
          Gestión de usuarios
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link link-warning <?= $_SESSION["tab"] == "moderar_posts" ? "active" : "" ?>"
          data-bs-toggle="pill" href="#tab-posts">
          Moderar posts
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link link-warning <?= $_SESSION["tab"] == "moderar_comentarios" ? "active" : "" ?>"
          data-bs-toggle="pill" href="#tab-comentarios">
          Moderar comentarios
        </a>
      </li>
    </ul>
    <!-- Fin Pills -->

    <!-- Contenido tabs -->
    <div class="tab-content">
      <!-- Contenido tab gestión usuarios -->
      <div class="tab-pane fade <?= $_SESSION["tab"] == "gestion_usuarios" ? "show active" : "" ?>" id="tab-usuarios">
        <section class="container-fluid col-md-10 col-lg-8 text-light border border-warning rounded py-2">
          <!-- Buscador de usuarios -->
          <div class="col-md-6 col-lg-5">
            <div class="input-group mb-2">
              <span class="input-group-text text-warning bg-secondary">
                <i class="bi bi-search"></i>
              </span>
              <input type="text" class="form-control" id="buscar-usuarios" placeholder="Buscar usuario..." />
            </div>
          </div>
          <!-- Fin Buscador de usuarios -->
          <!-- Lista usuarios -->
          <div class="container-fluid d-flex flex-column gap-1 p-0 overflow-auto rounded" style="max-height: 500px;"
            id="lista-usuarios">
            <?php foreach ($_SESSION["usuarios"] as $usuario) { ?>
              <!-- Usuario -->
              <div class="container-fluid d-flex justify-content-between align-items-center bg-secondary p-2"
                title="<?= $usuario["nombre"] ?> (@<?= $usuario["username"] ?>)">
                <div class="col-2 col-lg-1">
                  <a href="/perfil/<?= $usuario["id"] ?>/posts" class="ratio ratio-1x1">
                    <img src="/assets/perfil/<?= $usuario["foto"] ?>" alt="foto" class="rounded-circle" />
                  </a>
                </div>
                <div class="col-6 col-lg-5 m-0 px-2 d-flex flex-column flex-fill">
                  <a class="link-warning text-decoration-none text-truncate" href="/perfil/<?= $usuario["id"] ?>/posts">
                    <?= $usuario["nombre"] ?>
                  </a>
                  <small class="text-truncate">
                    <?= "@" . $usuario["username"] ?>
                  </small>
                </div>
                <div class="col-auto d-flex justify-content-end gap-2">
                  <button class="btn btn-sm btn-outline-warning btn-editar" data-bs-target="#modal-editar"
                    data-bs-toggle="modal" data-id="<?= $usuario["id"] ?>">
                    Editar
                  </button>
                  <button class="btn btn-sm btn-danger btn-eliminar" data-id="<?= $usuario["id"] ?>"
                    data-nombre="<?= $usuario["nombre"] ?>" data-username="<?= $usuario["username"] ?>">
                    Eliminar
                  </button>
                </div>
              </div>
              <!-- Fin usuario -->
            <?php } ?>
          </div>
          <!-- Fin lista usuarios -->
        </section>
      </div>
      <!-- Fin Contenido tab gestión usuarios -->
      <!-- Contenido tab moderar posts -->
      <div class="tab-pane fade <?= $_SESSION["tab"] == "moderar_posts" ? "show active" : "" ?>" id="tab-posts">
        <section class="container-fluid col-md-10 col-lg-8 text-light border border-warning rounded py-2">
          <!-- Lista posts denunciados -->
          <div class="container-fluid d-flex flex-column gap-1 overflow-auto rounded" style="max-height: 500px;"
            id="lista-usuarios">
            <?php if (sizeof($_SESSION["posts_denunciados"]) == 0) { ?>
              <div class="container bg-secondary rounded">
                <p class="lead text-warning text-center py-5">
                  No hay ningún post que necesite moderación.
                </p>
              </div>
              <?php
            } else {
              foreach ($_SESSION["posts_denunciados"] as $post) {
                ?>
                <!-- Post -->
                <div class="row p-2 border-2 bg-secondary">
                  <!-- Post body -->
                  <div class="col-12 d-flex flex-wrap">
                    <!-- Título -->
                    <a href="ficha/<?= $post["ficha_tipo"] ?>/<?= $post["id_ficha"] ?>"
                      class="text-decoration-none col-8 col-md-9 col-lg-10">
                      <h3 class="text-warning">
                        <?= $post["titulo"] ?>
                        <?= $post["ficha_tipo"] == "tv" ? "[TV]" : "" ?>
                      </h3>
                    </a>
                    <!-- Fin Título -->
                    <!-- Fecha -->
                    <span class="col-4 col-md-3 col-lg-2 text-white-50 text-end">
                      <small>
                        <?= formatear_fecha($post["fecha"]) ?>
                      </small>
                    </span>
                    <!-- Fin Fecha -->
                    <!-- Texto -->
                    <p class="col-12 p-2">
                      <?= $post["contenido"] ?>
                    </p>
                    <!-- Fin Texto -->
                  </div>
                  <!-- Fin Post body -->
                  <!-- Post footer -->
                  <div class="d-flex">
                    <!-- Permitir -->
                    <div class="col-2 py-2 d-flex align-items-center justify-content-center gap-2">
                      <button class="btn btn-success btn-permitir-post px-1" data-id="<?= $post["id_post"] ?>">
                        <i class="bi bi-check-circle-fill"></i> Permitir
                      </button>
                    </div>
                    <!-- Fin Permitir -->
                    <!-- Borrar -->
                    <div class="col-2 py-2 d-flex align-items-center justify-content-center gap-2">
                      <button class="btn btn-danger btn-borrar-post px-1" data-id="<?= $post["id_post"] ?>">
                        <i class="bi bi-x-circle-fill"></i> Borrar
                      </button>
                    </div>
                    <!-- Fin Borrar -->
                    <!-- Usuario -->
                    <div class="col-8 d-flex text-warning">
                      <div class="col-10 col-lg-11 d-flex flex-column justify-content-center align-items-end px-2">
                        <a href="/perfil/<?= $post["id_usuario"] ?>/posts" class="text-decoration-none link-warning">
                          <span class="lead">
                            <?= $post["nombre"] ?>
                          </span>
                        </a>
                        <span class="fw-bold">
                          <small class="text-end">@
                            <?= $post["username"] ?>
                          </small>
                        </span>
                      </div>
                      <div class="col-2 col-lg-1 d-flex align-items-center">
                        <a href="/perfil/<?= $post["id_usuario"] ?>/posts" class="ratio ratio-1x1">
                          <img src="/assets/perfil/<?= $post["foto"] ?>" alt="user" class="rounded-circle" />
                        </a>
                      </div>
                    </div>
                    <!-- Fin usuario -->
                  </div>
                  <!-- Fin Post footer -->
                </div>
                <!-- Fin Post -->
                <?php
              }
            }
            ?>
          </div>
          <!-- Fin lista posts denunciados -->
        </section>
      </div>
      <!-- Fin Contenido tab moderar posts -->
      <!-- Contenido tab moderar comentarios -->
      <div class="tab-pane fade <?= $_SESSION["tab"] == "moderar_comentarios" ? "show active" : "" ?>"
        id="tab-comentarios">
        <section class="container-fluid col-md-10 col-lg-8 text-light border border-warning rounded py-2">
          <!-- Lista comentarios denunciados -->
          <div class="container-fluid d-flex flex-column gap-1 overflow-auto rounded" style="max-height: 500px;"
            id="lista-usuarios">
            <?php if (sizeof($_SESSION["comentarios_denunciados"]) == 0) { ?>
              <div class="container bg-secondary rounded">
                <p class="lead text-warning text-center py-5">
                  No hay ningún comentario que necesite moderación.
                </p>
              </div>
              <?php
            } else {
              foreach ($_SESSION["comentarios_denunciados"] as $comentario) {
                ?>
                <!-- Comentario -->
                <div class="row p-2 border-2 bg-secondary">
                  <!-- Comentario body -->
                  <div class="col-12 d-flex flex-wrap">
                    <!-- Fecha -->
                    <span class="col-12 text-white-50 text-end">
                      <small>
                        <?= formatear_fecha($comentario["fecha"]) ?>
                      </small>
                    </span>
                    <!-- Fin Fecha -->
                    <!-- Texto -->
                    <p class="col-12 p-2">
                      <?= $comentario["contenido"] ?>
                    </p>
                    <!-- Fin Texto -->
                  </div>
                  <!-- Fin Comentario body -->
                  <!-- Comentario footer -->
                  <div class="d-flex">
                    <!-- Permitir -->
                    <div class="col-2 py-2 d-flex align-items-center justify-content-center gap-2">
                      <button class="btn btn-success btn-permitir-comentario px-1"
                        data-id="<?= $comentario["id_comentario"] ?>">
                        <i class="bi bi-check-circle-fill"></i> Permitir
                      </button>
                    </div>
                    <!-- Fin Permitir -->
                    <!-- Borrar -->
                    <div class="col-2 py-2 d-flex align-items-center justify-content-center gap-2">
                      <button class="btn btn-danger btn-borrar-comentario px-1"
                        data-id="<?= $comentario["id_comentario"] ?>">
                        <i class="bi bi-x-circle-fill"></i> Borrar
                      </button>
                    </div>
                    <!-- Fin Borrar -->
                    <!-- Usuario -->
                    <div class="col-8 d-flex text-warning">
                      <div class="col-10 col-lg-11 d-flex flex-column justify-content-center align-items-end px-2">
                        <a href="/perfil/<?= $comentario["id_usuario"] ?>/posts" class="text-decoration-none link-warning">
                          <span class="lead">
                            <?= $comentario["nombre"] ?>
                          </span>
                        </a>
                        <span class="fw-bold">
                          <small class="text-end">@
                            <?= $comentario["username"] ?>
                          </small>
                        </span>
                      </div>
                      <div class="col-2 col-lg-1 d-flex align-items-center">
                        <a href="/perfil/<?= $comentario["id_usuario"] ?>/posts" class="ratio ratio-1x1">
                          <img src="/assets/perfil/<?= $comentario["foto"] ?>" alt="user" class="rounded-circle" />
                        </a>
                      </div>
                    </div>
                    <!-- Fin usuario -->
                  </div>
                  <!-- Fin Comentario footer -->
                </div>
                <!-- Fin Comentario -->
                <?php
              }
            }
            ?>
          </div>
          <!-- Fin lista comentarios denunciados -->
        </section>
      </div>
      <!-- Fin Contenido tab moderar comentarios -->
    </div>
    <!-- Fin Contenido tabs -->
  </div>
  <!-- Fin Main -->

  <!-- Modal editar usuario -->
  <div class="modal fade" id="modal-editar" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content bg-dark">
        <div class="modal-header border-0">
          <h5 class="modal-title text-warning">Editar usuario</h5>
          <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">
            <i class="bi bi-x-lg fw-bold"></i>
          </button>
        </div>
        <form method="post" action="/index.php?c=administrador&m=editar_usuario">
          <div class="modal-body bg-secondary">
            <input type="hidden" name="id" id="id">
            <div class="container d-flex flex-column align-items-center mb-3 p-0">
              <div class="col-10 mb-3">
                <label for="nombre" class="form-label text-warning">Nombre</label>
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Introduce un nombre"
                  required>
              </div>
              <div class="col-10 mb-3">
                <label for="username" class="form-label text-warning">Usuario</label>
                <input type="text" class="form-control" name="username" id="username" placeholder="Introduce un usuario"
                  required>
              </div>
              <div class="col-10 mb-3">
                <label for="email" class="form-label text-warning">Correo electrónico</label>
                <input type="email" class="form-control" name="email" id="email"
                  placeholder="Introduce un correo electrónico" required>
              </div>
              <div class="col-10 mb-3">
                <label for="tipo" class="form-label text-warning">Tipo de usuario</label>
                <select class="form-select" id="tipo" name="tipo">
                  <option value="Normal">Normal</option>
                  <option value="Administrador">Administrador</option>
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer border-0">
            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
              Cancelar
            </button>
            <button id="guardar" type="submit" class="btn btn-outline-warning">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Fin Modal editar usuario -->

  <?php
  // Footer
  require_once "templates/footer.php";
  ?>

  <!-- Bootstrap JS -->
  <script src="/js/bootstrap.bundle.min.js"></script>

  <script type="module" src="/js/administrador.js"></script>
</body>

</html>