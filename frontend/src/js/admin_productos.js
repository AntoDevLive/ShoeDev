const inputFile = document.getElementById("imagen");
const preview = document.getElementById("preview");
const cerrarBtn = document.getElementById("cerrar-btn");
const form = document.querySelector("form");
const errorMsg = document.getElementById("errorMsg");
const titleInput = form.querySelector('input[placeholder="Título del producto"]');
const descriptionInput = form.querySelector("textarea");
const brandSelect = form.querySelector("select");
const stockInput = form.querySelector('input[placeholder="Stock"]');
const priceInput = form.querySelector('input[placeholder="Precio"]');
const modalForm = document.querySelector('#modal-form');
const nuevoProductoBtn = document.querySelector('#nuevo-producto-btn');
const toast = document.querySelector('#toast');
const submit = document.querySelector('#submit');

const sectionNike = document.querySelector('#productos-nike');
const sectionAdidas = document.querySelector('#productos-adidas');
const sectionPuma = document.querySelector('#productos-puma');
const actionInput = document.querySelector('#action-input');

const modalEliminar = document.querySelector('#modal-eliminar');
const dialogModalEliminar = document.querySelector('#dialog-modal-eliminar');
const btnDialogEliminar = document.querySelector('#btn-dialog-eliminar');
const btnDialogCancelar = document.querySelector('#btn-dialog-cancelar');


// Preview imagen
function mostrarPreview(file) {
  const reader = new FileReader();

  reader.onload = function (e) {
    const img = document.createElement("img");
    img.src = e.target.result;
    img.className = "w-full h-full object-cover";

    preview.innerHTML = "";
    preview.appendChild(img);
    preview.classList.remove("hidden");
  };

  reader.readAsDataURL(file);
}

inputFile.addEventListener("change", function () {
  if (this.files && this.files[0]) {
    mostrarPreview(this.files[0]);
  }
});


// Validación
function limpiarErrores() {
  errorMsg.classList.add("hidden");
  errorMsg.textContent = "";
  form.querySelectorAll(".border-red-500").forEach(el => {
    el.classList.remove("border-red-500", "border-2");
  });
}

function marcarError(input) {
  input.classList.add("border-red-500", "border-2");
}

function validarFormulario() {
  limpiarErrores();
  const errores = [];

  if (titleInput.value.trim() === "") {
    errores.push("Título");
    marcarError(titleInput);
  }

  if (descriptionInput.value.trim() === "") {
    errores.push("Descripción");
    marcarError(descriptionInput);
  }

  if (brandSelect.value === "" || brandSelect.value.includes("Seleccionar")) {
    errores.push("Marca");
    marcarError(brandSelect);
  }

  if (stockInput.value.trim() === "") {
    errores.push("Stock");
    marcarError(stockInput);
  }

  if (priceInput.value.trim() === "") {
    errores.push("Precio");
    marcarError(priceInput);
  } else {
    const normalizedPrice = priceInput.value.replace(",", ".");
    const priceNumber = parseFloat(normalizedPrice);

    if (isNaN(priceNumber) || priceNumber < 0) {
      errores.push("Precio inválido");
      marcarError(priceInput);
    }
  }

  if (errores.length > 0) {
    errorMsg.textContent = `Los siguientes campos son obligatorios o inválidos: ${errores.join(", ")}.`;
    errorMsg.classList.remove("hidden");
    return false;
  }

  return true;
}

form.addEventListener("submit", e => {
  e.preventDefault();

  if (validarFormulario() && submit.value === 'Crear Producto') {
    crearProducto();
  } else {
    editarProducto();
  }

});


async function crearProducto() {

  actionInput.value = 'crear-producto';

  const formData = new FormData(form);

  try {
    const res = await fetch('/shoedev/crear_producto.php', {
      method: 'POST',
      body: formData
    });

    const data = await res.json();

    if (data.status === "success") {
      closeModalForm();
      listarProductos();
      mostrarToast(data.message);
      setTimeout(() => {
        ocultarToast();
      }, 3000);
    } else {
      console.log('error');
    }

  } catch (err) {
    console.error(err);
    console.log('error');
  }

}


async function editarProducto() {
  actionInput.value = 'editar-producto';

  const formData = new FormData(form);

  try {
    const res = await fetch('/shoedev/update_product.php', {
      method: 'POST',
      body: formData
    });

    const data = await res.json();

    if (data.status === "success") {
      closeModalForm();
      listarProductos();
      mostrarToast(data.message);
      setTimeout(() => {
        ocultarToast();
      }, 3000);
    } else {
      console.log('error');
    }

  } catch (err) {
    console.error(err);
    console.log('error');
  }
}



function mostrarToast(msg) {
  toast.textContent = msg;
  toast.classList.remove('-translate-x-full', 'opacity-0');
}

function ocultarToast() {
  toast.classList.add('-translate-x-full', 'opacity-0');
}


// Modal form
function openModalForm(mode) {
  modalForm.classList.remove("hidden");
  if (mode === 'editando') {
    submit.value = 'Guardar';
  } else {
    submit.value = 'Crear Producto';
  }
}

function closeModalForm() {
  modalForm.classList.add("hidden");
  form.reset();
  preview.innerHTML = "";
  preview.classList.add("hidden");
}

// Eventos modal
nuevoProductoBtn.addEventListener("click", () => openModalForm('crear'));
cerrarBtn.addEventListener("click", e => {
  e.preventDefault();
  closeModalForm();
});

modalForm.addEventListener("click", closeModalForm);
form.addEventListener("click", e => e.stopPropagation());



// Botones de editar y eliminar en los productos extraidos de la API
function activarBotones() {

  const editBtn = document.querySelectorAll('.edit-btn');

  editBtn.forEach(btn => {
    btn.addEventListener('click', () => {
      const id = btn.closest('.product-card').getAttribute('data-id');
      getCampos(id);
      openModalForm('editando');
    });
  });

  const deleteBtn = document.querySelectorAll('.delete-btn');

  deleteBtn.forEach(btn => {

    btn.addEventListener('click', () => {
      const id = btn.closest('.product-card').getAttribute('data-id');
      openModalEliminar();
      btnDialogEliminar.addEventListener('click', () => eliminarProducto(id));
    });

  });

}


async function eliminarProducto(id) {
  const formData = new FormData();
  formData.append('id', id);

  try {
    const res = await fetch('/shoedev/eliminar_producto.php', {
      method: 'POST',
      body: formData
    });

    const data = await res.json();

    if (data.status === "success") {
      closeModalEliminar();
      listarProductos();
      mostrarToast(data.message);
      setTimeout(() => {
        ocultarToast();
      }, 3000);
    } else {
      console.log('error');
    }

  } catch (err) {
    console.error(err);
    console.log('error');
  }
}



function openModalEliminar() {
  modalEliminar.classList.remove('hidden');
}

function closeModalEliminar() {
  modalEliminar.classList.add('hidden');
}

dialogModalEliminar.addEventListener('click', e => e.stopPropagation());
modalEliminar.addEventListener('click', closeModalEliminar);
btnDialogCancelar.addEventListener('click', closeModalEliminar);




async function getCampos(id) {

  document.querySelector('#product-id').value = id;

  const formData = new FormData();
  formData.append('id', id);
  formData.append('action', 'obtener');

  const res = await fetch('/shoedev/update_product.php', {
    method: 'POST',
    body: formData
  });

  const data = await res.json();
  formEdit(data.imagen, data.titulo, data.descripcion, data.marca, data.stock, data.precio);
}



//Form con los datos del producto a editar
function formEdit(imagen, titulo, descripcion, marca, stock, precio) {

  // Mostrar imagen actual del producto
  if (imagen) {
    preview.innerHTML = `
      <img src="/shoedev/backend/uploads/products/${imagen}" class="w-full h-full object-cover" />
    `;
    preview.classList.remove("hidden");
  }

  // Rellenar campos del formulario
  titleInput.value = titulo;
  descriptionInput.value = descripcion;
  brandSelect.value = marca;
  stockInput.value = stock;
  priceInput.value = precio;
}



async function listarNike() {

  try {
    const res = await fetch('/shoedev/get_nike.php');
    const productos = await res.json();

    sectionNike.innerHTML = "";

    productos.forEach(producto => {

      const card = `
        <div data-id="${producto.id}"
            class="product-card bg-neutral-100 rounded-lg hover:shadow-xl transition p-4 flex flex-col shadow-lg shadow-black/30" data-name="${producto.titulo}" data-brand="${producto.marca}">

          <div class="aspect-square overflow-hidden rounded-lg mb-4">
            <img src="/shoedev/backend/uploads/products/${producto.imagen}"
                 class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
          </div>

          <h3 class="font-semibold text-gray-900 mb-2 capitalize text-xl">
            ${producto.titulo}
          </h3>

          <div class="flex items-center justify-start gap-5 w-full mt-2">
            <button class="py-1 px-4 bg-amber-500 text-white rounded-sm cursor-pointer hover:bg-yellow-500/90 edit-btn">
              Editar
            </button>
            <button class="py-1 px-4 bg-red-500 text-white rounded-sm cursor-pointer hover:bg-red-500/90 delete-btn">
              Eliminar
            </button>
          </div>

        </div>
      `;

      sectionNike.innerHTML += card;
    });

    activarBotones();

  } catch (err) {
    console.error("Error al cargar productos Nike:", err);
  }
}


async function listarAdidas() {

  try {
    const res = await fetch('/shoedev/get_adidas.php');
    const productos = await res.json();

    sectionAdidas.innerHTML = ""; 

    productos.forEach(producto => {

      const card = `
        <div data-id="${producto.id}"
            class="product-card bg-neutral-100 rounded-lg hover:shadow-xl transition p-4 flex flex-col shadow-lg shadow-black/30" data-name="${producto.titulo}" data-brand="${producto.marca}">

          <div class="aspect-square overflow-hidden rounded-lg mb-4">
            <img src="/shoedev/backend/uploads/products/${producto.imagen}"
                 class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
          </div>

          <h3 class="font-semibold text-gray-900 mb-2 capitalize text-xl">
            ${producto.titulo}
          </h3>

          <div class="flex items-center justify-start gap-5 w-full mt-2">
            <button class="py-1 px-4 bg-amber-500 text-white rounded-sm cursor-pointer hover:bg-yellow-500/90 edit-btn">
              Editar
            </button>
            <button class="py-1 px-4 bg-red-500 text-white rounded-sm cursor-pointer hover:bg-red-500/90 delete-btn">
              Eliminar
            </button>
          </div>

        </div>
      `;

      sectionAdidas.innerHTML += card;
    });

    activarBotones();

  } catch (err) {
    console.error("Error al cargar productos Nike:", err);
  }
}


async function listarPuma() {

  try {
    const res = await fetch('/shoedev/get_puma.php');
    const productos = await res.json();

    sectionPuma.innerHTML = "";

    productos.forEach(producto => {

      const card = `
        <div data-id="${producto.id}"
            class="product-card bg-neutral-100 rounded-lg hover:shadow-xl transition p-4 flex flex-col shadow-lg shadow-black/30" data-name="${producto.titulo}" data-brand="${producto.marca}">

          <div class="aspect-square overflow-hidden rounded-lg mb-4">
            <img src="/shoedev/backend/uploads/products/${producto.imagen}"
                 class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
          </div>

          <h3 class="font-semibold text-gray-900 mb-2 capitalize text-xl">
            ${producto.titulo}
          </h3>

          <div class="flex items-center justify-start gap-5 w-full mt-2">
            <button class="py-1 px-4 bg-amber-500 text-white rounded-sm cursor-pointer hover:bg-yellow-500/90 edit-btn">
              Editar
            </button>
            <button class="py-1 px-4 bg-red-500 text-white rounded-sm cursor-pointer hover:bg-red-500/90 delete-btn">
              Eliminar
            </button>
          </div>

        </div>
      `;

      sectionPuma.innerHTML += card;
    });

    activarBotones();

  } catch (err) {
    console.error("Error al cargar productos Nike:", err);
  }
}


function listarProductos() {
  listarNike();
  listarAdidas();
  listarPuma();
}


document.addEventListener('DOMContentLoaded', listarProductos);