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

}

?>