<?php
require_once "config/Conexion.php";
require_once "model/Ficha.php";
require_once "model/Usuario.php";

class Post
{

  function __construct()
  {

  }

  /**
   * Añadir un post
   */
  static function addPost($contenido, $id_usuario, $id_ficha, $tipo)
  {
    $conn = new Conexion();
    $sql = "insert into posts (contenido, id_usuario, id_ficha, ficha_tipo) values ('$contenido', $id_usuario, $id_ficha, '$tipo')";
    $conn->exec($sql);
  }

  /**
   * Obtener los posts de la página de inicio
   */
  static function getPostsInicio($id_usuario)
  {
    $conn = new Conexion();
    $sql = "select * from posts, fichas, usuarios where posts.id_usuario = usuarios.id and posts.ficha_tipo = fichas.tipo and posts.id_ficha = fichas.id and (posts.id_usuario = $id_usuario or posts.id_usuario in (select id_usuario_2 from amigos where id_usuario_1 = $id_usuario)) order by posts.fecha desc limit 5";
    return $conn->consulta($sql);
  }

  /**
   * Comprobar si hay más posts que mostrar en la página de inicio
   */
  static function hayPostsBufferInicio($id_usuario)
  {
    $conn = new Conexion();
    $sql = "select count(*) from posts where id_usuario = $id_usuario or id_usuario in (select id_usuario_2 from amigos where id_usuario_1 = $id_usuario)";
    $consulta = $conn->consulta($sql);
    return $consulta[0][0] > 5;
  }

  /**
   * Obtener los posts "en cola" de la página de inicio
   */
  static function getPostsBufferInicio($id_usuario)
  {
    $conn = new Conexion();
    $sql = "select * from posts, fichas, usuarios where posts.id_usuario = usuarios.id and posts.ficha_tipo = fichas.tipo and posts.id_ficha = fichas.id and (posts.id_usuario = $id_usuario or posts.id_usuario in (select id_usuario_2 from amigos where id_usuario_1 = $id_usuario)) order by posts.fecha desc limit 5, 200";
    return $conn->consulta($sql);
  }

  /**
   * Obtener un post
   */
  static function getPost($id_post)
  {
    $conn = new Conexion();
    $sql = "select * from posts, fichas, usuarios where posts.id = $id_post and posts.id_ficha = fichas.id and posts.id_usuario = usuarios.id";
    return $conn->consulta($sql);
  }

  /**
   * Obtener los posts de una ficha
   */
  static function get_posts_ficha($tipo, $id)
  {
    $conn = new Conexion();
    $sql = "select * from posts, usuarios where posts.id_usuario = usuarios.id and posts.id_ficha = $id and posts.ficha_tipo = '$tipo' order by posts.fecha desc limit 5";
    return $conn->consulta($sql);
  }

  /**
   * Comprobar si hay más posts que mostrar en la página de la ficha
   */
  static function hayPostsBufferFicha($tipo, $id)
  {
    $conn = new Conexion();
    $sql = "select count(*) from posts where id_ficha = $id and ficha_tipo = '$tipo'";
    $consulta = $conn->consulta($sql);
    return $consulta[0][0] > 5;
  }

  /**
   * Obtener los posts "en cola" de la página de la ficha
   */
  static function getPostsBufferFicha($tipo, $id)
  {
    $conn = new Conexion();
    $sql = "select * from posts, usuarios where posts.id_usuario = usuarios.id and posts.id_ficha = $id and posts.ficha_tipo = '$tipo' order by posts.fecha desc limit 5, 200";
    return $conn->consulta($sql);
  }

  /**
   * Obtener los posts de un perfil
   */
  static function get_post_perfil($id_usuario)
  {
    $conn = new Conexion();
    $sql = "select * from posts, fichas where posts.id_ficha = fichas.id and posts.ficha_tipo = fichas.tipo and posts.id_usuario = $id_usuario order by fecha desc limit 5";
    return $conn->consulta($sql);
  }

  /**
   * Comprobar si hay más posts que mostrar en la página del perfil
   */
  static function hayPostsBufferPerfil($id_usuario)
  {
    $conn = new Conexion();
    $sql = "select count(*) from posts where id_usuario = $id_usuario";
    $consulta = $conn->consulta($sql);
    return $consulta[0][0] > 5;
  }

  /**
   * Obtener los posts "en cola" de la página del perfil
   */
  static function getPostsBufferPerfil($id_usuario)
  {
    $conn = new Conexion();
    $sql = "select * from posts, fichas where posts.id_ficha = fichas.id and posts.ficha_tipo = fichas.tipo and posts.id_usuario = $id_usuario order by fecha desc limit 5, 200";
    return $conn->consulta($sql);
  }

  /**
   * Obtener los posts denunciados
   */
  static function get_posts_denunciados()
  {
    $id_usuario_actual = $_SESSION["usuario"]->id;
    $conn = new Conexion();
    $sql = "select * from denuncias_posts, posts, usuarios, fichas where denuncias_posts.id_post = posts.id and posts.id_usuario = usuarios.id and posts.id_ficha = fichas.id and posts.ficha_tipo = fichas.tipo and usuarios.id != $id_usuario_actual";
    return $conn->consulta($sql);
  }
}

?>