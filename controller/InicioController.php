<?php

require_once "model/Usuario.php";

session_start();

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
      header("Location: index.php?c=login");
    }
  }

  function logout()
  {
    session_destroy();
    setcookie("login", null, -1);
    setcookie("pwd", null, -1);
    header("Location: index.php?c=login");
  }

}

?>