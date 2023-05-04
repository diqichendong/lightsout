let pagina = 1;

// Pagina activa en el menu
$("#menu a").eq(1).addClass("active");

// Filtro
$("select").change(function (e) {
  if ($(this).attr("id") == "tipo") {
    $("#genero option[value='none']").attr("selected", "true");
    console.log($("#genero"));
  }
  $("#filtro").submit();
});
