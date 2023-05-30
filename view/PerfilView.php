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
            <a class="nav-link link-warning <?= $_SESSION["tab"] == "posts" ? "active" : "" ?>" data-bs-toggle="pill"
              href="#tab-posts">
              Posts
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link link-warning <?= $_SESSION["tab"] == "series" ? "active" : "" ?>" data-bs-toggle="pill"
              href="#tab-series">
              Series
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link link-warning <?= $_SESSION["tab"] == "peliculas" ? "active" : "" ?>"
              data-bs-toggle="pill" href="#tab-peliculas">
              Películas
            </a>
          </li>
        </ul>
        <!-- Fin Pills -->

        <!-- Contenido tabs -->
        <div class="tab-content">
          <!-- Contenido tab posts -->
          <div class="tab-pane fade <?= $_SESSION["tab"] == "posts" ? "show active" : "" ?>" id="tab-posts">
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
                      <a href="/ficha/<?= $post["ficha_tipo"] ?>/<?= $post["id_ficha"] ?>">
                        <img src="http://image.tmdb.org/t/p/original<?= $post["imagen"] ?>" alt="poster"
                          class="container p-0 rounded border border-warning" />
                      </a>
                    </div>
                    <!-- Fin Poster -->
                    <!-- Post body -->
                    <div class="col-9 col-md-10 d-flex flex-wrap">
                      <!-- Título -->
                      <a href="/ficha/<?= $post["ficha_tipo"] ?>/<?= $post["id_ficha"] ?>"
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
                          data-bs-target="#modal-comentarios" data-id="<?= $post[0] ?>" title="Comentarios">
                          <i class="bi bi-chat" data-id="<?= $post[0] ?>"></i>
                        </button>
                        <span class="contador-comentarios" data-id="<?= $post[0] ?>"></span>
                      </div>
                      <!-- Fin Comentarios -->
                      <!-- Lights -->
                      <div class="col-3 py-2 d-flex align-items-center justify-content-center gap-2">
                        <input type="checkbox" id="light-<?= $post[0] ?>" class="light-checkbox"
                          data-idusuario="<?= $_SESSION["usuario"]->id ?>">
                        <label class="text-warning px-1" for="light-<?= $post[0] ?>" title="Lights">
                          <i></i>
                        </label>
                        <span class="contador-lights" data-id="<?= $post[0] ?>"></span>
                      </div>
                      <!-- Fin Lights -->
                      <!-- Denunciar -->
                      <div class="col-3 py-2 d-flex align-items-center justify-content-center gap-2">
                        <?php if ($post["id_usuario"] != $_SESSION["usuario"]->id) { ?>
                          <button class="btn btn-link link-danger btn-denunciar-post px-1" data-id="<?= $post[0] ?>"
                            title="Denunciar">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                          </button>
                        <?php } ?>
                      </div>
                      <!-- Fin Denunciar -->
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
            <!-- Botón cargar más -->
            <div class="container py-2 justify-content-center">
              <button class="btn btn-outline-warning" id="btn-cargar-mas">
                Cargar más
              </button>
            </div>
            <!-- Fin Botón cargar más -->
          </div>
          <!-- Fin Contenido tab posts -->

          <!-- Contenido tab series -->
          <div class="tab-pane fade <?= $_SESSION["tab"] == "series" ? "show active" : "" ?>" id="tab-series">
            <!-- Series seguidas -->
            <section class="container-fluid bg-secondary rounded d-flex flex-column p-3 mb-3" id="siguiendo">
              <h3 class="text-warning mb-3">Siguiendo</h3>
              <?php if (sizeof($_SESSION["series_seguidas"]) == 0) { ?>
                <div class="container bg-secondary rounded p-3">
                  <p class="lead text-warning text-center py-5">No estás siguiendo ninguna serie.</p>
                </div>
              <?php } ?>

              <div class="row row-cols-2 row-cols-sm-3 row-cols-lg-6">
                <?php foreach ($_SESSION["series_seguidas"] as $serie) { ?>
                  <div class="container-fluid col d-flex flex-column mb-3 justify-content-between"
                    title="<?= $serie["titulo"] ?>">
                    <a href="/ficha/tv/<?= $serie["id_ficha"] ?>" class="flex-fill">
                      <img
                        src="<?= $serie["imagen"] == null ? "/assets/img/default-poster.png" : API_IMG_BASE . $serie["imagen"] ?>"
                        alt="<?= $serie["titulo"] ?>" class="container p-0 rounded border border-warning h-100" />
                    </a>
                    <a href="/ficha/tv/<?= $serie["id_ficha"] ?>"
                      class="text-truncate link-warning text-decoration-none text-center">
                      <?= $serie["titulo"] ?>
                    </a>
                  </div>
                <?php } ?>
              </div>
              <?php if (isset($_SESSION["ver_mas_series_seguidas"])) { ?>
                <div class="collapse row row-cols-2 row-cols-sm-3 row-cols-lg-6" id="ver-mas-series_seguidas">
                  <?php foreach ($_SESSION["ver_mas_series_seguidas"] as $serie) { ?>
                    <div class="container-fluid col d-flex flex-column mb-3 justify-content-between"
                      title="<?= $serie["titulo"] ?>">
                      <a href="/ficha/tv/<?= $serie["id_ficha"] ?>" class="flex-fill">
                        <img
                          src="<?= $serie["imagen"] == null ? "/assets/img/default-poster.png" : API_IMG_BASE . $serie["imagen"] ?>"
                          alt="<?= $serie["titulo"] ?>" class="container p-0 rounded border border-warning h-100" />
                      </a>
                      <a href="/ficha/tv/<?= $serie["id_ficha"] ?>"
                        class="text-truncate link-warning text-decoration-none text-center">
                        <?= $serie["titulo"] ?>
                      </a>
                    </div>
                  <?php } ?>
                </div>
                <div class="container d-flex justify-content-center">
                  <a class="btn btn-outline-warning" data-bs-toggle="collapse" href="#ver-mas-series_seguidas">
                    Ver más
                  </a>
                </div>
              <?php } ?>
            </section>
            <!-- Fin Series seguidas -->
            <!-- Series pendientes -->
            <section class="container-fluid bg-secondary rounded d-flex flex-column p-3 mb-3" id="series-pendientes">
              <h3 class="text-warning mb-3">Pendientes</h3>
              <?php if (sizeof($_SESSION["series_pendientes"]) == 0) { ?>
                <div class="container bg-secondary rounded p-3">
                  <p class="lead text-warning text-center py-5">No tienes ninguna serie pendiente de ver.</p>
                </div>
              <?php } ?>

              <div class="row row-cols-2 row-cols-sm-3 row-cols-lg-6">
                <?php foreach ($_SESSION["series_pendientes"] as $serie) { ?>
                  <div class="container-fluid col d-flex flex-column mb-3 justify-content-between"
                    title="<?= $serie["titulo"] ?>">
                    <a href="/ficha/tv/<?= $serie["id_ficha"] ?>" class="flex-fill">
                      <img
                        src="<?= $serie["imagen"] == null ? "/assets/img/default-poster.png" : API_IMG_BASE . $serie["imagen"] ?>"
                        alt="<?= $serie["titulo"] ?>" class="container p-0 rounded border border-warning h-100" />
                    </a>
                    <a href="/ficha/tv/<?= $serie["id_ficha"] ?>"
                      class="text-truncate link-warning text-decoration-none text-center">
                      <?= $serie["titulo"] ?>
                    </a>
                  </div>
                <?php } ?>
              </div>
              <?php if (isset($_SESSION["ver_mas_series_pendientes"])) { ?>
                <div class="collapse row row-cols-2 row-cols-sm-3 row-cols-lg-6" id="ver-mas-series_pendientes">
                  <?php foreach ($_SESSION["ver_mas_series_pendientes"] as $serie) { ?>
                    <div class="container-fluid col d-flex flex-column mb-3 justify-content-between"
                      title="<?= $serie["titulo"] ?>">
                      <a href="/ficha/tv/<?= $serie["id_ficha"] ?>" class="flex-fill">
                        <img
                          src="<?= $serie["imagen"] == null ? "/assets/img/default-poster.png" : API_IMG_BASE . $serie["imagen"] ?>"
                          alt="<?= $serie["titulo"] ?>" class="container p-0 rounded border border-warning h-100" />
                      </a>
                      <a href="/ficha/tv/<?= $serie["id_ficha"] ?>"
                        class="text-truncate link-warning text-decoration-none text-center">
                        <?= $serie["titulo"] ?>
                      </a>
                    </div>
                  <?php } ?>
                </div>
                <div class="container d-flex justify-content-center">
                  <a class="btn btn-outline-warning" data-bs-toggle="collapse" href="#ver-mas-series_pendientes">
                    Ver más
                  </a>
                </div>
              <?php } ?>
            </section>
            <!-- Fin Series pendientes -->
            <!-- Series vistas -->
            <section class="container-fluid bg-secondary rounded d-flex flex-column p-3 mb-3">
              <h3 class="text-warning mb-3">Vistas</h3>
              <?php if (sizeof($_SESSION["series_vistas"]) == 0) { ?>
                <div class="container bg-secondary rounded p-3">
                  <p class="lead text-warning text-center py-5">No tienes ninguna serie vista.</p>
                </div>
              <?php } ?>

              <div class="row row-cols-2 row-cols-sm-3 row-cols-lg-6">
                <?php foreach ($_SESSION["series_vistas"] as $serie) { ?>
                  <div class="container-fluid col d-flex flex-column mb-3 justify-content-between"
                    title="<?= $serie["titulo"] ?>">
                    <a href="/ficha/tv/<?= $serie["id_ficha"] ?>" class="flex-fill">
                      <img
                        src="<?= $serie["imagen"] == null ? "/assets/img/default-poster.png" : API_IMG_BASE . $serie["imagen"] ?>"
                        alt="<?= $serie["titulo"] ?>" class="container p-0 rounded border border-warning h-100" />
                    </a>
                    <a href="/ficha/tv/<?= $serie["id_ficha"] ?>"
                      class="text-truncate link-warning text-decoration-none text-center">
                      <?= $serie["titulo"] ?>
                    </a>
                  </div>
                <?php } ?>
              </div>
              <?php if (isset($_SESSION["ver_mas_series_vistas"])) { ?>
                <div class="collapse row row-cols-2 row-cols-sm-3 row-cols-lg-6" id="ver-mas-series_vistas">
                  <?php foreach ($_SESSION["ver_mas_series_vistas"] as $serie) { ?>
                    <div class="container-fluid col d-flex flex-column mb-3 justify-content-between"
                      title="<?= $serie["titulo"] ?>">
                      <a href="/ficha/tv/<?= $serie["id_ficha"] ?>" class="flex-fill">
                        <img
                          src="<?= $serie["imagen"] == null ? "/assets/img/default-poster.png" : API_IMG_BASE . $serie["imagen"] ?>"
                          alt="<?= $serie["titulo"] ?>" class="container p-0 rounded border border-warning h-100" />
                      </a>
                      <a href="/ficha/tv/<?= $serie["id_ficha"] ?>"
                        class="text-truncate link-warning text-decoration-none text-center">
                        <?= $serie["titulo"] ?>
                      </a>
                    </div>
                  <?php } ?>
                </div>
                <div class="container d-flex justify-content-center">
                  <a class="btn btn-outline-warning" data-bs-toggle="collapse" href="#ver-mas-series_vistas">
                    Ver más
                  </a>
                </div>
              <?php } ?>
            </section>
            <!-- Fin Series vistas -->
            <!-- Series favoritas -->
            <section class="container-fluid bg-secondary rounded d-flex flex-column p-3" id="series-favoritas">
              <h3 class="text-warning mb-3">Favoritas</h3>
              <?php if (sizeof($_SESSION["series_favoritas"]) == 0) { ?>
                <div class="container bg-secondary rounded p-3">
                  <p class="lead text-warning text-center py-5">No tienes ninguna serie favorita.</p>
                </div>
              <?php } ?>

              <div class="row row-cols-2 row-cols-sm-3 row-cols-lg-6">
                <?php foreach ($_SESSION["series_favoritas"] as $serie) { ?>
                  <div class="container-fluid col d-flex flex-column mb-3 justify-content-between"
                    title="<?= $serie["titulo"] ?>">
                    <a href="/ficha/tv/<?= $serie["id_ficha"] ?>" class="flex-fill">
                      <img
                        src="<?= $serie["imagen"] == null ? "/assets/img/default-poster.png" : API_IMG_BASE . $serie["imagen"] ?>"
                        alt="<?= $serie["titulo"] ?>" class="container p-0 rounded border border-warning h-100" />
                    </a>
                    <a href="/ficha/tv/<?= $serie["id_ficha"] ?>"
                      class="text-truncate link-warning text-decoration-none text-center">
                      <?= $serie["titulo"] ?>
                    </a>
                  </div>
                <?php } ?>
              </div>
              <?php if (isset($_SESSION["ver_mas_series_favoritas"])) { ?>
                <div class="collapse row row-cols-2 row-cols-sm-3 row-cols-lg-6" id="ver-mas-series_favoritas">
                  <?php foreach ($_SESSION["ver_mas_series_favoritas"] as $serie) { ?>
                    <div class="container-fluid col d-flex flex-column mb-3 justify-content-between"
                      title="<?= $serie["titulo"] ?>">
                      <a href="/ficha/tv/<?= $serie["id_ficha"] ?>" class="flex-fill">
                        <img
                          src="<?= $serie["imagen"] == null ? "/assets/img/default-poster.png" : API_IMG_BASE . $serie["imagen"] ?>"
                          alt="<?= $serie["titulo"] ?>" class="container p-0 rounded border border-warning h-100" />
                      </a>
                      <a href="/ficha/tv/<?= $serie["id_ficha"] ?>"
                        class="text-truncate link-warning text-decoration-none text-center">
                        <?= $serie["titulo"] ?>
                      </a>
                    </div>
                  <?php } ?>
                </div>
                <div class="container d-flex justify-content-center">
                  <a class="btn btn-outline-warning" data-bs-toggle="collapse" href="#ver-mas-series_favoritas">
                    Ver más
                  </a>
                </div>
              <?php } ?>
            </section>
            <!-- Fin Series favoritas -->
          </div>
          <!-- Fin Contenido tab series -->

          <!-- Contenido tab películas -->
          <div class="tab-pane fade <?= $_SESSION["tab"] == "peliculas" ? "show active" : "" ?>" id="tab-peliculas">
            <!-- Películas pendientes -->
            <section class="container-fluid bg-secondary rounded d-flex flex-column p-3 mb-3" id="peliculas-pendientes">
              <h3 class="text-warning mb-3">Pendientes</h3>
              <?php if (sizeof($_SESSION["peliculas_pendientes"]) == 0) { ?>
                <div class="container bg-secondary rounded p-3">
                  <p class="lead text-warning text-center py-5">No tienes ninguna película pendiente de ver.</p>
                </div>
              <?php } ?>

              <div class="row row-cols-2 row-cols-sm-3 row-cols-lg-6">
                <?php foreach ($_SESSION["peliculas_pendientes"] as $pelicula) { ?>
                  <div class="container-fluid col d-flex flex-column mb-3 justify-content-between"
                    title="<?= $pelicula["titulo"] ?>">
                    <a href="/ficha/movie/<?= $pelicula["id_ficha"] ?>" class="flex-fill">
                      <img
                        src="<?= $pelicula["imagen"] == null ? "/assets/img/default-poster.png" : API_IMG_BASE . $pelicula["imagen"] ?>"
                        alt="<?= $pelicula["titulo"] ?>" class="container p-0 rounded border border-warning h-100" />
                    </a>
                    <a href="/ficha/movie/<?= $pelicula["id_ficha"] ?>"
                      class="text-truncate link-warning text-decoration-none text-center">
                      <?= $pelicula["titulo"] ?>
                    </a>
                  </div>
                <?php } ?>
              </div>
              <?php if (isset($_SESSION["ver_mas_peliculas_pendientes"])) { ?>
                <div class="collapse row row-cols-2 row-cols-sm-3 row-cols-lg-6" id="ver-mas-peliculas-pendientes">
                  <?php foreach ($_SESSION["ver_mas_peliculas_pendientes"] as $pelicula) { ?>
                    <div class="container-fluid col d-flex flex-column mb-3 justify-content-between"
                      title="<?= $pelicula["titulo"] ?>">
                      <a href="/ficha/movie/<?= $pelicula["id_ficha"] ?>" class="flex-fill">
                        <img
                          src="<?= $pelicula["imagen"] == null ? "/assets/img/default-poster.png" : API_IMG_BASE . $pelicula["imagen"] ?>"
                          alt="<?= $pelicula["titulo"] ?>" class="container p-0 rounded border border-warning h-100" />
                      </a>
                      <a href="/ficha/movie/<?= $pelicula["id_ficha"] ?>"
                        class="text-truncate link-warning text-decoration-none text-center">
                        <?= $pelicula["titulo"] ?>
                      </a>
                    </div>
                  <?php } ?>
                </div>
                <div class="container d-flex justify-content-center">
                  <a class="btn btn-outline-warning" data-bs-toggle="collapse" href="#ver-mas-peliculas-pendientes">
                    Ver más
                  </a>
                </div>
              <?php } ?>
            </section>
            <!-- Fin Películas pendientes -->
            <!-- Películas vistas -->
            <section class="container-fluid bg-secondary rounded d-flex flex-column p-3 mb-3">
              <h3 class="text-warning mb-3">Vistas</h3>
              <?php if (sizeof($_SESSION["peliculas_vistas"]) == 0) { ?>
                <div class="container bg-secondary rounded p-3">
                  <p class="lead text-warning text-center py-5">No tienes ninguna película vista.</p>
                </div>
              <?php } ?>

              <div class="row row-cols-2 row-cols-sm-3 row-cols-lg-6">
                <?php foreach ($_SESSION["peliculas_vistas"] as $pelicula) { ?>
                  <div class="container-fluid col d-flex flex-column mb-3 justify-content-between"
                    title="<?= $pelicula["titulo"] ?>">
                    <a href="/ficha/movie/<?= $pelicula["id_ficha"] ?>" class="flex-fill">
                      <img
                        src="<?= $pelicula["imagen"] == null ? "/assets/img/default-poster.png" : API_IMG_BASE . $pelicula["imagen"] ?>"
                        alt="<?= $pelicula["titulo"] ?>" class="container p-0 rounded border border-warning h-100" />
                    </a>
                    <a href="/ficha/movie/<?= $pelicula["id_ficha"] ?>"
                      class="text-truncate link-warning text-decoration-none text-center">
                      <?= $pelicula["titulo"] ?>
                    </a>
                  </div>
                <?php } ?>
              </div>
              <?php if (isset($_SESSION["ver_mas_peliculas_vistas"])) { ?>
                <div class="collapse row row-cols-2 row-cols-sm-3 row-cols-lg-6" id="ver-mas-peliculas-vistas">
                  <?php foreach ($_SESSION["ver_mas_peliculas_vistas"] as $pelicula) { ?>
                    <div class="container-fluid col d-flex flex-column mb-3 justify-content-between"
                      title="<?= $pelicula["titulo"] ?>">
                      <a href="/ficha/movie/<?= $pelicula["id_ficha"] ?>" class="flex-fill">
                        <img
                          src="<?= $pelicula["imagen"] == null ? "/assets/img/default-poster.png" : API_IMG_BASE . $pelicula["imagen"] ?>"
                          alt="<?= $pelicula["titulo"] ?>" class="container p-0 rounded border border-warning h-100" />
                      </a>
                      <a href="/ficha/movie/<?= $pelicula["id_ficha"] ?>"
                        class="text-truncate link-warning text-decoration-none text-center">
                        <?= $pelicula["titulo"] ?>
                      </a>
                    </div>
                  <?php } ?>
                </div>
                <div class="container d-flex justify-content-center">
                  <a class="btn btn-outline-warning" data-bs-toggle="collapse" href="#ver-mas-peliculas-vistas">
                    Ver más
                  </a>
                </div>
              <?php } ?>
            </section>
            <!-- Fin Películas vistas -->
            <!-- Películas favoritas -->
            <section class="container-fluid bg-secondary rounded d-flex flex-column p-3">
              <h3 class="text-warning mb-3">Favoritas</h3>
              <?php if (sizeof($_SESSION["peliculas_favoritas"]) == 0) { ?>
                <div class="container bg-secondary rounded p-3">
                  <p class="lead text-warning text-center py-5">No tienes ninguna película favorita.</p>
                </div>
              <?php } ?>

              <div class="row row-cols-2 row-cols-sm-3 row-cols-lg-6">
                <?php foreach ($_SESSION["peliculas_favoritas"] as $pelicula) { ?>
                  <div class="container-fluid col d-flex flex-column mb-3 justify-content-between"
                    title="<?= $pelicula["titulo"] ?>">
                    <a href="/ficha/movie/<?= $pelicula["id_ficha"] ?>" class="flex-fill">
                      <img
                        src="<?= $pelicula["imagen"] == null ? "/assets/img/default-poster.png" : API_IMG_BASE . $pelicula["imagen"] ?>"
                        alt="<?= $pelicula["titulo"] ?>" class="container p-0 rounded border border-warning h-100" />
                    </a>
                    <a href="/ficha/movie/<?= $pelicula["id_ficha"] ?>"
                      class="text-truncate link-warning text-decoration-none text-center">
                      <?= $pelicula["titulo"] ?>
                    </a>
                  </div>
                <?php } ?>
              </div>
              <?php if (isset($_SESSION["ver_mas_peliculas_favoritas"])) { ?>
                <div class="collapse row row-cols-2 row-cols-sm-3 row-cols-lg-6" id="ver-mas-peliculas-favoritas">
                  <?php foreach ($_SESSION["ver_mas_peliculas_favoritas"] as $pelicula) { ?>
                    <div class="container-fluid col d-flex flex-column mb-3 justify-content-between"
                      title="<?= $pelicula["titulo"] ?>">
                      <a href="/ficha/movie/<?= $pelicula["id_ficha"] ?>" class="flex-fill">
                        <img
                          src="<?= $pelicula["imagen"] == null ? "/assets/img/default-poster.png" : API_IMG_BASE . $pelicula["imagen"] ?>"
                          alt="<?= $pelicula["titulo"] ?>" class="container p-0 rounded border border-warning h-100" />
                      </a>
                      <a href="/ficha/movie/<?= $pelicula["id_ficha"] ?>"
                        class="text-truncate link-warning text-decoration-none text-center">
                        <?= $pelicula["titulo"] ?>
                      </a>
                    </div>
                  <?php } ?>
                </div>
                <div class="container d-flex justify-content-center">
                  <a class="btn btn-outline-warning" data-bs-toggle="collapse" href="#ver-mas-peliculas-favoritas">
                    Ver más
                  </a>
                </div>
              <?php } ?>
            </section>
            <!-- Fin Películas favoritas -->
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
  <script src="/js/denunciar.js"></script>

  <script>
    <?php if ($_SESSION["perfil"]->id == $_SESSION["usuario"]->id) { ?>
      // Pagina activa en el menu
      $("#menu a").eq(3).addClass("active");
    <?php } ?>

    var id_usuario_actual = <?= $_SESSION["usuario"]->id ?>;
    var hay_posts_buffer = <?= $_SESSION["hay_posts_buffer"] ? "true" : "false" ?>;
    var id_perfil = <?= $_SESSION["perfil"]->id ?>;
  </script>
</body>

</html>