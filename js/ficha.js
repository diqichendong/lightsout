import * as v from "/js/validar.js";

// Botón de Ver ficha completa / Cerrar ficha completa
$("#btn-ficha-completa").click(function (e) {
  if ($(this).html() == "Ver ficha completa") {
    $(this).html("Cerrar ficha completa");
  } else {
    $(this).html("Ver ficha completa");
  }
});

// Puntuación
$("#nota").change(function (e) {
  let nota = $(this).find(":selected").attr("value");
  let id_ficha = $(this).data("id");
  let tipo = $(this).data("tipo");
  $.post(
    "/index.php?c=nota&m=manejar_nota",
    { nota: nota, id_ficha: id_ficha, tipo: tipo },
    function (res) {
      location.reload();
    }
  );
});

// Seguimiento
$("#seguimiento").change(function (e) {
  let estado = $(this).find(":selected").attr("value");
  let id_ficha = $(this).data("id");
  let tipo = $(this).data("tipo");
  $.post(
    "/index.php?c=seguimiento&m=manejar_seguimiento",
    { estado: estado, id_ficha: id_ficha, tipo: tipo },
    function (res) {
      location.reload();
    }
  );
});

// Validar contenido de un nuevo post
$("#post").click(function (e) {
  if (!v.validarContenido($("#contenido").val())) {
    e.preventDefault();
  }
});
