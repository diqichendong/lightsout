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

  <!-- Mensaje de usuario editado -->
  <?php if (isset($_SESSION["editar_usuario_ok"])) { ?>
    <div class="container alert alert-success alert-dismissible fade show" role="alert">
      <span>
        <?= $_SESSION["editar_usuario_ok"] ?>
      </span>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION["editar_usuario_ok"]);
  } ?>
  </div>

  <!-- Mensaje de usuario eliminado -->
  <?php if (isset($_SESSION["eliminar_usuario_ok"])) { ?>
    <div class="container alert alert-success alert-dismissible fade show" role="alert">
      <span>
        <?= $_SESSION["eliminar_usuario_ok"] ?>
      </span>
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    <?php unset($_SESSION["eliminar_usuario_ok"]);
  } ?>
  </div>

  <!-- Main -->
  <div class="container flex-fill">
    <!-- Pills -->
    <ul class="nav nav-pills nav-fill p-2 mb-3 bg-secondary rounded lead">
      <li class="nav-item">
        <a class="nav-link link-warning active" data-bs-toggle="pill" href="#tab-usuarios">
          Gestión de usuarios
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link link-warning" data-bs-toggle="pill" href="#tab-posts">
          Moderar posts
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link link-warning" data-bs-toggle="pill" href="#tab-comentarios">
          Moderar comentarios
        </a>
      </li>
    </ul>
    <!-- Fin Pills -->

    <!-- Contenido tabs -->
    <div class="tab-content">
      <!-- Contenido tab gestión usuarios -->
      <div class="tab-pane fade show active" id="tab-usuarios">
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
        <form method="post" action="index.php?c=administrador&m=editar_usuario">
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