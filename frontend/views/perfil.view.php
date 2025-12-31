<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../frontend/src/output.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />
  <link rel="shortcut icon" href="/shoedev/frontend/src/assets/favicon.png" type="image/x-icon">
  <title>ShoeDev | Mi perfil</title>
</head>

<body>

  <!-- Modal -->
  <?php include '../frontend/templates/Modal.php' ?>


  <!-- Header -->
  <?php include '../frontend/templates/Header.php' ?>


  <!-- Carrito -->
  <?php include '../frontend/templates/Carrito.php' ?>


  <!-- Modal Eliminar -->
  <div id="modal-eliminar" class="hidden fixed inset-0 bg-black/50 z-99 flex justify-center items-center">
    <div id="form-eliminar-cuenta" class="text-xl flex justify-between items-center flex-col bg-neutral-300 rounded-lg shadow-lg shadow-neutral-700 relative overflow-hidden">
      <button id="btn-cerrar" class="absolute top-1 right-1 cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-x">
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <path d="M18 6l-12 12" />
          <path d="M6 6l12 12" />
        </svg>
      </button>
      <header class="py-2 text-center text-[23px] bg-red-900 w-full font-semibold text-white">Eliminar cuenta</header>
      <div class="flex justify-center items-center flex-col gap-3 py-6 px-5">
        <p>Introduce tu contraseña para eliminar la cuenta</p>
        <form method="POST" action="/shoedev/backend/controllers/User_controller.php" class="w-full flex justify-center items-center relative flex-col gap-3">
          <div class="w-full flex justify-center items-center relative">
            <input name="password" id="input-confirmar-password" type="password" placeholder="Contraseña" class="bg-white text-lg py-1 px-2.5 rounded-md shadow-md w-[80%] outline-none duration-300 transition-all focus:shadow-black/50 focus:shadow-md">

            <!-- Mostrar/Ocultar contraseña -->
            <button id="password-btn" title="Mostrar/Ocultar contraseña" class="absolute right-0 top-0 cursor-pointer bg-white p-1 rounded-full">
              <svg id="eye" xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#616161" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-eye">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M10 12a2 2 0 1 0 4 0a2 2 0 0 0 -4 0" />
                <path d="M21 12c-2.4 4 -5.4 6 -9 6c-3.6 0 -6.6 -2 -9 -6c2.4 -4 5.4 -6 9 -6c3.6 0 6.6 2 9 6" />
              </svg>
              <svg id="eye-off" xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="hidden icon-tabler icons-tabler-outline icon-tabler-eye-off">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M10.585 10.587a2 2 0 0 0 2.829 2.828" />
                <path d="M16.681 16.673a8.717 8.717 0 0 1 -4.681 1.327c-3.6 0 -6.6 -2 -9 -6c1.272 -2.12 2.712 -3.678 4.32 -4.674m2.86 -1.146a9.055 9.055 0 0 1 1.82 -.18c3.6 0 6.6 2 9 6c-.666 1.11 -1.379 2.067 -2.138 2.87" />
                <path d="M3 3l18 18" />
              </svg>
            </button>
          </div>

          <input type="hidden" name="action" value="eliminar-cuenta">

          <input id="submit-eliminar-cuenta" type="submit" value="Eliminar cuenta" class="bg-red-500 text-lg py-1 px-2.5 rounded-md w-[50%] duration-300 hover:bg-red-500/85 cursor-pointer transition-all text-white">
        </form>

      </div>
    </div>
  </div>

  <!-- Imagen y username -->
  <section class="bg-neutral-50 flex justify-center items-center flex-col p-10">
    <form id="form-user-profile" enctype="multipart/form-data" action="/shoedev/backend/controllers/User_controller.php" method="POST" class="flex justify-center items-center gap-4">
      <input id="input-profile" type="hidden" name="action" value="setUsername">

      <div class="user-profile w-30 h-30 cursor-pointer relative overflow-hidden rounded-full group">

        <div class="absolute opacity-0 w-28 h-28 bg-black/50 rounded-full flex justify-center items-center 
              top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 transition-opacity duration-300
              group-hover:opacity-100">
          <svg xmlns="http://www.w3.org/2000/svg" width="35" height="35" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-camera">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M5 7h1a2 2 0 0 0 2 -2a1 1 0 0 1 1 -1h6a1 1 0 0 1 1 1a2 2 0 0 0 2 2h1a2 2 0 0 1 2 2v9a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-9a2 2 0 0 1 2 -2" />
            <path d="M9 13a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
          </svg>
        </div>

        <img id="preview-img" class="object-cover" src="/shoedev/backend/uploads/profile/<?php echo $perfil['imagen']; ?>" alt="">

        <input id="profile-img" type="file" name="img-perfil" class="absolute inset-0 opacity-0 cursor-pointer" accept="image/*">
      </div>

      <div class="username-perfil flex justify-center items-center gap-4">
        <h2 id="username-text" class="text-5xl font-semibold capitalize"><?php echo $_SESSION['username'] ?></h2>
        <input type="hidden" name="id" value="<?php echo $perfil['usuario_id'] ?>">
        <input name="username" id="username-input" type="text" class="text-4xl py-1 px-2 bg-orange-50 rounded-md font-semibold capitalize outline-none focus:border-orange-400 focus:border-2 border border-orange-300 hidden w-96" value="<?php echo $_SESSION['username'] ?>">

        <!-- Botones editar y guardar -->
        <button title="Editar nombre" id="edit-username-btn" class="bg-yellow-500 p-1 rounded-full cursor-pointer transition-all duration-200 hover:bg-yellow-500/80">
          <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
            <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
            <path d="M16 5l3 3" />
          </svg>
        </button>

        <button id="save-user-btn" type="submit" class="bg-blue-500 py-2 px-5 rounded-md text-white hidden text-md cursor-pointer transition-all duration-200 hover:bg-blue-600">Guardar</button>

        <button id="cancel-btn" type="submit" class="bg-gray-500 py-2 px-5 rounded-md text-white  text-md cursor-pointer transition-all duration-200 hover:bg-gray-600 hidden">Cancelar</button>
      </div>

    </form>

  </section>

  <!-- Datos del usuario -->
  <section class="flex justify-center items-center flex-col gap-4 bg-neutral-100 p-10 relative">
    <div class="flex justify-center items-center gap-2">

      <!-- Toast -->
      <div id="toast-edit"
        class="text-xl bg-green-500 text-white py-2 px-5 absolute left-0 top-0 rounded-tr-md rounded-br-md -translate-x-full duration-500 transition-all opacity-0">
      </div>

      <h3 class="text-4xl">Mi información</h3>
      <button title="Editar información" id="edit-info-btn" class="bg-yellow-500 p-1 rounded-full cursor-pointer transition-all duration-200 hover:bg-yellow-500/80">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-edit">
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <path d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
          <path d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
          <path d="M16 5l3 3" />
        </svg>
        <button id="cancel-info-btn" type="submit" class="bg-gray-500 py-1.5 px-4 rounded-md text-white  text-md cursor-pointer transition-all duration-200 hover:bg-gray-600 hidden">Cancelar</button>
      </button>
    </div>
    <form id="info-profile-form" class="disabled w-150 py-12 px-8 bg-orange-50 flex flex-col gap-5 justify-center items-center shadow-xl rounded-lg">
      <input type="hidden" name="action" value="update-info">
      <fieldset class="grid grid-cols-2 w-full gap-5">
        <input class="bg-white border border-orange-300 p-1.5 text-xl rounded-md w-full" type="email" placeholder="Email" value="<?php echo $perfil['email'] ?>" name="email">
        <input class="bg-white border border-orange-300 p-1.5 text-xl rounded-md w-full capitalize" type="text" placeholder="Nombre" value="<?php echo $perfil['nombre'] ?>" name="nombre">
        <input class="bg-white border border-orange-300 p-1.5 text-xl rounded-md w-full capitalize" type="text" placeholder="Apellidos" value="<?php echo $perfil['apellidos'] ?>" name="apellidos">
        <input class="bg-white border border-orange-300 p-1.5 text-xl rounded-md w-full capitalize" type="text" placeholder="Dirección" value="<?php echo $perfil['direccion'] ?>" name="direccion">
      </fieldset>
      <input class="bg-white border border-orange-300 p-1.5 text-xl rounded-md w-full" type="date" placeholder="Nacimiento" value="<?php echo $perfil['nacimiento'] ?>" name="nacimiento">
      <button id="edit-info-submit" class="p-2.5 text-xl text-white rounded-md w-full bg-orange-600 transition-all duration-300 hover:bg-orange-600/85 cursor-pointer flex justify-center items-center gap-2" type="submit">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-device-floppy">
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <path d="M6 4h10l4 4v10a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2v-12a2 2 0 0 1 2 -2" />
          <path d="M12 14m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
          <path d="M14 4l0 4l-6 0l0 -4" />
        </svg>
        Guardar
      </button>
    </form>

    <div class="w-full flex justify-center items-center gap-8 mx-auto my-8">
      <a href="/shoedev/backend/config/cerrar.php" class="text-md text-white bg-gray-900 py-2 px-5 rounded-xl cursor-pointer transition-all duration-200 hover:bg-gray-900/80">
        Cerrar Sesión
      </a>
      <button id="eliminar-cuenta-btn" class="text-md text-white bg-red-700 py-2 px-5 rounded-xl cursor-pointer transition-all duration-200 hover:bg-red-700/80">
        Eliminar Cuenta
      </button>
    </div>
  </section>

  <?php include '../frontend/templates/Footer.php' ?>
</body>

<script src="../frontend/src/js/perfil.js"></script>
<script src="../frontend/src/js/carrito.js"></script>
<script src="../frontend/src/js/main.js"></script>

</html>