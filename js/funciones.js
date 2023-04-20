/**
 * Formatear una fecha que está en formato timestamp de la base de datos
 * @param {string} timestamp Fecha en formato timestamp
 * @returns Fecha en formato dd/mm/aaaa
 */
export function obtener_fecha(timestamp) {
  let fecha = timestamp.split(" ")[0];
  let fecha_arr = fecha.split("-");
  return fecha_arr[2] + "/" + fecha_arr[1] + "/" + fecha_arr[0];
}
