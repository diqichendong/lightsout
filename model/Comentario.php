<?php
require_once "config/Conexion.php";

class Comentario
{

  function __construct()
  {

  }

  static function get_comentarios($id_post)
  {
    $conn = new Conexion();
    $sql = "select * from comentarios, usuarios where usuarios.id = comentarios.id_usuario and comentarios.id_post = $id_post order by comentarios.fecha desc";
    $consulta = $conn->consulta($sql);
    return $consulta;
  }

  static function add_comentario($contenido, $id_post, $id_usuario)
  {
    $conn = new Conexion();
    $sql = "insert into comentarios (contenido, id_post, id_usuario) values ('$contenido', $id_post, $id_usuario)";
    $conn->exec($sql);

    $sql = "select * from usuarios, comentarios where usuarios.id = $id_usuario and usuarios.id = comentarios.id_usuario and comentarios.id_post = $id_post and comentarios.contenido = '$contenido' order by comentarios.fecha desc";
    return $conn->consulta($sql);
  }

  static function get_comentario_publicado($contenido, $id_post, $id_usuario)
  {
    $conn = new Conexion();
    $sql = "select * from usuarios, comentarios where usuarios.id = $id_usuario and usuarios.id = comentarios.id_usuario and comentarios.id_post = $id_post and comentarios.contenido = '$contenido' order by comentarios.fecha desc";
    return $conn->consulta($sql);
  }

  static function get_contador_comentarios($id_post)
  {
    $conn = new Conexion();
    $sql = "select count(*) from comentarios where id_post = $id_post";
    return $conn->consulta($sql);
  }

  function __get($name)
  {
    return $this->$name;
  }
}

?>