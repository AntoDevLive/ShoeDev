const carritoBtn = document.querySelector('#carrito-btn');
const carrito = document.querySelector('#carrito');
const cerrarCarritoBtn = document.querySelector('#cerrar-carrito');
const mdoal = document.querySelector('#modal');


carritoBtn.addEventListener('click', openModal)

cerrarCarritoBtn.addEventListener('click', closeModal)

mdoal.addEventListener('click', closeModal)


function openModal() {
    carrito.classList.remove('translate-x-full');
    mdoal.classList.remove('hidden');
    mdoal.classList.remove('fade-out');
    mdoal.classList.add('fade-in');
}


function closeModal() {
    carrito.classList.add('translate-x-full');
    mdoal.classList.remove('fade-in');
    setTimeout(() => {
        mdoal.classList.add('hidden');
    }, 300);
    setTimeout(() => {
        mdoal.classList.remove('fade-out');
    }, 400);
    mdoal.classList.add('fade-out');
}