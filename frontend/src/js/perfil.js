const editUserBtn = document.querySelector('#edit-username-btn');
const saveUserBtn = document.querySelector('#save-user-btn');
const cancelBtn = document.querySelector('#cancel-btn');
const usernameText = document.querySelector('#username-text');
const usernameInput = document.querySelector('#username-input');

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