/**
 * Valida el campo usuario
 * @param login Campo login
 * @returns true si valida, false si no
 */
export function validarLogin(login) {
  let patron = /^[0-9A-Za-z-_.]+$/;
  let login_str = login.value.trim();
  login.classList.remove("is-valid");
  login.classList.remove("is-invalid");

  if (login_str.length > 30) {
    alert("El usuario no puede superar los 30 caracteres.");
    login.classList.add("is-invalid");
    return false;
  } else if (login_str.length == 0) {
    alert("El usuario no puede estar vacío.");
    login.classList.add("is-invalid");
    return false;
  } else if (patron.test(login_str)) {
    login.classList.add("is-valid");
    return true;
  } else {
    alert("El formato del usuario es incorrecto.");
    login.classList.add("is-invalid");
    return false;
  }
}

/**
 * Valida el campo correo electrónico
 * @param email Campo email
 * @returns true si valida, false si no
 */
export function validarEmail(email) {
  let patron = /^[0-9a-z-_.]+[@][a-z0-9-_.]+[.][a-z]+$/;
  let email_str = email.value.trim();
  email.classList.remove("is-valid");
  email.classList.remove("is-invalid");

  if (email_str.length == 0) {
    alert("El correo electrónico no puede estar vacío.");
    email.classList.add("is-invalid");
    return false;
  } else if (patron.test(email_str)) {
    email.classList.add("is-valid");
    return true;
  } else {
    alert("El formato del correo electrónico es incorrecto.");
    email.classList.add("is-invalid");
    return false;
  }
}

/**
 * Valida el campo contraseña y confirmar contraseña
 * @param pwd Campo contraseña
 * @param pwd_conf Campo confirmar contraseña
 * @returns true si valida, false si no
 */
export function validarPwd(pwd, pwd_conf) {
  let patron = /^[0-9A-Za-zÀ-ÿ\u00f1\u00d1\-\_\.]+$/;
  let pwd_str = pwd.value.trim();
  let pwd_conf_str = pwd_conf.value.trim();
  pwd.classList.remove("is-valid");
  pwd.classList.remove("is-invalid");
  pwd_conf.classList.remove("is-valid");
  pwd_conf.classList.remove("is-invalid");

  if (pwd_str.length == 0) {
    alert("La contraseña no puede estar vacía.");
    pwd.classList.add("is-invalid");
    return false;
  } else if (patron.test(pwd_str)) {
    if (pwd_str == pwd_conf_str) {
      pwd.classList.add("is-valid");
      pwd_conf.classList.add("is-valid");
      return true;
    } else {
      alert("La confirmación de contraseña no coincide con la contraseña.");
      pwd.classList.add("is-valid");
      pwd_conf.classList.add("is-invalid");
      return false;
    }
  } else {
    alert("El formato de la contraseña es incorrecto.");
    pwd.classList.add("is-invalid");
    return false;
  }
}

/**
 * Valida el campo nombre
 * @param nombre Campo nombre
 * @returns true si valida, false si no
 */
export function validarNombre(nombre) {
  let patron = /^[0-9A-Za-zÀ-ÿ\u00f1\u00d1\-\.\s\"\']+$/;
  let nombre_str = nombre.value.trim();
  nombre.classList.remove("is-valid");
  nombre.classList.remove("is-invalid");

  if (nombre_str.length > 30) {
    alert("El nombre no puede superar los 30 caracteres.");
    nombre.classList.add("is-invalid");
    return false;
  } else if (nombre_str.length == 0) {
    alert("El nombre no puede estar vacío.");
    nombre.classList.add("is-invalid");
    return false;
  } else if (patron.test(nombre_str)) {
    nombre.classList.add("is-valid");
    return true;
  } else {
    alert("El formato del nombre es incorrecto.");
    nombre.classList.add("is-invalid");
    return false;
  }
}

/**
 * Valida el checkbox para aceptar términos y condiciones
 * @param {boolean} tcp Valor del checkbox
 * @returns true si valida, false si no
 */
export function validarTCP(tcp) {
  if (tcp) {
    return true;
  } else {
    alert(
      "No se han aceptado los Términos y Condiciones de Uso y la Política de Privacidad."
    );
    return false;
  }
}

/**
 * Valida si el archivo subido es una imagen
 * @param {string} nombre_archivo Nombre del archivo subido
 * @returns true si valida, false si no
 */
export function validarFoto(nombre_archivo) {
  var extensiones_permitidas = ["jpg", "png"];
  var extension = nombre_archivo.split(".").pop().toLowerCase();

  for (let i = 0; i < extensiones_permitidas.length; i++) {
    if (extensiones_permitidas[i] == extension) {
      return true;
    }
  }
  return false;
}

/**
 * Valida el contenido de un post
 * @param {string} contenido Contenido del post
 * @returns true si valida, false si no
 */
export function validarContenido(contenido) {
  if (contenido.length < 500) {
    return true;
  } else {
    alert("El contenido no puede superar los 500 caracteres.");
    return false;
  }
}

/**
 * Valida el comentario de un post
 * @param {string} comentario comentario
 * @returns true si valida, false si no
 */
export function validarComentario(comentario) {
  if (comentario.length < 255) {
    return true;
  } else {
    alert("El comentario no puede superar los 255 caracteres.");
    return false;
  }
}

/**
 * Valida el "sobre mí"
 * @param {string} sobre_mi sobre mí
 * @returns true si valida, false si no
 */
export function validarSobreMi(sobre_mi) {
  if (sobre_mi.length < 255) {
    return true;
  } else {
    alert("El apartado sobre mí no puede superar los 255 caracteres.");
    return false;
  }
}
