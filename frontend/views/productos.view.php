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
      <h1 class="text-4xl font-semibold text-orange-600">Administrar Productos</h1>
    </div>

  </section>


  <!-- Secciones de productos -->
  <section>

    <!-- Adidas -->
    <section>
      <div class="container mx-auto px-4">
        <div class="mb-12">
          <div class="bg-gradient-to-r from-orange-100 to-transparent p-8 rounded-lg mb-8">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-2">Adidas</h2>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <div class="bg-white rounded-lg shadow hover:shadow-xl transition p-4 flex justify-center items-center flex-col w-full">
              <div class="aspect-square overflow-hidden rounded-lg mb-4">
                <a href="#"><img src="../../frontend/src/assets/adidas1.jfif" alt="Adidas 1" class="w-full h-full object-cover hover:scale-110 transition-transform duration-500"></a>
              </div>
              <h3 class="font-semibold text-gray-900 mb-2">Adidas Ultraboost</h3>
              <div class="flex items-center justify-center gap-5 w-full">
                <button class="py-1 px-4 bg-amber-500 rounded-sm text-white cursor-pointer transition-all duration-200 hover:bg-yellow-500/90">Editar</button>
                <button class="py-1 px-4 bg-red-500 rounded-sm text-white cursor-pointer transition-all duration-200 hover:bg-red-500/90">Eliminar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


  </section>



  <!-- Footer -->
  <?php include __DIR__ . '/../templates/Footer.php' ?>

</body>

<script src="/shoedev/frontend/src/js/carrito.js"></script>
<script src="/shoedev/frontend/src/js/main.js"></script>

</html>