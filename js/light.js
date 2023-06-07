export default function () {
  // Contador de lights
  $(".contador-lights").each((i, e) => {
    let id_post = $(e).data("id");
    $.post(
      "/index.php?c=light&m=contador_lights",
      { id: id_post },
      function (res) {
        $(e).html(res);
      }
    );
  });

  // Estado inicial light
  $(".light-checkbox").each((i, e) => {
    let id_post = $(e).attr("id").split("-")[1];
    let id_usuario = $(e).data("idusuario");
    $.post(
      "/index.php?c=light&m=usuario_light",
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
  $(".light-checkbox")
    .off("change")
    .change(function (e) {
      let id_post = $(this).attr("id").split("-")[1];
      let id_usuario = $(this).data("idusuario");
      let light = $("label[for='" + $(this).attr("id") + "'] i");
      let classList = light.attr("class").split(" ");
      if (classList.includes("bi-lightbulb")) {
        classList[1] = "bi-lightbulb-fill";
        $.post(
          "/index.php?c=light&m=dar_light",
          {
            id_post: id_post,
            id_usuario: id_usuario,
          },
          function (res) {
            let contador = $(
              ".contador-lights[data-id='" + id_post + "'"
            ).html();
            $(".contador-lights[data-id='" + id_post + "'").html(
              parseInt(contador) + 1
            );
          }
        );
      } else {
        classList[1] = "bi-lightbulb";
        $.post(
          "/index.php?c=light&m=quitar_light",
          {
            id_post: id_post,
            id_usuario: id_usuario,
          },
          function (res) {
            let contador = $(
              ".contador-lights[data-id='" + id_post + "'"
            ).html();
            $(".contador-lights[data-id='" + id_post + "'").html(
              parseInt(contador) - 1
            );
          }
        );
      }
      light.attr("class", classList.join(" "));
    });
}
