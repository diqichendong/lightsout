<?php

require_once "model/Usuario.php";
require_once "model/Post.php";
require_once "model/Comentario.php";

session_start();

class AdministradorController
{

  function __construct()
  {

  }

  function index()
  {
    // Usuario logeado
    if (isset($_SESSION["usuario"])) {

      // Path incorrecto
      if ($_SESSION["usuario"]->tipo == "Normal" || !isset($_GET["tab"])) {
        header("Location: /inicio");
      }

      // Obtener datos
      $_SESSION["tab"] = $_GET["tab"];
      $_SESSION["usuarios"] = Usuario::get_usuarios();
      $_SESSION["posts_denunciados"] = Post::get_posts_denunciados();
      $_SESSION["comentarios_denunciados"] = Comentario::get_comentarios_denunciados();

      require_once "view/AdministradorView.php";
    } else {
      header("Location: /login");
    }
  }

  /**
   * Obtener usuario (AJAX)
   */
  function obtener_usuario()
  {
    if (isset($_POST["id"])) {
      $id_usuario = $_POST["id"];
      echo json_encode(Usuario::get_usuario($id_usuario));
    }
  }

  /**
   * Editar usuario (AJAX)
   */
  function editar_usuario()
  {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $tipo = $_POST["tipo"];

    Usuario::editar_usuario($id, $nombre, $username, $email, $tipo);
    $_SESSION["mensaje"] = "El usuario $nombre (@$username) ha sido editado correctamente.";
  }

  /**
   * Eliminar usuario (AJAX)
   */
  function eliminar_usuario()
  {
    if (isset($_POST["id"]) && isset($_POST["nombre"]) && isset($_POST["username"])) {
      $id = $_POST["id"];
      $nombre = $_POST["nombre"];
      $username = $_POST["username"];

      Usuario::eliminar_usuario($id);
      $_SESSION["mensaje"] = "El usuario $nombre (@$username) ha sido eliminado correctamente.";

      header("Location: /administrador/gestion_usuarios");
    }
  }

  /**
   * Buscar usuarios (AJAX)
   */
  function buscar_usuarios()
  {
    if (isset($_POST["query"])) {
      $query = strtolower(trim($_POST["query"]));

      echo json_encode(Usuario::buscar_usuarios($query));
    }
  }

}

?>