<?php
require_once "config/Conexion.php";

class Ficha
{
  private $id;
  private $titulo;
  private $poster;
  private $tipo;

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

  function __get($name)
  {
    return $this->$name;
  }
}

?>