<!DOCTYPE html>
<?php

$ficha = $_SESSION["ficha"];
$tipo = $_SESSION["tipo"];
$year = $tipo == "tv" ? explode("-", $ficha["first_air_date"])[0] : explode("-", $ficha["release_date"])[0];
$paises = $_SESSION["paises"];
$generos = [];
foreach ($ficha["genres"] as $genero) {
  array_push($generos, $genero["name"]);
}
$nota_usuario = sizeof($_SESSION["nota_usuario"]) > 0 ? $_SESSION["nota_usuario"][0][0] : null;
$seguimiento = sizeof($_SESSION["seguimiento"]) > 0 ? $_SESSION["seguimiento"][0][0] : null;

?>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>
    <?= $tipo == "tv" ? $ficha["name"] . " [TV]" : $ficha["title"] ?>
  </title>
  <link rel="shortcut icon" href="/assets/img/favicon.ico" type="image/x-icon" />
  <link rel="stylesheet" href="/css/bootstrap.min.css" />
  <link rel="stylesheet" href="/css/style.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css" />
  <script src="/js/jquery-3.6.4.min.js"></script>
  <style>
    #ficha-header {
      background-image: url("<?= API_IMG_BASE . $ficha["backdrop_path"] ?>");
    }
  </style>
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
    <!-- Ficha header -->
    <div class="container-fluid" id="ficha-header">
      <!-- Nota -->
      <div class="container-fluid d-flex justify-content-end">
        <div class="col-5 col-md-3 col-lg-2 d-flex flex-column align-items-center p-2">
          <h1 class="bg-dark text-warning p-1 rounded border border-warning" id="nota-media">
            <?= $_SESSION["nota_media"] == null ? "-" : formato_nota_media($_SESSION["nota_media"]) ?>
          </h1>
          <div class="form-floating col-12">
            <select class="form-select" id="nota" data-id="<?= $ficha["id"] ?>" data-tipo="<?= $tipo ?>">
              <option value=" 0" <?= $nota_usuario == null ? "selected" : "" ?>>¡Puntúa!</option>
              <option value="1" <?= $nota_usuario == 1 ? "selected" : "" ?>>💀 1</option>
              <option value="2" <?= $nota_usuario == 2 ? "selected" : "" ?>>🤮 2</option>
              <option value="3" <?= $nota_usuario == 3 ? "selected" : "" ?>>🤢 3</option>
              <option value="4" <?= $nota_usuario == 4 ? "selected" : "" ?>>😴 4</option>
              <option value="5" <?= $nota_usuario == 5 ? "selected" : "" ?>>🙁 5</option>
              <option value="6" <?= $nota_usuario == 6 ? "selected" : "" ?>>😐 6</option>
              <option value="7" <?= $nota_usuario == 7 ? "selected" : "" ?>>🙂 7</option>
              <option value="8" <?= $nota_usuario == 8 ? "selected" : "" ?>>😀 8</option>
              <option value="9" <?= $nota_usuario == 9 ? "selected" : "" ?>>😊 9</option>
              <option value="10" <?= $nota_usuario == 10 ? "selected" : "" ?>>😍 10</option>
            </select>
            <label for="floatingSelect">Tu calificación</label>
          </div>
        </div>
      </div>
      <!-- Fin Nota -->
      <!-- Ficha info -->
      <div class="container d-flex flex-wrap bg-dark my-2 mt-5 p-2 border rounded-top border-warning border-bottom-0">
        <!-- Poster -->
        <div class="col-3 col-sm-2">
          <img src="<?= API_IMG_BASE . $ficha["poster_path"] ?>" alt="poster"
            class="container p-0 rounded border border-warning" />
        </div>
        <!-- Fin Poster -->
        <!-- Info -->
        <div class="container-fluid col-9 col-sm-10">
          <!-- Info header -->
          <div class="container-fluid d-flex flex-column p-0">
            <div class="align-self-end col-sm-4 col-lg-3">
              <select class="form-select form-select-sm h-min" id="seguimiento" data-id="<?= $ficha["id"] ?>"
                data-tipo="<?= $tipo ?>">
                <option value="0" <?= $seguimiento == null ? "selected" : "" ?>>-- Estado --</option>
                <?php if ($tipo == "tv") { ?>
                  <option value="Siguiendo" <?= $seguimiento == "Siguiendo" ? "selected" : "" ?>>🏃‍♂️ Siguiendo</option>
                <?php } ?>
                <option value="Pendiente" <?= $seguimiento == "Pendiente" ? "selected" : "" ?>>🕒 Pendiente</option>
                <option value="Vista" <?= $seguimiento == "Vista" ? "selected" : "" ?>>👁️ Vista</option>
                <option value="Favorita" <?= $seguimiento == "Favorita" ? "selected" : "" ?>>❤️ Favorita</option>
              </select>
            </div>
            <p class="text-warning h3 col-12">
              <?= $tipo == "tv" ? $ficha["name"] . " [TV]" : $ficha["title"] ?>
            </p>
          </div>
          <!-- Fin Info header -->
          <!-- Info body -->
          <div class="container-fluid d-flex flex-column text-light p-0">
            <div class="col-12 mb-3 d-flex flex-wrap">
              <div class="col-3 col-lg-2 d-flex flex-column">
                <span class="text-warning">Año</span>
                <span class="small">
                  <?= $year ?>
                </span>
              </div>
              <div class="col-4 col-lg-2 d-flex flex-column">
                <span class="text-warning">
                  <?= $tipo == "tv" ? "Temporadas" : "Duración" ?>
                </span>
                <span class="small">
                  <?= $tipo == "tv" ? $ficha["number_of_seasons"] : $ficha["runtime"] . " minutos" ?>
                </span>
              </div>
              <div class="col-5 col-lg-2 d-flex flex-column">
                <span class="text-warning">
                  <?= $tipo == "tv" ? "Capítulos" : "Director" ?>
                </span>
                <span class="small">
                  <?= $tipo == "tv" ? $ficha["number_of_episodes"] : $_SESSION["director"] ?>
                </span>
              </div>
              <div class="col-4 col-lg-3 d-flex flex-column">
                <span class="text-warning">País</span>
                <span class="small">
                  <?= isset($ficha["production_countries"][0]) ? $paises[$ficha["production_countries"][0]["iso_3166_1"]] : "" ?>
                </span>
              </div>
              <div class="col-8 col-lg-3 d-flex flex-column">
                <span class="text-warning">Género</span>
                <span class="small">
                  <?= implode(", ", $generos) ?>
                </span>
              </div>
            </div>
            <div class="d-md-flex flex-wrap collapse" id="collapse">
              <div class="col-12 d-flex flex-column mb-3">
                <span class="text-warning">Reparto</span>
                <span id="reparto" class="small">
                  <?= implode(", ", $_SESSION["reparto"]) ?>
                </span>
              </div>
              <div class="col-12 d-flex flex-column">
                <span class="text-warning">Sinopsis</span>
                <p class="small">
                  <?= $ficha["overview"] ?>
                </p>
              </div>
            </div>
          </div>
          <!-- Fin Info body -->
        </div>
        <!-- Fin Info -->
        <!-- Boton ver ficha completa -->
        <div class="d-md-none d-flex justify-content-center col-12 my-1">
          <button class="btn btn-sm btn-outline-warning" id="btn-ficha-completa" data-bs-toggle="collapse"
            data-bs-target="#collapse">Ver ficha completa</button>
        </div>
        <!-- Fin Boton ver ficha completa -->
      </div>
      <!-- Fin Ficha info -->
    </div>
    <!-- Fin Ficha header -->

    <!-- Ficha body -->
    <div class="container col-lg-8">
      <!-- Pills para responsive -->
      <ul class="nav nav-pills nav-fill p-2 mb-3 bg-secondary rounded lead">
        <li class="nav-item">
          <a class="nav-link link-warning active" data-bs-toggle="pill" href="#tab-posts">
            Posts
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link link-warning" data-bs-toggle="pill" href="#tab-trailer">
            Tráiler
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link link-warning" data-bs-toggle="pill" href="#tab-donde-ver">
            ¿Dónde puedo verla?
          </a>
        </li>
      </ul>
      <!-- Fin Pills para responsive -->

      <div class="tab-content">
        <!-- Contenido tab posts -->
        <div class="tab-pane fade show active" id="tab-posts">
          <!-- Posts -->
          <section class="col-12 rounded overflow-hidden d-flex flex-column gap-1 text-light my-2" id="posts">
            <?php if (sizeof($_SESSION["posts_ficha"]) == 0) { ?>
              <div class="container bg-secondary rounded">
                <p class="lead text-warning text-center py-5">Sé el primero en publicar un post de esta ficha</p>
              </div>
              <?php
            } else {
              foreach ($_SESSION["posts_ficha"] as $post) {
                ?>
                <!-- Post -->
                <div class="row p-2 border-2 bg-secondary">
                  <!-- Post body -->
                  <div class="col-12 d-flex flex-wrap">
                    <!-- Fecha -->
                    <span class="col-12 text-white-50 text-end">
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
                    <!-- Comentarios -->
                    <div class="col-2 py-2 d-flex align-items-center justify-content-center gap-2">
                      <button class="btn btn-link link-warning btn-comentario px-1" data-bs-toggle="modal"
                        data-bs-target="#modal-comentarios" title="Comentarios">
                        <i class="bi bi-chat" data-id="<?= $post[0] ?>"></i>
                      </button>
                      <span class="contador-comentarios" data-id="<?= $post[0] ?>"></span>
                    </div>
                    <!-- Fin Comentarios -->
                    <!-- Lights -->
                    <div class="col-2 py-2 d-flex align-items-center justify-content-center gap-2">
                      <input type="checkbox" id="light-<?= $post[0] ?>" class="light-checkbox"
                        data-idusuario="<?= $_SESSION["usuario"]->id ?>">
                      <label class="text-warning px-1" for="light-<?= $post[0] ?>" title="Lights">
                        <i></i>
                      </label>
                      <span class="contador-lights" data-id="<?= $post[0] ?>"></span>
                    </div>
                    <!-- Fin Lights -->
                    <!-- Denunciar -->
                    <div class="col-2 py-2 d-flex align-items-center justify-content-center gap-2">
                      <?php if ($post["id_usuario"] != $_SESSION["usuario"]->id) { ?>
                        <button class="btn btn-link link-danger btn-denunciar-post px-1" data-id="<?= $post[0] ?>"
                          title="Denunciar">
                          <i class="bi bi-exclamation-triangle-fill"></i>
                        </button>
                      <?php } ?>
                    </div>
                    <!-- Fin Denunciar -->
                    <!-- Usuario -->
                    <div class="col-6 d-flex text-warning">
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

        <!-- Contenido tab trailer -->
        <div class="tab-pane fade" id="tab-trailer">
          <section class="col-12 rounded overflow-hidden d-flex flex-column gap-1 text-light my-2">
            <?php if (sizeof($_SESSION["trailers"]) == 0) { ?>
              <div class="container bg-secondary rounded p-3">
                <p class="lead text-warning text-center py-5">No se encuentra disponible ningún tráiler.</p>
              </div>
            <?php } ?>
            <?php foreach ($_SESSION["trailers"] as $trailer) { ?>
              <div class="container-fluid mb-2 bg-secondary rounded p-3">
                <h3 class="text-warning mb-3">
                  <?= $trailer["name"] ?>
                </h3>
                <div class="ratio ratio-16x9">
                  <iframe src="https://www.youtube.com/embed/<?= $trailer["key"] ?>" title="YouTube video"
                    allowfullscreen></iframe>
                </div>
              </div>
            <?php } ?>
          </section>
        </div>
        <!-- Fin Contenido tab trailer -->

        <!-- Contenido tab dónde ver -->
        <div class="tab-pane fade" id="tab-donde-ver">
          <section class="col-12 rounded overflow-hidden d-flex flex-column gap-1 text-light my-2">
            <div class="container-fluid px-0">
              <?php if (sizeof($_SESSION["proveedores"]) == 0) { ?>
                <div class="container mb-5 bg-secondary rounded p-3">
                  <p class="lead text-warning text-center py-5">No se encuentra disponible en este momento.</p>
                </div>
              <?php } ?>
              <?php if (isset($_SESSION["proveedores"]["flatrate"])) { ?>
                <div class="container mb-2 bg-secondary rounded p-3">
                  <h4 class="text-warning mb-3 col-12">Subscripción</h4>
                  <?php foreach ($_SESSION["proveedores"]["flatrate"] as $proveedor) { ?>
                    <div class="container mb-2">
                      <img src="<?= API_IMG_BASE . $proveedor["logo_path"] ?>" alt="proveedor" class="rounded col-1 mx-2">
                      <span>
                        <?= $proveedor["provider_name"] ?>
                      </span>
                    </div>
                  <?php } ?>
                </div>
              <?php } ?>
              <?php if (isset($_SESSION["proveedores"]["rent"])) { ?>
                <div class="container mb-2 bg-secondary rounded p-3">
                  <h4 class="text-warning mb-3">Alquilar</h4>
                  <?php foreach ($_SESSION["proveedores"]["rent"] as $proveedor) { ?>
                    <div class="container mb-2">
                      <img src="<?= API_IMG_BASE . $proveedor["logo_path"] ?>" alt="proveedor" class="rounded col-1 mx-2">
                      <span>
                        <?= $proveedor["provider_name"] ?>
                      </span>
                    </div>
                  <?php } ?>
                </div>
              <?php } ?>
              <?php if (isset($_SESSION["proveedores"]["buy"])) { ?>
                <div class="container bg-secondary rounded p-3">
                  <h4 class="text-warning mb-3">Comprar</h4>
                  <?php foreach ($_SESSION["proveedores"]["buy"] as $proveedor) { ?>
                    <div class="container mb-2">
                      <img src="<?= API_IMG_BASE . $proveedor["logo_path"] ?>" alt="proveedor" class="rounded col-1 mx-2">
                      <span>
                        <?= $proveedor["provider_name"] ?>
                      </span>
                    </div>
                  <?php } ?>
                </div>
              <?php } ?>
            </div>
          </section>
        </div>
        <!-- Fin Contenido tab dónde ver -->
      </div>
    </div>
    <!-- Fin Main -->

    <!-- Crear post -->
    <div class="position-sticky bottom-0 float-end p-3 w-auto pe-none">
      <button class="btn btn-warning btn-lg pe-auto float-end" id="crear-post" data-bs-toggle="modal"
        data-bs-target="#modal-crear-post">
        <i class="bi bi-pencil-square"></i>
      </button>
    </div>
    <!-- Fin Crear post -->
  </div>
  <!-- Fin Ficha body -->

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
        <form method="post" action="/index.php?c=ficha&m=crear_post">
          <div class="modal-body bg-secondary d-flex flex-wrap">
            <h3 class="fw-bold text-warning col-12 px-2 mb-3">
              <?= $tipo == "tv" ? $ficha["name"] . " [TV]" : $ficha["title"] ?>
            </h3>
            <div class="container mb-3 p-0 col-3 d-flex align-items-center">
              <div class="col-12 px-3">
                <img src="<?= API_IMG_BASE . $ficha["poster_path"] ?>" alt="poster" id="crear-post-poster"
                  class="container p-0 rounded border border-warning" />
              </div>
            </div>
            <div class="mb-3 col-9 px-3 d-flex flex-column justify-content-center">
              <label for="contenido-crear-post" class="col-form-label text-warning">
                Contenido:
              </label>
              <textarea class="form-control" id="contenido-crear-post" name="contenido" rows="5"
                placeholder="Cuéntame algo..." required></textarea>
              <input type="hidden" name="id-ficha" value="<?= $ficha["id"] ?>">
              <input type="hidden" name="poster" value="<?= $ficha["poster_path"] ?>">
              <input type="hidden" name="tipo" value="<?= $tipo ?>">
              <input type="hidden" name="titulo" value="<?= $tipo == "tv" ? $ficha["name"] : $ficha["title"] ?>">
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
  // Modal Comentarios
  require_once "templates/comentarios.php";

  // Footer
  require_once "templates/footer.php";
  ?>

  <!-- Bootstrap JS -->
  <script src="/js/bootstrap.bundle.min.js"></script>

  <script type="module" src="/js/ficha.js"></script>
  <script type="module" src="/js/comentario.js"></script>
  <script src="/js/light.js"></script>
  <script src="/js/denunciar.js"></script>

  <script>
    var id_usuario_actual = <?= $_SESSION["usuario"]->id ?>;
    var hay_posts_buffer = <?= $_SESSION["hay_posts_buffer"] ? "true" : "false" ?>;
    var ficha_tipo = "<?= $_SESSION["tipo"] ?>";
    var ficha_id = <?= $_SESSION["id"] ?>;
  </script>
</body>

</html>