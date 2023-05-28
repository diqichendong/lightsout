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
    // Path correcto
    if (isset($_GET["pagina"])) {
      // Elegir diferentes tipos de páginas de información
      $pagina = $_GET["pagina"];
      switch ($pagina) {
        case "sobre_lightsout":
          require_once "view/SobreNosotrosView.php";
          break;
        case "condiciones_uso":
          require_once "view/CondicionesUsoView.php";
          break;
        case "politica_privacidad":
          require_once "view/PoliticaPrivacidadView.php";
          break;
      }
    } else {
      // Usuario logeado
      if (isset($_SESSION["usuario"])) {
        header("Location: /inicio");
      } else {
        // Página por defecto
        require_once "view/PresentacionView.php";
      }

    }
  }

}

?>