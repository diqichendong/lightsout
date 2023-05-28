<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>LightsOUT</title>
  <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="css/bootstrap.min.css" />
  <link rel="stylesheet" href="css/style.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
  <script src="js/jquery-3.6.4.min.js"></script>
</head>

<body class="bg-dark d-flex flex-column justify-content-between min-vh-100">

  <!-- CABECERA -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-secondary fixed-top border-bottom border-dark border-2 h-10">
    <div class="container-fluid d-flex justify-content-center">
      <a class="navbar-brand" href="">
        <img src="img/logo.png" alt="logo" width="100px" />
      </a>
    </div>
  </nav>
  <!-- Fin CABECERA -->

  <!-- MAIN CONTENT -->
  <div class="flex-fill d-flex flex-column">
    <div class="flex-fill" id="presentacion-fondo"></div>
    <div class="d-flex flex-column justify-content-center flex-fill align-items-center" id="presentacion">
      <div class="container d-flex flex-wrap gap-3 justify-content-center">
        <h1 class="text-warning">LightsOUT</h1>
        <p class="text-light lead">
          ¡Bienvenido a nuestra red social de películas y series! Sumérgete en
          un universo lleno de historias fascinantes, conecta con amantes del
          cine y descubre nuevas joyas audiovisuales. Explora nuestra amplia
          biblioteca, comparte tus opiniones y participa en debates
          apasionantes. Únete a nuestra comunidad y vive una experiencia
          cinematográfica única. ¡La pantalla te espera!
        </p>
        <a href="/login" class="btn btn btn-warning">Entrar</a>
      </div>
    </div>
  </div>
  <!-- Final MAIN CONTENT -->

  <?php
  //Importar footer
  require_once "templates/footer.php";

  ?>

  <!-- Bootstrap JS -->
  <script src="js/bootstrap.bundle.min.js"></script>

</body>

</html>