<?php
require_once "config/Conexion.php";
require_once "model/Ficha.php";
require_once "model/Usuario.php";

class Post
{
  private $id;
  private Ficha $ficha;
  private Usuario $usuario;
  private $contenido;
  private $fecha;

  function __construct()
  {

  }

  static function addPost($contenido, $id_usuario, $id_ficha)
  {
    $conn = new Conexion();
    $sql = "insert into posts (contenido, id_usuario, id_ficha) values ('$contenido', $id_usuario, $id_ficha)";
    $conn->exec($sql);
  }

  function __get($name)
  {
    return $this->$name;
  }
}

?>