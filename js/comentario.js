import * as v from "./validar.js";
import * as f from "./funciones.js";

// Función del icono de comentarios de un post
function comentarios(event) {
  let post_id = $(event.target).data("id");
  $("#id-post").attr("value", post_id);
  $.post("/index.php?c=post&m=obtener_post", { id: post_id }, function (res) {
    let response = JSON.parse(res);
    $("#post-original-titulo").text(
      response[0]["titulo"] + (response[0][7] == "tv" ? " [TV]" : "")
    );
    $("#post-original-usuario").text(response[0]["nombre"]);
    $("#post-original-contenido").text(response[0]["contenido"]);
    $("#post-original-poster").attr(
      "src",
      "http://image.tmdb.org/t/p/original" + response[0]["imagen"]
    );
    $("#post-original-fecha").text(f.obtener_fecha(response[0]["fecha"]));
  });

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
            "<div class='border-top border-warning py-3'>" +
              "<h6 class='text-warning'>" +
              c["nombre"] +
              " <span class='text-white-50'>@" +
              c["username"] +
              "</span>" +
              "</h6>" +
              "<p class='text-light'>" +
              c["contenido"] +
              "</p>" +
              "<span class='text-white-50'>" +
              f.obtener_fecha(c["fecha"]) +
              "</span>" +
              "</div>"
          );
        });
      }
    }
  );
}

// Añadir evento de click en el icono de comentarios
$(".btn-comentario").click(comentarios);

// Envío del comentario
$("#btn-comentar").click(function (e) {
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
          ".contador-comentarios[data-id='" + $("#id-post").attr("value") + "']"
        ).html();
        contador = parseInt(contador) + 1;
        $(
          ".contador-comentarios[data-id='" + $("#id-post").attr("value") + "']"
        ).html(contador);
      }
    );
    // Hacer visible el comentario publicado
    $.post(
      "/index.php?c=comentario&m=comentario_publicado",
      {
        comentario: $("#comentario").val(),
        id_post: $("#id-post").attr("value"),
        id_usuario: $("#id-usuario").attr("value"),
      },
      function (res) {
        let response = JSON.parse(res);
        console.log(response);
        $("#comentarios-post").prepend(
          "<div class='border-top border-warning py-3'>" +
            "<h6 class='text-warning'>" +
            response[0]["nombre"] +
            " <span class='text-white-50'>@" +
            response[0]["username"] +
            "</span>" +
            "</h6>" +
            "<p class='text-light'>" +
            response[0]["contenido"] +
            "</p>" +
            "<span class='text-white-50'>" +
            f.obtener_fecha(response[0]["fecha"]) +
            "</span>" +
            "</div>"
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
