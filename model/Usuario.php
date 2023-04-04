<?php
require_once "config/Conexion.php";

class Usuario
{

  private $id;
  private $nombre;
  private $username;
  private $password;
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

  /**
   * Crea un nuevo usuario en la base de datos
   */
  function addUsuario($login, $pwd, $email, $nombre, $tipo)
  {
    $conn = $this->setConexion();
    $sql = "insert into usuarios (username, password, email, nombre, tipo, foto, sobre_mi) values ('$login', '$pwd', '$email', '$nombre', '$tipo', 'default.jpg', '')";

    return $conn->exec($sql);
  }

  /**
   * Comprueba si un usuario existe en la base de datos
   */
  function existeUsuario($login, $pwd)
  {
    $conn = $this->setConexion();
    $sql = "select * from usuarios where username = '$login' and password = '$pwd'";
    $consulta = $conn->consulta($sql);

    if (count($consulta) > 0) {
      $this->id = $consulta[0]["id"];
      $this->nombre = $consulta[0]["nombre"];
      $this->username = $consulta[0]["username"];
      $this->password = $consulta[0]["password"];
      $this->email = $consulta[0]["email"];
      $this->foto = $consulta[0]["foto"];
      $this->sobre_mi = $consulta[0]["sobre_mi"];
      $this->tipo = $consulta[0]["tipo"];
      return true;
    } else {
      return false;
    }
  }

  /**
   * Edita la foto de un usuario
   */
  function editarFoto($foto)
  {
    $conn = $this->setConexion();
    $sql = "update usuarios set foto = '$foto' where id = $this->id";
    $consulta = $conn->prepare($sql);
    $consulta->execute();
    $this->foto = $foto;
  }

  /**
   * Actualiza los datos del usuario
   */
  function actualizarDatos($nombre, $username, $sobre_mi)
  {
    $conn = $this->setConexion();
    $sql = "update usuarios set nombre = '$nombre', username = '$username', sobre_mi = '$sobre_mi' where id = $this->id";
    $consulta = $conn->prepare($sql);
    $consulta->execute();
    if ($consulta->rowCount() > 0) {
      $this->nombre = $nombre;
      $this->username = $username;
      $this->sobre_mi = $sobre_mi;
      return true;
    } else {
      return false;
    }
  }

  /**
   * Actualizar contraseña
   */
  function actualizarPassword($new_pwd)
  {
    $conn = $this->setConexion();
    $sql = "update usuarios set password = '$new_pwd' where id = $this->id";
    $consulta = $conn->prepare($sql);
    $consulta->execute();
    if ($consulta->rowCount() > 0) {
      $this->password = $new_pwd;
      return true;
    } else {
      return false;
    }
  }

  /**
   * Eliminar usuario
   */
  function eliminarUsuario()
  {
    $conn = $this->setConexion();
    $sql = "delete from usuarios where id = $this->id";
    $consulta = $conn->prepare($sql);
    $consulta->execute();
    return $consulta->rowCount() > 0;
  }


  function __get($name)
  {
    return $this->$name;
  }

}

?>