<section id="inicio" class="py-20 bg-linear-to-b from-gray-100 to-white scroll-mt-20">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-5xl font-bold mb-4">Productos <span class="text-orange-600">Estrella</span></h2>
        <p class="text-lg text-gray-600 max-w-2xl mx-auto mb-12">Descubre nuestra selección premium de zapatillas deportivas diseñadas para el máximo rendimiento</p>

        <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">

            <?php foreach ($productos_estrella as $producto): ?>

                <!-- Producto -->
                <div data-id="<?php echo $producto['id'] ?>" class="producto shadow-xl/20 rounded-lg p-6 hover:shadow-xl/30 transition group flex flex-col justify-center items-start">
                    <a href="/shoedev/producto.php?id=<?php echo $producto['id'] ?>">
                        <div class="aspect-square mb-4 bg-gray-100 rounded-lg overflow-hidden">
                            <img src="/shoedev/backend/uploads/products/<?php echo $producto['imagen'] ?>" alt="Zapatilla" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                        </div>
                    </a>
                    <div class="flex justify-center items-start flex-col">
                        <span class="inline-block bg-gray-200 text-gray-700 px-2 py-1 rounded mb-2 text-sm capitalize"><?php echo $producto['marca'] ?></span>
                        <h3 class="text-xl font-bold mb-2 capitalize"><?php echo $producto['titulo'] ?></h3>
                    </div>
                    <div class="flex items-center justify-between mt-1 relative w-full">
                        <span class="precio-producto text-2xl font-bold text-orange-600"><?php echo $producto['precio'] ?></span>
                        <button class="producto-btn flex items-center gap-2 bg-orange-600 text-white px-3 py-2 rounded hover:bg-orange-500 transition cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                <path d="M17 17h-11v-14h-2" />
                                <path d="M6 5l14 1l-1 7h-13" />
                            </svg>
                            Añadir
                        </button>
                        <button class="producto-agregado-btn hidden flex items-center gap-1 bg-green-600 px-3 py-2 rounded cursor-cursor text-sm text-white">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-check">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M5 12l5 5l10 -10" />
                            </svg>
                            Producto añadido
                        </button>
                    </div>
                </div>

            <?php endforeach; ?>

        </div>
    </div>
</section>