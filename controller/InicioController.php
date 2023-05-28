<?php

require_once "model/Usuario.php";
require_once "model/Ficha.php";
require_once "model/Post.php";
require_once "model/Comentario.php";
require_once "model/Light.php";
require_once "model/Seguimiento.php";

session_start();

class InicioController
{

  function __construct()
  {

  }

  function index()
  {
    //Usuario logeado
    if (isset($_SESSION["usuario"])) {
      //Posts inicio
      $_SESSION["posts_inicio"] = Post::getPostsInicio($_SESSION["usuario"]->id);
      $_SESSION["hay_posts_buffer"] = Post::hayPostsBufferInicio($_SESSION["usuario"]->id);

      //Seguimiento
      $_SESSION["siguiendo"] = Seguimiento::series_seguidas($_SESSION["usuario"]->id);
      $_SESSION["ver_todas_siguiendo"] = false;
      if (sizeof($_SESSION["siguiendo"]) > 6) {
        $_SESSION["siguiendo"] = array_slice($_SESSION["siguiendo"], 0, 6);
        $_SESSION["ver_todas_siguiendo"] = true;
      }
      $_SESSION["series_pendientes"] = Seguimiento::series_pendientes($_SESSION["usuario"]->id);
      $_SESSION["ver_todas_series_pendientes"] = false;
      if (sizeof($_SESSION["series_pendientes"]) > 6) {
        $_SESSION["series_pendientes"] = array_slice($_SESSION["series_pendientes"], 0, 6);
        $_SESSION["ver_todas_series_pendientes"] = true;
      }
      $_SESSION["peliculas_pendientes"] = Seguimiento::peliculas_pendientes($_SESSION["usuario"]->id);
      $_SESSION["ver_todas_peliculas_pendientes"] = false;
      if (sizeof($_SESSION["peliculas_pendientes"]) > 6) {
        $_SESSION["peliculas_pendientes"] = array_slice($_SESSION["peliculas_pendientes"], 0, 6);
        $_SESSION["ver_todas_peliculas_pendientes"] = true;
      }

      require_once "view/InicioView.php";
    } else {
      header("Location: login");
    }
  }

  /**
   * Método para cerrar sesión
   */
  function logout()
  {
    session_destroy();
    setcookie("login", null, -1);
    setcookie("pwd", null, -1);
    header("Location: login");
  }

  /**
   * Método para crear un posts
   */
  function crear_post()
  {
    $id_ficha = $_POST["id-ficha"];
    $titulo = $_POST["titulo"];
    $tipo = $_POST["tipo"];
    $poster = $_POST["poster"];
    $contenido = htmlspecialchars($_POST["contenido"]);
    $usuario = $_SESSION["usuario"];


    if (!Ficha::existeFicha(intval($id_ficha), $tipo)) {
      Ficha::addFicha(intval($id_ficha), $titulo, $poster, $tipo);
    }

    Post::addPost($contenido, intval($usuario->id), intval($id_ficha), $tipo);

    header("Location: inicio");
  }

}

?>