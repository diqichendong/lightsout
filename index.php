<?php

session_start();

require_once "./config/config.php";

// Comprobar el parámetro del controlador
if (isset($_GET["c"])) {
  $controllerName = ucwords($_GET["c"]) . "Controller";

  // Comprobar si existe el controlador
  if (file_exists("controller/" . $controllerName . ".php")) {
    require_once "controller/" . $controllerName . ".php";

    $controller = new $controllerName();

    // Comprobar si existe el parámetro del método
    if (isset($_GET["m"])) {
      $method = $_GET["m"];

      // Comprobar si existe el método en el controlador
      if (method_exists($controller, $method)) {
        $controller->$method();
      } else {
        // No existe el método en el controlador
        $method = DEFAULT_METHOD;
        $controller->$method();
      }
    } else {
      // No existe el parámetro del método
      $method = DEFAULT_METHOD;
      $controller->$method();
    }

  } else {
    // No existe el controlador
    $controllerName = ucwords(DEFAULT_CONTROLLER) . "Controller";
    $method = DEFAULT_METHOD;
    require_once "controller/" . $controllerName . ".php";

    $controller = new $controllerName();
    $controller->$method();
  }
} else {
  // Faltan parámetros
  $controllerName = ucwords(DEFAULT_CONTROLLER) . "Controller";
  $method = DEFAULT_METHOD;
  require_once "controller/" . $controllerName . ".php";

  $controller = new $controllerName();
  $controller->$method();
}

?>