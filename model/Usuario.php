<?php
require_once "config/Conexion.php";

class Usuario
{

  private $nombre;
  private $username;
  private $email;
  private $foto;
  private $sobre_mi;
  private $tipo;

  function __construct()
  {

  }

  private function setConexion()
  {
    return new Conexion();
  }

  function addUsuario($login, $pwd, $email, $nombre, $tipo)
  {
    $conn = $this->setConexion();
    $sql = "insert into usuarios (username, password, email, nombre, tipo, foto, sobre_mi) values ('$login', '$pwd', '$email', '$nombre', '$tipo', 'default.jpg', '')";

    return $conn->exec($sql);
  }

  function existeUsuario($login, $pwd)
  {
    $conn = $this->setConexion();
    $sql = "select * from usuarios where username = '$login' and password = '$pwd'";
    $consulta = $conn->consulta($sql);

    if (count($consulta) > 0) {
      $this->nombre = $consulta[0]["nombre"];
      $this->username = $consulta[0]["username"];
      $this->email = $consulta[0]["email"];
      $this->foto = $consulta[0]["foto"];
      $this->sobre_mi = $consulta[0]["sobre_mi"];
      $this->tipo = $consulta[0]["tipo"];
      return true;
    } else {
      return false;
    }
  }

}

?>