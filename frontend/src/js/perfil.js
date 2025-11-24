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


saveUserBtn.addEventListener('click', e => {
  e.preventDefault();
  ocultarCamposEditar();
  editarUser(usernameInput.getAttribute('data-id'));
})


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


const toast = document.querySelector('#toast');

async function editarUser(id) {
  try {
    const res = await fetch('/shoedev/textuser.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        id: id,
        username: usernameInput.value
      })
    });

    if (!res.ok) throw new Error('Error al actualizar el usuario');

    const data = await res.json();
    const toast = mostrarToast(data.message);
    setTimeout(() => {
      ocultarToast();
    }, 2000);

    if (data.success) {
      // Actualizar el DOM con el nuevo username
      usernameText.textContent = usernameInput.value;
      usernameInput.value = usernameInput.value; // opcional
    }

  } catch (error) {
    console.error(error);
    alert('No se pudo actualizar el usuario');
  }
}


function mostrarToast(msg) {
  toast.textContent = msg;
  toast.classList.remove('opacity-0');
  toast.classList.remove('-translate-x-full');
}

function ocultarToast() {
  toast.classList.add('opacity-0');
  toast.classList.add('-translate-x-full');
}