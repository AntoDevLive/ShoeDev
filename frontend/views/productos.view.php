<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="/shoedev/frontend/src/output.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />
    <link rel="shortcut icon" href="/shoedev/frontend/src/assets/favicon.png" type="image/x-icon">
  <title>ShoeDev | Administrar productos</title>
</head>

<body class="min-h-screen text-gray-900 relative">

  <?php include __DIR__ . '/../templates/Btn_subir.php' ?>
  <?php include __DIR__ . '/../templates/Modal.php' ?>
  <?php include __DIR__ . '/../templates/Header.php' ?>
  <?php include __DIR__ . '/../templates/Carrito.php' ?>
  <?php include __DIR__ . '/../templates/Modal_form_admin.php' ?>
  <?php include __DIR__ . '/../templates/Modal_eliminar.php' ?>

  <!-- Título section -->
  <section id="inicio" class="bg-neutral-50 pb-8 flex flex-col justify-center items-center gap-8 pt-30 scroll-mt-20">

    <div class="w-110 border-b border-b-orange-400 text-center">
      <h1 class="text-4xl font-semibold text-orange-600">Administrar Productos</h1>
    </div>

    <!-- Search -->
    <div>
      <div class="w-xl max-w-2xl mx-auto mb-6 relative barra-busqueda">
        <input id="searchInput" type="text" placeholder="Buscar zapatillas..." class="pl-10 h-12 w-full border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-600">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
            <path d="M21 21l-6 -6" />
          </svg>
        </span>
      </div>

      <!-- Brand Filter Buttons -->
      <div class="flex flex-wrap justify-center gap-5">
        <button onclick="document.getElementById('nike').scrollIntoView({behavior:'smooth'})" class="px-4 py-2 border border-gray-400 rounded-md font-semibold hover:bg-orange-600 hover:text-white transition cursor-pointer">Nike</button>
        <button onclick="document.getElementById('puma').scrollIntoView({behavior:'smooth'})" class="px-4 py-2 border border-gray-400 rounded-md font-semibold hover:bg-orange-600 hover:text-white transition cursor-pointer">Puma</button>
        <button onclick="document.getElementById('adidas').scrollIntoView({behavior:'smooth'})" class="px-4 py-2 border border-gray-400 rounded-md font-semibold hover:bg-orange-600 hover:text-white transition cursor-pointer">Adidas</button>
      </div>
    </div>

  </section>

  <section class="flex flex-col justify-center items-center gap-12 py-8">

    <!-- Búsqueda sin resultados -->
    <section id="empty-search" class="flex justify-center items-center flex-col gap-2 text-neutral-500 py-25 hidden">
      <p class="text-3xl">¡Oh no!</p>
      <p class="text-2xl">No encontramos resultados que coincidan con tu búsqueda.</p>
      <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-mood-sad">
        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
        <path d="M12 12m-9 0a9 9 0 1 0 18 0a9 9 0 1 0 -18 0" />
        <path d="M9 10l.01 0" />
        <path d="M15 10l.01 0" />
        <path d="M9.5 15.25a3.5 3.5 0 0 1 5 0" />
      </svg>
    </section>


    <div id="toast" class="bg-green-500 text-white py-2 px-5 text-xl rounded-br-md rounded-tr-md shadow-md shadow-neutral-500 fixed top-50 left-0 -translate-x-full opacity-0 transition-all duration-500"></div>

    <button id="nuevo-producto-btn" class="bg-blue-500 text-white text-xl py-2 px-5 capitalize cursor-pointer rounded-md transition-all duration-300 hover:bg-blue-500/90">Nuevo producto</button>

    <!-- NIKE -->
    <section id="nike" class="scroll-mt-25">
      <div class="container mx-auto px-4">
        <div class="mb-12">
          <div class="bg-gradient-to-r from-orange-100 to-transparent p-8 rounded-lg mb-8">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-2">Nike</h2>
          </div>

          <div id="productos-nike" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">



          </div>
        </div>
      </div>
    </section>

    <!-- ADIDAS -->
    <section id="adidas" class="scroll-mt-25">
      <div class="container mx-auto px-4">
        <div class="mb-12">
          <div class="bg-gradient-to-r from-orange-100 to-transparent p-8 rounded-lg mb-8">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-2">Adidas</h2>
          </div>

          <div id="productos-adidas" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">


          </div>
        </div>
      </div>
    </section>

    <!-- PUMA -->
    <section id="puma" class="scroll-mt-25">
      <div class="container mx-auto px-4">
        <div class="mb-12">
          <div class="bg-gradient-to-r from-orange-100 to-transparent p-8 rounded-lg mb-8">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-2">Puma</h2>
          </div>

          <div id="productos-puma" class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">



          </div>
        </div>
      </div>
    </section>

  </section>

  <?php include __DIR__ . '/../templates/Footer.php' ?>

</body>

<script src="/shoedev/frontend/src/js/carrito.js"></script>
<script src="/shoedev/frontend/src/js/main.js"></script>
<script src="/shoedev/frontend/src/js/search.js"></script>
<script src="/shoedev/frontend/src/js/admin_productos.js"></script>

</html>