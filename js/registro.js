document.getElementById("enviar").addEventListener("click", (e) => {
  const form = document.forms[0];

  let login = form.elements["login"].value.trim();
  let email = form.elements["email"].value.trim();
  let pwd = form.elements["pwd"].value.trim();
  let pwd_conf = form.elements["pwd-conf"].value.trim();
  let nombre = form.elements["nombre"].value.trim();
  let tcp = form.elements["tcp"].checked;

  if (
    !validarLogin(login) ||
    !validarEmail(email) ||
    !validarPwd(pwd, pwd_conf) ||
    !validarNombre(nombre) ||
    !validarTCP(tcp)
  ) {
    e.preventDefault();
  }
});

/**
 * Valida el campo usuario
 * @param {string} login Cadena login
 * @returns true si valida, false si no
 */
function validarLogin(login) {
  let patron = /^[0-9A-Za-z-_.]+$/;

  if (patron.test(login)) {
    return true;
  } else if (login.length == 0) {
    alert("El usuario no puede estar vacío.");
    return false;
  } else {
    alert("El formato del usuario es incorrecto.");
    return false;
  }
}

/**
 * Valida el campo correo electrónico
 * @param {string} email Cadena email
 * @returns true si valida, false si no
 */
function validarEmail(email) {
  console.log(email);
  let patron = /^[0-9a-z-_.]+[@][a-z0-9-_.]+[.][a-z]+$/;

  if (patron.test(email)) {
    return true;
  } else if (email.length == 0) {
    alert("El correo electrónico no puede estar vacío.");
    return false;
  } else {
    alert("El formato del correo electrónico es incorrecto.");
    return false;
  }
}

/**
 * Valida el campo contraseña y confirmar contraseña
 * @param {string} pwd Cadena pwd
 * @param {string} pwd_conf Cadena pwd_conf
 * @returns true si valida, false si no
 */
function validarPwd(pwd, pwd_conf) {
  let patron = /^[0-9A-Za-z-_.]+$/;

  if (patron.test(pwd)) {
    if (pwd == pwd_conf) {
      return true;
    } else {
      alert("La confirmación de contraseña no coincide con la contraseña.");
    }
  } else if (pwd.length == 0) {
    alert("La contraseña no puede estar vacía.");
    return false;
  } else {
    alert("El formato de la contraseña es incorrecto.");
    return false;
  }
}

/**
 * Valida el campo nombre
 * @param {string} nombre Cadena nombre
 * @returns true si valida, false si no
 */
function validarNombre(nombre) {
  let patron = /^[0-9A-Za-z-.\s\"\']+$/;

  if (patron.test(nombre)) {
    return true;
  } else if (nombre.length == 0) {
    alert("El nombre no puede estar vacío.");
    return false;
  } else {
    alert("El formato del nombre es incorrecto.");
    return false;
  }
}

/**
 * Valida el checkbox para aceptar términos y condiciones
 * @param {boolean} tcp Valor del checkbox
 * @returns true si valida, false si no
 */
function validarTCP(tcp) {
  if (tcp) {
    return true;
  } else {
    alert(
      "No se han aceptado los Términos y Condiciones de Uso y la Política de Privacidad."
    );
    return false;
  }
}
