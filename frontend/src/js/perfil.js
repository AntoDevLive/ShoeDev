const editUserBtn = document.querySelector('#edit-username-btn');
const editInfoBtn = document.querySelector('#edit-info-btn');
const saveUserBtn = document.querySelector('#save-user-btn');
const cancelBtn = document.querySelector('#cancel-btn');
const cancelInfoBtn = document.querySelector('#cancel-info-btn');
const infoForm = document.querySelector('#info-profile-form');
const usernameText = document.querySelector('#username-text');
const usernameInput = document.querySelector('#username-input');
const submitInfo = document.querySelector('#edit-info-submit');
const toastEdit = document.querySelector('#toast-edit');
const formUserProfile = document.querySelector('#form-user-profile');
const inputProfile = document.querySelector('#input-profile');
const inputConfirmarPassword = document.querySelector('#input-confirmar-password');
const passwordBtn = document.querySelector('#password-btn');
const eye = document.querySelector('#eye');
const eyeOff = document.querySelector('#eye-off');
const cerrarBtn = document.querySelector('#btn-cerrar');
const formEliminarCuenta = document.querySelector('#form-eliminar-cuenta');
const modalEliminar = document.querySelector('#modal-eliminar');
const eliminarCuentaBtn = document.querySelector('#eliminar-cuenta-btn');

editUserBtn.addEventListener('click', e => {
  e.preventDefault();
  mostrarCamposEditar();
})


cancelBtn.addEventListener('click', e => {
  e.preventDefault();
  ocultarCamposEditar();
});


function mostrarCamposEditar() {
  saveUserBtn.classList.remove('hidden');
  cancelBtn.classList.remove('hidden');
  editUserBtn.classList.add('hidden');
  usernameText.classList.add('hidden');
  usernameInput.classList.remove('hidden');
}

function ocultarCamposEditar() {
  saveUserBtn.classList.add('hidden');
  cancelBtn.classList.add('hidden');
  editUserBtn.classList.remove('hidden');
  usernameText.classList.remove('hidden');
  usernameInput.classList.add('hidden');
  inputProfile.setAttribute('value', 'setUsername');
}

const fileInput = document.getElementById('profile-img');
const previewImg = document.getElementById('preview-img');

fileInput.addEventListener('change', e => {
  const file = e.target.files[0];

  if (file) {
    // Usuario seleccionó imagen → SOLO mostrar GUARDAR
    saveUserBtn.classList.remove('hidden');
    editUserBtn.classList.add('hidden');

    // Ocultar cancelar
    cancelBtn.classList.add('hidden');

    // Actualizar preview
    const reader = new FileReader();
    reader.onload = () => {
      previewImg.src = reader.result;
    };
    reader.readAsDataURL(file);

    // Indicar al backend la acción
    inputProfile.value = 'profile-img';

  } else {
    saveUserBtn.classList.add('hidden');
    cancelBtn.classList.add('hidden');
    editUserBtn.classList.remove('hidden');
  }
});


editInfoBtn.addEventListener('click', enableForm);
cancelInfoBtn.addEventListener('click', disableForm);


function enableForm() {
  editInfoBtn.classList.add('hidden');
  infoForm.classList.remove('disabled');
  cancelInfoBtn.classList.remove('hidden');
}

function disableForm() {
  editInfoBtn.classList.remove('hidden');
  infoForm.classList.add('disabled');
  cancelInfoBtn.classList.add('hidden');
}

submitInfo.addEventListener('click', e => {
  e.preventDefault();
  editInfo();
  disableForm();
});


async function editInfo() {
  const formData = new FormData(infoForm);

  const res = await fetch('/shoedev/ajax.php', {
    method: 'POST',
    body: formData
  });

  const data = await res.json();

  if (data.status === 'success') {
    mostrarToast(data.message);
    setTimeout(() => {
      ocultarToast();
    }, 3000);

  } else {
    console.error('Error:', data.message);
  }
}


function mostrarToast(msg) {
  toastEdit.textContent = msg;
  toastEdit.classList.remove('-translate-x-full', 'opacity-0');
}

function ocultarToast() {
  toastEdit.classList.add('-translate-x-full', 'opacity-0');
}

passwordBtn.addEventListener('click', e => {

  e.preventDefault();

  eye.classList.toggle('hidden');
  eyeOff.classList.toggle('hidden');

  eye.classList.contains('hidden') ? inputConfirmarPassword.type = 'text' : inputConfirmarPassword.type = 'password';

});

cerrarBtn.addEventListener('click', e => {
  closeModalEliminar();
});

modalEliminar.addEventListener('click', () => {
  closeModalEliminar();
});

formEliminarCuenta.addEventListener('click', e => e.stopPropagation());

eliminarCuentaBtn.addEventListener('click', e => {
  e.stopPropagation();
  openModalEliminar();
}); 

function openModalEliminar() {
  modalEliminar.classList.remove('hidden');
}


function closeModalEliminar() {
    modalEliminar.classList.add('hidden');
    inputConfirmarPassword.value = '';
  }