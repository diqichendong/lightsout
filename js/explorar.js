let pagina = 1;

// Pagina activa en el menu
$("#menu a").eq(1).addClass("active");

// Filtro
$("select").change(function (e) {
  if ($(this).attr("id") == "tipo") {
    $("#genero option[value='none']").attr("selected", "true");
  }
  $("#filtro").submit();
});

// Cargar más
$("#cargar-mas").click(function (e) {
  let tipo = $("#tipo option:selected").attr("value");
  let genero = $("#genero option:selected").attr("value");
  let year = $("#year option:selected").attr("value");
  let orden = $("#orden option:selected").attr("value");
  pagina++;

  $.post(
    "/index.php?c=explorar&m=cargar_mas",
    { tipo: tipo, genero: genero, year: year, orden: orden, pagina: pagina },
    function (res) {
      let response = JSON.parse(res);
      console.log(response);
      response["results"].forEach((ficha) => {
        let titulo = ficha.hasOwnProperty("title") ? ficha.title : ficha.name;
        let poster =
          ficha.poster_path.length > 0
            ? "http://image.tmdb.org/t/p/original" + ficha.poster_path
            : "/assets/img/default-poster.png";
        $("#resultados").append(
          `
          <div class="container col-6 col-sm-4 col-md-3 col-lg-2 d-flex flex-column mb-3 justify-content-between"
          title="${titulo}">
          <a href="/ficha/${tipo}/${ficha.id}" class="flex-fill">
            <img
              src="${poster}"
              alt="${titulo}"
              class="container p-0 rounded border border-warning h-100" />
          </a>
          <a href="/ficha/${tipo}/${ficha.id}"
            class="text-truncate link-warning text-decoration-none text-center">
            ${titulo}
          </a>
        </div>
          `
        );
      });
    }
  );
});
