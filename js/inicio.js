import * as v from "./validar.js";
import * as f from "./funciones.js";

// Pagina activa en el menu
$("#menu a").eq(0).addClass("active");

// Buscador en la ventana modal de peliculas y series
$("#crear-post-buscador").keyup((e) => {
  let q = e.target.value;
  $.post("ajax/buscar_ficha.php", { query: q }, function (res) {
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
  });
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

// Función del icono de comentarios de un post
function comentarios(event) {
  let post_id = $(event.target).data("id");
  $("#id-post").attr("value", post_id);
  $.post("index.php?c=post&m=obtener_post", { id: post_id }, function (res) {
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
    "index.php?c=comentario&m=obtener_comentarios",
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
            "<div class='border-top border-warning py-1'>" +
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
      "index.php?c=comentario&m=comentar",
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
      "index.php?c=comentario&m=comentario_publicado",
      {
        comentario: $("#comentario").val(),
        id_post: $("#id-post").attr("value"),
        id_usuario: $("#id-usuario").attr("value"),
      },
      function (res) {
        let response = JSON.parse(res);
        console.log(response);
        $("#comentarios-post").prepend(
          "<div class='border-top border-warning py-1'>" +
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
    "index.php?c=comentario&m=contador_comentarios",
    { id: id_post },
    function (res) {
      $(e).html(res);
    }
  );
});

// Contador de lights
$(".contador-lights").each((i, e) => {
  let id_post = $(e).data("id");
  $.post(
    "index.php?c=light&m=contador_lights",
    { id: id_post },
    function (res) {
      console.log(res);
      $(e).html(res);
    }
  );
});

// Estado inicial light
$(".light-checkbox").each((i, e) => {
  let id_post = $(e).attr("id").split("-")[1];
  let id_usuario = $(e).data("idusuario");
  $.post(
    "index.php?c=light&m=usuario_light",
    { id_post: id_post, id_usuario: id_usuario },
    function (res) {
      if (res == "0") {
        $("label[for='light-" + id_post + "'] i").attr(
          "class",
          "bi bi-lightbulb"
        );
      } else {
        $("label[for='light-" + id_post + "'] i").attr(
          "class",
          "bi bi-lightbulb-fill"
        );
      }
    }
  );
});

// Dar/Quitar Lights (Likes en esta aplicación)
$(".light-checkbox").change(function (e) {
  let id_post = $(this).attr("id").split("-")[1];
  let id_usuario = $(this).data("idusuario");
  let light = $("label[for='" + $(this).attr("id") + "'] i");
  let classList = light.attr("class").split(" ");
  if (classList.includes("bi-lightbulb")) {
    classList[1] = "bi-lightbulb-fill";
    $.post(
      "index.php?c=light&m=dar_light",
      {
        id_post: id_post,
        id_usuario: id_usuario,
      },
      function (res) {
        let contador = $(".contador-lights[data-id='" + id_post + "'").html();
        $(".contador-lights[data-id='" + id_post + "'").html(
          parseInt(contador) + 1
        );
      }
    );
  } else {
    classList[1] = "bi-lightbulb";
    $.post(
      "index.php?c=light&m=quitar_light",
      {
        id_post: id_post,
        id_usuario: id_usuario,
      },
      function (res) {
        let contador = $(".contador-lights[data-id='" + id_post + "'").html();
        $(".contador-lights[data-id='" + id_post + "'").html(
          parseInt(contador) - 1
        );
      }
    );
  }
  light.attr("class", classList.join(" "));
});
