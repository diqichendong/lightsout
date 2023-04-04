import * as v from "./validar.js";

document.getElementById("enviar").addEventListener("click", (e) => {
  const form = document.forms[0];

  let login = form.elements["login"].value.trim();
  let pwd = form.elements["pwd"].value.trim();

  if (!v.validarLogin(login) || !v.validarPwd(pwd)) {
    e.preventDefault();
  }
});
