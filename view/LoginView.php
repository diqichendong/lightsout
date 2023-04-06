<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon" />
  <title>Iniciar sesión - LightsOUT</title>
</head>

<body class="bg-dark min-vh-100 d-flex flex-column justify-content-between align-items-center">

  <div class="container fixed-top p-3">
    <!-- Mensaje de login incorrecto -->
    <?php if (isset($_SESSION["mensaje_error"])) { ?>
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <span>
          <?= $_SESSION["mensaje_error"] ?>
        </span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php unset($_SESSION["mensaje_error"]);
    } ?>

    <!-- Mensaje de usuario creado -->
    <?php if (isset($_SESSION["mensaje_ok"])) { ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        <span>
          <?= $_SESSION["mensaje_ok"] ?>
        </span>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
      <?php unset($_SESSION["mensaje_ok"]);
    } ?>
  </div>

  <!-- Iniciar sesión -->
  <div class="container pt-5">
    <div class="row justify-content-center m-3">
      <img src="assets/img/logo.png" class="col-8 col-lg-4 img-fluid" alt="Logo" />
    </div>
    <div class="row d-flex justify-content-center">
      <div class="card col-10 col-lg-6 bg-secondary m-3">
        <div class="card-body">
          <h4 class="card-title text-center text-warning mb-3">
            Iniciar sesión
          </h4>
          <form action="index.php?c=login&m=login" method="post" class="d-flex flex-wrap justify-content-center my-3">
            <div class="form-floating mb-3 col-12">
              <input type="text" class="form-control" name="login" id="login" placeholder="login" value="<?php if (isset($_COOKIE["login"])) {
                echo $_COOKIE["login"];
              } ?>" />
              <label for="login" class="form-label">Usuario</label>
            </div>
            <div class="form-floating mb-3 col-12">
              <input type="password" class="form-control" name="pwd" id="pwd" placeholder="password"
                value="<?php if (isset($_COOKIE["pwd"])) {
                  echo $_COOKIE["pwd"];
                } ?>" />
              <label for="pwd" class="form-label">Contraseña</label>
            </div>
            <div class="form-check col-12 mb-3">
              <input class="form-check-input" type="checkbox" id="recordar" name="recordar" />
              <label class="form-check-label text-light" for="recordar">
                Recordarme
              </label>
            </div>
            <button type="submit" id="enviar" class="btn btn-warning">
              Iniciar sesión
            </button>
          </form>
          <p class="text-center text-light">
            ¿No tienes una cuenta?
            <a href="index.php?c=registro&m=index" class="link-warning">Regístrate</a>
          </p>
        </div>
      </div>
    </div>
  </div>
  <!-- Fin Iniciar sesión -->

  <?php
  // Importar el footer
  require_once "templates/footer.php";
  ?>

  <script src="js/login.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>