<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="/shoedev/frontend/src/output.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />
    <link rel="shortcut icon" href="/shoedev/frontend/src/assets/favicon.png" type="image/x-icon">
  <title>ShoeDev | Admin</title>
</head>

<body class="min-h-screen text-gray-900">

  <!-- Modal -->
  <?php include __DIR__ . '/../templates/Modal.php' ?>

  <!-- Header -->
  <?php include __DIR__ . '/../templates/Header.php' ?>

  <!-- Carrito -->
  <?php include __DIR__ . '/../templates/Carrito.php' ?>


  <section class="bg-neutral-50/50 py-15 flex flex-col justify-center items-center gap-8">

    <div class="w-90 border-b border-b-slate-600 text-center">
      <p class="text-3xl font-semibold text-slate-800">Panel de administrador</p>
    </div>

    <h1 class="capitalize text-5xl font-semibold text-orange-600">Bienvenido, <?php echo $_SESSION['username'] ?></h1>

  </section>


  <section class="py-20 bg-neutral-100">
    <div class="max-w-5xl mx-auto grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 px-6">

      <!-- Card Administrar productos -->
      <a href="/shoedev/backend/admin/productos.php"
        class="group bg-white rounded-2xl shadow-md hover:shadow-lg hover:shadow-black/30 p-6 transition-all duration-300 border border-slate-200 flex items-center justify-center flex-col">

        <div class="w-16 h-16 bg-orange-100 rounded-xl group-hover:bg-orange-200 transition self-center flex justify-center items-center">
          <svg xmlns="http://www.w3.org/2000/svg"
            fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor"
            class="w-10 h-10 text-orange-600">
            <path stroke-linecap="round" stroke-linejoin="round"
              d="M20.25 7.5V19.5A2.25 2.25 0 0118 21.75H6A2.25 2.25 0 013.75 19.5V7.5m16.5 0V4.875A2.625 2.625 0 0017.625 2.25H6.375A2.625 2.625 0 003.75 4.875V7.5m16.5 0H3.75m6 4.5h4.5m-4.5 4.5h4.5" />
          </svg>
        </div>

        <h2 class="mt-5 text-2xl font-semibold text-slate-800 group-hover:text-orange-600 transition">
          Administrar productos
        </h2>

        <p class="mt-2 text-slate-600 text-md">
          Agrega, edita y elimina productos de la tienda de forma rápida, segura y eficiente.
        </p>
      </a>


      <!-- Card Administrar Usuarios -->
      <a href="/shoedev/backend/admin/usuarios.php"
        class="group bg-white rounded-2xl shadow-md hover:shadow-lg hover:shadow-black/30 p-6 transition-all duration-300 border border-slate-200 flex items-center justify-center flex-col">

        <div class="w-16 h-16 bg-orange-100 rounded-xl group-hover:bg-orange-200 transition self-center flex justify-center items-center">
          <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 24 24" fill="none" stroke="orangered" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
            <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
          </svg>
        </div>

        <h2 class="mt-5 text-2xl font-semibold text-slate-800 group-hover:text-orange-600 transition">
          Administrar usuarios
        </h2>

        <p class="mt-2 text-slate-600 text-md">
          Gestiona la información de los usuarios y elimina cuentas de forma segura.
        </p>

      </a>


      <!-- Card listar compras -->
      <a href="/shoedev/backend/admin/compras.php"
        class="group bg-white rounded-2xl shadow-md hover:shadow-lg hover:shadow-black/30 p-6 transition-all duration-300 border border-slate-200 flex items-center justify-center flex-col">

        <div class="w-16 h-16 bg-orange-100 rounded-xl group-hover:bg-orange-200 transition self-center flex justify-center items-center">
          <svg xmlns="http://www.w3.org/2000/svg" width="38" height="38" viewBox="0 0 24 24" fill="none" stroke="orangered" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-list">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M9 6l11 0" />
            <path d="M9 12l11 0" />
            <path d="M9 18l11 0" />
            <path d="M5 6l0 .01" />
            <path d="M5 12l0 .01" />
            <path d="M5 18l0 .01" />
          </svg>
        </div>

        <h2 class="mt-5 text-2xl font-semibold text-slate-800 group-hover:text-orange-600 transition">
          Historial de compras
        </h2>

        <p class="mt-2 text-slate-600 text-md">
          Consulta todas las compras realizadas en ShoeDev de forma rápida y eficiente.
        </p>
      </a>

    </div>
  </section>

  <!-- Footer -->
  <?php include __DIR__ . '/../templates/Footer.php' ?>
</body>

<script src="/shoedev/frontend/src/js/carrito.js"></script>
<script src="/shoedev/frontend/src/js/main.js"></script>

</html>