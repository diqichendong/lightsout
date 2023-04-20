<?php
require_once "config/Conexion.php";

class Light
{

  function __construct()
  {

  }

  static function get_contador_lights($id_post)
  {
    $conn = new Conexion();
    $sql = "select count(*) from lights where id_post = $id_post";
    return $conn->consulta($sql);
  }

  static function usuario_light($id_post, $id_usuario)
  {
    $conn = new Conexion();
    $sql = "select count(*) from lights where id_post = $id_post and id_usuario = $id_usuario";
    return $conn->consulta($sql);
  }

  static function set_light($id_post, $id_usuario)
  {
    $conn = new Conexion();
    $sql = "insert into lights (id_post, id_usuario) values ($id_post, $id_usuario)";
    $conn->exec($sql);
  }

  static function remove_light($id_post, $id_usuario)
  {
    $conn = new Conexion();
    $sql = "delete from lights where id_post = $id_post and id_usuario = $id_usuario";
    $conn->exec($sql);
  }

  function __get($name)
  {
    return $this->$name;
  }
}

?>