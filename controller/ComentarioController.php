<?php

require_once "model/Comentario.php";
require_once "model/Denuncia.php";

session_start();

class ComentarioController
{

  function __construct()
  {

  }

  /**
   * Obtener los comentarios (AJAX)
   */
  function obtener_comentarios()
  {
    if (isset($_POST["id"])) {
      $id_post = intval($_POST["id"]);
      echo json_encode(Comentario::get_comentarios($id_post));
    }
  }

  /**
   * Poner un comentario en un post
   */
  function comentar()
  {
    if (isset($_POST["id_post"]) && isset($_POST["id_usuario"]) && isset($_POST["comentario"])) {
      $id_post = $_POST["id_post"];
      $id_usuario = $_POST["id_usuario"];
      $comentario = htmlspecialchars($_POST["comentario"]);
      Comentario::add_comentario($comentario, intval($id_post), intval($id_usuario));
    }
  }

  /**
   * Obtener el comentario que acabo de publicar
   */
  function comentario_publicado()
  {
    if (isset($_POST["id_post"]) && isset($_POST["id_usuario"]) && isset($_POST["comentario"])) {
      $id_post = $_POST["id_post"];
      $id_usuario = $_POST["id_usuario"];
      $comentario = htmlspecialchars($_POST["comentario"]);
      echo json_encode(Comentario::get_comentario_publicado($comentario, intval($id_post), intval($id_usuario)));
    }
  }

  /**
   * Obtener el número de comentarios de un post
   */
  function contador_comentarios()
  {
    if (isset($_POST["id_post"])) {
      $id_post = $_POST["id_post"];
      echo Comentario::get_contador_comentarios($id_post)[0][0];
    }
  }

  /**
   * Denunciar comentario
   */
  function denunciar()
  {
    if (isset($_POST["id"])) {
      $id_comentario = $_POST["id"];
      echo Denuncia::denunciar_comentario($id_comentario);
    }
  }

}

?>