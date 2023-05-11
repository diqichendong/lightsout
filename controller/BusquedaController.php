<?php

require_once "model/Busqueda.php";

session_start();

class BusquedaController
{

  function __construct()
  {

  }

  function index()
  {
    if (isset($_SESSION["usuario"])) {
      if (isset($_GET["q"])) {
        $query = strtolower($_GET["q"]);
        $_SESSION["usuarios"] = Busqueda::buscar_usuario($query);
        unset($_SESSION["ver_mas_usuarios"]);
        if (sizeof($_SESSION["usuarios"]) > 6) {
          $_SESSION["ver_mas_usuarios"] = array_slice($_SESSION["usuarios"], 6);
          $_SESSION["usuarios"] = array_slice($_SESSION["usuarios"], 0, 6);
        }
      } else {
        //header("Location: /inicio");
      }

      require_once "view/BusquedaView.php";
    } else {
      header("Location: /login");
    }
  }

}

?>