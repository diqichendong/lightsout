import * as v from "/js/validar.js";

document.getElementById("enviar").addEventListener("click", (e) => {
  const form = document.forms[0];

  let login = form.elements["login"];
  let email = form.elements["email"];
  let pwd = form.elements["pwd"];
  let pwd_conf = form.elements["pwd-conf"];
  let nombre = form.elements["nombre"];
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
