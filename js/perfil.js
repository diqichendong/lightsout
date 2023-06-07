import * as f from "./funciones.js";
import lights from "./light.js";
import comentarios from "./comentario.js";

// Lights
lights();

// Comentarios
comentarios();

// Cambiar ver más/ver menos
$("a[data-bs-toggle='collapse']").click(function (e) {
  if ($(this).html().trim() == "Ver más") {
    $(this).html("Ver menos");
  } else {
    $(this).html("Ver más");
  }
});

// Buffer de posts
let posts_buffer;
if (hay_posts_buffer) {
  $("#btn-cargar-mas").parent().css("display", "flex");
  $.post(
    "/index.php?c=post&m=posts_buffer_perfil",
    { id: id_perfil },
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
        <div class="col-3 col-md-2">
          <a href="/ficha/${post["ficha_tipo"]}/${post["id_ficha"]}">
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
            class="text-decoration-none col-8">
            <h3 class="text-warning">
              ${post["titulo"]}
              ${post["ficha_tipo"] == "tv" ? "[TV]" : ""}
            </h3>
          </a>
          <!-- Fin Título -->
          <!-- Fecha -->
          <span class="col-4 text-white-50 text-end">
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
          <div class="col-3 py-2 d-flex align-items-center justify-content-center gap-2">
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
          <div class="col-3 py-2 d-flex align-items-center justify-content-center gap-2">
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
          <div class="col-3 py-2 d-flex align-items-center justify-content-center gap-2">
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

  lights();
  comentarios();
});
