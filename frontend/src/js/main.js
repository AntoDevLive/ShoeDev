// ---- Selectores ---- //
const carritoBtn = document.querySelector('#carrito-btn');
const carrito = document.querySelector('#carrito');
const cerrarCarritoBtn = document.querySelector('#cerrar-carrito');
const modal = document.querySelector('#modal');
const carritoBody = document.getElementById("carrito-body");
const carritoVacio = document.getElementById("carrito-vacio");
const productoBtns = document.querySelectorAll('.producto-btn');
const precioProducto = document.querySelectorAll('.precio-producto');
const cartBubble = document.querySelector('.cart-bubble');


precioProducto.forEach(producto => {
   producto.textContent = formatearEuro(producto.textContent);
})




// ---- Carrito con persistencia ---- //
let carritoArray = [];

carritoBtn.addEventListener('click', openModal);
cerrarCarritoBtn.addEventListener('click', closeModal);

// Guarda el carrito en localStorage
function guardarCarrito() {
    localStorage.setItem('carrito', JSON.stringify(carritoArray));
}

// Carga el carrito desde localStorage
function cargarCarrito() {
    const data = localStorage.getItem('carrito');
    if (data) {
        carritoArray = JSON.parse(data);
        carritoArray.forEach(producto => renderProductoCarrito(producto));
    }

    actualizarCarrito();
    actualizarSubtotal();
}


// Maneja el carrito cuando está vacío y cuando contiene algo
function actualizarCarrito(nuevoProducto = true) {
    if (carritoArray.length === 0) {
        carritoVacio.classList.remove('hidden');
        vaciarBtn.classList.add('disabled');
        vaciarBtn.disabled = true;
        carritoComprarBtn.classList.add('disabled');
        carritoComprarBtn.disabled = true;
        cartBubble.classList.add('opacity-0');
    } else {
        carritoVacio.classList.add('hidden');
        vaciarBtn.classList.remove('disabled');
        vaciarBtn.disabled = false;
        carritoComprarBtn.classList.remove('disabled');
        carritoComprarBtn.disabled = false;
    }
}


//manejar animación del bubble
function animarBubble() {
        cartBubble.classList.remove('opacity-0');
        cartBubble.textContent = carritoArray.length;
        cartBubble.classList.remove('animated-bubble');
        void cartBubble.offsetWidth;
        cartBubble.classList.add('animated-bubble');
}


// Maneja el subtotal
function actualizarSubtotal() {
    const subtotalSpan = carrito.querySelector(".subtotal");
    let total = 0;
    carritoArray.forEach(producto => {
        total += producto.precio * producto.cantidad;
    });
    subtotalSpan.textContent = formatearEuro(total);
}


// Renderiza los productos en el carrito
function renderProductoCarrito(producto) {
    // Verificar si ya existe la sección en DOM
    let sectionExistente = carritoBody.querySelector(`section[data-id='${producto.id}']`);
    if (sectionExistente) {
        // Solo actualizar cantidad y precio
        sectionExistente.querySelector("#cantidad").value = producto.cantidad;
        sectionExistente.querySelector("#precio-producto-carrito").textContent = formatearEuro(producto.precio * producto.cantidad);
        actualizarSubtotal();
        actualizarCarrito();
        return;
    }

    // Crear nuevo card a partir del seleccionado para renderizar en el carrito
    const section = document.createElement("section");
    section.className = "bg-white w-5/6 mx-auto px-8 py-4 rounded-xl shadow-md/20 space-y-5";
    section.dataset.id = producto.id;

    section.innerHTML = `
        <div class="flex justify-start items-center gap-4 text-xl w-full">
            <div class="w-36 overflow-hidden rounded-md">
                <img class="w-100% object-cover" src="${producto.imagen}" alt="">
            </div>
            <div>
                <h3>${producto.titulo}</h3>
                <span id="precio-producto-carrito">${formatearEuro(producto.precio)}</span>
            </div>
        </div>

        <div class="w-full flex justify-between items-center">
            <div class="text-xl">
                <button id="decrementar-btn" 
                    class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-sm text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 shrink-0 [&_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive text-secondary-foreground h-9 px-4 py-2 has-[>svg]:px-3 bg-orange-300 cursor-pointer hover:bg-orange-300/80">-</button>

                <input id="cantidad" 
                    data-slot="input"
                    class="text-center file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 border-input h-9 min-w-0 rounded-sm border bg-transparent px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[0.5px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive w-12"
                    min="1" max="99" type="number" value="1" name="quantity">

                <button id="aumentar-btn"
                    class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-sm text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 shrink-0 [&_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive text-secondary-foreground h-9 px-4 py-2 has-[>svg]:px-3 bg-orange-300 cursor-pointer hover:bg-orange-300/80">+</button>
            </div>

            <button class="btn-eliminar inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-sm text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 shrink-0 [&_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-[0.5px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive bg-destructive text-white hover:bg-destructive/90 focus-visible:ring-destructive/20 dark:focus-visible:ring-destructive/40 dark:bg-destructive/60 h-9 px-4 py-2 has-[&gt;svg]:px-3 cursor-pointer bg-red-500 transform-all duration-200 hover:bg-red-500/80">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2 lucide-trash-2" aria-hidden="true">
                        <path d="M10 11v6"></path>
                        <path d="M14 11v6"></path>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"></path>
                        <path d="M3 6h18"></path>
                        <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    </svg>
            </button>
        </div>
    `;

    // Añadimos el producto al cuerpo del carrito
    carritoBody.appendChild(section);

    actualizarSubtotal();

    // Selectores de elementos del card
    const cantidadInput = section.querySelector("#cantidad");
    const precioSpan = section.querySelector("#precio-producto-carrito");
    const aumentarBtn = section.querySelector("#aumentar-btn");
    const decrementarBtn = section.querySelector("#decrementar-btn");
    const btnEliminar = section.querySelector(".btn-eliminar");

    // Eventos para manejar las cantidades
    cantidadInput.addEventListener("input", () => {
        let value = parseInt(cantidadInput.value);
        if (isNaN(value) || value <= 0) value = 1;
        cantidadInput.value = value;
        producto.cantidad = value;
        precioSpan.textContent = formatearEuro(producto.precio * producto.cantidad);
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

    // Elimina el producto del carrito
    btnEliminar.addEventListener("click", () => {
        carritoBody.removeChild(section);
        carritoArray = carritoArray.filter(p => p.id !== producto.id);
        actualizarSubtotal();
        guardarCarrito();
        actualizarCarrito();
    });


    animarBubble();
    actualizarCarrito();
}


// Maneja el modal
modal.addEventListener('click', closeModal);
document.body.addEventListener('keydown', e => {
    if (!modal.classList.contains('hidden') && e.key === 'Escape') {
        closeModal();
    }
});

function openModal() {
    carrito.classList.remove('translate-x-full');
    modal.classList.remove('hidden');
    modal.classList.remove('fade-out');
    modal.classList.add('fade-in');
    carrito.classList.add('shadow-black');
}

function closeModal() {
    carrito.classList.add('translate-x-full');
    modal.classList.remove('fade-in');
    carrito.classList.remove('shadow-black');
    setTimeout(() => {
        modal.classList.add('hidden');
        closeDialog();
    }, 300);
    setTimeout(() => {
        modal.classList.remove('fade-out');
    }, 400);
    modal.classList.add('fade-out');
}


// Formatea valores a moneda
function formatearEuro(valor) {
    return new Intl.NumberFormat("es-ES", {
        style: "currency",
        currency: "EUR"
    }).format(valor);
}





// Click en productos
productoBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        const card = btn.closest('.producto');
        const id = card.dataset.id;
        const titulo = card.querySelector('h3').textContent;
        const precio = parseFloat(card.querySelector('.precio-producto').textContent.replace("€", "").replace(",", "."));
        const imagen = card.querySelector('img').src;

        // Revisar si ya existe en carrito
        let productoExistente = carritoArray.find(p => p.id === id);
        if (productoExistente) {
            productoExistente.cantidad++;
        } else {
            productoExistente = { id, titulo, precio, imagen, cantidad: 1 };
            carritoArray.push(productoExistente);
        }

        btn.textContent = 'Producto añadido';
        btn.classList.remove('bg-orange-600');
        btn.classList.add('bg-product-btn');
        setTimeout(() => {
            btn.innerHTML = `
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                    <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                    <path d="M17 17h-11v-14h-2" />
                    <path d="M6 5l14 1l-1 7h-13" />
                </svg>
                Comprar
            `
            btn.classList.remove('bg-product-btn');
            btn.classList.add('bg-orange-600');
        }, 1000);

        renderProductoCarrito(productoExistente);
        guardarCarrito();
    });
});


// Vaciar carrito
const vaciarBtn = carrito.querySelector("#vaciar-carrito-btn");
const carritoComprarBtn = carrito.querySelector("#comprar-carrito-btn");

vaciarBtn.addEventListener("click", showDialog);


// Manejar alerta Dialog
const dialog = document.querySelector('#dialog');
const dialogConfirmarBtn = document.querySelector('#dialog-confirmar');
const dialogCancelarBtn = document.querySelector('#dialog-cancelar');

function showDialog() {
    modal.classList.remove('z-40');
    modal.classList.add('z-96');
    dialog.classList.remove('hidden');
    dialog.addEventListener('click', e => e.stopPropagation());
}

function closeDialog() {
    modal.classList.remove('z-96');
    modal.classList.add('z-40');
    dialog.classList.add('hidden');
}


dialogConfirmarBtn.addEventListener('click', vaciarCarrito);
dialogCancelarBtn.addEventListener('click', closeDialog);


function vaciarCarrito() {
    // Vaciar todos los productos excepto el mensaje del carrito vacio
    const productos = carritoBody.querySelectorAll("section:not(#carrito-vacio)");
    productos.forEach(p => p.remove());

    // Vaciar array y actualizar localStorage
    carritoArray = [];
    guardarCarrito();

    // Actualizar subtotal y mostrar mensaje de carrito vacío
    actualizarSubtotal();
    actualizarCarrito();
    closeModal();
}



document.addEventListener('DOMContentLoaded', cargarCarrito)

//Slider index
const swiper = new Swiper('.swiper', {
    slidesPerView: 1,
    spaceBetween: 20,
    loop: true,

    navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
    },

    pagination: {
        el: '.swiper-pagination',
        clickable: true,
    },

    breakpoints: {
        768: {  // Tablet
            slidesPerView: 3,
        },
        1024: { // Desktop
            slidesPerView: 3,
        },
    },
});



const userProfile = document.querySelector('.user-profile');
const userMenu = document.querySelector('.user-menu') ?? null;
const body = document.querySelector('body');

userProfile.addEventListener('click', e => {
    if (userMenu.classList.contains('opacity-0')) {
        e.stopPropagation()
    }
    openUserMenu()
} );

function openUserMenu() {
    if (userMenu === null) return
    userMenu.classList.remove('opacity-0');
    userMenu.classList.remove('pointer-events-none');
    userMenu.addEventListener('click', e => e.stopPropagation());
    body.addEventListener('click', closeUserMenu);
}

function closeUserMenu() {
    if(userMenu === null) return
    userMenu.classList.add('opacity-0');
    userMenu.classList.add('pointer-events-none');
}