    <section class="flex justify-center items-center flex-col gap-8 py-26">

        <div class="text-center mb-12">
            <h2 class="text-4xl font-bold mb-4 text-foreground">
                Colección de <span class="text-orange-600">Temporada</span>
            </h2>
            <p class="text-lg text-muted-foreground max-w-2xl mx-auto">
                Lo último en tendencias deportivas para esta temporada
            </p>
        </div>

        <div class="swiper-container">
            <div class="swiper">
                <!-- Additional required wrapper -->
                <div class="swiper-wrapper">
                    <!-- Slides -->
                    <?php foreach ($productos_temporada as $producto): ?>




                        <div data-id="<?php echo $producto['id'] ?>" class="swiper-slide producto shadow-xl/20 rounded-lg p-6 hover:shadow-xl/30 transition group flex flex-col justify-center items-start">
                            <a href="/shoedev/producto.php?id=<?php echo $producto['id'] ?>">
                                <div class="img-container aspect-square mb-4 bg-gray-100 rounded-lg overflow-hidden">
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

            <!-- If we need pagination -->
            <div class="swiper-pagination"></div>

            <!-- If we need navigation buttons -->
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </section>