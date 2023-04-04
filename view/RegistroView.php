<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon" />
  <title>Registrarse - LightsOUT</title>
</head>

<body class="bg-dark min-vh-100 d-flex flex-column align-items-center justify-content-center">
  <!-- Registro -->
  <div class="container p-5">
    <div class="row justify-content-center">
      <img src="assets/img/logo.png" class="col-8 col-lg-4 img-fluid" alt="Logo" />
    </div>
    <div class="row d-flex justify-content-center">
      <div class="card col-10 col-lg-6 bg-secondary m-3">
        <div class="card-body">
          <h4 class="card-title text-center text-warning mb-3">Registro</h4>
          <form action="index.php?c=registro&m=registrar" method="post" id="formulario_registro"
            class="d-flex flex-wrap justify-content-center my-3">
            <div class="form-floating mb-3 col-12">
              <input type="text" class="form-control" name="login" id="login" placeholder="login" />
              <label for="login" class="form-label">Usuario</label>
            </div>
            <div class="form-floating mb-3 col-12">
              <input type="text" class="form-control" name="email" id="email" placeholder="email" />
              <label for="email" class="form-label">Correo electrónico</label>
            </div>
            <div class="form-floating mb-3 col-12">
              <input type="password" class="form-control" name="pwd" id="pwd" placeholder="pwd" />
              <label for="pwd" class="form-label">Contraseña</label>
            </div>
            <div class="form-floating mb-3 col-12">
              <input type="password" class="form-control" name="pwd-conf" id="pwd-conf" placeholder="pwd-conf" />
              <label for="pwd-conf" class="form-label">Confirmar contraseña</label>
            </div>
            <div class="form-floating mb-3 col-12">
              <input type="text" class="form-control" name="nombre" id="nombre" placeholder="nombre" />
              <label for="pwd" class="form-label">Nombre</label>
            </div>
            <div class="form-check col-12 mb-3">
              <input class="form-check-input" type="checkbox" name="tcp" id="tcp" />
              <label class="form-check-label text-light" for="recordar">
                Acepto los
                <a href="" class="link-warning">términos y condiciones de uso</a>
                y la
                <a href="" class="link-warning">política de privacidad</a>.
              </label>
            </div>
            <button type="submit" id="enviar" class="btn btn-warning">Registrarse</button>
          </form>
          <p class="text-center text-light">
            ¿Ya tienes una cuenta?
            <a href="index.php?c=login&m=index" class="link-warning">Iniciar sesión</a>
          </p>
        </div>
      </div>
    </div>
  </div>
  <!-- Fin Registro -->

  <?php
  // Importar el footer
  require_once "templates/footer.php";
  ?>


  <script src="js/registro.js"></script>
  <script src="js/bootstrap.bundle.min.js"></script>
</body>

</html>