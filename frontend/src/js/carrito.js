// Selectores
const modal = document.querySelector('.modal') ?? null;
const header = document.querySelector('header') ?? null;
const carritoBtns = document.querySelectorAll('.carrito-btn');
const carrito = document.querySelector('.carrito') ?? null;
const cerrarCarritoBtn = document.querySelector('.cerrar-carrito') ?? null;
const carritoBody = document.querySelector('.carrito-body') ?? null;
const carritoVacio = document.querySelector('.carrito-vacio') ?? null;
const productoBtns = document.querySelectorAll('.producto-btn');
const precioProducto = document.querySelectorAll('.precio-producto');
const cartBubble = document.querySelector('.cart-bubble') ?? null;
const vaciarBtn = document.querySelector('.vaciar-carrito-btn') ?? null;
const carritoComprarBtn = document.querySelector('.comprar-carrito-btn') ?? null;
const dialog = document.querySelector('#dialog') ?? null;
const dialogConfirmar = document.querySelector('#dialog-confirmar') ?? null;
const dialogCancelar = document.querySelector('#dialog-cancelar') ?? null;


if (carrito) {

  // Formatear precios
  precioProducto.forEach(p => {
    p.textContent = formatearEuro(p.textContent);
  });

  let carritoArray = [];

  // Modal
  carritoBtns.forEach(btn => btn?.addEventListener('click', openModal));

  cerrarCarritoBtn?.addEventListener('click', closeModal);

  modal?.addEventListener('click', closeModal);

  document.body.addEventListener('keydown', e => {
    if (!modal.classList.contains('hidden') && e.key === 'Escape') {
      closeModal();
    }
  });



  // LocalStorage
  function guardarCarrito() {
    localStorage.setItem('carrito', JSON.stringify(carritoArray));
  }

  function cargarCarrito() {
    const data = localStorage.getItem('carrito');
    if (data) {
      carritoArray = JSON.parse(data);
      carritoArray.forEach(producto => renderProductoCarrito(producto));
    }
    actualizarCarrito();
    actualizarSubtotal();
  }



  // Estados
  function actualizarCarrito() {

    if (!carritoVacio) return;

    if (carritoArray.length === 0) {
      carritoVacio.classList.remove('hidden');
      vaciarBtn?.classList.add('disabled');
      if (vaciarBtn) vaciarBtn.disabled = true;
      carritoComprarBtn?.classList.add('disabled');
      if (carritoComprarBtn) carritoComprarBtn.disabled = true;
      cartBubble?.classList.add('opacity-0');
    } else {
      carritoVacio.classList.add('hidden');
      vaciarBtn?.classList.remove('disabled');
      if (vaciarBtn) vaciarBtn.disabled = false;
      carritoComprarBtn?.classList.remove('disabled');
      if (carritoComprarBtn) carritoComprarBtn.disabled = false;
    }
  }



  // Subtotal
  function actualizarSubtotal() {
    const subtotalSpan = carrito.querySelector(".subtotal");
    if (!subtotalSpan) return;

    let total = 0;
    carritoArray.forEach(p => {
      total += p.precio * p.cantidad;
    });

    subtotalSpan.textContent = formatearEuro(total);
  }



  // Renderizar producto
  function renderProductoCarrito(producto) {

    if (!carritoBody) return;

    let section = carritoBody.querySelector(`section[data-id='${producto.id}']`);

    if (section) {
      section.querySelector("#cantidad").value = producto.cantidad;
      section.querySelector("#precio-producto-carrito").textContent =
        formatearEuro(producto.precio * producto.cantidad);
      actualizarSubtotal();
      actualizarCarrito();
      return;
    }

    // Crear nuevo elemento
    section = document.createElement("section");
    section.className =
      "bg-white w-5/6 mx-auto px-8 py-4 rounded-xl shadow-md/20 space-y-5";
    section.dataset.id = producto.id;

    section.innerHTML = `
            <div class="flex justify-start items-center gap-4 text-xl w-full">
                <div class="w-36 overflow-hidden rounded-md">
                    <img class="w-100% object-cover" src="${producto.imagen}">
                </div>
                <div>
                    <h3>${producto.titulo}</h3>
                    <span id="precio-producto-carrito">${formatearEuro(producto.precio)}</span>
                </div>
            </div>

            <div class="w-full flex justify-between items-center">
                <div class="text-xl">
                    <button id="decrementar-btn" class="btn-cantidad py-0 px-2 bg-orange-200 cursor-pointer rounded-sm transition-all duration-200 active:scale-90 hover:bg-orange-300">-</button>
                    <input id="cantidad" type="number" value="${producto.cantidad}" min="1" max="99" class="text-center w-12 bg-neutral-200 rounded-sm">
                    <button id="aumentar-btn" class="btn-cantidad py-0 px-2 bg-orange-200 cursor-pointer rounded-sm transition-all duration-200 active:scale-90 hover:bg-orange-300">+</button>
                </div>
                <button class="btn-eliminar bg-red-500 text-white px-4 py-2 rounded cursor-pointer transition-all duration-200 hover:bg-red-500/90">Eliminar</button>
            </div>
        `;

    carritoBody.appendChild(section);

    actualizarSubtotal();

    // Eventos internos
    const cantidadInput = section.querySelector("#cantidad");
    const precioSpan = section.querySelector("#precio-producto-carrito");
    const aumentarBtn = section.querySelector("#aumentar-btn");
    const decrementarBtn = section.querySelector("#decrementar-btn");
    const btnEliminar = section.querySelector(".btn-eliminar");

    cantidadInput.addEventListener("input", () => {
      let value = parseInt(cantidadInput.value);
      if (isNaN(value) || value < 1) value = 1;
      if (isNaN(value) || value > 99) value = 99;

      producto.cantidad = value;
      precioSpan.textContent = formatearEuro(producto.precio * value);
      actualizarSubtotal();
      guardarCarrito();
    });

    aumentarBtn.addEventListener("click", () => {
      producto.cantidad++;
      cantidadInput.value = producto.cantidad;
      precioSpan.textContent = formatearEuro(producto.precio * producto.cantidad);
      actualizarSubtotal();
      guardarCarrito();
    });

    decrementarBtn.addEventListener("click", () => {
      producto.cantidad = Math.max(1, producto.cantidad - 1);
      cantidadInput.value = producto.cantidad;
      precioSpan.textContent = formatearEuro(producto.precio * producto.cantidad);
      actualizarSubtotal();
      guardarCarrito();
    });

    btnEliminar.addEventListener("click", () => {
      section.remove();
      carritoArray = carritoArray.filter(p => p.id !== producto.id);
      actualizarSubtotal();
      guardarCarrito();
      actualizarCarrito();
    });

    animarBubble();
    actualizarCarrito();
  }



  // Bubble
  function animarBubble() {
    if (!cartBubble) return;

    cartBubble.textContent = carritoArray.length;
    cartBubble.classList.remove('opacity-0');
    cartBubble.classList.remove('animated-bubble');
    void cartBubble.offsetWidth;
    cartBubble.classList.add('animated-bubble');
  }


  // Modal carrito
  function openModal() {
    carrito.classList.remove('translate-x-full');
    modal.classList.remove('hidden');
    modal.classList.add('fade-in');
    body.classList.add('overflow-y-hidden');
  }

  function closeModal() {
    carrito.classList.add('translate-x-full');
    modal.classList.remove('fade-in');
    modal.classList.add('fade-out');
    body.classList.remove('overflow-y-hidden');
    ocultarDialog();

    setTimeout(() => {
      modal.classList.add('hidden');
      modal.classList.remove('fade-out');
    }, 300);
  }


  // Añadir productos
  productoBtns.forEach(btn => {
    btn.addEventListener('click', () => {

      const card = btn.closest('.producto');
      const productoAgregadoBtn = btn.closest('.producto').querySelector('.producto-agregado-btn');
      const id = card.dataset.id;
      const titulo = card.querySelector('h3').textContent;
      const precio = parseFloat(
        card.querySelector('.precio-producto').textContent.replace("€", "").replace(",", ".")
      );
      const imagen = card.querySelector('img').src;

      let producto = carritoArray.find(p => p.id === id);

      if (producto) {
        producto.cantidad++;
      } else {
        producto = { id, titulo, precio, imagen, cantidad: 1 };
        carritoArray.push(producto);
      }

      btn.classList.add('hidden');
      productoAgregadoBtn.classList.remove('hidden');

      setTimeout(() => {
        btn.classList.remove('hidden');
        productoAgregadoBtn.classList.add('hidden');
      }, 1000);

      guardarCarrito();
      renderProductoCarrito(producto);
    });
  });


  function mostrarDialog() {
    dialog?.classList.remove('hidden'); // muestra solo el diálogo
  }

  function ocultarDialog() {
    dialog?.classList.add('hidden'); // oculta el diálogo
  }


  // Vaciar
  vaciarBtn?.addEventListener("click", () => {
    mostrarDialog();
    dialogConfirmar.addEventListener('click', vaciarCarrito);
    dialogCancelar.addEventListener('click', ocultarDialog);
  });


  function vaciarCarrito() {

    carritoArray = [];
    guardarCarrito();

    if (carritoBody) {
      // Eliminamos todos los productos excepto el div de carrito-vacio
      carritoBody.querySelectorAll("section").forEach(sec => {
        if (!sec.classList.contains("carrito-vacio")) {
          sec.remove();
        }
      });
    }

    // Actualizar subtotal y botones
    actualizarSubtotal();
    actualizarCarrito();
    ocultarDialog();
    closeModal();
  }


  // Formatear a moneda
  function formatearEuro(valor) {
    return new Intl.NumberFormat("es-ES", {
      style: "currency",
      currency: "EUR"
    }).format(valor);
  }



  // Cargar storage
  document.addEventListener("DOMContentLoaded", cargarCarrito);
}
