<?php
require_once "config/Conexion.php";

class API
{
  function __construct()
  {

  }

  static function get_paises()
  {
    $paises = json_decode(file_get_contents(API_REQUEST_BASE . "/configuration/countries?api_key=" . API_KEY . "&language=es"), true);
    foreach ($paises as $pais) {
      $res[$pais["iso_3166_1"]] = $pais["native_name"];
    }
    return $res;
  }

  function __get($name)
  {
    return $this->$name;
  }
}

?>