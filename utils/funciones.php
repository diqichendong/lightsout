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

?>