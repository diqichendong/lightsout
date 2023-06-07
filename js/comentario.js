import * as v from "./validar.js";
import * as f from "./funciones.js";

export default function () {
  // Añadir evento de click en el icono de comentarios
  $(".btn-comentario")
    .off("click")
    .on("click", function (event) {
      let post_id = $(event.target).data("id");
      $("#id-post").attr("value", post_id);
      $.post(
        "/index.php?c=post&m=obtener_post",
        { id: post_id },
        function (res) {
          let response = JSON.parse(res);
          $("#post-original-titulo").html(
            response[0]["titulo"] + (response[0][7] == "tv" ? " [TV]" : "")
          );
          $("#post-original-usuario").html(
            `
      <a href="/perfil/${response[0]["id_usuario"]}/posts" class="text-decoration-none link-warning">
        ${response[0]["nombre"]}
      </a>
      `
          );
          $("#post-original-contenido").html(response[0]["contenido"]);
          $("#post-original-poster").attr(
            "src",
            "http://image.tmdb.org/t/p/original" + response[0]["imagen"]
          );
          $("#post-original-fecha").text(f.obtener_fecha(response[0]["fecha"]));
        }
      );

      $.post(
        "/index.php?c=comentario&m=obtener_comentarios",
        { id: post_id },
        function (res) {
          let response = JSON.parse(res);
          if (response.length == 0) {
            $("#comentarios-post").html(
              "<p class='text-warning display-5 text-center py-2'>No hay comentarios</p>"
            );
          } else {
            $("#comentarios-post").html("");
            response.forEach((c) => {
              $("#comentarios-post").append(
                `
            <div class='container-fluid d-flex flex-wrap border-top border-warning py-3'>
              <h6 class='col-11 text-warning'>
                <a href="/perfil/${
                  c["id_usuario"]
                }" class="link-warning text-decoration-none">
                  ${c["nombre"]}
                </a>
                <small class='text-white-50'>@${c["username"]}</small>
              </h6>
              <div class='col-1'>
                ${
                  id_usuario_actual != c["id_usuario"]
                    ? `
                <button class="btn btn-link link-danger btn-denunciar-comentario px-1" data-id="${c[0]}" title="Denunciar">
                  <i class="bi bi-exclamation-triangle-fill"></i>
                </button>
                `
                    : ""
                }
              </div>
              <p class='col-12 text-light'>
                ${c["contenido"]}
              </p>
              <span class='col-12 text-white-50'>
                ${f.obtener_fecha(c["fecha"])}
              </span>
            </div>
            `
              );
            });
          }
        }
      );
    });

  // Envío del comentario
  $("#btn-comentar")
    .off("click")
    .on("click", function (e) {
      e.preventDefault();

      //Validar comentario
      if (v.validarComentario($("#comentario").val())) {
        if ($("#comentarios-post").html().trim().startsWith("<p")) {
          $("#comentarios-post").html("");
        }
        //Guardar comentario en la base de datos
        $.post(
          "/index.php?c=comentario&m=comentar",
          {
            comentario: $("#comentario").val(),
            id_post: $("#id-post").attr("value"),
            id_usuario: $("#id-usuario").attr("value"),
          },
          function (res) {
            let contador = $(
              ".contador-comentarios[data-id='" +
                $("#id-post").attr("value") +
                "']"
            ).html();
            contador = parseInt(contador) + 1;
            $(
              ".contador-comentarios[data-id='" +
                $("#id-post").attr("value") +
                "']"
            ).html(contador);

            // Hacer visible el comentario publicado
            $.post(
              "/index.php?c=comentario&m=comentario_publicado",
              {
                id_usuario: $("#id-usuario").attr("value"),
              },
              function (res) {
                let response = JSON.parse(res);
                $("#comentarios-post").prepend(
                  `
                <div class='container-fluid d-flex flex-wrap border-top border-warning py-3'>
                  <h6 class='col-11 text-warning'>
                    <a href="/perfil/${
                      response["id_usuario"]
                    }" class="link-warning text-decoration-none">
                      ${response["nombre"]}
                    </a>
                    <small class='text-white-50'>@${
                      response["username"]
                    }</small>
                  </h6>
                  <div class='col-1'>
                    ${
                      id_usuario_actual != response["id_usuario"]
                        ? `
                    <button class="btn btn-link link-danger btn-denunciar-comentario px-1" data-id="${c[0]}" title="Denunciar">
                      <i class="bi bi-exclamation-triangle-fill"></i>
                    </button>
                    `
                        : ""
                    }
                  </div>
                  <p class='col-12 text-light'>
                    ${response["contenido"]}
                  </p>
                  <span class='col-12 text-white-50'>
                    ${f.obtener_fecha(response["fecha"])}
                  </span>
                </div>
                `
                );
              }
            );
          }
        );
      }

      $("#comentario").val("");
    });

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
}
