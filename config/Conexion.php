<?php
require_once "config/config.php";

class Conexion
{
  protected PDO $con;

  function __construct()
  {
    try {
      $dsn = "mysql:host=" . DB_HOST . ";dbname=" . DB;
      $this->con = new PDO($dsn, DB_USER, DB_PASS);
      $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      echo "Error: " . $e->getMessage() . "<br>";
    }
  }

  function exec($sql)
  {
    try {
      $this->con->exec($sql);
      echo "ok: $sql <br>";
      return true;
    } catch (PDOException $e) {
      echo "no ok: " . $e->getMessage() . "<br>";
      return false;
    }
  }

  function query($sql)
  {
    try {
      $res = $this->con->query($sql);
      $res->closeCursor();
      return $res;
    } catch (PDOException $e) {
      echo "no ok: " . $e->getMessage() . "<br>";
      return false;
    }
  }

  function prepare($sql)
  {
    try {
      $res = $this->con->prepare($sql);
      return $res;
    } catch (PDOException $e) {
      echo "no ok: " . $e->getMessage() . "<br>";
      return false;
    }
  }

  function consulta($sql)
  {
    $consulta = $this->prepare($sql);
    $consulta->execute();
    $res = $consulta->fetchAll();
    return $res;
  }

  function __get($name)
  {
    if (isset($this->$name)) {
      return $this->$name;
    }
  }

}
?>