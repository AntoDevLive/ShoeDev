    <section id="marcas" class="py-20 bg-gray-50 scroll-mt-50">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-4xl font-bold mb-12">Explora por <span class="text-orange-600">Marcas</span></h2>
            <div class="grid md:grid-cols-3 gap-6 max-w-5xl mx-auto">
                <a href="/shoedev/tienda.php#nike" class="bg-linear-to-r from-yellow-500 via-orange-500 to-red-500 shadow-lg/40 rounded-lg p-8 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl/40 cursor-pointer text-white">
                    <h3 class="text-2xl font-bold mb-2">Nike</h3>
                    <p class="text-slate-700 font-semibold"><?php echo ($productos_total_nike); ?> Productos</p>
                </a>
                <a href="/shoedev/tienda.php#adidas" class="bg-linear-to-r from-yellow-500 via-orange-500 to-red-500 shadow-lg/40 rounded-lg p-8 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl/40 cursor-pointer text-white">
                    <h3 class="text-2xl font-bold mb-2">Adidas</h3>
                    <p class="text-slate-700 font-semibold"><?php echo ($productos_total_adidas); ?> Productos</p>
                </a>
                <a href="/shoedev/tienda.php#puma" class="bg-linear-to-r from-yellow-500 via-orange-500 to-red-500 shadow-lg/40 rounded-lg p-8 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl/40 cursor-pointer text-white">
                    <h3 class="text-2xl font-bold mb-2">Puma</h3>
                    <p class="text-slate-700 font-semibold"><?php echo ($productos_total_puma); ?> Productos</p>
                </a>
            </div>
        </div>


    </section>