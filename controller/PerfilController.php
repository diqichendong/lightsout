<?php

require_once "model/Usuario.php";
require_once "model/Post.php";
require_once "model/Seguimiento.php";

session_start();

class PerfilController
{

  function __construct()
  {

  }

  function index()
  {
    if (isset($_SESSION["usuario"])) {
      if (isset($_GET["id"]) && isset($_GET["tab"])) {
        // Datos del perfil
        $id_perfil = $_GET["id"];
        $_SESSION["tab"] = $_GET["tab"];
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

        // Posts del  usuario
        $_SESSION["posts_perfil"] = Post::get_post_perfil($id_perfil);

        // Listas de las peliculas
        $_SESSION["peliculas_pendientes"] = Seguimiento::peliculas_pendientes($id_perfil);
        unset($_SESSION["ver_mas_peliculas_pendientes"]);
        if (sizeof($_SESSION["peliculas_pendientes"]) > 6) {
          $_SESSION["ver_mas_peliculas_pendientes"] = array_slice($_SESSION["peliculas_pendientes"], 6);
          $_SESSION["peliculas_pendientes"] = array_slice($_SESSION["peliculas_pendientes"], 0, 6);
        }
        $_SESSION["peliculas_vistas"] = Seguimiento::peliculas_vistas($id_perfil);
        unset($_SESSION["ver_mas_peliculas_vistas"]);
        if (sizeof($_SESSION["peliculas_vistas"]) > 6) {
          $_SESSION["ver_mas_peliculas_vistas"] = array_slice($_SESSION["peliculas_vistas"], 6);
          $_SESSION["peliculas_vistas"] = array_slice($_SESSION["peliculas_vistas"], 0, 6);
        }
        $_SESSION["peliculas_favoritas"] = Seguimiento::peliculas_favoritas($id_perfil);
        unset($_SESSION["ver_mas_peliculas_favoritas"]);
        if (sizeof($_SESSION["peliculas_favoritas"]) > 6) {
          $_SESSION["ver_mas_peliculas_favoritas"] = array_slice($_SESSION["peliculas_favoritas"], 6);
          $_SESSION["peliculas_favoritas"] = array_slice($_SESSION["peliculas_favoritas"], 0, 6);
        }

        // Listas de las series
        $_SESSION["series_pendientes"] = Seguimiento::series_pendientes($id_perfil);
        unset($_SESSION["ver_mas_series_pendientes"]);
        if (sizeof($_SESSION["series_pendientes"]) > 6) {
          $_SESSION["ver_mas_series_pendientes"] = array_slice($_SESSION["series_pendientes"], 6);
          $_SESSION["series_pendientes"] = array_slice($_SESSION["series_pendientes"], 0, 6);
        }
        $_SESSION["series_vistas"] = Seguimiento::series_vistas($id_perfil);
        unset($_SESSION["ver_mas_series_vistas"]);
        if (sizeof($_SESSION["series_vistas"]) > 6) {
          $_SESSION["ver_mas_series_vistas"] = array_slice($_SESSION["series_vistas"], 6);
          $_SESSION["series_vistas"] = array_slice($_SESSION["series_vistas"], 0, 6);
        }
        $_SESSION["series_favoritas"] = Seguimiento::series_favoritas($id_perfil);
        unset($_SESSION["ver_mas_series_favoritas"]);
        if (sizeof($_SESSION["series_favoritas"]) > 6) {
          $_SESSION["ver_mas_series_favoritas"] = array_slice($_SESSION["series_favoritas"], 6);
          $_SESSION["series_favoritas"] = array_slice($_SESSION["series_favoritas"], 0, 6);
        }
        $_SESSION["series_seguidas"] = Seguimiento::series_seguidas($id_perfil);
        unset($_SESSION["ver_mas_series_seguidas"]);
        if (sizeof($_SESSION["series_seguidas"]) > 6) {
          $_SESSION["ver_mas_series_seguidas"] = array_slice($_SESSION["series_seguidas"], 6);
          $_SESSION["series_seguidas"] = array_slice($_SESSION["series_seguidas"], 0, 6);
        }
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