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
    if (isset($_SESSION["usuario"])) {
      if ($_SESSION["usuario"]->tipo == "Normal") {
        header("Location: /inicio");
      }
      $_SESSION["usuarios"] = Usuario::get_usuarios();

      require_once "view/AdministradorView.php";
    } else {
      header("Location: /login");
    }
  }

  function obtener_usuario()
  {
    if (isset($_POST["id"])) {
      $id_usuario = $_POST["id"];
      echo json_encode(Usuario::get_usuario($id_usuario));
    }
  }

  function editar_usuario()
  {
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $tipo = $_POST["tipo"];

    Usuario::editar_usuario($id, $nombre, $username, $email, $tipo);
    $_SESSION["editar_usuario_ok"] = "El usuario $nombre (@$username) ha sido editado correctamente.";

    header("Location: /administrador");
  }

  function eliminar_usuario()
  {
    if (isset($_POST["id"]) && isset($_POST["nombre"]) && isset($_POST["username"])) {
      $id = $_POST["id"];
      $nombre = $_POST["nombre"];
      $username = $_POST["username"];

      Usuario::eliminar_usuario($id);
      $_SESSION["eliminar_usuario_ok"] = "El usuario $nombre (@$username) ha sido eliminado correctamente.";
    }
  }

  function buscar_usuarios()
  {
    if (isset($_POST["query"])) {
      $query = strtolower(trim($_POST["query"]));

      echo json_encode(Usuario::buscar_usuarios($query));
    }
  }

}

?>