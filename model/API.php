<?php
require_once "config/Conexion.php";

class API
{
  function __construct()
  {

  }

  /**
   * Obtener todos los paises de la API
   */
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

  /**
   * Obtener todos los géneros de películas de la API
   */
  static function get_genero_peliculas()
  {
    $c = curl_init();
    curl_setopt($c, CURLOPT_URL, API_REQUEST_BASE . "/genre/movie/list?api_key=" . API_KEY . "&language=es");
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($c);
    curl_close($c);
    return json_decode($data, true)["genres"];
  }

  /**
   * Obtener todos los géneros de series de la API
   */
  static function get_genero_series()
  {
    $c = curl_init();
    curl_setopt($c, CURLOPT_URL, API_REQUEST_BASE . "/genre/tv/list?api_key=" . API_KEY . "&language=es");
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($c);
    curl_close($c);
    return json_decode($data, true)["genres"];
  }

  /**
   * Obtener las tendencias
   */
  static function get_tendencias()
  {
    $c = curl_init();
    curl_setopt($c, CURLOPT_URL, API_REQUEST_BASE . "/trending/all/day?api_key=" . API_KEY . "&language=es");
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($c);
    curl_close($c);
    return json_decode($data, true)["results"];
  }
}

?>