const loginLink = document.querySelector('#login-link');
const registerLink = document.querySelector('#register-link');
const registerForm = document.querySelector('#register-form');
const loginForm = document.querySelector('#login-form');
const loginImg = document.querySelector('#login-img');
const registerImg = document.querySelector('#register-img');
const showPassLogin = document.querySelector('#show-password');
const showPassReg = document.querySelector('#show-password-reg');
const submitLogin = document.querySelector('#submit-login');
const submitReg = document.querySelector('#submit-reg');


// Mostrar registro, ocultar login
function tabLogin() {

    loginForm.reset();

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

    registerForm.reset();

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


showPassLogin.addEventListener('change', () => {
    const password = document.querySelector('#password-login');
    password.type === 'password' ? password.type = 'text' : password.type = 'password';
});

if (showPassReg) {
    showPassReg.addEventListener('change', () => {
        const passwordReg = document.querySelector('#pass-reg');
        const passwordRepReg = document.querySelector('#pass-rep-reg');
        if (passwordReg && passwordRepReg) {
            const newType = passwordReg.type === 'password' ? 'text' : 'password';
            passwordReg.type = newType;
            passwordRepReg.type = newType;
        }
    });
}

// Regex para email
const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

// Función para mostrar mensaje de error
function showError(form, message) {
    let msgEl = form.querySelector('.form-error');
    if (!msgEl) {
        msgEl = document.createElement('p');
        msgEl.className = 'form-error text-red-600 text-center mb-2';
        form.insertBefore(msgEl, form.querySelector('input[type="submit"]'));
    }
    msgEl.textContent = message;
}

// limpiar mensaje de error
function clearError(form) {
    const msgEl = form.querySelector('.form-error');
    if (msgEl) msgEl.remove();
}

// validar login
async function validateLogin(e) {
    e.preventDefault();
    const email = document.getElementById('email-login');
    const password = document.getElementById('password-login');

    let valid = true;
    clearError(loginForm);

    [email, password].forEach(input => {
        if (!input.value.trim()) {
            input.classList.add('border-red-500', 'border-2', 'rounded-md');
            valid = false;
        }
    });

    if (email.value && !emailRegex.test(email.value)) {
        email.classList.add('border-red-500', 'border-2', 'rounded-md');
        showError(loginForm, 'El email no es válido.');
        return;
    }

    if (!valid) {
        showError(loginForm, 'Los campos marcados son obligatorios.');
        return;
    }

    try {
        const res = await fetch('/shoedev/backend/apis/usuarios/verificar_login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                email: email.value.trim(),
                password: password.value.trim()
            })
        });

        const data = await res.json();
        if (data.message === 'wrong email' || data.message === 'wrong password') {

            let msg = document.querySelector('.login-error-msg');

            if (!msg) {
                msg = document.createElement('p');
                msg.textContent = 'Usuario o contraseña incorrectos';
                msg.classList.add('login-error-msg', 'text-red-600', 'text-lg', 'font-semibold');
                submitLogin.before(msg);
            }

        } else {
            const msg = document.querySelector('.login-error-msg');
            if (msg) msg.remove();
            loginForm.submit();

        }


    } catch (error) {
        console.error('Error en el login');
    }

}

// Función para validar registro
async function validateRegister(e) {
    e.preventDefault();

    const username = document.getElementById('username');

    const fields = [
        document.getElementById('nombre'),
        document.getElementById('apellidos'),
        document.getElementById('nacimiento'),
        document.getElementById('direccion'),
        document.getElementById('correo-reg'),
        document.getElementById('username'),
        document.getElementById('pass-reg'),
        document.getElementById('pass-rep-reg')
    ];

    clearError(registerForm);
    let errors = [];

    // Validar campos vacíos
    fields.forEach(input => {
        if (!input.value.trim()) {
            input.classList.add('border-red-500', 'border-2', 'rounded-md');
            if (!errors.includes('Los campos marcados son obligatorios')) {
                errors.push('Los campos marcados son obligatorios');
            }
        }
    });

    // Validar email
    const email = document.getElementById('correo-reg');
    if (email.value && !emailRegex.test(email.value)) {
        email.classList.add('border-red-500', 'border-2', 'rounded-md');
        errors.push('El email no es válido');
    }

    // Validar que las contraseñas coincidan
    const pass = document.getElementById('pass-reg');
    const passRep = document.getElementById('pass-rep-reg');
    if (pass.value && passRep.value && pass.value !== passRep.value) {
        pass.classList.add('border-red-500', 'border-2', 'rounded-md');
        passRep.classList.add('border-red-500', 'border-2', 'rounded-md');
        errors.push('Las contraseñas no coinciden');
    }

    if (errors.length > 0) {
        showError(registerForm, errors.join('. '));
        return;
    }


    try {
        const res = await fetch('/shoedev/backend/apis/usuarios/verificar_registro.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                email: email.value.trim(),
                username: username.value.trim()
            })
        });

        if (!res.ok) {
            throw new Error('Error en la respuesta del servidor');
        }

        const data = await res.json();

        let msg = document.querySelector('.login-error-msg');

        if (!msg) {
            msg = document.createElement('p');
            msg.classList.add(
                'login-error-msg',
                'text-red-600',
                'text-lg',
                'font-semibold'
            );
            submitReg.before(msg);
        }

        if (data.message === 'used email') {
            msg.textContent = 'El email ya existe';
        }
        else if (data.message === 'used username') {
            msg.textContent = 'Nombre de usuario no disponible';
        }
        else if (data.message === 'success') {
            msg.remove();
            registerForm.submit();
        }

    } catch (error) {
        console.error('Error en el registro:', error);

        let msg = document.querySelector('.login-error-msg');

        if (!msg) {
            msg = document.createElement('p');
            msg.classList.add(
                'login-error-msg',
                'text-red-600',
                'text-lg',
                'font-semibold'
            );
            submitReg.before(msg);
        }

        msg.textContent = 'Error inesperado. Intenta nuevamente.';
    }


}

// Quitar error cuando el usuario escribe
function removeErrorOnInput(input) {
    input.addEventListener('input', () => {
        input.classList.remove('border-red-500', 'border-2', 'rounded-md');
        clearError(input.closest('form'));
    });
}

// Aplicar listeners a todos los inputs
document.querySelectorAll('#login-form input').forEach(removeErrorOnInput);
document.querySelectorAll('#register-form input').forEach(removeErrorOnInput);

// Escuchar submit
loginForm.addEventListener('submit', validateLogin);
registerForm.addEventListener('submit', validateRegister);
