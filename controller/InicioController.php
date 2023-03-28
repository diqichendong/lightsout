<?php

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
      header("Location: index.php");
    }
  }

  function logout()
  {
    session_destroy();
    header("Location: index.php");
  }

}

?>