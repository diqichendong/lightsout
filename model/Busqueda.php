<?php
require_once "config/Conexion.php";
require_once "model/Usuario.php";

class Busqueda
{

  function __construct()
  {

  }

  static function buscar_usuario($query)
  {
    $id_usuario = $_SESSION["usuario"]->id;
    $conn = new Conexion();
    $sql = "select * from usuarios where (lower(nombre) like '%$query%' or lower(username) like '%$query%') and id != $id_usuario";
    return $conn->consulta($sql);
  }

  static function buscar_peliculas($query)
  {
    $c = curl_init();
    curl_setopt($c, CURLOPT_URL, API_REQUEST_BASE . "/search/movie?api_key=" . API_KEY . "&language=es&query=" . urlencode($query) . "&include_adult=false");
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($c);
    curl_close($c);

    $response = json_decode($data, true);
    $resultados = $response["results"];

    $total_paginas = $response["total_pages"];
    if ($total_paginas > 1) {
      $paginas = $total_paginas > 1 && $total_paginas <= 3 ? $total_paginas : 3;
      for ($i = 2; $i <= $paginas; $i++) {
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, API_REQUEST_BASE . "/search/movie?api_key=" . API_KEY . "&language=es&query=" . urlencode($query) . "&include_adult=false&page=$i");
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($c);
        curl_close($c);

        $resultados = array_merge($resultados, json_decode($data, true)["results"]);
      }
    }

    return $resultados;
  }

  static function buscar_series($query)
  {
    $c = curl_init();
    curl_setopt($c, CURLOPT_URL, API_REQUEST_BASE . "/search/tv?api_key=" . API_KEY . "&language=es&query=" . urlencode($query) . "&include_adult=false");
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($c);
    curl_close($c);

    $response = json_decode($data, true);
    $resultados = $response["results"];

    $total_paginas = $response["total_pages"];
    if ($total_paginas > 1) {
      $paginas = $total_paginas > 1 && $total_paginas <= 3 ? $total_paginas : 3;
      for ($i = 2; $i <= $paginas; $i++) {
        $c = curl_init();
        curl_setopt($c, CURLOPT_URL, API_REQUEST_BASE . "/search/tv?api_key=" . API_KEY . "&language=es&query=" . urlencode($query) . "&include_adult=false&page=$i");
        curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
        $data = curl_exec($c);
        curl_close($c);

        $resultados = array_merge($resultados, json_decode($data, true)["results"]);
      }
    }

    return $resultados;
  }

  function __get($name)
  {
    return $this->$name;
  }
}

?>