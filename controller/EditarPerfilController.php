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

    // Borrar imágenes antiguas
    array_map('unlink', glob($directorio . $this->usuario->id . ".*"));

    if (move_uploaded_file($_FILES["archivo"]["tmp_name"], $path_foto)) {
      $this->usuario->editarFoto($this->usuario->id . ".$extension");
      $_SESSION["foto_cambiada"] = true;
    }

    header("Location: editar_perfil");
  }

  /**
   * Guarda los datos actualizados del usuario
   */
  function guardar_datos()
  {
    $nombre = $_POST["nombre"];
    $login = $_POST["usuario"];
    $sobre_mi = $_POST["sobre_mi"];
    if ($this->usuario->actualizarDatos($nombre, $login, $sobre_mi)) {
      $_SESSION["datos_actualizados"] = true;
    }

    header("Location: editar_perfil");
  }

  /**
   * Guarda y actualiza la contraseña del usuario
   */
  function cambiar_pwd()
  {
    $actual_pass = $_POST["actual-pass"];
    $new_pass = $_POST["new-pass"];
    if ($actual_pass == $this->usuario->password) {
      if ($this->usuario->actualizarPassword($new_pass)) {
        $_SESSION["pwd_actualizado"] = true;
      }
    } else {
      $_SESSION["error_pwd"] = true;
    }

    header("Location: editar_perfil");
  }

  /**
   * Eliminar cuenta
   */
  function eliminar_cuenta()
  {
    if ($this->usuario->eliminarUsuario()) {
      array_map('unlink', glob("assets/perfil/" . $this->usuario->id . ".*"));
      unset($_SESSION["usuario"]);
      $_SESSION["mensaje_ok"] = "Cuenta eliminada correctamente.";
      header("Location: login");
    }
  }
}