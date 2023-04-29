<?php
require_once "config/Conexion.php";

class API
{
  function __construct()
  {

  }

  static function get_paises()
  {
    $c = curl_init();
    curl_setopt($c, CURLOPT_URL, API_REQUEST_BASE . "/configuration/countries?api_key=" . API_KEY . "&language=es");
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($c);
    curl_close($c);
    $paises = json_decode($data, true);
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