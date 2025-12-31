<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="frontend/src/output.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />
  <link rel="shortcut icon" href="frontend/src/assets/favicon.png" type="image/x-icon">
  <title>ShoeDev | Login</title>
</head>

<body class="min-h-screen text-gray-900 flex flex-col">

  <!-- Modal -->
  <?php include 'frontend/templates/Modal.php' ?>


  <!-- Header -->
  <?php include 'frontend/templates/Header.php' ?>


  <!-- Carrito -->
  <?php include 'frontend/templates/Carrito.php' ?>

  <section class="h-[calc(100dvh-4rem)] grid grid-cols-1 lg:grid-cols-2 relative bg-neutral-100">


    <!-- Form Login -->
    <div class="relative flex justify-center items-center transition-all duration-300">
      <div id="login-img" class="absolute w-full h-full opacity-0 duration-500 transition-all">
        <img
          src="frontend/src/assets/img-registro.jpg"
          alt=""
          class="w-full h-full object-cover rotate-y-180 mask-[linear-gradient(to_left,black_30%,transparent)]">
      </div>

      <form method="POST" action="backend/controllers/User_controller.php" id="login-form" class="bg-orange-50 shadow-2xl shadow-black/80 rounded-xl flex justify-center items-center flex-col gap-6 w-96 px-8 py-10 z-10 transition-all duration-300">
        <h2 class="text-2xl font-semibold text-gray-600">Iniciar Sesión</h2>
        <input type="hidden" name="action" value="login">
        <input class="outline-none focus:border-orange-500 w-full rounded-md py-1.5 px-2.5 text-xl bg-white border border-orange-300" type="text" name="email" id="email-login" placeholder="Email">
        <input class="outline-none focus:border-orange-500 w-full rounded-md py-1.5 px-2.5 text-xl bg-white border border-orange-300" type="password" name="password" id="password-login" placeholder="Contraseña">
        <div class="w-full">
          <input type="checkbox" class="h-full" id="show-password">
          <label for="show-password" class="text-lg">Mostrar contraseña</label>
        </div>
        <input class="cursor-pointer transition-all duration-300 hover:bg-orange-500 w-full rounded-sm p-2 text-xl bg-orange-600 text-white" type="submit" value="Iniciar Sesión" id="submit-login">

        <p>¿Aún no tienes una cuenta? <span id="login-link" class="underline text-orange-600 font-semibold cursor-pointer">Registrarme</span></p>
      </form>
    </div>


    <!-- Form Registro -->
    <div class="relative flex justify-center items-center">
      <div id="register-img" class="absolute w-full h-full duration-500 transition-all">
        <img
          src="frontend/src/assets/img-login.jpg"
          alt=""
          class="w-full h-full object-cover mask-[linear-gradient(to_left,black_30%,transparent)]">
      </div>

      <form method="POST" action="backend/controllers/User_controller.php" id="register-form" class="bg-orange-50 shadow-2xl shadow-black/80 rounded-xl flex justify-center items-center flex-col gap-5 w-116 px-8 py-10 z-10 transition-all duration-300 opacity-0 pointer-events-none">
        <h2 class="text-2xl font-semibold text-gray-600">Registro</h2>
        <input type="hidden" name="action" value="register">

        <fieldset class="grid grid-cols-2 gap-2">
          <!-- Nombre -->
          <input class="outline-none focus:border-orange-500 w-full rounded-md py-1.5 px-2.5 text-xl bg-white border border-orange-300"
            type="text" name="nombre" placeholder="Nombre" id="nombre">

          <!-- Apellidos -->
          <input class="outline-none focus:border-orange-500 w-full rounded-md py-1.5 px-2.5 text-xl bg-white border border-orange-300"
            type="text" name="apellidos" placeholder="Apellidos" id="apellidos">

          <!-- Fecha de nacimiento -->
          <input class="outline-none focus:border-orange-500 w-full rounded-md py-1.5 px-2.5 text-xl bg-white border border-orange-300"
            type="date" name="fecha_nacimiento" id="nacimiento">

          <!-- Dirección -->
          <input class="outline-none focus:border-orange-500 w-full rounded-md py-1.5 px-2.5 text-xl bg-white border border-orange-300"
            type="text" name="direccion" placeholder="Dirección" id="direccion">
        </fieldset>

        <!-- Email -->
        <input class="outline-none focus:border-orange-500 w-full rounded-md py-1.5 px-2.5 text-xl bg-white border border-orange-300"
          type="email" name="email" placeholder="Correo electrónico" id="correo-reg">

        <!-- Username -->
        <input class="outline-none focus:border-orange-500 w-full rounded-md py-1.5 px-2.5 text-xl bg-white border border-orange-300"
          type="text" name="username" placeholder="Nombre de usuario" id="username">

        <!-- Contraseña -->
        <div class="w-full">
          <input class="outline-none focus:border-orange-500 w-full rounded-md py-1.5 px-2.5 text-xl bg-white border border-orange-300"
            type="password" name="password" placeholder="Contraseña" id="pass-reg">
        </div>

        <!-- Repite contraseña -->
        <div class="w-full">
          <input class="outline-none focus:border-orange-500 w-full rounded-md py-1.5 px-2.5 text-xl bg-white border border-orange-300"
            type="password" name="password" placeholder="Contraseña" id="pass-rep-reg">
        </div>

        <!-- Medidor de seguridad -->
         <div class="w-full grid grid-cols-2 place-items-center">
          <span class="w-full">Seguridad de la contraseña</span>
          <div class="grid grid-cols-3 w-full h-3 rounded-md overflow-hidden bg-gray-200 border- border-neutral-600 relative">
            <div class="w-full bg-red-500"></div>
            <div class="w-full bg-yellow-500"></div>
            <div class="w-full bg-green-500"></div>
            <span class="absolute top-5 left-2/4 -translate-2/4">Débil</span>
          </div>
         </div>

        <div class="w-full">
          <input type="checkbox" class="h-full" id="show-password-reg">
          <label for="show-password-reg" class="text-lg">Mostrar contraseña</label>
        </div>

        <!-- Botón -->
        <input class="cursor-pointer transition-all duration-300 hover:bg-orange-500 w-full rounded-sm p-2 text-xl bg-orange-600 text-white"
          type="submit" value="Registrarme" id="submit-reg">

        <p>¿Ya tienes una cuenta?
          <span id="register-link" class="underline text-orange-600 font-semibold cursor-pointer">Iniciar Sesión</span>
        </p>
      </form>

    </div>

  </section>

  <?php include 'frontend/templates/Footer.php' ?>
</body>

<script src="frontend/src/js/login.js"></script>
<script src="frontend/src/js/carrito.js"></script>

</html>