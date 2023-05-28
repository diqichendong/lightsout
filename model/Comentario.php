<?php
require_once "config/Conexion.php";

class Comentario
{

  function __construct()
  {

  }

  /**
   * Obtener todos los comentarios de un post
   */
  static function get_comentarios($id_post)
  {
    $conn = new Conexion();
    $sql = "select * from comentarios, usuarios where usuarios.id = comentarios.id_usuario and comentarios.id_post = $id_post order by comentarios.fecha desc";
    $consulta = $conn->consulta($sql);
    return $consulta;
  }

  /**
   * Añadir un comentrio a un post
   */
  static function add_comentario($contenido, $id_post, $id_usuario)
  {
    $conn = new Conexion();
    $sql = "insert into comentarios (contenido, id_post, id_usuario) values ('$contenido', $id_post, $id_usuario)";
    $conn->exec($sql);

    $sql = "select * from usuarios, comentarios where usuarios.id = $id_usuario and usuarios.id = comentarios.id_usuario and comentarios.id_post = $id_post and comentarios.contenido = '$contenido' order by comentarios.fecha desc";
    return $conn->consulta($sql);
  }

  /**
   * Obtener el comentario que se acabó de publicar en un post
   */
  static function get_comentario_publicado($contenido, $id_post, $id_usuario)
  {
    $conn = new Conexion();
    $sql = "select * from usuarios, comentarios where usuarios.id = $id_usuario and usuarios.id = comentarios.id_usuario and comentarios.id_post = $id_post and comentarios.contenido = '$contenido' order by comentarios.fecha desc";
    return $conn->consulta($sql);
  }

  /**
   * Obtener el contador de comentarios de un post
   */
  static function get_contador_comentarios($id_post)
  {
    $conn = new Conexion();
    $sql = "select count(*) from comentarios where id_post = $id_post";
    return $conn->consulta($sql);
  }

  /**
   * Obtener los comentarios que se han denunciados
   */
  static function get_comentarios_denunciados()
  {
    $id_usuario_actual = $_SESSION["usuario"]->id;
    $conn = new Conexion();
    $sql = "select * from denuncias_comentarios, comentarios, usuarios where denuncias_comentarios.id_comentario = comentarios.id and comentarios.id_usuario = usuarios.id and usuarios.id != $id_usuario_actual";
    return $conn->consulta($sql);
  }
}

?>