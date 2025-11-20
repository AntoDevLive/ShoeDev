<header class="bg-white/90">
    <nav class="border-b border-b-slate-400/40 backdrop-blur">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <a href="/shoedev/index.php" class="text-2xl font-bold">
                    Shoe<span class="text-orange-600">Dev</span>
                </a>
                <div class="flex items-center gap-6">


                    <!-- Botón iniciar sesión -->
                    <?php if (basename($_SERVER['SCRIPT_NAME']) !== 'login.php' && !isset($_SESSION['username'])): ?>
                        <a href="login.php" class="login-btn cursor-pointer flex items-center gap-2 bg-sky-600 text-white px-4 py-2 rounded hover:bg-sky-500 transition">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-user">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                            </svg>
                            Iniciar Sesión
                        </a>
                    <?php elseif (basename($_SERVER['SCRIPT_NAME']) !== 'login.php' && isset($_SESSION['username'])): ?>
                        <!-- Perfil de usuario -->
                        <div class="relative">
                            <!-- IMG de usuario -->
                            <div class="user-profile w-9 h-9 cursor-pointer">
                                <img src="frontend/src/assets/user-default.png" alt="">
                            </div>

                            <!-- Menú de usuario -->
                            <section class="user-menu flex justify-center items-center flex-col text-xl user-submenu absolute bg-slate-700 text-white w-50 rounded-lg overflow-hidden opacity-0 pointer-events-none transition-all duration-300">
                                <header class="w-full h-full bg-slate-800 flex justify-center items-center gap-2 py-2 border-b px-5 border-slate-600">
                                    <div class="w-7 h-7">
                                        <img src="frontend/src/assets/user-default.png" alt="">
                                    </div>
                                    <span class="truncate">username</span>
                                </header>
                                <!-- links -->
                                <nav class="w-full">
                                    <ul class="text-[1.05rem]">
                                        <li class="w-full">
                                            <a class="transition-all duration-300 hover:bg-slate-600 flex items-center gap-2 py-1.5 px-4 border-b border-slate-500" href="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-bag">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M6.331 8h11.339a2 2 0 0 1 1.977 2.304l-1.255 8.152a3 3 0 0 1 -2.966 2.544h-6.852a3 3 0 0 1 -2.965 -2.544l-1.255 -8.152a2 2 0 0 1 1.977 -2.304z" />
                                                    <path d="M9 11v-5a3 3 0 0 1 6 0v5" />
                                                </svg>
                                                Mis compras
                                            </a>
                                        </li>
                                        <li class="w-full">
                                            <a class="transition-all duration-300 hover:bg-slate-600 flex items-center gap-2 py-1.5 px-4 border-b border-slate-500" href="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-bag-heart">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M11.5 21h-2.926a3 3 0 0 1 -2.965 -2.544l-1.255 -8.152a2 2 0 0 1 1.977 -2.304h11.339a2 2 0 0 1 1.977 2.304c-.057 .368 -.1 .644 -.127 .828" />
                                                    <path d="M9 11v-5a3 3 0 0 1 6 0v5" />
                                                    <path d="M18 22l3.35 -3.284a2.143 2.143 0 0 0 .005 -3.071a2.242 2.242 0 0 0 -3.129 -.006l-.224 .22l-.223 -.22a2.242 2.242 0 0 0 -3.128 -.006a2.143 2.143 0 0 0 -.006 3.071l3.355 3.296z" />
                                                </svg>
                                                Lista de deseos
                                            </a>
                                        </li>
                                        <li class="w-full">
                                            <a class="transition-all duration-300 hover:bg-slate-600 flex items-center gap-2 py-1.5 px-4 border-b border-slate-500" href="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-settings">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M10.325 4.317c.426 -1.756 2.924 -1.756 3.35 0a1.724 1.724 0 0 0 2.573 1.066c1.543 -.94 3.31 .826 2.37 2.37a1.724 1.724 0 0 0 1.065 2.572c1.756 .426 1.756 2.924 0 3.35a1.724 1.724 0 0 0 -1.066 2.573c.94 1.543 -.826 3.31 -2.37 2.37a1.724 1.724 0 0 0 -2.572 1.065c-.426 1.756 -2.924 1.756 -3.35 0a1.724 1.724 0 0 0 -2.573 -1.066c-1.543 .94 -3.31 -.826 -2.37 -2.37a1.724 1.724 0 0 0 -1.065 -2.572c-1.756 -.426 -1.756 -2.924 0 -3.35a1.724 1.724 0 0 0 1.066 -2.573c-.94 -1.543 .826 -3.31 2.37 -2.37c1 .608 2.296 .07 2.572 -1.065z" />
                                                    <path d="M9 12a3 3 0 1 0 6 0a3 3 0 0 0 -6 0" />
                                                </svg>
                                                Configuración
                                            </a>
                                        </li>
                                        <li class="w-full">
                                            <a class="transition-all duration-300 hover:bg-slate-600 flex items-center gap-2 py-1.5 px-4" href="#">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-logout-2">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path d="M10 8v-2a2 2 0 0 1 2 -2h7a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-7a2 2 0 0 1 -2 -2v-2" />
                                                    <path d="M15 12h-12l3 -3" />
                                                    <path d="M6 15l-3 -3" />
                                                </svg>
                                                Cerrar sesión
                                            </a>
                                        </li>

                                    </ul>
                                </nav>
                            </section>

                        </div>

                    <?php elseif (basename($_SERVER['SCRIPT_NAME']) == 'login.php' && isset($_SESSION['username'])): ?>
                    <?php header('Location: perfil.php') ;?>
                    <?php endif; ?>

                    <a href="tienda.php" class="text-sm font-medium hover:text-orange-600 transition">Tienda</a>
                    <a href="index.php#categorias" class="text-sm font-medium text-gray-500 hover:text-orange-600 transition">Categorías</a>
                    <a href="contacto.php" class="text-sm font-medium text-gray-500 hover:text-orange-600 transition">Contacto</a>

                    <button id="carrito-btn" class="cursor-pointer flex items-center gap-2 bg-orange-600 text-white p-2 rounded-full hover:bg-orange-500 transition relative">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-shopping-cart">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M6 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                            <path d="M17 19m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                            <path d="M17 17h-11v-14h-2" />
                            <path d="M6 5l14 1l-1 7h-13" />
                        </svg>

                        <span
                            class="cart-bubble opacity-0 bg-orange-300 absolute -top-3 -right-3 text-slate-800 py-1 px-3 rounded-full">
                            0
                        </span>
                    </button>

                </div>

            </div>
        </div>
    </nav>
</header>