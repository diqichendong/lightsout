<?php

require_once "model/Usuario.php";

session_start();

class InformacionController
{

  function __construct()
  {

  }

  function index()
  {
    if (isset($_SESSION["usuario"])) {
      header("Location: /inicio");
    }

    require_once "view/PresentacionView.php";
  }

}

?>