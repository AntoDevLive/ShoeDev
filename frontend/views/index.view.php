<?php session_start() ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="frontend/src/output.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />
    <link rel="shortcut icon" href="frontend/src/assets/favicon.png" type="image/x-icon">
    <title>ShoeDev</title>
</head>

<body class="min-h-screen text-gray-900">

    <!-- Modal -->
    <div id="modal" class="fixed inset-0 bg-black/50 z-40 flex justify-center items-center hidden">
        <section id="dialog" class="hidden">
            <div class="bg-neutral-300 flex justify-center items-center gap-4 flex-col p-6 rounded-lg shadow-xl/80">
                <div class="flex justify-center items-center flex-col">
                    <p class="text-2xl">¿Desea eliminar todos los productos del carrito?</p>
                    <p class="text-xl p-0 m-0">Esta acción no podrá revertirse</p>
                </div>
                <div class="flex justify-center items-center gap-4">
                    <button id="dialog-confirmar" class="text-xl py-1 px-5 rounded-md cursor-pointer transition-all duration-300 bg-orange-600 hover:bg-orange-600/80 text-white">Confirmar</button>
                    <button id="dialog-cancelar" class="text-xl py-1 px-5 rounded-md cursor-pointer transition-all duration-300 bg-neutral-500 hover:bg-neutral-500/80 text-white">Cancelar</button>
                </div>
            </div>
        </section>
    </div>


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