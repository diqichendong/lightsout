<?php

require_once "model/Usuario.php";

session_start();

class EditarPerfilController
{
  private $usuario;

  function __construct()
  {
    $this->usuario = $_SESSION["usuario"];
  }

  function index()
  {
    require_once "view/EditarPerfilView.php";
  }

  /**
   * Guarda la foto en el servidor y modifica la foto de perfil del usuario
   */
  function guardar_foto()
  {
    $directorio = "assets/perfil/";
    $extension = pathinfo($_FILES["archivo"]["name"], PATHINFO_EXTENSION);
    $path_foto = $directorio . $this->usuario->id . ".$extension";
    if (file_exists($path_foto)) {
      chmod($path_foto, 0755);
      unlink("$path_foto");
    }
    if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $path_foto)) {
      $this->usuario->editarFoto($this->usuario->id . ".$extension");
      $_SESSION["foto_cambiada"] = true;
    }

    header("Location: index.php?c=editar_perfil");
  }
}