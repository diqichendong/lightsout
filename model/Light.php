<?php
require_once "config/Conexion.php";

class Light
{

  function __construct()
  {

  }

  /**
   * Obtener el número de Lights de un post
   */
  static function get_contador_lights($id_post)
  {
    $conn = new Conexion();
    $sql = "select count(*) from lights where id_post = $id_post";
    return $conn->consulta($sql);
  }

  /**
   * Obtener si un usuario le ha dado Light a un post
   */
  static function usuario_light($id_post, $id_usuario)
  {
    $conn = new Conexion();
    $sql = "select count(*) from lights where id_post = $id_post and id_usuario = $id_usuario";
    return $conn->consulta($sql);
  }

  /**
   * Establecer el Light de un usuario
   */
  static function set_light($id_post, $id_usuario)
  {
    $conn = new Conexion();
    $sql = "insert into lights (id_post, id_usuario) values ($id_post, $id_usuario)";
    $conn->exec($sql);
  }

  /**
   * Eliminar el Light de un usuario
   */
  static function remove_light($id_post, $id_usuario)
  {
    $conn = new Conexion();
    $sql = "delete from lights where id_post = $id_post and id_usuario = $id_usuario";
    $conn->exec($sql);
  }
}

?>