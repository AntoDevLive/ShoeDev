<?php $sesion = isset($_GET['session']) ? $_GET['session'] : ''; ?>

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

    <?php if ($sesion === 'false'): ?>

        <div id="modal-session" class="fixed inset-0 bg-black/50 z-99 flex justify-center items-center">
            <div id="dialog-session" class="bg-neutral-300 flex justify-center items-center flex-col gap-5 py-8 px-5 rounded-md shadow-lg shadow-black/50">
                <p class="text-2xl text-slate-700">Debes iniciar sesión para proceder a la compra</p>
                <div class="flex justify-center items-center gap-5 text-lg">
                    <a class="bg-blue-500 rounded-sm duration-200 transition-all hover:bg-blue-600 text-white py-1 px-5" href="/shoedev/login.php">Iniciar sesión</a>
                    <button class="bg-gray-500 rounded-sm duration-200 transition-all hover:bg-gray-600 text-white py-1 px-5 cursor-pointer" id="cancel-btn-session">Cancelar</button>
                </div>
            </div>
        </div>

    <?php endif; ?>

    <!-- Subir Btn -->
    <?php include 'frontend/templates/Btn_subir.php' ?>

    <!-- Modal -->
    <?php include 'frontend/templates/Modal.php' ?>


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
<script src="frontend/src/js/carrito.js"></script>
<script src="frontend/src/js/swiper.js"></script>
<script src="frontend/src/js/main.js"></script>
<script src="/shoedev/frontend/src/js/modal_session.js"></script>

</html>