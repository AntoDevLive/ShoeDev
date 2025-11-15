const carritoBtn = document.querySelector('#carrito-btn');
const carrito = document.querySelector('#carrito');
const cerrarCarritoBtn = document.querySelector('#cerrar-carrito');
const modal = document.querySelector('#modal');
const cantidad = document.querySelector('#cantidad');
const decrementarBtn = document.querySelector('#decrementar-btn');
const aumentarBtn = document.querySelector('#aumentar-btn');
const precioProductoCarrito = document.querySelector('#precio-producto-carrito');
const precioProductos = document.querySelectorAll('#precio-producto');
const productoBtns = document.querySelectorAll('#producto-btn');



// formatear precio de productos a euro
precioProductos.forEach(precio => {
    precio.textContent = formatearEuro(Number(precio.textContent))
})


productoBtns.forEach(btn => {
    btn.addEventListener('click', () => {
        console.log(btn.closest('#producto').getAttribute('data-id'))
    })
})


//Handle Modal
modal.addEventListener('click', closeModal);

const body = document.querySelector('body')

body.addEventListener('keydown', e => { //Cerrar carrito presionando Esc
    if (!modal.classList.contains('hidden') && e.key === 'Escape') {
        closeModal()
    }
});

function openModal() {
    carrito.classList.remove('translate-x-full');
    modal.classList.remove('hidden');
    modal.classList.remove('fade-out');
    modal.classList.add('fade-in');
}


function closeModal() {
    carrito.classList.add('translate-x-full');
    modal.classList.remove('fade-in');
    setTimeout(() => {
        modal.classList.add('hidden');
    }, 300);
    setTimeout(() => {
        modal.classList.remove('fade-out');
    }, 400);
    modal.classList.add('fade-out');
}



//Handle carrito
function formatearEuro(valor) {
    return new Intl.NumberFormat("es-ES", {
        style: "currency",
        currency: "EUR"
    }).format(valor);
}

let precioBase = 82.99;


carritoBtn.addEventListener('click', openModal);
cerrarCarritoBtn.addEventListener('click', closeModal);

cantidad.addEventListener('input', () => {
    if (cantidad.value <= 0) cantidad.value = 1;
    let cantidadInt = parseInt(cantidad.value);
    precioProductoCarrito.textContent = formatearEuro(cantidadInt * precioBase);
});



aumentarBtn.addEventListener('click', () => {
    let cantidadInt = parseInt(cantidad.value);
    cantidadInt++
    cantidad.value = cantidadInt;
    precioProductoCarrito.textContent = formatearEuro(cantidadInt * precioBase);
});

decrementarBtn.addEventListener('click', () => {
    let cantidadInt = parseInt(cantidad.value);
    cantidadInt--
    if (cantidadInt <= 0) cantidadInt = 1;
    cantidad.value = cantidadInt;
    precioProductoCarrito.textContent = formatearEuro(cantidadInt * precioBase);
});




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

