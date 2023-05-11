// Cambiar ver más/ver menos
$("a[data-bs-toggle='collapse']").click(function (e) {
  if ($(this).html().trim() == "Ver más") {
    $(this).html("Ver menos");
  } else {
    $(this).html("Ver más");
  }
});
