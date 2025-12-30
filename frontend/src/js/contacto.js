// Regex para validar email
const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

const contactForm = document.getElementById('contact-form');
const contactEmail = document.getElementById('contact-email');
const contactSubject = document.getElementById('contact-subject');
const contactMessage = document.getElementById('contact-message');

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

// Función para limpiar mensaje de error
function clearError(form) {
    const msgEl = form.querySelector('.form-error');
    if (msgEl) msgEl.remove();
}

// Validación del formulario
function validateContact(e) {
    e.preventDefault();
    clearError(contactForm);

    let valid = true;

    [contactEmail, contactSubject, contactMessage].forEach(input => {
        if (!input.value.trim()) {
            input.classList.add('border-red-500', 'border-2', 'rounded-md');
            valid = false;
        }
    });

    if (contactEmail.value && !emailRegex.test(contactEmail.value)) {
        contactEmail.classList.add('border-red-500', 'border-2', 'rounded-md');
        showError(contactForm, 'El email no es válido.');
        return;
    }

    if (!valid) {
        showError(contactForm, 'Los campos marcados son obligatorios.');
        return;
    }

    enviarForm();
}

// Quitar error cuando el usuario escribe
function removeErrorOnInput(input) {
    input.addEventListener('input', () => {
        input.classList.remove('border-red-500', 'border-2', 'rounded-md');
        clearError(input.closest('form'));
    });
}

// Aplicar listeners
[contactEmail, contactSubject, contactMessage].forEach(removeErrorOnInput);
contactForm.addEventListener('submit', validateContact);


function enviarForm() {
    const toast = document.querySelector('#toast');
    toast.classList.remove('opacity-0', '-translate-y-full');
    contactForm.reset();
    setTimeout(() => {
        toast.classList.add('opacity-0', '-translate-y-full');
    }, 2500);
}