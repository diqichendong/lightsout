import * as v from "/js/validar.js";
import * as f from "/js/funciones.js";

// Botón de Ver ficha completa / Cerrar ficha completa
$("#btn-ficha-completa").click(function (e) {
  if ($(this).html() == "Ver ficha completa") {
    $(this).html("Cerrar ficha completa");
  } else {
    $(this).html("Ver ficha completa");
  }
});

// Puntuación
$("#nota").change(function (e) {
  let nota = $(this).find(":selected").attr("value");
  let id_ficha = $(this).data("id");
  let tipo = $(this).data("tipo");
  $.post(
    "/index.php?c=nota&m=manejar_nota",
    { nota: nota, id_ficha: id_ficha, tipo: tipo },
    function (res) {
      location.reload();
    }
  );
});

// Seguimiento
$("#seguimiento").change(function (e) {
  let estado = $(this).find(":selected").attr("value");
  let id_ficha = $(this).data("id");
  let tipo = $(this).data("tipo");
  $.post(
    "/index.php?c=seguimiento&m=manejar_seguimiento",
    { estado: estado, id_ficha: id_ficha, tipo: tipo },
    function (res) {
      location.reload();
    }
  );
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
    "/index.php?c=post&m=posts_buffer_ficha",
    { tipo: ficha_tipo, id: ficha_id },
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
        <!-- Post body -->
        <div class="col-12 d-flex flex-wrap">
          <!-- Fecha -->
          <span class="col-12 text-white-50 text-end">
            <small>
            ${f.obtener_fecha(post["fecha"])}
            </small>
          </span>
          <!-- Fin Fecha -->
          <!-- Texto -->
          <p class="col-12 p-2">
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
            }" title="Lights">
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
            <div class="col-2 col-lg-1 d-flex align-items-center">
              <a href="/perfil/${
                post["id_usuario"]
              }/posts" class="ratio ratio-1x1">
                <img src="/assets/perfil/${
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

  f.reload_js("/js/comentario.js");
  f.reload_js("/js/light.js");
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
