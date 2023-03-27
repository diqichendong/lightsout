document.getElementById("enviar").addEventListener("click", (e) => {
  const form = document.forms[0];

  let login = form.elements["login"].value.trim();
  let pwd = form.elements["pwd"].value.trim();

  if (!validarLogin(login) || !validarPwd(pwd)) {
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
 * Valida el campo contraseña
 * @param {string} pwd Cadena pwd
 * @returns true si valida, false si no
 */
function validarPwd(pwd, pwd_conf) {
  let patron = /^[0-9A-Za-z-_.]+$/;

  if (patron.test(pwd)) {
    return true;
  } else if (pwd.length == 0) {
    alert("La contraseña no puede estar vacía.");
    return false;
  } else {
    alert("El formato de la contraseña es incorrecto.");
    return false;
  }
}
