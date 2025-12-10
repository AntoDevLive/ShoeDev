<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="../frontend/src/output.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />
  <link rel="shortcut icon" href="frontend/src/assets/favicon.png" type="image/x-icon">
  <title>ShoeDev</title>
</head>

<body>

  <!-- Modal -->
  <?php include '../frontend/templates/Modal.php' ?>


  <!-- Header -->
  <?php include '../frontend/templates/Header.php' ?>


  <!-- Carrito -->
  <?php include '../frontend/templates/Carrito.php' ?>



  <section class="bg-neutral-100 flex justify-center items-center py-10">
    <div class="border-b border-orange-500 w-120 text-center relative">
      <h1 class="text-4xl font-semibold text-orange-500 absolute -top-1.5 left-2/4 -translate-2/4 bg-neutral-100 px-3">Mis Compras</h1>
    </div>
    
  </section>

  <section>
    
  </section>



  <?php include '../frontend/templates/Footer.php' ?>
</body>

<script src="../frontend/src/js/perfil.js"></script>
<script src="../frontend/src/js/carrito.js"></script>
<script src="../frontend/src/js/main.js"></script>

</html>