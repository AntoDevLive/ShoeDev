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
    <section id="carrito-body" class="grow w-full flex flex-col gap-8 pt-5 overflow-y-scroll">

        <!-- Aquí se listan todos los productos dinámicamente desde el localstorage -->

        <!-- Texto Carrito vacío -->
        <section id="carrito-vacio" class="hidden">
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
                <span>0,00 €</span>
            </div>

            <button id="comprar-carrito-btn" class="w-full bg-orange-600 mt-2 text-white rounded-sm p-1.5 cursor-pointer transition-all duration-300 hover:bg-orange-600/80 hover:tracking-wide">Proceder a la compra</button>
        </section>

        <button id="vaciar-carrito-btn" class="disabled w-full bg-black text-white rounded-sm p-1 mt-2 cursor-pointer transition-all duration-300 hover:bg-black/70">Vaciar Carrito</button>

    </footer>

</section>