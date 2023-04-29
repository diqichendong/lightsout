<?php

require_once "model/Usuario.php";
require_once "model/Ficha.php";
require_once "model/Post.php";
require_once "model/Comentario.php";
require_once "model/Light.php";
require_once "model/API.php";
require_once "model/Nota.php";
require_once "model/Seguimiento.php";

session_start();

class FichaController
{

  function __construct()
  {

  }

  function index()
  {
    if (isset($_SESSION["usuario"])) {
      if (isset($_GET["tipo"]) && isset($_GET["id"])) {
        $tipo = $_GET["tipo"];
        $id = $_GET["id"];
        $_SESSION["ficha"] = Ficha::get_ficha_api($tipo, $id);
        $_SESSION["tipo"] = $tipo;
        if (!isset($_SESSION["paises"])) {
          $_SESSION["paises"] = API::get_paises();
        }
        if ($tipo == "movie") {
          $_SESSION["director"] = Ficha::get_director($id);
        }
        $_SESSION["reparto"] = Ficha::get_reparto($tipo, $id);
        $_SESSION["posts_ficha"] = Post::get_posts_ficha($tipo, $id);
        $_SESSION["nota_media"] = Nota::get_nota_media($id, $tipo);
        $_SESSION["nota_usuario"] = Nota::get_nota($_SESSION["usuario"]->id, $id, $tipo);
        $_SESSION["seguimiento"] = Seguimiento::get_seguimiento($_SESSION["usuario"]->id, $id, $tipo);
        $_SESSION["trailers"] = Ficha::get_trailers($tipo, $id);
        $_SESSION["proveedores"] = Ficha::get_proveedores($tipo, $id);
      } else {
        header("Location: inicio");
      }
      require_once "view/FichaView.php";
    } else {
      header("Location: login");
    }
  }

  /**
   * Método para crear una posts
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

    header("Location: /ficha/$tipo/$id_ficha");
  }

}

?>