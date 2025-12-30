<?php

// Verificar que el usuario esté logueado
if (!isset($_SESSION['id'])) {
  header('Location: /shoedev/login.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../frontend/src/output.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />
  <link rel="shortcut icon" href="frontend/src/assets/favicon.png" type="image/x-icon">
  <title>Mis Compras - ShoeDev</title>
</head>

<body class="flex flex-col min-h-screen">

  <!-- Modal -->
  <?php include '../frontend/templates/Modal.php' ?>

  <!-- Header -->
  <?php include '../frontend/templates/Header.php' ?>

  <!-- Carrito -->
  <?php include '../frontend/templates/Carrito.php' ?>

  <!-- Título -->
  <section class="bg-neutral-100 flex justify-center items-center py-15">
    <div class="border-b border-orange-500 w-120 text-center relative">
      <h1 class="text-4xl font-semibold text-orange-500 absolute -top-1.5 left-2/4 -translate-2/4 bg-neutral-100 px-3">Mis Compras</h1>
    </div>
  </section>

  <!-- Filtros y búsqueda -->
  <section class="flex justify-center items-center py-6 px-4">
    <div class="w-full max-w-7xl">
      <div class="flex flex-wrap gap-4 items-center justify-between">
        
        <!-- Barra de búsqueda -->
        <div class="flex-1 min-w-64">
          <input 
            type="text" 
            id="searchInput" 
            placeholder="Buscar por ID, fecha, modelo..." 
            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500"
          />
        </div>

        <!-- Botones de ordenamiento -->
        <div class="flex gap-2">
          <button 
            id="btnRecent" 
            class="px-4 py-2 rounded-lg border border-orange-600 text-orange-600 hover:bg-orange-600 hover:text-white transition font-semibold"
          >
            Más recientes
          </button>
          <button 
            id="btnOldest" 
            class="px-4 py-2 rounded-lg border border-orange-600 text-orange-600 hover:bg-orange-600 hover:text-white transition font-semibold"
          >
            Más antiguas
          </button>
        </div>

      </div>
    </div>
  </section>

  <!-- Tabla de compras -->
  <section class="flex justify-center items-center flex-col py-10 grow px-4">
    <div class="w-full max-w-7xl overflow-x-auto shadow-md rounded-lg">
      <table id="comprasTable" class="w-full text-center bg-white">
        <thead class="bg-orange-600">
          <tr class="text-xl font-semibold text-white">
            <th class="px-6 py-4">ID</th>
            <th class="px-6 py-4">Fecha</th>
            <th class="px-6 py-4">Imagen</th>
            <th class="px-6 py-4">Modelo</th>
            <th class="px-6 py-4">Cantidad</th>
            <th class="px-6 py-4">Precio</th>
            <th class="px-6 py-4">Total</th>
          </tr>
        </thead>
        <tbody id="comprasTbody">
          <!-- Las filas se cargarán dinámicamente con JavaScript -->
          <tr>
            <td colspan="7" class="py-10 text-gray-500">
              <div class="flex justify-center items-center">
                Cargando compras...
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </section>

  <?php include '../frontend/templates/Footer.php' ?>
</body>


<script src="../frontend/src/js/carrito.js"></script>
<script src="../frontend/src/js/main.js"></script>
<script src="../frontend/src/js/misCompras.js"></script>

</html>