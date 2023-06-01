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

  /**
   * Crea un nuevo usuario en la base de datos
   */
  function addUsuario($login, $pwd, $email, $nombre, $tipo)
  {
    $pwd = md5($pwd);
    $conn = new Conexion();
    $sql = "insert into usuarios (username, password, email, nombre, tipo, foto, sobre_mi) values ('$login', '$pwd', '$email', '$nombre', '$tipo', 'default.jpg', '')";

    return $conn->exec($sql);
  }

  /**
   * Comprueba si un usuario existe en la base de datos
   */
  function existeUsuario($login, $pwd)
  {
    $pwd = md5($pwd);
    $conn = new Conexion();
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
   * Comprobar si existe ya un username
   */
  static function existeUsername($username)
  {
    $conn = new Conexion();
    $sql = "select * from usuarios where username = '$username'";
    return sizeof($conn->consulta($sql)) > 0;
  }

  /**
   * Comprobar si existe ya un email
   */
  static function existeEmail($email)
  {
    $conn = new Conexion();
    $sql = "select * from usuarios where email = '$email'";
    return sizeof($conn->consulta($sql)) > 0;
  }

  /**
   * Edita la foto de un usuario
   */
  function editarFoto($foto)
  {
    $conn = new Conexion();
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
    $conn = new Conexion();
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
    $new_pwd = md5($new_pwd);
    $conn = new Conexion();
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
    $conn = new Conexion();
    $sql = "delete from usuarios where id = $this->id";
    $consulta = $conn->prepare($sql);
    $consulta->execute();
    return $consulta->rowCount() > 0;
  }

  /**
   * Obtener el perfil de un usuario
   */
  function obtener_usuario($id_usuario)
  {
    $conn = new Conexion();
    $sql = "select * from usuarios where id = $id_usuario";
    $consulta = $conn->consulta($sql);
    if (sizeof($consulta) > 0) {
      $this->id = $consulta[0]["id"];
      $this->nombre = $consulta[0]["nombre"];
      $this->username = $consulta[0]["username"];
      $this->foto = $consulta[0]["foto"];
      $this->sobre_mi = $consulta[0]["sobre_mi"];
      $this->tipo = $consulta[0]["tipo"];
      return true;
    } else {
      return false;
    }
  }

  /**
   * Comprueba si el usuario está siguiendo o no al otro usuario
   */
  function siguiendo($id_otro_usuario)
  {
    $conn = new Conexion();
    $sql = "select * from amigos where id_usuario_1 = $this->id and id_usuario_2 = $id_otro_usuario";
    $consulta = $conn->consulta($sql);

    return sizeof($consulta) != 0;
  }

  /**
   * Seguir a otro usuario
   */
  function seguir($id_otro_usuario)
  {
    $conn = new Conexion();
    $sql = "insert into amigos (id_usuario_1, id_usuario_2) values ($this->id, $id_otro_usuario)";
    $conn->exec($sql);
  }

  /**
   * Dejar de seguir a otro usuario
   */
  function dejar_seguir($id_otro_usuario)
  {
    $conn = new Conexion();
    $sql = "delete from amigos where id_usuario_1 = $this->id and id_usuario_2 = $id_otro_usuario";
    $conn->exec($sql);
  }

  /**
   * Obtener número de seguidores
   */
  function numero_seguidores()
  {
    $conn = new Conexion();
    $sql = "select count(*) from amigos where id_usuario_2 = $this->id";
    $consulta = $conn->consulta($sql);
    return $consulta[0][0];
  }

  /**
   * Obtener número de usuarios que sigo
   */
  function numero_siguiendo()
  {
    $conn = new Conexion();
    $sql = "select count(*) from amigos where id_usuario_1 = $this->id";
    $consulta = $conn->consulta($sql);
    return $consulta[0][0];
  }

  /**
   * Obtener todos los usuarios
   */
  static function get_usuarios()
  {
    $id_usuario_actual = $_SESSION["usuario"]->id;
    $conn = new Conexion();
    $sql = "select * from usuarios where id != $id_usuario_actual";
    return $conn->consulta($sql);
  }

  /**
   * Obtener usuario
   */
  static function get_usuario($id_usuario)
  {
    $conn = new Conexion();
    $sql = "select * from usuarios where id = $id_usuario";
    return $conn->consulta($sql)[0];
  }

  /**
   * Editar usuario
   */
  static function editar_usuario($id, $nombre, $username, $email, $tipo)
  {
    $conn = new Conexion();
    $sql = "update usuarios set nombre = '$nombre', username = '$username', email = '$email', tipo = '$tipo' where id = $id";
    $conn->exec($sql);
  }

  /**
   * Eliminar usuario
   */
  static function eliminar_usuario($id)
  {
    $conn = new Conexion();
    $sql = "delete from usuarios where id = $id";
    $conn->exec($sql);
  }

  /**
   * Buscar usuarios
   */
  static function buscar_usuarios($query)
  {
    $id_usuario_actual = $_SESSION["usuario"]->id;
    $conn = new Conexion();
    if ($query != "") {
      $sql = "select * from usuarios where id != $id_usuario_actual and (lower(nombre) like '%$query%' or lower(username) like '%$query%')";
    } else {
      $sql = "select * from usuarios where id != $id_usuario_actual";
    }
    return $conn->consulta($sql);
  }

  function __get($name)
  {
    return $this->$name;
  }
}

?>