<?php
require_once "config/Conexion.php";
require_once "model/Ficha.php";
require_once "model/Usuario.php";

class Post
{

  function __construct()
  {

  }

  static function addPost($contenido, $id_usuario, $id_ficha, $tipo)
  {
    $conn = new Conexion();
    $sql = "insert into posts (contenido, id_usuario, id_ficha, ficha_tipo) values ('$contenido', $id_usuario, $id_ficha, '$tipo')";
    $conn->exec($sql);
  }

  static function getPostsInicio($id_usuario)
  {
    $conn = new Conexion();
    $sql = "select * from posts, fichas, usuarios where posts.id_usuario = usuarios.id and posts.id_ficha = fichas.id and (posts.id_usuario = $id_usuario or posts.id_usuario in (select id_usuario_2 from amigos where id_usuario_1 = $id_usuario)) order by posts.fecha desc limit 200";
    return $conn->consulta($sql);
  }

  static function getPost($id_post)
  {
    $conn = new Conexion();
    $sql = "select * from posts, fichas, usuarios where posts.id = $id_post and posts.id_ficha = fichas.id and posts.id_usuario = usuarios.id";
    return $conn->consulta($sql);
  }

  static function get_posts_ficha($tipo, $id)
  {
    $conn = new Conexion();
    $sql = "select * from posts, usuarios where posts.id_usuario = usuarios.id and posts.id_ficha = $id and posts.ficha_tipo = '$tipo' order by posts.fecha desc";
    return $conn->consulta($sql);
  }

  static function get_post_perfil($id_usuario)
  {
    $conn = new Conexion();
    $sql = "select * from posts, fichas where posts.id_ficha = fichas.id and posts.ficha_tipo = fichas.tipo and posts.id_usuario = $id_usuario order by fecha desc";
    return $conn->consulta($sql);
  }

  function __get($name)
  {
    return $this->$name;
  }
}

?>