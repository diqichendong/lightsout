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

  /**
   * Películas pendientes de un usuario
   */
  static function peliculas_pendientes($id_usuario)
  {
    $conn = new Conexion();
    $sql = "select * from fichas, seguimiento where fichas.id = seguimiento.id_ficha and seguimiento.ficha_tipo = 'movie' and seguimiento. estado = 'Pendiente' and seguimiento.id_usuario = $id_usuario order by seguimiento.fecha_actualizacion desc";
    return $conn->consulta($sql);
  }

  /**
   * Películas vistas de un usuario
   */
  static function peliculas_vistas($id_usuario)
  {
    $conn = new Conexion();
    $sql = "select * from fichas, seguimiento where fichas.id = seguimiento.id_ficha and seguimiento.ficha_tipo = 'movie' and seguimiento. estado = 'Vista' and seguimiento.id_usuario = $id_usuario order by seguimiento.fecha_actualizacion desc";
    return $conn->consulta($sql);
  }

  /**
   * Películas favoritas de un usuario
   */
  static function peliculas_favoritas($id_usuario)
  {
    $conn = new Conexion();
    $sql = "select * from fichas, seguimiento where fichas.id = seguimiento.id_ficha and seguimiento.ficha_tipo = 'movie' and seguimiento. estado = 'Favorita' and seguimiento.id_usuario = $id_usuario order by seguimiento.fecha_actualizacion desc";
    return $conn->consulta($sql);
  }

  /**
   * Series pendientes de un usuario
   */
  static function series_pendientes($id_usuario)
  {
    $conn = new Conexion();
    $sql = "select * from fichas, seguimiento where fichas.id = seguimiento.id_ficha and seguimiento.ficha_tipo = 'tv' and seguimiento. estado = 'Pendiente' and seguimiento.id_usuario = $id_usuario order by seguimiento.fecha_actualizacion desc";
    return $conn->consulta($sql);
  }

  /**
   * Series vistas de un usuario
   */
  static function series_vistas($id_usuario)
  {
    $conn = new Conexion();
    $sql = "select * from fichas, seguimiento where fichas.id = seguimiento.id_ficha and seguimiento.ficha_tipo = 'tv' and seguimiento. estado = 'Vista' and seguimiento.id_usuario = $id_usuario order by seguimiento.fecha_actualizacion desc";
    return $conn->consulta($sql);
  }

  /**
   * Series favoritas de un usuario
   */
  static function series_favoritas($id_usuario)
  {
    $conn = new Conexion();
    $sql = "select * from fichas, seguimiento where fichas.id = seguimiento.id_ficha and seguimiento.ficha_tipo = 'tv' and seguimiento. estado = 'Favorita' and seguimiento.id_usuario = $id_usuario order by seguimiento.fecha_actualizacion desc";
    return $conn->consulta($sql);
  }

  /**
   * Series seguidas de un usuario
   */
  static function series_seguidas($id_usuario)
  {
    $conn = new Conexion();
    $sql = "select * from fichas, seguimiento where fichas.id = seguimiento.id_ficha and seguimiento.ficha_tipo = 'tv' and seguimiento. estado = 'Siguiendo' and seguimiento.id_usuario = $id_usuario order by seguimiento.fecha_actualizacion desc";
    return $conn->consulta($sql);
  }

  function __get($name)
  {
    return $this->$name;
  }
}

?>