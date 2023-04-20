<?php

require_once "model/Light.php";

session_start();

class LightController
{

  function __construct()
  {

  }

  /**
   * Obtener el número de lights de un post
   */
  function contador_lights()
  {
    if (isset($_POST["id"])) {
      $id_post = $_POST["id"];
      echo Light::get_contador_lights($id_post)[0][0];
    }
  }

  /**
   * Saber si un usuario ya le ha dado light a un post
   */
  function usuario_light()
  {
    if (isset($_POST["id_usuario"]) && isset($_POST["id_post"])) {
      $id_post = $_POST["id_post"];
      $id_usuario = $_POST["id_usuario"];
      echo Light::usuario_light($id_post, $id_usuario)[0][0];
    }
  }

  /**
   * Dar light a un post
   */
  function dar_light()
  {
    if (isset($_POST["id_post"]) && isset($_POST["id_usuario"])) {
      $id_post = $_POST["id_post"];
      $id_usuario = $_POST["id_usuario"];
      Light::set_light($id_post, $id_usuario);
    }
  }

  /**
   * Quitar light a un post
   */
  function quitar_light()
  {
    if (isset($_POST["id_post"]) && isset($_POST["id_usuario"])) {
      $id_post = $_POST["id_post"];
      $id_usuario = $_POST["id_usuario"];
      Light::remove_light($id_post, $id_usuario);
    }
  }

}

?>