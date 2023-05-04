<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>
    Explorar
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
  <div class="flex-fill">
    <!-- Filtro -->
    <form class="container rounded bg-secondary p-3 mb-3 d-flex flex-wrap" method="get" id="filtro" action="/index.php">
      <div class="col-6 col-md-3 px-1 my-1">
        <div class="form-floating">
          <select class="form-select" id="tipo" name="tipo">
            <option value="movie" <?= $_SESSION["tipo"] == "movie" ? "selected" : "" ?>>Películas</option>
            <option value="tv" <?= $_SESSION["tipo"] == "tv" ? "selected" : "" ?>>Series</option>
          </select>
          <label for="tipo">Tipo</label>
        </div>
      </div>
      <div class="col-6 col-md-3 px-1 my-1">
        <div class="form-floating">
          <select class="form-select" id="genero" name="genero">
            <option value="none" <?= $_SESSION["genero"] == "none" ? "selected" : "" ?>>Ninguno</option>
            <?php foreach ($_SESSION["generos"] as $genero) { ?>
              <option value="<?= $genero["id"] ?>" <?= $_SESSION["genero"] == $genero["id"] ? "selected" : "" ?>>
                <?= $genero["name"] ?>
              </option>
            <?php } ?>
          </select>
          <label for="genero">Género</label>
        </div>
      </div>
      <div class="col-6 col-md-3 px-1 my-1">
        <div class="form-floating">
          <select class="form-select" id="year" name="year">
            <option value="none" <?= $_SESSION["year"] == "none" ? "selected" : "" ?>>Ninguno</option>
            <?php for ($year = intval(date("Y")); $year >= 1900; $year--) { ?>
              <option value="<?= $year ?>" <?= intval($_SESSION["year"]) == $year ? "selected" : "" ?>>
                <?= $year ?>
              </option>
            <?php } ?>
          </select>
          <label for="year">Año</label>
        </div>
      </div>
      <div class="col-6 col-md-3 px-1 my-1">
        <div class="form-floating">
          <select class="form-select" id="orden" name="orden">
            <option value="popularity.desc" <?= $_SESSION["orden"] == "popularity.desc" ? "selected" : "" ?>>
              Poularidad
            </option>
            <option value="fecha" <?= $_SESSION["orden"] == "fecha" ? "selected" : "" ?>>
              Fecha
            </option>
          </select>
          <label for="orden">Ordenar por</label>
        </div>
      </div>
      <input type="hidden" name="pagina" value="<?= $_SESSION["pagina"] ?>">
      <input type="hidden" name="c" value="explorar">
    </form>
    <!-- Fin Filtro -->

    <!-- Resultados -->
    <div class="container bg-secondary rounded d-flex flex-wrap p-3" id="resultados">
      <?php foreach ($_SESSION["fichas_explorar"]["results"] as $ficha) { ?>
        <div class="container col-6 col-sm-4 col-md-3 col-lg-2 d-flex flex-column mb-3 justify-content-between"
          title="<?= isset($ficha["title"]) ? $ficha["title"] : $ficha["name"] ?>">
          <a href="/ficha/<?= isset($ficha["title"]) ? "movie" : "tv" ?>/<?= $ficha["id"] ?>" class="flex-fill">
            <img
              src="<?= $ficha["poster_path"] == null ? "/assets/img/default-poster.png" : API_IMG_BASE . $ficha["poster_path"] ?>"
              alt="<?= isset($ficha["title"]) ? $ficha["title"] : $ficha["name"] ?>"
              class="container p-0 rounded border border-warning h-100" />
          </a>
          <a href="/ficha/<?= isset($ficha["title"]) ? "movie" : "tv" ?>/<?= $ficha["id"] ?>"
            class="text-truncate link-warning text-decoration-none text-center">
            <?= isset($ficha["title"]) ? $ficha["title"] : $ficha["name"] ?>
          </a>
        </div>
      <?php } ?>
    </div>
    <!-- Fin Resultados -->
  </div>
  <!-- Fin Main -->

  <?php
  // Modal Comentarios
  require_once "templates/comentarios.php";

  // Footer
  require_once "templates/footer.php";

  // Para desarrollador
  var_dump($_SESSION["genero"]);
  var_dump($_SESSION["tipo"]);
  var_dump($_SESSION["orden"]);
  var_dump($_SESSION["year"]);
  var_dump($_SESSION["hola"]);
  ?>

  <!-- Bootstrap JS -->
  <script src="/js/bootstrap.bundle.min.js"></script>

  <script>
    var total_paginas = <?= $_SESSION["fichas_explorar"]["total_pages"] > 10 ? 10 : intval($_SESSION["fichas_explorar"]["total_pages"]) ?>;
  </script>
  <script src="/js/explorar.js"></script>
</body>

</html>