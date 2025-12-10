<?php

require '../backend/config/database.php';

$conexion = conectarDB();

$stmt = $conexion->prepare("SELECT perfil.nombre, perfil.apellidos, perfil.direccion, usuario.email FROM perfil RIGHT JOIN usuario ON usuario.id = perfil.usuario_id");
$stmt->execute();
$info = $stmt->fetch();

?>


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

<body class="min-h-screen text-gray-900 flex flex-col">

  <!-- Modal -->
  <?php include __DIR__ . '/../templates/Modal.php' ?>

  <!-- Header -->
  <?php include __DIR__ . '/../templates/Header.php' ?>

  <!-- Carrito -->
  <?php include __DIR__ . '/../templates/Carrito.php' ?>

  <!-- Modal compra -->
  <div id="modal-compra" class="fixed inset-0 bg-black/50 flex justify-center items-center hidden">

    <!-- Procesando card -->
    <div id="card-procesando" class="bg-neutral-300 flex justify-center items-center flex-col gap-2 z-99 rounded-md py-5 px-6 shadow-md shadow-black/60">
      <!-- Loader -->
      <div id="loader" class=""></div>
      <p class="text-xl">Procesando la compra, espere por favor.</p>
    </div>

    <!-- Exito card -->
    <div id="card-exito" class="bg-neutral-300 flex justify-center items-center flex-col gap-1 z-101 rounded-md py-5 px-6 shadow-md shadow-black/60 hidden">
      <div class="flex justify-center items-center gap-2">
        <div class="flex justify-center items-center bg-green-600 rounded-full p-1">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-check">
            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
            <path d="M5 12l5 5l10 -10" />
          </svg>
        </div>
        <p class="text-xl">pedido realizado exitosamente</p>
      </div>
      <p class="text-lg">Gracias por confiar en ShoeDev.</p>
    </div>


  </div>

  <!-- Título section -->
  <section class="bg-neutral-50 py-15 flex flex-col justify-center items-center gap-8">

    <div class="w-110 border-b border-b-orange-400 text-center">
      <h1 class="text-4xl font-semibold text-orange-600">Procedimiento al pago</h1>
    </div>

  </section>


  <!-- info compra-->
  <section class="flex flex-col lg:flex-row gap-8 px-6 grow py-10">

    <!-- CARD USUARIO -->
    <div class="flex-1 flex justify-center">

      <div class="max-w-xl w-full">

        <div class="bg-white shadow-md rounded-xl overflow-hidden border border-gray-200">

          <!-- Header de la card -->
          <div class="bg-orange-500 px-6 py-2">
            <h2 class="text-white font-semibold text-lg text-center">Información del Usuario</h2>
          </div>

          <!-- Contenido -->
          <div class="p-7 bg-neutral-50/70">

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

              <!-- Nombre -->
              <div class="bg-white py-2 px-4 rounded-lg shadow-sm border">
                <p class="text-sm text-gray-500 font-medium">Nombre</p>
                <p class="text-gray-800 font-semibold">
                  <?php echo $info['nombre']; ?>
                </p>
              </div>

              <!-- Apellidos -->
              <div class="bg-white py-2 px-4 rounded-lg shadow-sm border">
                <p class="text-sm text-gray-500 font-medium">Apellidos</p>
                <p class="text-gray-800 font-semibold">
                  <?php echo $info['apellidos']; ?>
                </p>
              </div>

              <!-- Dirección -->
              <div class="bg-white py-2 px-4 rounded-lg shadow-sm border">
                <p class="text-sm text-gray-500 font-medium">Dirección</p>
                <p class="text-gray-800 font-semibold">
                  <?php echo $info['direccion']; ?>
                </p>
              </div>

              <!-- Email -->
              <div class="bg-white py-2 px-4 rounded-lg shadow-sm border">
                <p class="text-sm text-gray-500 font-medium">Email</p>
                <p class="text-gray-800 font-semibold">
                  <?php echo $info['email']; ?>
                </p>
              </div>

            </div>

          </div>
        </div>

      </div>
    </div>

    <!-- Tabla productos -->
    <div class="overflow-x-auto flex-1">
      <table class="min-w-full bg-white rounded-lg shadow-md overflow-hidden">
        <thead class="bg-orange-500">
          <tr>
            <th class="px-4 py-3 text-left font-semibold text-white">Producto</th>
            <th class="px-4 py-3 text-left font-semibold text-white">Cantidad</th>
            <th class="px-4 py-3 text-left font-semibold text-white">Precio</th>
            <th class="px-4 py-3 text-left font-semibold text-white">Subtotal</th>
          </tr>
        </thead>

        <tbody id="tbody" class="bg-neutral-50/70">
        </tbody>

        <tfoot>
          <tr class="bg-orange-100">
            <td colspan="3" class="px-4 py-3 text-right font-semibold text-gray-700">
              Total:
            </td>
            <td id="totalFinal" class="px-4 py-3 font-bold text-gray-900"></td>
          </tr>
        </tfoot>
      </table>

      <button data-user-id="<?php echo $_SESSION['id']; ?>" id="confirmar-compra-btn" class="text-xl py-2 px-6 rounded-md bg-green-500 text-white mt-4 cursor-pointer duration-200 transition-all hover:bg-green-500/80">Confirmar compra</button>

    </div>

  </section>





  <!-- Footer -->
  <?php include __DIR__ . '/../templates/Footer.php' ?>

</body>

<script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.9.3/dist/confetti.browser.min.js"></script>
<script src="/shoedev/frontend/src/js/carrito.js"></script>
<script src="/shoedev/frontend/src/js/main.js"></script>
<script src="/shoedev/frontend/src/js/compra.js"></script>

</html>