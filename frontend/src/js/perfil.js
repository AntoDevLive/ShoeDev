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
}

const fileInput = document.getElementById('profile-img');
const previewImg = document.getElementById('preview-img');

fileInput.addEventListener('change', (e) => {
  const file = e.target.files[0];
  if (!file) return;

  const reader = new FileReader();
  reader.onload = () => {
    previewImg.src = reader.result;  // Muestra la imagen seleccionada
  };
  reader.readAsDataURL(file);
});


const formUserProfile = document.querySelector('#form-user-profile');

fileInput.addEventListener('click', () => {
  cancelBtn.classList.remove('hidden');
  saveUserBtn.classList.remove('hidden');
  editUserBtn.classList.add('hidden');
  formUserProfile.setAttribute('action', '/shoedev/user/subir.php');
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
    console.log('Actualizado correctamente');
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