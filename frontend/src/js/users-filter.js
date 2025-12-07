// Maneja búsqueda en tiempo real, filtros por rol y orden (recientes/antiguos).
document.addEventListener('DOMContentLoaded', function () {
  const searchInput = document.getElementById('searchInput');
  const btnRecent = document.getElementById('btnRecent');
  const btnOldest = document.getElementById('btnOldest');
  const btnAdmin = document.getElementById('btnAdmin');
  const btnStandard = document.getElementById('btnStandard');
  const tbody = document.getElementById('usersTbody');

  // Tomamos las filas y la convertimos a array para manipular
  let rows = Array.from(tbody.querySelectorAll('tr.user-row'));

  // Estado de filtros
  let searchQuery = '';
  let roleFilter = 'all'; // 'all' | 'admin' | 'standard'
  let sortOrder = 'recent'; // 'recent' | 'oldest'

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
        // si no contiene 'admin' se excluye
        if (!rowRol.includes('admin')) return false;
      } else if (roleFilter === 'standard') {
        // excluir administradores: consideraremos 'admin' substring como admin
        if (rowRol.includes('admin')) return false;
      }

      // Si la query está vacía, pasa
      if (!normalizedQuery) return true;

      // Construirr string con el contenido de todas las celdas visibles
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
    // Crear fragmento para evitar reflow innecesario
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

  // Event listeners
  searchInput.addEventListener('input', function (e) {
    searchQuery = e.target.value;
    filterAndRender();
  });

  btnRecent.addEventListener('click', function () {
    // activar recent
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
    // toggle admin
    roleFilter = (roleFilter === 'admin') ? 'all' : 'admin';
    updateButtonStates();
    filterAndRender();
  });

  btnStandard.addEventListener('click', function () {
    // toggle standard
    roleFilter = (roleFilter === 'standard') ? 'all' : 'standard';
    updateButtonStates();
    filterAndRender();
  });

  // Inicial
  updateButtonStates();
  filterAndRender();
});
