<?php

require_once "model/Post.php";
require_once "model/Denuncia.php";

session_start();

class PostController
{

  function __construct()
  {

  }

  /**
   * Obtener post (AJAX)
   */
  function obtener_post()
  {
    $id_post = intval($_POST["id"]);
    echo json_encode(Post::getPost($id_post));
  }

  /**
   * Denunciar post
   */
  function denunciar()
  {
    if (isset($_POST["id"])) {
      $id_post = $_POST["id"];
      Denuncia::denunciar_post($id_post);
    }
  }

  /**
   * Permitir post denunciado
   */
  function permitir()
  {
    if (isset($_POST["id"])) {
      $id_post = $_POST["id"];
      Denuncia::eliminar_denuncia_post($id_post);
      $_SESSION["mensaje"] = "Post permitido correctamente.";
    }
  }

  /**
   * Borrar post denunciado
   */
  function borrar()
  {
    if (isset($_POST["id"])) {
      $id_post = $_POST["id"];
      Denuncia::eliminar_post($id_post);
      $_SESSION["mensaje"] = "Post eliminado correctamente.";
    }
  }

}

?>