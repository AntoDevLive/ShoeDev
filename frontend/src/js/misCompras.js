const searchInput = document.getElementById('searchInput');
const btnRecent = document.getElementById('btnRecent');
const btnOldest = document.getElementById('btnOldest');
const tbody = document.getElementById('comprasTbody');
let rows = [];
let searchQuery = '';
let sortOrder = 'recent'; // recent | oldest

// Helper: normaliza texto (quita diacríticos y a minúsculas)
function normalizeText(str = '') {
  return String(str)
    .normalize('NFD')
    .replace(/[\u0300-\u036f]/g, '')
    .toLowerCase();
}

// Aplica filtros y renderiza la tabla
function filterAndRender() {
  const normalizedQuery = normalizeText(searchQuery.trim());

  // Filtrar
  let matches = rows.filter(row => {
    // Si la query está vacía, pasa
    if (!normalizedQuery) return true;

    // Construir string con el contenido de todas las celdas visibles
    const cells = Array.from(row.querySelectorAll('td')).map(td => td.textContent || '');
    const fullText = cells.join(' | ');
    const normalizedFull = normalizeText(fullText);

    return normalizedFull.includes(normalizedQuery);
  });

  // Ordenar según sortOrder usando data-compra-id
  matches.sort((a, b) => {
    const idA = parseInt(a.dataset.compraId || '0', 10);
    const idB = parseInt(b.dataset.compraId || '0', 10);
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
    const cellsCount = document.querySelectorAll('#comprasTable thead th').length || 1;
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
  if (sortOrder === 'recent') {
    btnRecent.classList.add('bg-orange-600', 'text-white');
    btnOldest.classList.remove('bg-orange-600', 'text-white');
  } else {
    btnOldest.classList.add('bg-orange-600', 'text-white');
    btnRecent.classList.remove('bg-orange-600', 'text-white');
  }
}

// Listar las compras en tiempo real
async function listarCompras() {
  try {
    const res = await fetch('/shoedev/get_mis-compras.php');
    const compras = await res.json();

    tbody.innerHTML = '';

    compras.forEach(compra => {
      const td = `
        <tr class="compra-row hover:bg-orange-50 transition border-b border-b-orange-300" data-compra-id="${compra.compra_id}">
          <td class="py-3 px-6 text-center">${compra.compra_id}</td>
          <td class="py-3 px-6 text-center">${compra.fecha}</td>
          <td class="py-3 px-6 flex justify-center">
            <img class="!w-20 !h-20 !object-cover rounded-md shadow" src="/shoedev/backend/uploads/products/${compra.imagen}" alt="${compra.titulo}">
          </td>
          <td class="py-3 px-6 text-center">${compra.titulo}</td>
          <td class="py-3 px-6 text-center">${compra.cantidad}</td>
          <td class="py-3 px-6 text-center">${parseFloat(compra.precio_compra).toFixed(2)} €</td>
          <td class="py-3 px-6 text-center font-bold text-orange-600">${parseFloat(compra.subtotal).toFixed(2)} €</td>
        </tr>
      `;

      tbody.innerHTML += td;
    });

    // Actualizar el array rows después de cargar las compras
    rows = Array.from(tbody.querySelectorAll('tr.compra-row'));

    // Aplicar los filtros actuales a los nuevos datos
    filterAndRender();

  } catch (error) {
    console.log('Error al cargar las compras:', error);
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

  // Inicial
  updateButtonStates();

  // Cargar compras al inicio
  listarCompras();
});

