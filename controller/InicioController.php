<?php

require_once "model/Usuario.php";
require_once "model/Ficha.php";
require_once "model/Post.php";

session_start();

class InicioController
{

  function __construct()
  {

  }

  function index()
  {
    if (isset($_SESSION["usuario"])) {
      require_once "view/InicioView.php";
    } else {
      header("Location: index.php?c=login");
    }
  }

  function logout()
  {
    session_destroy();
    setcookie("login", null, -1);
    setcookie("pwd", null, -1);
    header("Location: index.php?c=login");
  }

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

    Post::addPost($contenido, intval($usuario->id), intval($id_ficha));

    header("Location: index.php?c=inicio");
  }

}

?>