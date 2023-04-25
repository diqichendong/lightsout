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
    return json_decode(file_get_contents(API_REQUEST_BASE . "/$tipo/$id?api_key=" . API_KEY . "&language=es"), true);
  }

  static function get_director($id)
  {
    $creditos = json_decode(file_get_contents(API_REQUEST_BASE . "/movie/$id/credits?api_key=" . API_KEY . "&language=es"), true);
    foreach ($creditos["crew"] as $persona) {
      if ($persona["job"] == "Director") {
        return $persona["name"];
      }
    }
  }

  static function get_reparto($tipo, $id)
  {
    $creditos = json_decode(file_get_contents(API_REQUEST_BASE . "/$tipo/$id/credits?api_key=" . API_KEY . "&language=es"), true);
    $reparto = [];
    foreach ($creditos["cast"] as $persona) {
      array_push($reparto, $persona["name"]);
      if (sizeof($reparto) == 20) {
        break;
      }
    }
    return $reparto;
  }

  function __get($name)
  {
    return $this->$name;
  }
}

?>