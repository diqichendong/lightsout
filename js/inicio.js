import * as v from "./validar.js";
import * as f from "./funciones.js";

// Pagina activa en el menu
$("#menu a").eq(0).addClass("active");

// Buscador en la ventana modal de peliculas y series
$("#crear-post-buscador").keyup((e) => {
  let q = e.target.value;
  $.post(
    "index.php?c=busqueda&m=buscar_ficha_crear_post",
    { query: q },
    function (res) {
      const response = JSON.parse(res);

      $("#crear-post-fichas").html(
        "<option value=0>-- Elige una ficha --</option>"
      );
      $("#crear-post-poster").attr("src", "assets/img/default-poster.png");
      response.results.forEach((elem) => {
        if (elem.media_type == "movie") {
          let fecha = elem.release_date;
          let titulo = elem.title + " (" + fecha.split("-")[0] + ")";
          $("#crear-post-fichas").append(
            "<option value='" +
              elem.id +
              "' data-poster='" +
              elem.poster_path +
              "' data-titulo='" +
              elem.title +
              "' data-tipo='" +
              elem.media_type +
              "'>" +
              titulo +
              "</option>"
          );
        }
        if (elem.media_type == "tv") {
          let fecha = elem.first_air_date;
          let titulo = elem.name + " [TV] (" + fecha.split("-")[0] + ")";
          $("#crear-post-fichas").append(
            "<option value='" +
              elem.id +
              "' data-poster='" +
              elem.poster_path +
              "' data-titulo='" +
              elem.name +
              "' data-tipo='" +
              elem.media_type +
              "'>" +
              titulo +
              "</option>"
          );
        }
      });
    }
  );
});

// Cambios cuando seleccionamos una ficha
$("#crear-post-fichas").change(function () {
  let poster = $(this).find(":selected").data("poster");
  let titulo = $(this).find(":selected").data("titulo");
  let tipo = $(this).find(":selected").data("tipo");
  $("#crear-post-buscador").val("");
  $("#titulo").val(titulo);
  $("#poster").val(poster);
  $("#tipo").val(tipo);
  if (poster != undefined) {
    $("#crear-post-poster").attr(
      "src",
      "http://image.tmdb.org/t/p/original" + poster
    );
  } else {
    $("#crear-post-poster").attr("src", "assets/img/default-poster.png");
  }
});

// Validar contenido de un nuevo post
$("#post").click(function (e) {
  if (!v.validarContenido($("#contenido").val())) {
    e.preventDefault();
  }
});

// Buffer de posts
let posts_buffer;
if (hay_posts_buffer) {
  $("#btn-cargar-mas").parent().css("display", "flex");
  $.post(
    "/index.php?c=post&m=posts_buffer_inicio",
    { id: id_usuario_actual },
    function (res) {
      posts_buffer = JSON.parse(res);
    }
  );
} else {
  $("#btn-cargar-mas").parent().css("display", "none");
}

// Botón cargar más
$("#btn-cargar-mas").on("click", function (e) {
  let contador = 0;
  for (let i = 0; i < posts_buffer.length; i++) {
    const post = posts_buffer[i];

    $("#posts").append(
      `
      <!-- Post -->
      <div class="row p-2 border-2 bg-secondary">
        <!-- Poster -->
        <div class="col-3 col-md-2" title="${post["titulo"]}">
          <a href="ficha/${post["ficha_tipo"]}/${post["id_ficha"]}">
            <img src="http://image.tmdb.org/t/p/original${
              post["imagen"]
            }" alt="poster"
              class="container p-0 rounded border border-warning" />
          </a>
        </div>
        <!-- Fin Poster -->
        <!-- Post body -->
        <div class="col-9 col-md-10 d-flex flex-wrap">
          <!-- Título -->
          <a href="ficha/${post["ficha_tipo"]}/${post["id_ficha"]}"
            class="text-decoration-none col-8 col-md-9 col-lg-10">
            <h3 class="text-warning">
              ${post["titulo"]}
              ${post["ficha_tipo"] == "tv" ? "[TV]" : ""}
            </h3>
          </a>
          <!-- Fin Título -->
          <!-- Fecha -->
          <span class="col-4 col-md-3 col-lg-2 text-white-50 text-end">
            <small>
              ${f.obtener_fecha(post["fecha"])}
            </small>
          </span>
          <!-- Fin Fecha -->
          <!-- Texto -->
          <p class="col-12 contenido">
          ${post["contenido"]}
          </p>
          <!-- Fin Texto -->
        </div>
        <!-- Fin Post body -->
        <!-- Post footer -->
        <div class="d-flex">
          <!-- Comentarios -->
          <div class="col-2 py-2 d-flex align-items-center justify-content-center gap-2">
            <button class="btn btn-link link-warning btn-comentario px-1" data-bs-toggle="modal"
              data-bs-target="#modal-comentarios" data-id="${
                post[0]
              }" title="Comentarios">
              <i class="bi bi-chat" data-id="${post[0]}"></i>
            </button>
            <span class="contador-comentarios" data-id="${post[0]}"></span>
          </div>
          <!-- Fin Comentarios -->
          <!-- Lights -->
          <div class="col-2 py-2 d-flex align-items-center justify-content-center gap-2">
            <input type="checkbox" id="light-${post[0]}" class="light-checkbox"
              data-idusuario="${id_usuario_actual}">
            <label class="text-warning px-1" for="light-${
              post[0]
            }" title="Ligths">
              <i></i>
            </label>
            <span class="contador-lights" data-id="${post[0]}"></span>
          </div>
          <!-- Fin Lights -->
          <!-- Denunciar -->
          <div class="col-2 py-2 d-flex align-items-center justify-content-center gap-2">
            ${
              post["id_usuario"] != id_usuario_actual
                ? `
              <button class="btn btn-link link-danger btn-denunciar-post px-1" data-id="${post[0]}"
                title="Denunciar">
                <i class="bi bi-exclamation-triangle-fill"></i>
              </button>
              `
                : ""
            }
          </div>
          <!-- Fin Denunciar -->
          <!-- Usuario -->
          <div class="col-6 d-flex text-warning">
            <div class="col-10 col-lg-11 d-flex flex-column justify-content-center align-items-end px-2">
              <a href="/perfil/${
                post["id_usuario"]
              }/posts" class="text-decoration-none link-warning">
                <span class="lead">
                ${post["nombre"]}
                </span>
              </a>
              <span class="fw-bold">
                <small class="text-end">@
                ${post["username"]}
                </small>
              </span>
            </div>
            <div class="col-2 col-lg-1 d-flex align-items-center" title="${
              post["nombre"]
            }">
              <a href="/perfil/${
                post["id_usuario"]
              }/posts" class="ratio ratio-1x1">
                <img src="assets/perfil/${
                  post["foto"]
                }" alt="user" class="rounded-circle" />
              </a>
            </div>
          </div>
          <!-- Fin usuario -->
        </div>
        <!-- Fin Post footer -->
      </div>
      <!-- Fin Post -->
      `
    );

    contador++;

    if (contador == 5) {
      break;
    }
  }

  if (posts_buffer.length > 5) {
    posts_buffer = posts_buffer.slice(5);
  } else {
    $("#btn-cargar-mas").css("display", "none");
  }

  f.reload_js("js/comentario.js");
  f.reload_js("js/light.js");

  // Contador de comentarios
  $(".contador-comentarios").each((i, e) => {
    let id_post = $(e).data("id");
    $.post(
      "/index.php?c=comentario&m=contador_comentarios",
      { id_post: id_post },
      function (res) {
        $(e).html(res);
      }
    );
  });
});
