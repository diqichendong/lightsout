<?php

require_once "model/Nota.php";
require_once "model/Usuario.php";
require_once "model/Ficha.php";

session_start();

class NotaController
{

  function __construct()
  {

  }

  /**
   * Manejar la calificación de un usuario sobre una ficha
   */
  function manejar_nota()
  {
    if (isset($_POST["nota"]) && isset($_POST["id_ficha"]) && isset($_POST["tipo"])) {
      $nota = $_POST["nota"];
      $id_usuario = $_SESSION["usuario"]->id;
      $id_ficha = $_POST["id_ficha"];
      $tipo = $_POST["tipo"];

      if (!Ficha::existeFicha($id_ficha, $tipo)) {
        $ficha = Ficha::get_ficha_api($tipo, $id_ficha);
        $titulo = $tipo == "tv" ? $ficha["name"] : $ficha["title"];
        Ficha::addFicha($id_ficha, $titulo, $ficha["poster_path"], $tipo);
      }

      if (intval($nota) == 0) {
        Nota::remove_nota($id_usuario, $id_ficha, $tipo);
      } else if (Nota::existe_nota($id_usuario, $id_ficha, $tipo)) {
        Nota::modificar_nota($nota, $id_usuario, $id_ficha, $tipo);
      } else {
        Nota::set_nota($nota, $id_usuario, $id_ficha, $tipo);
      }
    }
  }

}

?>