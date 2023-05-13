import * as v from "./validar.js";

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
