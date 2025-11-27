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

<body class="min-h-screen text-gray-900 relative">

  <!-- Modal -->
  <?php include __DIR__ . '/../templates/Modal.php' ?>

  <!-- Header -->
  <?php include __DIR__ . '/../templates/Header.php' ?>

  <!-- Carrito -->
  <?php include __DIR__ . '/../templates/Carrito.php' ?>


  <!-- Modal form -->
  <div id="modal-form" class="fixed inset-0 flex justify-center items-center bg-black/50 hidden">
    <form enctype="multipart/form-data" action="" class="flex flex-col justify-center items-center bg-neutral-100 gap-6 py-10 px-8 w-120 rounded-lg shadow-lg shadow-black/50 relative">

      <button id="cerrar-btn" class="absolute right-2 top-2 cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="gray" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-x">
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <path d="M18 6l-12 12" />
          <path d="M6 6l12 12" />
        </svg>
      </button>

      <!-- Input imagen -->
      <div class="flex justify-center items-center gap-3">

        <!-- Preview -->
        <div id="preview" class="w-20 h-20 hidden rounded-md overflow-hidden shadow-md">
          <!-- preview image -->
        </div>

        <!-- Botón subir -->
        <div class="w-60">
          <label for="imagen"
            class="bg-orange-500 text-white py-2 rounded-md w-full block text-center cursor-pointer transition-all hover:bg-orange-500/90">
            Subir Imagen
          </label>

          <input type="file" id="imagen" class="hidden" accept="image/*">
        </div>
      </div>

      <input type="text" placeholder="Título del producto" class="border p-2 w-full rounded-md outline-none focus:shadow-md focus:shadow-black/30 duration-200 transition-all">
      <textarea placeholder="Descripción del producto" class="border p-2 w-full h-30 rounded-md outline-none focus:shadow-md focus:shadow-black/30 duration-200 transition-all resize-none"></textarea>

      <select class="border p-2 w-full rounded-md outline-none focus:shadow-md focus:shadow-black/30 duration-200 transition-all">
        <option disabled selected>-- Seleccionar Marca ---</option>
        <option>Nike</option>
        <option>Puma</option>
        <option>Adidas</option>
        <option>Vans</option>
      </select>

      <input type="number" placeholder="Stock" class="border p-2 w-full rounded-md outline-none focus:shadow-md focus:shadow-black/30 duration-200 transition-all">
      <input type="number" placeholder="Precio" class="border p-2 w-full rounded-md outline-none focus:shadow-md focus:shadow-black/30 duration-200 transition-all" step="0.01" min="0">

      <input type="submit" value="Crear Producto" class="bg-blue-500 text-white p-2 rounded-md w-full cursor-pointer transition-all duration-300 hover:bg-blue-500/90">

      <p id="errorMsg" class="text-red-900 text-center hidden"></p>
    </form>




  </div>


  <!-- Título section -->
  <section class="bg-neutral-50 py-15 flex flex-col justify-center items-center gap-8">

    <div class="w-110 border-b border-b-orange-400 text-center">
      <h1 class="text-4xl font-semibold text-orange-600">Administrar Productos</h1>
    </div>

  </section>


  <!-- Secciones de productos -->
  <section class="flex flex-col justify-center items-center gap-12 py-8">
    <button id="nuevo-producto-btn" class="bg-blue-500 text-white text-xl py-2 px-5 capitalize cursor-pointer rounded-md transition-all duration-300 hover:bg-blue-500/90">Nuevo producto</button>

    <!-- Adidas -->
    <section>
      <div class="container mx-auto px-4">
        <div class="mb-12">
          <div class="bg-gradient-to-r from-orange-100 to-transparent p-8 rounded-lg mb-8">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-2">Adidas</h2>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <div class="bg-neutral-100 rounded-lg hover:shadow-xl transition p-4 flex justify-center items-center flex-col w-full shadow-lg shadow-black/30">
              <div class="aspect-square overflow-hidden rounded-lg mb-4">
                <a href="#"><img src="../../frontend/src/assets/adidas1.jfif" alt="Adidas 1" class="w-full h-full object-cover hover:scale-110 transition-transform duration-500"></a>
              </div>
              <h3 class="font-semibold text-gray-900 mb-2">Adidas Ultraboost</h3>
              <div class="flex items-center justify-center gap-5 w-full">
                <button class="py-1 px-4 bg-amber-500 rounded-sm text-white cursor-pointer transition-all duration-200 hover:bg-yellow-500/90 flex justify-center items-center gap-1">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                    <path d="M16 5l3 3" />
                  </svg>
                  Editar
                </button>
                <button class="py-1 px-4 bg-red-500 rounded-sm text-white cursor-pointer transition-all duration-200 hover:bg-red-500/90 flex justify-center items-center gap-1">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M4 7l16 0" />
                    <path d="M10 11l0 6" />
                    <path d="M14 11l0 6" />
                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                  </svg>
                  Eliminar
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>



    <!-- Nike -->
    <section>
      <div class="container mx-auto px-4">
        <div class="mb-12">
          <div class="bg-gradient-to-r from-orange-100 to-transparent p-8 rounded-lg mb-8">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-2">Nike</h2>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <div class="bg-neutral-100 rounded-lg hover:shadow-xl transition p-4 flex justify-center items-center flex-col w-full shadow-lg shadow-black/30">
              <div class="aspect-square overflow-hidden rounded-lg mb-4">
                <a href="#"><img src="../../frontend/src/assets/nike1.jfif" alt="Adidas 1" class="w-full h-full object-cover hover:scale-110 transition-transform duration-500"></a>
              </div>
              <h3 class="font-semibold text-gray-900 mb-2">Adidas Ultraboost</h3>
              <div class="flex items-center justify-center gap-5 w-full">
                <button class="py-1 px-4 bg-amber-500 rounded-sm text-white cursor-pointer transition-all duration-200 hover:bg-yellow-500/90 flex justify-center items-center gap-1">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                    <path d="M16 5l3 3" />
                  </svg>
                  Editar
                </button>
                <button class="py-1 px-4 bg-red-500 rounded-sm text-white cursor-pointer transition-all duration-200 hover:bg-red-500/90 flex justify-center items-center gap-1">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M4 7l16 0" />
                    <path d="M10 11l0 6" />
                    <path d="M14 11l0 6" />
                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                  </svg>
                  Eliminar
                </button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>


    <!-- puma -->
    <section>
      <div class="container mx-auto px-4">
        <div class="mb-12">
          <div class="bg-gradient-to-r from-orange-100 to-transparent p-8 rounded-lg mb-8">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-900 mb-2">Puma</h2>
          </div>

          <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            <div class="bg-neutral-100 rounded-lg hover:shadow-xl transition p-4 flex justify-center items-center flex-col w-full shadow-lg shadow-black/30">
              <div class="aspect-square overflow-hidden rounded-lg mb-4">
                <a href="#"><img src="../../frontend/src/assets/puma1.jfif" alt="Adidas 1" class="w-full h-full object-cover hover:scale-110 transition-transform duration-500"></a>
              </div>
              <h3 class="font-semibold text-gray-900 mb-2">Adidas Ultraboost</h3>
              <div class="flex items-center justify-center gap-5 w-full">
                <button class="py-1 px-4 bg-amber-500 rounded-sm text-white cursor-pointer transition-all duration-200 hover:bg-yellow-500/90 flex justify-center items-center gap-1">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                    <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                    <path d="M16 5l3 3" />
                  </svg>
                  Editar
                </button>
                <button class="py-1 px-4 bg-red-500 rounded-sm text-white cursor-pointer transition-all duration-200 hover:bg-red-500/90 flex justify-center items-center gap-1">
                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M4 7l16 0" />
                    <path d="M10 11l0 6" />
                    <path d="M14 11l0 6" />
                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                  </svg>
                  Eliminar
                </button>
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
<script src="/shoedev/frontend/src/js/admin_productos.js"></script>

</html>