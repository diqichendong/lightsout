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
   * Denunciar post (AJAX)
   */
  function denunciar()
  {
    if (isset($_POST["id"])) {
      $id_post = $_POST["id"];
      Denuncia::denunciar_post($id_post);
    }
  }

  /**
   * Permitir post denunciado (AJAX)
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
   * Borrar post denunciado (AJAX)
   */
  function borrar()
  {
    if (isset($_POST["id"])) {
      $id_post = $_POST["id"];
      Denuncia::eliminar_post($id_post);
      $_SESSION["mensaje"] = "Post eliminado correctamente.";
    }
  }

  /**
   * Obtener el posts buffer de inicio (AJAX)
   */
  function posts_buffer_inicio()
  {
    if (isset($_POST["id"])) {
      $id_usuario = $_POST["id"];
      echo json_encode(Post::getPostsBufferInicio($id_usuario));
    }
  }

  /**
   * Obtener el posts buffer de ficha (AJAX)
   */
  function posts_buffer_ficha()
  {
    if (isset($_POST["id"]) && isset($_POST["tipo"])) {
      $id_ficha = $_POST["id"];
      $tipo_ficha = $_POST["tipo"];
      echo json_encode(Post::getPostsBufferFicha($tipo_ficha, $id_ficha));
    }
  }

  /**
   * Obtener el posts buffer de perfil (AJAX)
   */
  function posts_buffer_perfil()
  {
    if (isset($_POST["id"])) {
      $id_perfil = $_POST["id"];
      echo json_encode(Post::getPostsBufferPerfil($id_perfil));
    }
  }

}

?>