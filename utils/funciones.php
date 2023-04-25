<?php

/**
 * Formatea la el timestamp de la base de datos a una fecha
 */
function formatear_fecha($timestamp)
{
  $fecha = explode(" ", $timestamp)[0];
  $fecha_arr = explode("-", $fecha);
  return "$fecha_arr[2]/$fecha_arr[1]/$fecha_arr[0]";
}

/**
 * Formato nota media
 */
function formato_nota_media($nota_media)
{
  $nota = "" . $nota_media;
  $arr = explode(".", $nota);
  if ($arr[1] == "0") {
    return $arr[0];
  }
  return $nota_media;
}

?>