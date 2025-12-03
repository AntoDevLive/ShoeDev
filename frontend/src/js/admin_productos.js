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

  if (validarFormulario()) {
    crearProducto();
  }
});


async function crearProducto() {

  const formData = new FormData(form);

  try {
    const res = await fetch('/shoedev/crear_producto.php', {
      method: 'POST',
      body: formData
    });

    const data = await res.json();

    if (data.status === "success") {
      closeModalForm();
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
  if(mode === 'editando') {
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


const editBtn = document.querySelectorAll('.edit-btn');

editBtn.forEach(btn => {

  btn.addEventListener('click', () => {
    const id = btn.closest('.product-card').getAttribute('data-id');

    getCampos(id);

    openModalForm('editando');
  });


});


async function getCampos(id) {

  const formData = new FormData();
  formData.append('id', id);

  try {
    const res = await fetch('/shoedev/update_product.php', {
      method: 'POST',
      body: formData
    });

    const data = await res.json();

    formEdit(data.imagen, data.titulo, data.descripcion, data.marca, data.stock, data.precio);

  } catch (err) {
    console.error(err);
  }

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
