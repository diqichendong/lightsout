const foto = document.getElementById("foto");
const archivo = document.getElementById("archivo");
const guardar = document.getElementById("guardar_foto");

// Cambiar foto en tiempo real
archivo.addEventListener("change", (e) => {
  if (validarFoto(e.target.files[0].name))
    foto.src = URL.createObjectURL(e.target.files[0]);
});

// Validar el archivo subido
guardar.addEventListener("click", (e) => {
  if (!validarFoto(archivo.files[0].name)) {
    const error_foto = document.getElementById("error_foto");
    error_foto.style.display = "block";
    e.preventDefault();
  }
});

/**
 * Valida si el archivo subido es una imagen
 * @param {string} nombre_archivo Nombre del archivo subido
 * @returns true si valida, false si no
 */
function validarFoto(nombre_archivo) {
  var extensiones_permitidas = ["jpg", "png"];
  var extension = nombre_archivo.split(".").pop().toLowerCase();

  for (let i = 0; i < extensiones_permitidas.length; i++) {
    if (extensiones_permitidas[i] == extension) {
      return true;
    }
  }
  return false;
}
