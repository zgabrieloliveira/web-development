document.forms.signup.onsubmit = validate;

function validate(e) {
  let form = e.target;
  let valid = true;

  const errorUser = form.user.nextElementSibling;
  const errorPassword = form.password.nextElementSibling;
  const errorEmail = form.email.nextElementSibling;

  errorUser.textContent = "";
  errorPassword.textContent = "";
  errorEmail.textContent = "";

  if (form.user.value === "") {
    errorUser.textContent = "Campo obrigatório";
    valid = false;
  }
  if (form.password.value === "") {
    errorPassword.textContent = "Campo obrigatório";
    valid = false;
  }
  if (form.email.value === "") {
    errorEmail.textContent = "Campo obrigatório";
    valid = false;
  }

  if (!valid) {
    e.preventDefault();
  }
}

