<?php
require_once "config/Conexion.php";

class Denuncia
{

  function __construct()
  {

  }

  /**
   * Añadir una denuncia a un post
   */
  static function denunciar_post($id_post)
  {
    $conn = new Conexion();
    $sql = "insert into denuncias_posts (id_post) values ($id_post)";
    $consulta = $conn->exec($sql);
  }

  /**
   * Añadir una denuncia a un comentario
   */
  static function denunciar_comentario($id_comentario)
  {
    $conn = new Conexion();
    $sql = "insert into denuncias_comentarios (id_comentario) values ($id_comentario)";
    $consulta = $conn->exec($sql);
  }

  /**
   * Eliminar una denuncia a un post
   */
  static function eliminar_denuncia_post($id_post)
  {
    $conn = new Conexion();
    $sql = "delete from denuncias_posts where id_post = $id_post";
    $conn->exec($sql);
  }

  /**
   * Eliminar un post denunciado
   */
  static function eliminar_post($id_post)
  {
    $conn = new Conexion();
    $sql = "delete from posts where id = $id_post";
    $conn->exec($sql);
  }

  /**
   * Eliminar la denuncia a un comentario
   */
  static function eliminar_denuncia_comentario($id_comentario)
  {
    $conn = new Conexion();
    $sql = "delete from denuncias_comentarios where id_comentario = $id_comentario";
    $conn->exec($sql);
  }

  /**
   * Eliminar el comentario denunciado
   */
  static function eliminar_comentario($id_comentario)
  {
    $conn = new Conexion();
    $sql = "delete from comentarios where id = $id_comentario";
    $conn->exec($sql);
  }
}

?>