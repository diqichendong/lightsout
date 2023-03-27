<?php

require_once "model/Usuario.php";

class LoginController
{
  private $usuario;
  function __construct()
  {
    $this->usuario = new Usuario();
  }

  function index()
  {
    if (isset($_SESSION["usuario"])) {
      header("Location: index.php?c=inicio");
    } else {
      require_once "view/LoginView.php";
    }
  }

  function login()
  {
    $login = $_POST["login"];
    $pwd = $_POST["pwd"];

    if ($this->usuario->existeUsuario($login, $pwd)) {
      $_SESSION["usuario"] = $this->usuario;
      header("Location: index.php?c=inicio");
    } else {
      $_SESSION["error_login"] = true;
      header("Location: index.php?c=login");
    }
  }

}

?>