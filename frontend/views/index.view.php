<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="frontend/src/output.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />
    <title>ShoeDev</title>
</head>

<body class="min-h-screen text-gray-900">

    <!-- Modal -->
    <div id="modal" class="fixed inset-0 bg-black/50 z-40 hidden"></div>


    <!-- Header -->
    <?php include 'frontend/templates/Header.php' ?>


    <!-- Carrito -->
    <?php include 'frontend/templates/Carrito.php' ?>


    <!-- Hero -->
    <?php include 'frontend/templates/Hero.php'; ?>


    <!-- Categorías -->
    <?php include 'frontend/templates/Categorias.php' ?>


    <!-- Colección de Temporada -->
    <?php include 'frontend/templates/Temporadas.php' ?>


    <!-- Footer -->
    <?php include 'frontend/templates/Footer.php' ?>

</body>

<script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
<script src="frontend/src/js/main.js"></script>
</html>