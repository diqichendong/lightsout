<?php

require_once "model/Seguimiento.php";
require_once "model/Usuario.php";
require_once "model/Ficha.php";

session_start();

class SeguimientoController
{

  function __construct()
  {

  }

  /**
   * Manejar el seguimiento de un usuario sobre una ficha
   */
  function manejar_seguimiento()
  {
    if (isset($_POST["estado"]) && isset($_POST["id_ficha"]) && isset($_POST["tipo"])) {
      $estado = $_POST["estado"];
      $id_usuario = $_SESSION["usuario"]->id;
      $id_ficha = $_POST["id_ficha"];
      $tipo = $_POST["tipo"];

      if (!Ficha::existeFicha($id_ficha, $tipo)) {
        $ficha = Ficha::get_ficha_api($tipo, $id_ficha);
        $titulo = $tipo == "tv" ? $ficha["name"] : $ficha["title"];
        Ficha::addFicha($id_ficha, $titulo, $ficha["poster_path"], $tipo);
      }

      if ($estado == "0") {
        Seguimiento::remove_seguimiento($id_usuario, $id_ficha, $tipo);
      } else if (Seguimiento::existe_seguimiento($id_usuario, $id_ficha, $tipo)) {
        Seguimiento::modificar_seguimiento($estado, $id_usuario, $id_ficha, $tipo);
      } else {
        Seguimiento::set_seguimiento($estado, $id_usuario, $id_ficha, $tipo);
      }
    }
  }

}

?>