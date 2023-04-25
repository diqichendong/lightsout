<?php
require_once "config/Conexion.php";

class Seguimiento
{

  function __construct()
  {

  }

  static function existe_seguimiento($id_usuario, $id_ficha, $tipo)
  {
    return sizeof(Seguimiento::get_seguimiento($id_usuario, $id_ficha, $tipo)) > 0;
  }

  static function set_seguimiento($estado, $id_usuario, $id_ficha, $tipo)
  {
    $conn = new Conexion();
    $sql = "insert into seguimiento (estado, id_usuario, id_ficha, ficha_tipo) values ('$estado', $id_usuario, $id_ficha, '$tipo')";
    $conn->exec($sql);
  }

  static function remove_seguimiento($id_usuario, $id_ficha, $tipo)
  {
    $conn = new Conexion();
    $sql = "delete from seguimiento where id_usuario = $id_usuario and id_ficha = $id_ficha and ficha_tipo = '$tipo')";
    $conn->exec($sql);
  }

  static function get_seguimiento($id_usuario, $id_ficha, $tipo)
  {
    $conn = new Conexion();
    $sql = "select estado from seguimiento where id_usuario = $id_usuario and id_ficha = $id_ficha and ficha_tipo = '$tipo'";
    return $conn->consulta($sql);
  }

  static function modificar_seguimiento($estado, $id_usuario, $id_ficha, $tipo)
  {
    $conn = new Conexion();
    $sql = "update seguimiento set estado = '$estado', 	fecha_actualizacion = now() where id_usuario = $id_usuario and id_ficha = $id_ficha and ficha_tipo = '$tipo'";
    $conn->exec($sql);
  }

  function __get($name)
  {
    return $this->$name;
  }
}

?>