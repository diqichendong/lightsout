const menu = document.getElementById("menu");
const crear_post_ficha = document.getElementById("crear-post-ficha");

// Pagina activa en el menu
menu.getElementsByTagName("a")[0].classList.add("active");

// Buscador en la ventana modal de peliculas y series
crear_post_ficha.addEventListener("keyup", (e) => {
  let q = e.target.value;
  $.post("ajax/buscar_ficha.php", { query: q }, function (res) {
    const response = JSON.parse(res);
    console.log(response);
    $("option").each(function (i) {
      if (q == $(this).val()) {
        $("#crear-post-poster").attr(
          "src",
          "http://image.tmdb.org/t/p/original" + $(this).data("poster")
        );
      } else if (q == "") {
        $("#crear-post-poster").attr("src", "assets/img/default-poster.png");
      }
    });
    $("#datalistFichas").html("");
    response.results.forEach((elem) => {
      if (elem.media_type == "movie") {
        let fecha = elem.release_date;
        let titulo = elem.title + " (" + fecha.split("-")[0] + ")";
        $("#datalistFichas").append(
          "<option data-id='" +
            elem.id +
            "' data-poster='" +
            elem.poster_path +
            "' value='" +
            titulo +
            "' ></option>"
        );
      }
      if (elem.media_type == "tv") {
        let fecha = elem.first_air_date;
        let titulo = elem.name + " (" + fecha.split("-")[0] + ")";
        $("#datalistFichas").append(
          "<option data-id='" +
            elem.id +
            "' data-poster='" +
            elem.poster_path +
            "' value='" +
            titulo +
            "' ></option>"
        );
      }
    });
  });
});
