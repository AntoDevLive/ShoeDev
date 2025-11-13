<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="frontend/src/output.css">
    <title>ShoeDev</title>
</head>

<body class="min-h-screen text-gray-900">

    <!-- MODAL -->
    <div id="modal" class="fixed inset-0 bg-black/50 z-40 hidden"></div>

    <!-- HEADER -->
    <?php include 'frontend/templates/Header.php' ?>

    <!-- CARRITO -->
    <?php include 'frontend/templates/Carrito.php' ?>

    <!-- HERO -->
    <?php include 'frontend/templates/Hero.php' ?>


    <!-- CATEGORÍAS -->
    <?php include 'frontend/templates/Categorias.php' ?>


    <!-- Colección de Temporada -->



    <!-- Footer -->
    <?php include 'frontend/templates/Footer.php' ?>

</body>


<script type="module" src="frontend/src/js/main.js"></script>

</html>