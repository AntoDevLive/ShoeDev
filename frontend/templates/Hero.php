<section class="py-20 bg-linear-to-b from-gray-100 to-white">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-5xl font-bold mb-4">Productos <span class="text-orange-600">Estrella</span></h2>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto mb-12">Descubre nuestra selección premium de zapatillas deportivas diseñadas para el máximo rendimiento</p>

        <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">

            <?php foreach ($productos as $producto): ?>

                <!-- Producto -->
                <div id="producto" data-id="<?php echo $producto['id'] ?>" class="shadow-xl/20 rounded-lg p-6 hover:shadow-xl/30 transition group">
                    <a href="#">
                        <div class="aspect-square mb-4 bg-gray-100 rounded-lg overflow-hidden">
                            <img src="<?php echo $producto['imagen'] ?>" alt="Zapatilla" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        </div>
                    </a>
                    <div class="flex items-center gap-1 mb-2 text-yellow-500"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="currentColor" class="icon icon-tabler icons-tabler-filled icon-tabler-star">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M8.243 7.34l-6.38 .925l-.113 .023a1 1 0 0 0 -.44 1.684l4.622 4.499l-1.09 6.355l-.013 .11a1 1 0 0 0 1.464 .944l5.706 -3l5.693 3l.1 .046a1 1 0 0 0 1.352 -1.1l-1.091 -6.355l4.624 -4.5l.078 -.085a1 1 0 0 0 -.633 -1.62l-6.38 -.926l-2.852 -5.78a1 1 0 0 0 -1.794 0l-2.853 5.78z" />
                        </svg> <span class="text-sm text-gray-800"><?php echo $producto['valoracion'] ?>/5</span></div>
                    <h3 class="text-xl font-bold mb-2 capitalize"><?php echo $producto['titulo'] ?></h3>
                    <div class="flex items-center justify-between mt-4">
                        <span id="precio-producto" class="text-2xl font-bold text-orange-600"><?php echo $producto['precio'] ?></span>
                        <button id="producto-btn" class="flex items-center gap-2 bg-orange-600 text-white px-3 py-2 rounded hover:bg-orange-500 transition cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M17 17h-11v-14h-2" />
                                <path d="M6 5l14 1l-1 7h-13" />
                            </svg>
                            Comprar
                        </button>
                    </div>
                </div>

            <?php endforeach; ?>

        </div>
    </div>
</section>