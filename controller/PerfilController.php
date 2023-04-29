<?php

require_once "model/Usuario.php";
require_once "model/Post.php";

session_start();

class PerfilController
{

  function __construct()
  {

  }

  function index()
  {
    if (isset($_SESSION["usuario"])) {
      if (isset($_GET["id"])) {
        $id_perfil = $_GET["id"];
        if ($id_perfil == $_SESSION["usuario"]->id) {
          $_SESSION["perfil"] = $_SESSION["usuario"];
        } else {
          $perfil = new Usuario();
          $usuario = $_SESSION["usuario"];
          if (!$perfil->obtener_usuario($id_perfil)) {
            header("Location: /inicio");
          }
          $_SESSION["perfil"] = $perfil;
          if ($usuario->siguiendo($perfil->id)) {
            $_SESSION["siguiendo"] = true;
          } else {
            $_SESSION["siguiendo"] = false;
          }
        }
        $_SESSION["posts_perfil"] = Post::get_post_perfil($id_perfil);
      } else {
        header("Location: /inicio");
      }
      require_once "view/PerfilView.php";
    } else {
      header("Location: /login");
    }
  }

  /**
   * Seguir a un usuario
   */
  function seguir()
  {
    if (isset($_POST["id"])) {
      $id_otro_usuario = $_POST["id"];
      $_SESSION["usuario"]->seguir($id_otro_usuario);
    }

    header("Location: /perfil/$id_otro_usuario");
  }

  /**
   * Dejar de seguir a un usuario
   */
  function dejar_seguir()
  {
    if (isset($_POST["id"])) {
      $id_otro_usuario = $_POST["id"];
      $_SESSION["usuario"]->dejar_seguir($id_otro_usuario);
    }

    header("Location: /perfil/$id_otro_usuario");
  }

}

?>