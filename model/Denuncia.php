<?php
require_once "config/Conexion.php";

class Denuncia
{

  function __construct()
  {

  }

  static function denunciar_post($id_post)
  {
    $conn = new Conexion();
    $sql = "insert into denuncias_posts (id_post) values ($id_post)";
    $consulta = $conn->exec($sql);
  }

  static function denunciar_comentario($id_comentario)
  {
    $conn = new Conexion();
    $sql = "insert into denuncias_comentarios (id_comentario) values ($id_comentario)";
    $consulta = $conn->exec($sql);
  }

  function __get($name)
  {
    return $this->$name;
  }
}

?>