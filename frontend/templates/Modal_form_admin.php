  <div id="modal-form" class="fixed z-20 inset-0 flex justify-center items-center bg-black/50 hidden">
    <form enctype="multipart/form-data" method="POST" action="/shoedev/crear_producto.php" class="flex flex-col justify-center items-center bg-neutral-100 gap-6 py-10 px-8 w-120 rounded-lg shadow-lg shadow-black/50 relative">
      
    <input type="hidden" name="action" value="crear-producto">

      <button id="cerrar-btn" class="absolute right-2 top-2 cursor-pointer">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="gray" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-x">
          <path stroke="none" d="M0 0h24v24H0z" fill="none" />
          <path d="M18 6l-12 12" />
          <path d="M6 6l12 12" />
        </svg>
      </button>

      <!-- Input imagen -->
      <div class="flex justify-center items-center gap-3">

        <!-- Preview -->
        <div id="preview" class="w-20 h-20 hidden rounded-md overflow-hidden shadow-md">
          <!-- preview image -->
        </div>

        <!-- Botón subir -->
        <div class="w-60">
          <label for="imagen"
            class="bg-orange-500 text-white py-2 rounded-md w-full block text-center cursor-pointer transition-all hover:bg-orange-500/90">
            Subir Imagen
          </label>

          <input type="file" id="imagen" class="hidden" accept="image/*" name="imagen">
        </div>
      </div>

      <input name="titulo" type="text" placeholder="Título del producto" class="border p-2 w-full rounded-md outline-none focus:shadow-md focus:shadow-black/30 duration-200 transition-all">
      <textarea name="descripcion" placeholder="Descripción del producto" class="border p-2 w-full h-30 rounded-md outline-none focus:shadow-md focus:shadow-black/30 duration-200 transition-all resize-none"></textarea>

      <select name="marca" class="border p-2 w-full rounded-md outline-none focus:shadow-md focus:shadow-black/30 duration-200 transition-all">
        <option disabled selected>-- Seleccionar Marca ---</option>
        <option value="nike">Nike</option>
        <option value="puma">Puma</option>
        <option value="adidas">Adidas</option>
        <option value="vans">Vans</option>
      </select>

      <input name="stock" type="number" placeholder="Stock" class="border p-2 w-full rounded-md outline-none focus:shadow-md focus:shadow-black/30 duration-200 transition-all">
      <input name="precio" type="number" placeholder="Precio" class="border p-2 w-full rounded-md outline-none focus:shadow-md focus:shadow-black/30 duration-200 transition-all" step="0.01" min="0">

      <input id="submit" type="submit" value="Crear Producto" class="bg-blue-500 text-white p-2 rounded-md w-[50%] self-start cursor-pointer transition-all duration-300 hover:bg-blue-500/90">

      <p id="errorMsg" class="text-red-900 text-center hidden"></p>
    </form>

  </div>