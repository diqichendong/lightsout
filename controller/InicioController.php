<?php

require_once "model/Usuario.php";
require_once "model/Ficha.php";
require_once "model/Post.php";
require_once "model/Comentario.php";
require_once "model/Light.php";

session_start();

class InicioController
{

  function __construct()
  {

  }

  function index()
  {
    if (isset($_SESSION["usuario"])) {
      $_SESSION["posts_inicio"] = Post::getPostsInicio($_SESSION["usuario"]->id);
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
    $contenido = $_POST["contenido"];
    $usuario = $_SESSION["usuario"];


    if (!Ficha::existeFicha(intval($id_ficha), $tipo)) {
      Ficha::addFicha(intval($id_ficha), $titulo, $poster, $tipo);
    }

    Post::addPost($contenido, intval($usuario->id), intval($id_ficha), $tipo);

    header("Location: inicio");
  }

}

?>