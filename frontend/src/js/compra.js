const tbody = document.querySelector('#tbody');
const productos = JSON.parse(localStorage.getItem('carrito')) || [];

// Limpiar el tbody
tbody.innerHTML = '';

// Crear filas
productos.forEach(producto => {

  const tr = document.createElement('tr');
  tr.className = "hover:bg-orange-50 transition";

  const tdProducto = document.createElement('td');
  tdProducto.className = "px-4 py-3 text-gray-800";
  tdProducto.textContent = producto.titulo;

  const tdCantidad = document.createElement('td');
  tdCantidad.className = "px-4 py-3 text-gray-800";
  tdCantidad.textContent = producto.cantidad;

  const tdPrecio = document.createElement('td');
  tdPrecio.className = "px-4 py-3 text-gray-800";
  tdPrecio.textContent = producto.precio.toFixed(2) + " €";

  const tdSubtotal = document.createElement('td');
  tdSubtotal.className = "px-4 py-3 text-gray-800 font-medium";
  const subtotal = (producto.precio * producto.cantidad).toFixed(2);
  tdSubtotal.textContent = subtotal + " €";

  tr.appendChild(tdProducto);
  tr.appendChild(tdCantidad);
  tr.appendChild(tdPrecio);
  tr.appendChild(tdSubtotal);

  tbody.appendChild(tr);
});

// ---- TOTAL FINAL ----
let total = 0;
productos.forEach(producto => {
  total += producto.precio * producto.cantidad;
});

// Mostrar total
document.querySelector('#totalFinal').textContent = total.toFixed(2) + " €";


const confirmarCompraBtn = document.querySelector('#confirmar-compra-btn');
const modalCompra = document.querySelector('#modal-compra');
const cardProcesando = document.querySelector('#card-procesando');
const loader = document.querySelector('#loader');
const cardExito = document.querySelector('#card-exito');
const userId = confirmarCompraBtn.getAttribute('data-user-id');

confirmarCompraBtn.addEventListener('click', () => {

  modalCompra.classList.remove('hidden');
  loader.classList.add('loader');
  setTimeout(() => {
    localStorage.setItem('carrito', JSON.stringify([]));
    cardProcesando.classList.add('hidden');
    loader.classList.remove('loader');
    cardExito.classList.remove('hidden');
    confetti({
      particleCount: 100,
      spread: 70,
      origin: { y: 0.6 }
    });
    realizarCompra();
  }, 1500);


  setTimeout(() => {
    window.location.href = "/shoedev/index.php"
  }, 4000);

});







async function realizarCompra() {

  try{

  const res = await fetch('/shoedev/set_compra.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({total, productos, userId})
  });

  const data = await res.json();

  console.log(data.message);

  } catch(error) {
    console.log(error)
  }

}