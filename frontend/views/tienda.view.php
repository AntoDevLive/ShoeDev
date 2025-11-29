<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="frontend/src/output.css">
  <title>ShoeDev | Tienda</title>
</head>

<body class="min-h-screen bg-gray-50 text-gray-900">

  <!-- Subir Btn -->
  <?php include 'frontend/templates/Btn_subir.php' ?>

  <!-- Modal -->
  <?php include 'frontend/templates/Modal.php' ?>


  <!-- Header -->
  <?php include 'frontend/templates/Header.php' ?>


  <!-- Carrito -->
  <?php include 'frontend/templates/Carrito.php' ?>

  <!-- Search & Filters -->
  <div class="bg-gray-100/30 border-b border-gray-300">
    <div class="container mx-auto px-4 py-6">

      <!-- Search -->
      <div class="max-w-2xl mx-auto mb-6 relative">
        <input type="text" placeholder="Buscar zapatillas..." class="pl-10 h-12 w-full border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-orange-600">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">🔍</span>
      </div>

      <!-- Brand Filter Buttons -->
      <div class="flex flex-wrap justify-center gap-3">
        <button onclick="document.getElementById('nike').scrollIntoView({behavior:'smooth'})" class="px-4 py-2 border border-gray-400 rounded font-semibold hover:bg-orange-600 hover:text-white transition">Nike</button>
        <button onclick="document.getElementById('puma').scrollIntoView({behavior:'smooth'})" class="px-4 py-2 border border-gray-400 rounded font-semibold hover:bg-orange-600 hover:text-white transition">Puma</button>
        <button onclick="document.getElementById('adidas').scrollIntoView({behavior:'smooth'})" class="px-4 py-2 border border-gray-400 rounded font-semibold hover:bg-orange-600 hover:text-white transition">Adidas</button>
      </div>

    </div>
  </div>

  <!-- Nike Section -->
  <section id="nike" class="py-16 scroll-mt-20">
    <div class="container mx-auto px-4">
      <div class="mb-12">
        <div class="bg-gradient-to-r from-orange-100 to-transparent p-8 rounded-lg mb-8">
          <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-2">Nike Collection</h2>
          <p class="text-lg text-gray-500">Innovación y rendimiento en cada paso</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
          <!-- Productos Nike -->
          <div class="bg-white rounded-lg shadow hover:shadow-xl transition p-4">
            <div class="aspect-square overflow-hidden rounded-lg mb-4">
              <img src="frontend/src/assets/nike1.jfif" alt="Nike 1" class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
            </div>
            <span class="inline-block bg-gray-200 text-gray-700 px-2 py-1 rounded mb-2 text-sm">Nike</span>
            <h3 class="font-semibold text-gray-900 mb-2">Nike Air Force</h3>
            <div class="flex items-center justify-between">
              <p class="text-xl font-bold text-orange-600">82,99€</p>
              <button class="px-2 py-1 border border-gray-300 rounded hover:bg-orange-600 hover:text-white transition">🛒</button>
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>

  <!-- Puma Section -->
  <section id="puma" class="py-16 bg-gray-100/20 scroll-mt-20">
    <div class="container mx-auto px-4">
      <div class="mb-12">
        <div class="bg-gradient-to-r from-orange-100 to-transparent p-8 rounded-lg mb-8">
          <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-2">Puma Collection</h2>
          <p class="text-lg text-gray-500">Estilo urbano con actitud única</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
          <div class="bg-white rounded-lg shadow hover:shadow-xl transition p-4">
            <div class="aspect-square overflow-hidden rounded-lg mb-4">
              <img src="frontend/src/assets/puma1.jfif" alt="Puma 1" class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
            </div>
            <span class="inline-block bg-gray-200 text-gray-700 px-2 py-1 rounded mb-2 text-sm">Puma</span>
            <h3 class="font-semibold text-gray-900 mb-2">Puma RS</h3>
            <div class="flex items-center justify-between">
              <p class="text-xl font-bold text-orange-600">99,99€</p>
              <button class="px-2 py-1 border border-gray-300 rounded hover:bg-orange-600 hover:text-white transition">🛒</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Adidas Section -->
  <section id="adidas" class="py-16 scroll-mt-20">
    <div class="container mx-auto px-4">
      <div class="mb-12">
        <div class="bg-gradient-to-r from-orange-100 to-transparent p-8 rounded-lg mb-8">
          <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-2">Adidas Collection</h2>
          <p class="text-lg text-gray-500">Icónicas tres rayas, diseño legendario</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
          <div class="bg-white rounded-lg shadow hover:shadow-xl transition p-4">
            <div class="aspect-square overflow-hidden rounded-lg mb-4">
              <img src="frontend/src/assets/adidas1.jfif" alt="Adidas 1" class="w-full h-full object-cover hover:scale-110 transition-transform duration-500">
            </div>
            <span class="inline-block bg-gray-200 text-gray-700 px-2 py-1 rounded mb-2 text-sm">Adidas</span>
            <h3 class="font-semibold text-gray-900 mb-2">Adidas Ultraboost</h3>
            <div class="flex items-center justify-between">
              <p class="text-xl font-bold text-orange-600">130,99€</p>
              <button class="px-2 py-1 border border-gray-300 rounded hover:bg-orange-600 hover:text-white transition">🛒</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


  <!-- Footer -->
  <?php include 'frontend/templates/Footer.php' ?>

</body>

<script src="frontend/src/js/carrito.js"></script>
<script src="frontend/src/js/main.js"></script>

</html>