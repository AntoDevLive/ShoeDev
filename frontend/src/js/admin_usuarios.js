const searchInput = document.getElementById('searchInput');
const btnRecent = document.getElementById('btnRecent');
const btnOldest = document.getElementById('btnOldest');
const btnAdmin = document.getElementById('btnAdmin');
const btnStandard = document.getElementById('btnStandard');
const tbody = document.getElementById('usersTbody');
const toast = document.getElementById('toast');
const modalEliminar = document.querySelector('#modal-eliminar');
const dialogEliminar = document.querySelector('#dialog-modal-eliminar');
let rows = [];
let searchQuery = '';
let roleFilter = 'all'; // all | admin | standard
let sortOrder = 'recent'; // recent | oldest

// Helper: normaliza texto (quita diacríticos y a minúsculas)
function normalizeText(str = '') {
  return String(str)
    .normalize('NFD')
    .replace(/[\u0300-\u036f]/g, '') // quita acentos
    .toLowerCase();
}

// Aplica filtros y renderiza la tabla (muestra/oculta y ordena)
function filterAndRender() {
  const normalizedQuery = normalizeText(searchQuery.trim());

  // Filtrar
  let matches = rows.filter(row => {
    // rol dataset
    const rowRol = (row.dataset.rol || '').toLowerCase();

    // Filtrar por rol
    if (roleFilter === 'admin') {
      if (!rowRol.includes('admin')) return false;
    } else if (roleFilter === 'standard') {
      if (rowRol.includes('admin')) return false;
    }

    // Si la query está vacía, pasa
    if (!normalizedQuery) return true;

    // Construir string con el contenido de todas las celdas visibles
    const cells = Array.from(row.querySelectorAll('td')).map(td => td.textContent || '');
    const fullText = cells.join(' | ');
    const normalizedFull = normalizeText(fullText);

    return normalizedFull.includes(normalizedQuery);
  });

  // Ordenar según sortOrder usando data-id
  matches.sort((a, b) => {
    const idA = parseInt(a.dataset.id || '0', 10);
    const idB = parseInt(b.dataset.id || '0', 10);
    if (sortOrder === 'recent') {
      return idB - idA;
    } else {
      return idA - idB;
    }
  });

  // Limpiar tbody y reinsertar en el orden deseado
  const fragment = document.createDocumentFragment();

  if (matches.length === 0) {
    // Mostrar fila no results
    const noTr = document.createElement('tr');
    noTr.className = 'no-results';
    const cellsCount = document.querySelectorAll('#usersTable thead th').length || 1;
    noTr.innerHTML = `<td colspan="${cellsCount}" class="py-6 px-4">
      <div class="flex justify-center items-center flex-col text-gray-600">
      No se encontraron resultados
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-mood-sad"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" /><path d="M9 10l.01 0" /><path d="M15 10l.01 0" /><path d="M9.5 15.25a3.5 3.5 0 0 1 5 0" /></svg>
      </div>
      </td>`;
    fragment.appendChild(noTr);
  } else {
    matches.forEach(r => {
      fragment.appendChild(r);
    });
  }

  // Eliminar hijos y append del fragment
  while (tbody.firstChild) {
    tbody.removeChild(tbody.firstChild);
  }
  tbody.appendChild(fragment);
}

// Reset de estado visual de botones
function updateButtonStates() {
  // orden buttons
  if (sortOrder === 'recent') {
    btnRecent.classList.add('bg-orange-600', 'text-white');
    btnOldest.classList.remove('bg-orange-600', 'text-white');
  } else {
    btnOldest.classList.add('bg-orange-600', 'text-white');
    btnRecent.classList.remove('bg-orange-600', 'text-white');
  }

  // role buttons
  if (roleFilter === 'admin') {
    btnAdmin.classList.add('bg-orange-600', 'text-white');
    btnStandard.classList.remove('bg-orange-600', 'text-white');
  } else if (roleFilter === 'standard') {
    btnStandard.classList.add('bg-orange-600', 'text-white');
    btnAdmin.classList.remove('bg-orange-600', 'text-white');
  } else {
    btnAdmin.classList.remove('bg-orange-600', 'text-white');
    btnStandard.classList.remove('bg-orange-600', 'text-white');
  }
}

// Listar los usuarios en tiempo real
async function listarUsers() {
  try {
    const res = await fetch('/shoedev/backend/apis/usuarios/get_users.php');
    const usuarios = await res.json();

    tbody.innerHTML = '';

    usuarios.forEach(usuario => {
      const td = `
        <tr class="user-row hover:bg-orange-50 transition" data-id="${usuario.id}" data-rol="${usuario.rol}">
          <td class="py-3 px-4 id-cell"> ${usuario.id} </td>
          <td class="py-3 px-4 username-cell">${usuario.username}</td>
          <td class="py-3 px-4 email-cell">${usuario.email}</td>
          <td class="py-3 px-4 capitalize nombre-cell">${usuario.nombre}</td>
          <td class="py-3 px-4 capitalize apellidos-cell">${usuario.apellidos}</td>
          <td class="py-3 px-4 capitalize direccion-cell">${usuario.direccion}</td>
          <td class="py-3 px-4 nacimiento-cell">${usuario.nacimiento}</td>
          <td class="py-3 px-4">
            <span class="bg-orange-100 text-orange-700 px-2 py-1 rounded-full text-xs font-semibold capitalize rol-cell">${usuario.rol}</span>
          </td>
          <td class="py-3 px-4">
            <div class="flex gap-3 justify-center">
              <button class="edit-user-btn px-3 py-1 text-sm bg-blue-500 hover:bg-blue-600 text-white rounded-md transition cursor-pointer">Editar</button>
              <button class="delete-user-btn px-3 py-1 text-sm bg-red-500 hover:bg-red-600 text-white rounded-md transition cursor-pointer">Eliminar</button>
            </div>
          </td>
        </tr>
      `;

      tbody.innerHTML += td;
    });

    // btns editar
    document.querySelectorAll('.edit-user-btn').forEach(btn => {
      btn.onclick = () => {
        const id = btn.closest('.user-row').querySelector('.id-cell').textContent;
        const username = btn.closest('.user-row').querySelector('.username-cell').textContent;
        const email = btn.closest('.user-row').querySelector('.email-cell').textContent;
        const nombre = btn.closest('.user-row').querySelector('.nombre-cell').textContent;
        const apellidos = btn.closest('.user-row').querySelector('.apellidos-cell').textContent;
        const direccion = btn.closest('.user-row').querySelector('.direccion-cell').textContent;
        const nacimiento = btn.closest('.user-row').querySelector('.nacimiento-cell').textContent;
        const rol = btn.closest('.user-row').querySelector('.rol-cell').textContent;
        openModalForm(id, username, email, nombre, apellidos, direccion, nacimiento, rol);
      } 
    });


    //btns eliminar
    document.querySelectorAll('.delete-user-btn').forEach(btn => {
      btn.onclick = () => {
        const id = btn.closest('.user-row').querySelector('.id-cell').textContent;
        openDialogEliminar(id);
      }
    });

    // Actualizar el array rows después de cargar los usuarios
    rows = Array.from(tbody.querySelectorAll('tr.user-row'));

    // Aplicar los filtros actuales a los nuevos datos
    filterAndRender();

  } catch (error) {
    console.log(error);
  }
}


// Handle modal eliminar
function openDialogEliminar(id) {
  modalEliminar.classList.remove('hidden');
  const btnEliminar = document.querySelector('#btn-dialog-eliminar');
  const btnCancelarEliminar = document.querySelector('#btn-dialog-cancelar');

  // Reemplaza cualquier listener anterior
  btnEliminar.onclick = async () => {
    await deleteUser(id);
  };
  btnCancelarEliminar.onclick = closeDialogEliminar;

  modalEliminar.onclick = closeDialogEliminar;
  dialogEliminar.onclick = e => e.stopPropagation();
}



function closeDialogEliminar() {
  modalEliminar.classList.add('hidden');
}


async function deleteUser(id) {

  try {

    const res = await fetch('/shoedev/backend/apis/usuarios/delete_user.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({id})
    });

    const data = await res.json();
    listarUsers();
    closeDialogEliminar();
    mostrarToast(data.message);
    setTimeout(() => {
      ocultarToast();
    }, 3000);

  } catch(error) {
    console.log(error);
  }
}


// Event listeners
document.addEventListener('DOMContentLoaded', function () {

  searchInput.addEventListener('input', function (e) {
    searchQuery = e.target.value;
    filterAndRender();
  });

  btnRecent.addEventListener('click', function () {
    sortOrder = 'recent';
    updateButtonStates();
    filterAndRender();
  });

  btnOldest.addEventListener('click', function () {
    sortOrder = 'oldest';
    updateButtonStates();
    filterAndRender();
  });

  btnAdmin.addEventListener('click', function () {
    roleFilter = (roleFilter === 'admin') ? 'all' : 'admin';
    updateButtonStates();
    filterAndRender();
  });

  btnStandard.addEventListener('click', function () {
    roleFilter = (roleFilter === 'standard') ? 'all' : 'standard';
    updateButtonStates();
    filterAndRender();
  });

  // Inicial
  updateButtonStates();

  // Cargar usuarios al inicio
  listarUsers();
});


// Validación form
const form = document.getElementById("user-form");
const errorMsg = document.getElementById("errorMsg");

const idInput = document.getElementById("id");
const usuarioInput = document.getElementById("usuario");
const emailInput = document.getElementById("email");
const nombreInput = document.getElementById("nombre");
const apellidosInput = document.getElementById("apellidos");
const direccionInput = document.getElementById("direccion");
const nacimientoInput = document.getElementById("nacimiento");
const rolSelect = document.getElementById("rol");

const modalForm = document.getElementById("modal-form");
const cerrarBtn = document.getElementById("cerrar-btn");

// Limpiar errores
function limpiarErrores() {
  errorMsg.classList.add("hidden");
  errorMsg.textContent = "";
  form.querySelectorAll(".border-red-500").forEach(el => {
    el.classList.remove("border-red-500", "border-2");
  });
}

// Marcar error visual
function marcarError(input) {
  input.classList.add("border-red-500", "border-2");
}

// Validación del formulario
function validarFormulario() {
  limpiarErrores();
  const errores = [];

  if (usuarioInput.value.trim() === "") {
    errores.push("Usuario");
    marcarError(usuarioInput);
  }

  if (emailInput.value.trim() === "") {
    errores.push("Email");
    marcarError(emailInput);
  }

  if (nombreInput.value.trim() === "") {
    errores.push("Nombre");
    marcarError(nombreInput);
  }

  if (apellidosInput.value.trim() === "") {
    errores.push("Apellidos");
    marcarError(apellidosInput);
  }

  if (direccionInput.value.trim() === "") {
    errores.push("Dirección");
    marcarError(direccionInput);
  }

  if (nacimientoInput.value === "") {
    errores.push("Nacimiento");
    marcarError(nacimientoInput);
  }

  if (rolSelect.value.includes("Seleccionar")) {
    errores.push("Rol");
    marcarError(rolSelect);
  }

  if (errores.length > 0) {
    errorMsg.textContent = `Los siguientes campos son obligatorios o inválidos: ${errores.join(", ")}.`;
    errorMsg.classList.remove("hidden");
    return false;
  }

  return true;
}

// Evento submit
form.addEventListener("submit", async e => {
  e.preventDefault();

  if (validarFormulario()) {
    await updateUser();
    closeModalForm();
  }
});


// update con AJAX
async function updateUser() {
  try {
    const formData = new FormData(form);

    const res = await fetch('/shoedev/backend/apis/usuarios/edit_user_info.php', {
      method: 'POST',
      body: formData
    });

    const data = await res.json();
    listarUsers();
    mostrarToast(data.message);
    setTimeout(() => {
      ocultarToast();
    }, 3000);

  } catch (error) {
    console.log(error);
  }
}


function mostrarToast(msg) {
  toast.textContent = msg;
  toast.classList.remove('-translate-x-full', 'opacity-0');
}

function ocultarToast() {
  toast.classList.add('-translate-x-full', 'opacity-0');
}



function closeModalForm() {
  form.reset();
  modalForm.classList.add("hidden");
  limpiarErrores();
}

function openModalForm(id, usuario, email, nombre, apellidos, direccion, nacimiento, rol) {
  modalForm.classList.remove("hidden");
  idInput.value = id;
  usuarioInput.value = usuario;
  emailInput.value = email;
  nombreInput.value = nombre;
  apellidosInput.value = apellidos;
  direccionInput.value = direccion;
  nacimientoInput.value = nacimiento;
  rolSelect.value = rol.toLowerCase().trim();
}

cerrarBtn.addEventListener("click", e => {
  e.preventDefault();
  closeModalForm();
});

modalForm.addEventListener("click", closeModalForm);
form.addEventListener("click", e => e.stopPropagation());
