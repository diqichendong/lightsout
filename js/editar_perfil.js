import * as v from "./validar.js";

const foto = document.getElementById("foto");
const archivo = document.getElementById("archivo");
const guardar = document.getElementById("guardar_foto");
const guardar_datos = document.getElementById("guardar_datos");
const cambiar_pwd = document.getElementById("cambiar_pwd");
const eliminar_cuenta = document.getElementById("eliminar_cuenta");

// Cambiar foto en tiempo real
archivo.addEventListener("change", (e) => {
  if (v.validarFoto(e.target.files[0].name))
    foto.src = URL.createObjectURL(e.target.files[0]);
});

// Validar el archivo subido
guardar.addEventListener("click", (e) => {
  if (!v.validarFoto(archivo.files[0].name)) {
    const error_foto = document.getElementById("error_foto");
    error_foto.style.display = "block";
    e.preventDefault();
  }
});

// Validar datos usuario
guardar_datos.addEventListener("click", (e) => {
  let nombre = document.getElementById("nombre");
  let usuario = document.getElementById("usuario");
  if (!v.validarNombre(nombre) || !v.validarLogin(usuario)) {
    e.preventDefault();
  }
});

// Validar contraseñas del usuario
cambiar_pwd.addEventListener("click", (e) => {
  let new_pass = document.getElementById("new-pass");
  let new_pass_conf = document.getElementById("new-pass-conf");
  if (!v.validarPwd(new_pass, new_pass_conf)) {
    e.preventDefault();
  }
});

// Confirmar eliminar cuenta
eliminar_cuenta.addEventListener("click", (e) => {
  if (!confirm("¿Estás seguro que quieres eliminar tu cuenta?")) {
    e.preventDefault();
  }
});
