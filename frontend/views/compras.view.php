<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="/shoedev/frontend/src/output.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />
  <link rel="shortcut icon" href="frontend/src/assets/favicon.png" type="image/x-icon">
  <title>ShoeDev | Administrar productos</title>
</head>

<body class="min-h-screen text-gray-900">

  <!-- Modal -->
  <?php include __DIR__ . '/../templates/Modal.php' ?>

  <!-- Header -->
  <?php include __DIR__ . '/../templates/Header.php' ?>

  <!-- Carrito -->
  <?php include __DIR__ . '/../templates/Carrito.php' ?>

  <!-- Título section -->
  <section class="bg-neutral-50 py-15 flex flex-col justify-center items-center gap-8">

    <div class="w-110 border-b border-b-orange-400 text-center">
      <h1 class="text-4xl font-semibold text-orange-600">Historial de Compras</h1>
    </div>

  </section>


<!-- Filtros y búsqueda -->
  <section class="flex justify-center items-center py-6 px-4">
    <div class="w-full max-w-7xl">
      <div class="flex flex-wrap gap-4 items-center justify-between">
        
        <!-- Barra de búsqueda -->
        <div class="flex-1 min-w-64">
          <div class="relative">
            <input 
              type="text" 
              id="searchInput" 
              placeholder="Buscar por ID, usuario, producto, fecha..." 
              class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 shadow-sm"
            />
            <svg xmlns="http://www.w3.org/2000/svg" class="absolute left-3 top-3.5 h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
            </svg>
          </div>
        </div>

        <!-- Botones de ordenamiento -->
        <div class="flex gap-2">
          <button 
            id="btnRecent" 
            class="px-4 py-3 rounded-lg border-2 border-orange-600 text-orange-600 hover:bg-orange-600 hover:text-white transition font-semibold shadow-sm"
          >
            Más recientes
          </button>
          <button 
            id="btnOldest" 
            class="px-4 py-3 rounded-lg border-2 border-orange-600 text-orange-600 hover:bg-orange-600 hover:text-white transition font-semibold shadow-sm"
          >
            Más antiguas
          </button>
        </div>

      </div>
    </div>
  </section>

  <!-- Tabla de compras -->
  <section class="flex justify-center items-center flex-col py-10 grow px-4">
    <div class="w-full max-w-7xl overflow-x-auto shadow-lg rounded-lg">
      <table id="comprasTable" class="w-full text-center bg-white">
        <thead class="bg-orange-600">
          <tr class="text-lg font-semibold text-white">
            <th class="px-6 py-4">ID Compra</th>
            <th class="px-6 py-4">Fecha</th>
            <th class="px-6 py-4">Producto(s)</th>
            <th class="px-6 py-4">ID Producto(s)</th>
            <th class="px-6 py-4">Usuario</th>
            <th class="px-6 py-4">Subtotal</th>
          </tr>
        </thead>
        <tbody id="comprasTbody">
          <!-- Las filas se cargarán dinámicamente con JavaScript -->
          <tr>
            <td colspan="6" class="py-10 text-gray-500">
              <div class="flex justify-center items-center flex-col gap-2">
                <div class="loader"></div>
                <span>Cargando compras...</span>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>

  <!-- Footer -->
  <?php include __DIR__ . '/../templates/Footer.php' ?>

</body>

<script src="/shoedev/frontend/src/js/carrito.js"></script>
<script src="/shoedev/frontend/src/js/main.js"></script>
<script src="/shoedev/frontend/src/js/admin-compras.js"></script>

</html>