const loginLink = document.querySelector('#login-link');
const registerLink = document.querySelector('#register-link');
const registerForm = document.querySelector('#register-form');
const loginForm = document.querySelector('#login-form');
const loginImg = document.querySelector('#login-img');
const registerImg = document.querySelector('#register-img');


// Mostrar registro, ocultar login
function tabLogin() {

  loginForm.classList.remove('opacity-100');
  loginForm.classList.remove('z-10');
  loginForm.classList.add('pointer-events-none');
  loginForm.classList.add('opacity-0');

  registerForm.classList.remove('opacity-0');
  registerForm.classList.remove('pointer-events-none');
  registerForm.classList.add('opacity-100');
  registerForm.classList.add('z-10');

  loginImg.classList.remove('opacity-0');
  loginImg.classList.add('opacity-100');

  registerImg.classList.remove('opacity-100');
  registerImg.classList.add('opacity-0');

}

// Mostrar login, ocultar registro
function tabRegister() {

  registerForm.classList.add('opacity-0');
  registerForm.classList.remove('opacity-100');
  registerForm.classList.add('pointer-events-none');

  loginForm.classList.add('opacity-100');
  loginForm.classList.remove('opacity-0');
  loginForm.classList.remove('pointer-events-none');
  loginForm.classList.add('z-10');

  registerImg.classList.remove('opacity-0');
  registerImg.classList.add('opacity-100');

  loginImg.classList.remove('opacity-100');
  loginImg.classList.add('opacity-0');

}


function tabForm(form) {
  form === loginForm ? tabLogin() : tabRegister();
}


loginLink.addEventListener('click', () => tabForm(loginForm));
registerLink.addEventListener('click', () => tabForm(registerForm));

