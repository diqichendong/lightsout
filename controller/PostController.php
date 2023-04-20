<?php

require_once "model/Post.php";

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

}

?>