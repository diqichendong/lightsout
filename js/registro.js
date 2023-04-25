import * as v from "/js/validar.js";

document.getElementById("enviar").addEventListener("click", (e) => {
  const form = document.forms[0];

  let login = form.elements["login"].value.trim();
  let email = form.elements["email"].value.trim();
  let pwd = form.elements["pwd"].value.trim();
  let pwd_conf = form.elements["pwd-conf"].value.trim();
  let nombre = form.elements["nombre"].value.trim();
  let tcp = form.elements["tcp"].checked;

  if (
    !v.validarLogin(login) ||
    !v.validarEmail(email) ||
    !v.validarPwd(pwd, pwd_conf) ||
    !v.validarNombre(nombre) ||
    !v.validarTCP(tcp)
  ) {
    e.preventDefault();
  }
});
