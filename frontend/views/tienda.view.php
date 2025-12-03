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
  <div id="inicio" class="bg-gray-100/30 border-b border-gray-300 pt-25 scroll-mt-20">
    <div class="container mx-auto px-4 py-6">

      <!-- Search -->
      <div class="max-w-2xl mx-auto mb-6 relative barra-busqueda">
        <input id="searchInput" type="text" placeholder="Buscar zapatillas..." class="pl-10 h-12 w-full border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-600">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-search">
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
  </div>

  <!-- Búsqueda sin resultados -->
  <section id="empty-search" class="flex justify-center items-center flex-col gap-2 text-neutral-500 py-35 hidden">
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

  <!-- Nike Section -->
  <section id="nike" class="py-16 -scroll-mt-5"">
    <div class=" container mx-auto px-4">
    <div class="mb-12">
      <div class="bg-gradient-to-r from-orange-100 to-transparent p-8 rounded-lg mb-8">
        <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-2">Nike Collection</h2>
        <p class="text-lg text-gray-500">Innovación y rendimiento en cada paso</p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

        <!-- Productos Nike -->
        <?php foreach ($productos_nike as $producto): ?>

          <div data-id="<?php echo $producto['id'] ?>" class="producto product-card shadow-xl/20 rounded-lg p-6 hover:shadow-xl/30 transition group flex flex-col justify-center items-start" data-name="<?php echo $producto['titulo'] ?>" data-brand="<?php echo $producto['marca'] ?>">
            <a href="/shoedev/producto.php?id=<?php echo $producto['id'] ?>">
              <div class="aspect-square mb-4 bg-gray-100 rounded-lg overflow-hidden">
                <img src="/shoedev/backend/uploads/products/<?php echo $producto['imagen'] ?>" alt="Zapatilla" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
              </div>
            </a>
            <div class="flex justify-center items-start flex-col">
              <span class="inline-block bg-gray-200 text-gray-700 px-2 py-1 rounded mb-2 text-sm capitalize"><?php echo $producto['marca'] ?></span>
              <h3 class="text-xl font-bold mb-2 capitalize"><?php echo $producto['titulo'] ?></h3>
            </div>
            <div class="flex items-center justify-between mt-1 relative w-full">
              <span class="precio-producto text-2xl font-bold text-orange-600"><?php echo $producto['precio'] ?></span>
              <button class="producto-btn flex items-center gap-2 bg-orange-600 text-white px-3 py-2 rounded hover:bg-orange-500 transition cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                  <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                  <path d="M17 17h-11v-14h-2" />
                  <path d="M6 5l14 1l-1 7h-13" />
                </svg>
                Añadir
              </button>
              <button class="producto-agregado-btn hidden flex items-center gap-1 bg-green-600 px-3 py-2 rounded cursor-cursor text-sm text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-check">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M5 12l5 5l10 -10" />
                </svg>
                Producto añadido
              </button>
            </div>
          </div>

        <?php endforeach; ?>

      </div>
    </div>
    </div>
  </section>

  <!-- Adidas Section -->
  <section id="adidas" class="py-16 -scroll-mt-5">
    <div class="container mx-auto px-4">
      <div class="mb-12">
        <div class="bg-gradient-to-r from-orange-100 to-transparent p-8 rounded-lg mb-8">
          <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-2">Adidas Collection</h2>
          <p class="text-lg text-gray-500">Icónicas tres rayas, diseño legendario</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

          <!-- Productos Adidas -->
          <?php foreach ($productos_adidas as $producto): ?>

            <div data-id="<?php echo $producto['id'] ?>" class="producto product-card shadow-xl/20 rounded-lg p-6 hover:shadow-xl/30 transition group flex flex-col justify-center items-start" data-name="<?php echo $producto['titulo'] ?>" data-brand="<?php echo $producto['marca'] ?>">
              <a href="/shoedev/producto.php?id=<?php echo $producto['id'] ?>">
                <div class="aspect-square mb-4 bg-gray-100 rounded-lg overflow-hidden">
                  <img src="/shoedev/backend/uploads/products/<?php echo $producto['imagen'] ?>" alt="Zapatilla" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                </div>
              </a>
              <div class="flex justify-center items-start flex-col">
                <span class="inline-block bg-gray-200 text-gray-700 px-2 py-1 rounded mb-2 text-sm capitalize"><?php echo $producto['marca'] ?></span>
                <h3 class="text-xl font-bold mb-2 capitalize"><?php echo $producto['titulo'] ?></h3>
              </div>
              <div class="flex items-center justify-between mt-1 relative w-full">
                <span class="precio-producto text-2xl font-bold text-orange-600"><?php echo $producto['precio'] ?></span>
                <button class="producto-btn flex items-center gap-2 bg-orange-600 text-white px-3 py-2 rounded hover:bg-orange-500 transition cursor-pointer">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                    <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                    <path d="M17 17h-11v-14h-2" />
                    <path d="M6 5l14 1l-1 7h-13" />
                  </svg>
                  Añadir
                </button>
                <button class="producto-agregado-btn hidden flex items-center gap-1 bg-green-600 px-3 py-2 rounded cursor-cursor text-sm text-white">
                  <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-check">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M5 12l5 5l10 -10" />
                  </svg>
                  Producto añadido
                </button>
              </div>
            </div>

          <?php endforeach; ?>

        </div>
      </div>
    </div>
  </section>


  <!-- Puma Section -->
  <section id="puma" class="py-16 bg-gray-100/20 -scroll-mt-5"">
    <div class=" container mx-auto px-4">
    <div class="mb-12">
      <div class="bg-gradient-to-r from-orange-100 to-transparent p-8 rounded-lg mb-8">
        <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-2">Puma Collection</h2>
        <p class="text-lg text-gray-500">Estilo urbano con actitud única</p>
      </div>

      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

        <!-- Productos Puma -->
        <?php foreach ($productos_puma as $producto): ?>

          <div data-id="<?php echo $producto['id'] ?>" class="producto product-card shadow-xl/20 rounded-lg p-6 hover:shadow-xl/30 transition group flex flex-col justify-center items-start" data-name="<?php echo $producto['titulo'] ?>" data-brand="<?php echo $producto['marca'] ?>">
            <a href="/shoedev/producto.php?id=<?php echo $producto['id'] ?>">
              <div class="aspect-square mb-4 bg-gray-100 rounded-lg overflow-hidden">
                <img src="/shoedev/backend/uploads/products/<?php echo $producto['imagen'] ?>" alt="Zapatilla" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
              </div>
            </a>
            <div class="flex justify-center items-start flex-col">
              <span class="inline-block bg-gray-200 text-gray-700 px-2 py-1 rounded mb-2 text-sm capitalize"><?php echo $producto['marca'] ?></span>
              <h3 class="text-xl font-bold mb-2 capitalize"><?php echo $producto['titulo'] ?></h3>
            </div>
            <div class="flex items-center justify-between mt-1 relative w-full">
              <span class="precio-producto text-2xl font-bold text-orange-600"><?php echo $producto['precio'] ?></span>
              <button class="producto-btn flex items-center gap-2 bg-orange-600 text-white px-3 py-2 rounded hover:bg-orange-500 transition cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                  <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                  <path d="M17 17h-11v-14h-2" />
                  <path d="M6 5l14 1l-1 7h-13" />
                </svg>
                Añadir
              </button>
              <button class="producto-agregado-btn hidden flex items-center gap-1 bg-green-600 px-3 py-2 rounded cursor-cursor text-sm text-white">
                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-check">
                  <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                  <path d="M5 12l5 5l10 -10" />
                </svg>
                Producto añadido
              </button>
            </div>
          </div>

        <?php endforeach; ?>


      </div>
    </div>
    </div>
  </section>


  <!-- Footer -->
  <?php include 'frontend/templates/Footer.php' ?>

</body>

<script src="frontend/src/js/carrito.js"></script>
<script src="frontend/src/js/search.js"></script>
<script src="frontend/src/js/main.js"></script>

</html>