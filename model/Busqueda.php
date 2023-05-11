<?php
require_once "config/Conexion.php";
require_once "model/Usuario.php";

class Busqueda
{

  function __construct()
  {

  }

  static function buscar_usuario($query)
  {
    $id_usuario = $_SESSION["usuario"]->id;
    $conn = new Conexion();
    $sql = "select * from usuarios where (lower(nombre) like '%$query%' or lower(username) like '%$query%') and id != $id_usuario";
    return $conn->consulta($sql);
  }

  function __get($name)
  {
    return $this->$name;
  }
}

?>