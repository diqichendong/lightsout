<?php
require_once "config/Conexion.php";
require_once "model/Ficha.php";
require_once "model/Usuario.php";

class Post
{
  private $id;
  private Ficha $ficha;
  private Usuario $usuario;
  private $contenido;
  private $fecha;

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
    $sql = "select * from posts, fichas, usuarios where posts.id_usuario = usuarios.id and posts.id_ficha = fichas.id and posts.id_usuario = $id_usuario order by posts.fecha DESC";
    return $conn->consulta($sql);
  }

  static function getPost($id_post)
  {
    $conn = new Conexion();
    $sql = "select * from posts, fichas, usuarios where posts.id = $id_post and posts.id_ficha = fichas.id and posts.id_usuario = usuarios.id";
    return $conn->consulta($sql);
  }

  function __get($name)
  {
    return $this->$name;
  }
}

?>