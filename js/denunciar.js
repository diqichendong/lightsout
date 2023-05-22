// Denunciar post
$(document).on("click", ".btn-denunciar-post", function (e) {
  let id_post = $(this).data("id");
  if (confirm("¿Estás seguro que quieres denunciar este post?")) {
    $.post("/index.php?c=post&m=denunciar", { id: id_post }, function (res) {
      alert("Denuncia realizada.");
    });
  }
});

// Denunciar comentario
$(document).on("click", ".btn-denunciar-comentario", function (e) {
  let id_comentario = $(this).data("id");
  if (confirm("¿Estás seguro que quieres denunciar este comentario?")) {
    $.post(
      "/index.php?c=comentario&m=denunciar",
      { id: id_comentario },
      function (res) {
        alert("Denuncia realizada.");
      }
    );
  }
});
