<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="frontend/src/output.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />
  <link rel="shortcut icon" href="frontend/src/assets/favicon.png" type="image/x-icon">
  <title>ShoeDev | Contacto</title>
</head>

<body class="flex flex-col min-h-screen">

  <!-- Modal -->
  <?php include 'frontend/templates/Modal.php' ?>

  <!-- Header -->
  <?php include 'frontend/templates/Header.php' ?>

  <!-- Carrito -->
  <?php include 'frontend/templates/Carrito.php' ?>

  <div id="toast" class="text-center text-xl rounded-md bg-green-500 shadow-xl/40 fixed top-5 left-2/4 -translate-x-2/4 text-white py-2 px-5 transition-all duration-500 opacity-0 -translate-y-full">
    Mensaje enviado correctamente
  </div>

  <!-- Título -->
  <section class="bg-neutral-100 flex justify-center items-center py-15">
    <div class="border-b border-orange-500 w-120 text-center relative">
      <h1 class="text-4xl font-semibold text-orange-500 absolute -top-1.5 left-2/4 -translate-2/4 bg-neutral-100 px-3">Contacto</h1>
    </div>
  </section>
    
<section class="flex justify-center items-center bg-neutral-100 grow py-15">
  <form id="contact-form" class="bg-orange-50 shadow-2xl shadow-black/80 rounded-xl flex flex-col gap-5 w-110 px-8 py-10">
    <h2 class="text-2xl font-semibold text-gray-600 text-center">Contáctanos</h2>

    <!-- Email -->
    <input type="text" id="contact-email" placeholder="Correo electrónico" class="outline-none focus:border-orange-500 w-full rounded-md py-1.5 px-2.5 text-xl bg-white border border-orange-300">

    <!-- Asunto -->
    <input type="text" id="contact-subject" placeholder="Asunto" class="outline-none focus:border-orange-500 w-full rounded-md py-1.5 px-2.5 text-xl bg-white border border-orange-300">

    <!-- Mensaje -->
    <textarea id="contact-message" placeholder="Mensaje" rows="5" class="outline-none focus:border-orange-500 w-full rounded-md py-1.5 px-2.5 text-xl bg-white border border-orange-300 resize-none"></textarea>

    <!-- Submit -->
    <input type="submit" value="Enviar" class="cursor-pointer transition-all duration-300 hover:bg-orange-500 w-full rounded-sm p-2 text-xl bg-orange-600 text-white">
  </form>
</section>

  <?php include 'frontend/templates/Footer.php' ?>

</body>

<script src="frontend/src/js/carrito.js"></script>
<script src="frontend/src/js/main.js"></script>
<script src="frontend/src/js/contacto.js"></script>
</html>