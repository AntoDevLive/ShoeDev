<section id="carrito" class="fixed transition-all duration-500 translate-x-full h-screen bg-neutral-100 right-0 top-0 w-110 z-50 flex items-start flex-col">
    <!-- Cabecera del carrito -->
    <header class="w-full text-xl flex justify-center items-center bg-neutral-200 shadow-sm shadow-neutral-300 py-2">
        <h2 class="">Tus productos:</h2>
        <button id="cerrar-carrito" class="absolute cursor-pointer right-2" title="Cerrar Carrito">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-x">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M18 6l-12 12" />
                <path d="M6 6l12 12" />
            </svg>
        </button>
    </header>

    <!-- Body del carrito -->
    <section class="grow w-full pt-5">

        <!-- Plantilla Producto Carrito -->
        <section class="bg-white w-5/6 mx-auto px-8 py-4 rounded-xl shadow-md/20 space-y-5">
            <div class="flex justify-start items-center gap-4 text-xl w-full">
                <div class="w-36 overflow-hidden rounded-md">
                    <img class="w-100% object-cover" src="frontend/src/assets/ref5.jpg" alt="">
                </div>
                <div>
                    <h3>Air Force</h3>
                    <span>82.00€</span>
                </div>
            </div>

            <div class="w-full flex justify-between items-center">
                <div class="text-xl">
                    <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-sm text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 shrink-0 [&_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive text-secondary-foreground h-9 px-4 py-2 has-[>svg]:px-3 bg-orange-300 cursor-pointer hover:bg-orange-300/80">-</button>

                    <input data-slot="input" class="text-center file:text-foreground placeholder:text-muted-foreground selection:bg-primary selection:text-primary-foreground dark:bg-input/30 border-input h-9 min-w-0 rounded-sm border bg-transparent px-3 py-1 text-base shadow-xs transition-[color,box-shadow] outline-none file:inline-flex file:h-7 file:border-0 file:bg-transparent file:text-sm file:font-medium disabled:pointer-events-none disabled:cursor-not-allowed disabled:opacity-50 md:text-sm focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[0.5px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive w-12" min="1" max="99" type="number" value="1" name="quantity">

                    <button class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-sm text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 shrink-0 [&_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive text-secondary-foreground h-9 px-4 py-2 has-[>svg]:px-3 bg-orange-300 cursor-pointer hover:bg-orange-300/80">+</button>
                </div>

                <button data-slot="button" class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-sm text-sm font-medium transition-all disabled:pointer-events-none disabled:opacity-50 [&amp;_svg]:pointer-events-none [&amp;_svg:not([class*='size-'])]:size-4 shrink-0 [&amp;_svg]:shrink-0 outline-none focus-visible:border-ring focus-visible:ring-[0.5px] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive bg-destructive text-white hover:bg-destructive/90 focus-visible:ring-destructive/20 dark:focus-visible:ring-destructive/40 dark:bg-destructive/60 h-9 px-4 py-2 has-[&gt;svg]:px-3 cursor-pointer bg-red-500 transform-all duration-200 hover:bg-red-500/80">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash2 lucide-trash-2" aria-hidden="true">
                        <path d="M10 11v6"></path>
                        <path d="M14 11v6"></path>
                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6"></path>
                        <path d="M3 6h18"></path>
                        <path d="M8 6V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                    </svg>
                </button>
            </div>

        </section>

        <!-- Texto Carrito vacío -->
        <section class="hidden">
            <div class="px-5 text-5xl text-center h-full flex justify-center items-center flex-col gap-5 text-gray-500">
                <p>¡Vaya!</p>
                <p class="text-3xl">Tu carrito está vacío</p>
            </div>
        </section>

    </section>

    <!-- Footer del carrito -->
    <footer class="bg-neutral-200 w-full px-8 py-5">

        <section class="w-full border-b border-b-neutral-400 pb-2">
            <div class="w-full flex justify-between items-center">
                <span>Subtotal:</span>
                <span>0.00€</span>
            </div>

            <button class="w-full bg-orange-600 mt-2 text-white rounded-sm p-1.5 cursor-pointer transition-all duration-300 hover:bg-orange-600/80 hover:tracking-wide">Proceder a la compra</button>
        </section>

        <button class="w-full bg-black text-white rounded-sm p-1 mt-2 cursor-pointer transition-all duration-300 hover:bg-black/70">Vaciar Carrito</button>

    </footer>

</section>