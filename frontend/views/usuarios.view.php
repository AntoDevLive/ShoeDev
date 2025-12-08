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

<body class="min-h-screen flex flex-col text-gray-900">

  <!-- Modal -->
  <?php include __DIR__ . '/../templates/Modal.php' ?>

  <!-- Modal form -->
  <div id="modal-form" class="fixed z-20 inset-0 flex justify-center items-center bg-black/50 hidden">

    <form id="user-form" method="POST" action="/shoedev/edit_user_info.php" class="flex flex-col justify-center items-center bg-neutral-100 gap-6 py-10 px-8 w-120 rounded-lg shadow-lg shadow-black/50 relative">

      <button id="cerrar-btn" class="absolute right-2 top-2 cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="gray" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <path d="M18 6l-12 12" />
          <path d="M6 6l12 12" />
        </svg>
      </button>

      <input type="hidden" name="id" id="id">

      <input name="username" id="usuario" type="text" placeholder="Usuario" class="border p-2 w-full rounded-md outline-none focus:shadow-md focus:shadow-black/30 duration-200 transition-all">

      <input name="email" id="email" type="email" placeholder="Email" class="border p-2 w-full rounded-md outline-none focus:shadow-md focus:shadow-black/30 duration-200 transition-all">

      <input name="nombre" id="nombre" type="text" placeholder="Nombre" class="border p-2 w-full rounded-md outline-none focus:shadow-md focus:shadow-black/30 duration-200 transition-all">

      <input name="apellidos" id="apellidos" type="text" placeholder="Apellidos" class="border p-2 w-full rounded-md outline-none focus:shadow-md focus:shadow-black/30 duration-200 transition-all">

      <input name="direccion" id="direccion" type="text" placeholder="Dirección" class="border p-2 w-full rounded-md outline-none focus:shadow-md focus:shadow-black/30 duration-200 transition-all">

      <input name="nacimiento" id="nacimiento" type="date" class="border p-2 w-full rounded-md outline-none focus:shadow-md focus:shadow-black/30 duration-200 transition-all">

      <select name="rol" id="rol" class="border p-2 w-full rounded-md outline-none focus:shadow-md focus:shadow-black/30 duration-200 transition-all">
        <option disabled selected>-- Seleccionar Rol --</option>
        <option value="admin">Admin</option>
        <option value="user">User</option>
      </select>

      <input id="submit" type="submit" value="Guardar Cambios" class="bg-blue-500 text-white p-2 rounded-md w-[50%] self-start cursor-pointer transition-all duration-300 hover:bg-blue-500/90">

      <p id="errorMsg" class="text-red-900 text-center hidden"></p>

    </form>

  </div>

  <!-- Modal eliminar -->
  <div id="modal-eliminar" class="fixed inset-0 z-90 bg-black/70 flex justify-center items-center hidden">
    <div id="dialog-modal-eliminar" class="bg-neutral-200 flex justify-center items-center flex-col gap-5 p-5 rounded-md shadow-lg shadow-black/50">
      <!-- Mensaje dialog -->
      <div class="flex justify-center items-center flex-col gap-1">
        <p class="text-2xl font-semibold">¿Seguro que deseas eliminar este usuario?</p>
        <p class="text-xl">Esta acción no podrá revertirse.</p>
      </div>
      <!-- Botones -->
      <div class="text-xl flex justify-center items-center gap-5">
        <button id="btn-dialog-eliminar" class="py-1 px-2 cursor-pointer bg-red-500 text-white rounded-md transition-all duration-200 hover:bg-red-600/80">Eliminar</button>
        <button id="btn-dialog-cancelar" class="py-1 px-2 cursor-pointer bg-gray-500 text-white rounded-md transition-all duration-200 hover:bg-gray-600/80">Cancelar</button>
      </div>
    </div>
  </div>

  <!-- Toast -->
  <div id="toast" class="bg-green-500 text-white py-2 px-5 text-xl rounded-br-md rounded-tr-md shadow-md shadow-neutral-500 fixed top-50 left-0 -translate-x-full opacity-0 transition-all duration-500"></div>

  <!-- Header -->
  <?php include __DIR__ . '/../templates/Header.php' ?>

  <!-- Carrito -->
  <?php include __DIR__ . '/../templates/Carrito.php' ?>

  <!-- Título section -->
  <section class="bg-neutral-50 py-15 flex flex-col justify-center items-center gap-8">

    <div class="w-110 border-b border-b-orange-400 text-center">
      <h1 class="text-4xl font-semibold text-orange-600">Administrar Usuarios</h1>
    </div>

  </section>


  <!-- Usuarios -->
  <section class="py-8 grow">

    <!-- Filters -->
    <div class="flex justify-center items-center flex-col gap-2 w-full">
      <div class="max-w-2xl mx-auto mb-6 relative barra-busqueda w-full">
        <input id="searchInput" type="text" placeholder="Buscar usuarios..." class="pl-10 h-12 w-full border border-gray-400 rounded-md focus:outline-none focus:ring-2 focus:ring-orange-600">
        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-search">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
            <path d="M21 21l-6 -6" />
          </svg>
        </span>
      </div>

      <!-- Buttons -->
      <div class="w-full flex justify-center items-center gap-10">
        <button data-action="recent" id="btnRecent" class="filter-btn py-2 px-5 rounded-md border border-gray-400 cursor-pointer duration-200 transition-all hover:bg-orange-600 hover:text-white">Más recientes primero</button>
        <button data-action="oldest" id="btnOldest" class="filter-btn py-2 px-5 rounded-md border border-gray-400 cursor-pointer duration-200 transition-all hover:bg-orange-600 hover:text-white">Más antiguos primero</button>
        <button data-action="admin" id="btnAdmin" class="filter-btn py-2 px-5 rounded-md border border-gray-400 cursor-pointer duration-200 transition-all hover:bg-orange-600 hover:text-white">Administradores</button>
        <button data-action="standard" id="btnStandard" class="filter-btn py-2 px-5 rounded-md border border-gray-400 cursor-pointer duration-200 transition-all hover:bg-orange-600 hover:text-white">Usuarios estándar</button>
      </div>
    </div>

    <div class="overflow-x-auto px-6 py-10">
      <table id="usersTable" class="min-w-full border border-gray-200 rounded-lg overflow-hidden shadow-sm">
        <thead class="bg-orange-600 text-white">
          <tr>
            <th class="py-3 px-4 text-center text-md font-semibold">ID</th>
            <th class="py-3 px-4 text-center text-md font-semibold">Usuario</th>
            <th class="py-3 px-4 text-center text-md font-semibold">Email</th>
            <th class="py-3 px-4 text-center text-md font-semibold">Nombre</th>
            <th class="py-3 px-4 text-center text-md font-semibold">Apellidos</th>
            <th class="py-3 px-4 text-center text-md font-semibold">Dirección</th>
            <th class="py-3 px-4 text-center text-md font-semibold">Nacimiento</th>
            <th class="py-3 px-4 text-center text-md font-semibold">Rol</th>
            <th class="py-3 px-4 text-center text-md font-semibold">Acciones</th>
          </tr>
        </thead>

        <tbody id="usersTbody" class="divide-y divide-gray-200 bg-white text-center">



        </tbody>
      </table>
    </div>
  </section>

  <!-- Footer -->
  <?php include __DIR__ . '/../templates/Footer.php' ?>

</body>

<!-- scripts -->
<script src="/shoedev/frontend/src/js/carrito.js"></script>
<script src="/shoedev/frontend/src/js/main.js"></script>
<script src="/shoedev/frontend/src/js/admin_usuarios.js"></script>

</html>