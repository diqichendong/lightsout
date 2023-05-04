<?php
require_once "config/Conexion.php";

class Ficha
{

  function __construct()
  {

  }

  static function existeFicha(int $id, string $tipo)
  {
    $conn = new Conexion();
    $sql = "select * from fichas where id = $id and tipo = '$tipo'";
    $consulta = $conn->prepare($sql);
    $consulta->execute();

    return $consulta->rowCount() > 0;
  }

  static function addFicha(int $id, string $titulo, string $poster, string $tipo)
  {
    $conn = new Conexion();
    $sql = "insert into fichas (id, titulo, imagen, tipo) values ($id, '$titulo', '$poster', '$tipo')";
    $conn->exec($sql);
  }

  static function get_ficha_api($tipo, $id)
  {
    $c = curl_init();
    curl_setopt($c, CURLOPT_URL, API_REQUEST_BASE . "/$tipo/$id?api_key=" . API_KEY . "&language=es");
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($c);
    curl_close($c);

    return json_decode($data, true);
  }

  static function get_director($id)
  {
    $c = curl_init();
    curl_setopt($c, CURLOPT_URL, API_REQUEST_BASE . "/movie/$id/credits?api_key=" . API_KEY . "&language=es");
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($c);
    curl_close($c);

    $creditos = json_decode($data, true);
    foreach ($creditos["crew"] as $persona) {
      if ($persona["job"] == "Director") {
        return $persona["name"];
      }
    }
  }

  static function get_reparto($tipo, $id)
  {
    $c = curl_init();
    curl_setopt($c, CURLOPT_URL, API_REQUEST_BASE . "/$tipo/$id/credits?api_key=" . API_KEY . "&language=es");
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($c);
    curl_close($c);

    $creditos = json_decode($data, true);
    $reparto = [];
    foreach ($creditos["cast"] as $persona) {
      array_push($reparto, $persona["name"]);
      if (sizeof($reparto) == 20) {
        break;
      }
    }
    return $reparto;
  }

  static function get_trailers($tipo, $id)
  {
    $c = curl_init();
    curl_setopt($c, CURLOPT_URL, API_REQUEST_BASE . "/$tipo/$id/videos?api_key=" . API_KEY . "&language=es");
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($c);
    curl_close($c);

    $videos = json_decode($data, true);
    $trailers = [];
    foreach ($videos["results"] as $video) {
      if ($video["site"] == "YouTube" && ($video["type"] == "Trailer" || $video["type"] == "Teaser")) {
        array_push($trailers, $video);
      }
    }
    return $trailers;
  }

  static function get_proveedores($tipo, $id)
  {
    $c = curl_init();
    curl_setopt($c, CURLOPT_URL, API_REQUEST_BASE . "/$tipo/$id/watch/providers?api_key=" . API_KEY . "&language=es");
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($c);
    curl_close($c);

    $proveedores = json_decode($data, true);

    if (isset($proveedores["results"]["ES"])) {
      return $proveedores["results"]["ES"];
    } else {
      return [];
    }
  }

  static function get_fichas_explorar($tipo, $genero, $year, $orden, $pagina)
  {
    $url = API_REQUEST_BASE . "/discover/$tipo?api_key=" . API_KEY . "&language=es&page=$pagina";
    if ($orden == "fecha") {
      $url .= $tipo == "tv" ? "&sort_by=first_air_data_desc" : "&sort_by=primary_release_date_desc";
    } else {
      $url .= "&sort_by=$orden";
    }
    if ($genero != "none") {
      $url .= "&with_genres=$genero";
    }
    if ($year != "none") {
      $url .= $tipo == "tv" ? "&first_air_date_year=$year" : "&primary_release_year=$year";
    }

    $c = curl_init();
    curl_setopt($c, CURLOPT_URL, $url);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($c);
    curl_close($c);

    return json_decode($data, true);
  }

  function __get($name)
  {
    return $this->$name;
  }
}

?>