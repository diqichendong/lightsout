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
    // Usuario logeado
    if (isset($_SESSION["usuario"])) {
      // Path correcto
      if (isset($_GET["q"])) {
        $query = strtolower($_GET["q"]);

        // Obtener usuarios
        $_SESSION["usuarios"] = Busqueda::buscar_usuario($query);
        unset($_SESSION["ver_mas_usuarios"]);
        if (sizeof($_SESSION["usuarios"]) > 6) {
          $_SESSION["ver_mas_usuarios"] = array_slice($_SESSION["usuarios"], 6);
          $_SESSION["usuarios"] = array_slice($_SESSION["usuarios"], 0, 6);
        }

        // Obtener películas
        $_SESSION["peliculas"] = Busqueda::buscar_peliculas($query);
        unset($_SESSION["ver_mas_peliculas"]);
        if (sizeof($_SESSION["peliculas"]) > 6) {
          $_SESSION["ver_mas_peliculas"] = array_slice($_SESSION["peliculas"], 6);
          $_SESSION["peliculas"] = array_slice($_SESSION["peliculas"], 0, 6);
        }

        // Obtener series
        $_SESSION["series"] = Busqueda::buscar_series($query);
        unset($_SESSION["ver_mas_series"]);
        if (sizeof($_SESSION["series"]) > 6) {
          $_SESSION["ver_mas_series"] = array_slice($_SESSION["series"], 6);
          $_SESSION["series"] = array_slice($_SESSION["series"], 0, 6);
        }
      } else {
        header("Location: /inicio");
      }

      require_once "view/BusquedaView.php";
    } else {
      header("Location: /login");
    }
  }

  /**
   * Buscar ficha para crear post (AJAX)
   */
  function buscar_ficha_crear_post()
  {
    if (isset($_POST["query"])) {
      $query = $_POST["query"];
      $c = curl_init();
      curl_setopt($c, CURLOPT_URL, API_REQUEST_BASE . "/search/multi?api_key=" . API_KEY . "&language=es&query=" . urlencode($query) . "&include_adult=false");
      curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
      $data = curl_exec($c);
      curl_close($c);

      echo $data;
    } else {
      echo "{}";
    }
  }

}

?>