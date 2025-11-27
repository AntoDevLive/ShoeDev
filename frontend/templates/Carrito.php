<section class="carrito fixed transition-all duration-500 translate-x-full h-screen bg-neutral-100 right-0 top-0 w-110 z-50 flex items-start flex-col shadow-2xl">
    <!-- Cabecera del carrito -->
    <header class="w-full text-xl flex justify-center items-center bg-neutral-200 shadow-sm shadow-neutral-300 py-2">
        <h2 class="">Tus productos:</h2>
        <button class="cerrar-carrito absolute cursor-pointer right-2" title="Cerrar Carrito">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-x">
                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                <path d="M18 6l-12 12" />
                <path d="M6 6l12 12" />
            </svg>
        </button>
    </header>

    <!-- Body del carrito -->
    <section class="carrito-body grow w-full flex flex-col gap-8 pt-5 overflow-y-scroll">

        <!-- Aquí se listan todos los productos dinámicamente desde el localstorage -->

        <!-- Texto Carrito vacío -->
        <section class="carrito-vacio hidden h-full">
            <div class="px-5 text-4xl text-center h-full flex justify-center items-center flex-col gap-5 text-gray-500">
                <p>¡Vaya!</p>
                <p class="text-3xl">Tu carrito está vacío</p>
                <svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 24 24" fill="none" stroke="lightgray" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="-rotate-15 icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                    <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                    <path d="M17 17h-11v-14h-2" />
                    <path d="M6 5l14 1l-1 7h-13" />
                </svg>
                <a class="bg-orange-600 text-2xl text-white py-2 px-5 rounded-lg transition-all duration-300 hover:bg-orange-500 hover:tracking-wide" href="tienda.php">Ir a la tienda</a>
            </div>
        </section>

    </section>

    <!-- Footer del carrito -->
    <footer class="bg-neutral-200 w-full px-8 py-5">

        <section class="w-full border-b border-b-neutral-400 pb-2">
            <div class="w-full flex justify-between items-center">
                <span>Subtotal:</span>
                <span class="subtotal">0,00 €</span>
            </div>

            <button class="comprar-carrito-btn w-full bg-orange-600 mt-2 text-white rounded-sm p-1.5 cursor-pointer transition-all duration-300 hover:bg-orange-600/80 hover:tracking-wide">Proceder a la compra</button>
        </section>

        <button class="vaciar-carrito-btn disabled w-full bg-black text-white rounded-sm p-1 mt-2 cursor-pointer transition-all duration-300 hover:bg-black/70">Vaciar Carrito</button>

    </footer>

</section>