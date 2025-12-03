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


// FUNCIONES DE PREVIEW DE IMAGEN
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


// VALIDACIÓN DEL FORMULARIO
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
    // form.submit();
    crearProducto();
  }
});


async function crearProducto() {
  // Crear FormData con todos los campos del form
  const formData = new FormData(form);

  try {
    const res = await fetch('/shoedev/crear_producto.php', {
      method: 'POST',
      body: formData
    });

    const data = await res.json();

    if (data.status === "success") {
      closeModalForm();
      console.log(data.message);
    } else {
      console.log('error');
    }

  } catch (err) {
    console.error(err);
    console.log('error');
  }
}


// MODAL DEL FORMULARIO
function openModalForm() {
  modalForm.classList.remove("hidden");
}

function closeModalForm() {
  modalForm.classList.add("hidden");
  form.reset();
  preview.innerHTML = "";
  preview.classList.add("hidden");
}

// EVENTOS MODAL
nuevoProductoBtn.addEventListener("click", openModalForm);
cerrarBtn.addEventListener("click", e => {
  e.preventDefault();
  closeModalForm();
});

// Cerrar modal al hacer click fuera del formulario
modalForm.addEventListener("click", closeModalForm);
form.addEventListener("click", e => e.stopPropagation());