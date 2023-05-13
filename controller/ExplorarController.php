<?php

require_once "model/Usuario.php";
require_once "model/Ficha.php";
require_once "model/API.php";

session_start();

class ExplorarController
{

  function __construct()
  {

  }

  function index()
  {
    if (isset($_SESSION["usuario"])) {
      if (isset($_GET["tipo"]) && isset($_GET["genero"]) && isset($_GET["year"]) && isset($_GET["orden"]) && isset($_GET["pagina"])) {
        $_SESSION["tipo"] = $_GET["tipo"];
        $_SESSION["genero"] = $_GET["genero"];
        $_SESSION["year"] = $_GET["year"];
        $_SESSION["orden"] = $_GET["orden"];
        $_SESSION["pagina"] = $_GET["pagina"];
        $_SESSION["hola"] = "hola";

        if ($_SESSION["tipo"] == "tv") {
          $_SESSION["generos"] = API::get_genero_series();
        } else {
          $_SESSION["generos"] = API::get_genero_peliculas();
        }
        $_SESSION["fichas_explorar"] = Ficha::get_fichas_explorar($_GET["tipo"], $_GET["genero"], $_GET["year"], $_GET["orden"], $_GET["pagina"]);
      } else {
        $_SESSION["generos"] = API::get_genero_peliculas();
        $_SESSION["tipo"] = "movie";
        $_SESSION["genero"] = "none";
        $_SESSION["year"] = "none";
        $_SESSION["orden"] = "popularity.desc";
        $_SESSION["pagina"] = 1;
        $_SESSION["fichas_explorar"] = Ficha::get_fichas_explorar($_SESSION["tipo"], $_SESSION["genero"], $_SESSION["year"], $_SESSION["orden"], $_SESSION["pagina"]);
      }

      require_once "view/ExplorarView.php";
    } else {
      header("Location: login");
    }
  }

  function generos_series()
  {
    echo API::get_genero_series();
  }

  function generos_peliculas()
  {
    echo API::get_genero_peliculas();
  }

  function cargar_mas()
  {
    if (isset($_POST["tipo"]) && isset($_POST["genero"]) && isset($_POST["year"]) && isset($_POST["orden"]) && isset($_POST["pagina"])) {
      $tipo = $_POST["tipo"];
      $genero = $_POST["genero"];
      $year = $_POST["year"];
      $orden = $_POST["orden"];
      $pagina = $_POST["pagina"];

      echo json_encode(Ficha::get_fichas_explorar($tipo, $genero, $year, $orden, $pagina));
    }
  }

}
?>