import * as v from "/js/validar.js";

// Botón de editar lista de usuarios
$(document).on("click", ".btn-editar", function (e) {
  let id_usuario = $(this).data("id");

  $.post(
    "/index.php?c=administrador&m=obtener_usuario",
    { id: id_usuario },
    function (res) {
      let response = JSON.parse(res);
      $("#id").val(response.id);
      $("#nombre").val(response.nombre);
      $("#username").val(response.username);
      $("#email").val(response.email);
      $("option[value='" + response.tipo + "']").attr("selected", "");
    }
  );
});

// Botón "Guardar" del modal de editar usuario
$("#guardar").click(function (e) {
  const form = document.forms[1];

  let nombre = form.elements["nombre"];
  let username = form.elements["username"];
  let email = form.elements["email"];

  if (
    !v.validarNombre(nombre) ||
    !v.validarLogin(username) ||
    !v.validarEmail(email)
  ) {
    e.preventDefault();
  }
});

// Botón eliminar
$(document).on("click", ".btn-eliminar", function (e) {
  let id_usuario = $(this).data("id");
  let nombre = $(this).data("nombre");
  let username = $(this).data("username");

  if (
    confirm(`¿Seguro que quieres eliminar al usuario ${nombre} (@${username})?`)
  ) {
    $.post(
      "/index.php?c=administrador&m=eliminar_usuario",
      { id: id_usuario, nombre: nombre, username: username },
      function (res) {}
    );
  }
});

// Buscador de usuarios
$("#buscar-usuarios").keyup(function (e) {
  let query = $(this).val();

  $.post(
    "/index.php?c=administrador&m=buscar_usuarios",
    { query: query },
    function (res) {
      let response = JSON.parse(res);
      $("#lista-usuarios").html("");
      response.forEach((e) => {
        $("#lista-usuarios").append(
          `
          <div class="container-fluid d-flex justify-content-between align-items-center bg-secondary p-2"
                title="${e.nombre} (@${e.username})">
                <div class="col-2 col-lg-1">
                  <a href="/perfil/${e.id}/posts" class="ratio ratio-1x1">
                    <img src="/assets/perfil/${
                      e.foto
                    }" alt="foto" class="rounded-circle" />
                  </a>
                </div>
                <div class="col-6 col-lg-5 m-0 px-2 d-flex flex-column flex-fill">
                  <a class="link-warning text-decoration-none text-truncate" href="/perfil/${
                    e.id
                  }/posts">
                  ${e.nombre}
                  </a>
                  <small class="text-truncate">
                    ${"@" + e.username}
                  </small>
                </div>
                <div class="col-auto d-flex justify-content-end gap-2">
                  <button class="btn btn-sm btn-outline-warning btn-editar" data-bs-target="#modal-editar"
                    data-bs-toggle="modal" data-id="${e.id}">
                    Editar
                  </button>
                  <button class="btn btn-sm btn-danger btn-eliminar" data-id="${
                    e.id
                  }"
                    data-nombre="${e.nombre}" data-username="${e.username}">
                    Eliminar
                  </button>
                </div>
              </div>
          `
        );
      });
    }
  );
});

// Permitir post
$(".btn-permitir-post").click(function (e) {
  let id_post = $(this).data("id");
  if (confirm("¿Estás seguro que quieres permitir este post?")) {
    $.post("/index.php?c=post&m=permitir", { id: id_post }, function (res) {
      location.href = "/administrador/moderar_posts";
    });
  }
});

// Borrar post
$(".btn-borrar-post").click(function (e) {
  let id_post = $(this).data("id");
  if (confirm("¿Estás seguro que quieres borrar este post?")) {
    $.post("/index.php?c=post&m=borrar", { id: id_post }, function (res) {
      location.href = "/administrador/moderar_posts";
    });
  }
});

// Permitir comentario
$(".btn-permitir-comentario").click(function (e) {
  let id_comentario = $(this).data("id");
  if (confirm("¿Estás seguro que quieres permitir este comentario?")) {
    $.post(
      "/index.php?c=comentario&m=permitir",
      { id: id_comentario },
      function (res) {
        location.href = "/administrador/moderar_comentarios";
      }
    );
  }
});

// Borrar comentario
$(".btn-borrar-comentario").click(function (e) {
  let id_comentario = $(this).data("id");
  if (confirm("¿Estás seguro que quieres borrar este comentario?")) {
    $.post(
      "/index.php?c=comentario&m=borrar",
      { id: id_comentario },
      function (res) {
        location.href = "/administrador/moderar_comentarios";
      }
    );
  }
});
