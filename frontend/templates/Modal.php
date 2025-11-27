    <div class="modal fixed inset-0 bg-black/50 z-40 flex justify-center items-center hidden">
      <section id="dialog" class="hidden">
        <div class="bg-neutral-300 flex justify-center items-center gap-4 flex-col p-6 rounded-lg shadow-xl/80">
          <div class="flex justify-center items-center flex-col">
            <p class="text-2xl">¿Desea eliminar todos los productos del carrito?</p>
            <p class="text-xl p-0 m-0">Esta acción no podrá revertirse</p>
          </div>
          <div class="flex justify-center items-center gap-4">
            <button id="dialog-confirmar" class="text-xl py-1 px-5 rounded-md cursor-pointer transition-all duration-300 bg-orange-600 hover:bg-orange-600/80 text-white">Confirmar</button>
            <button id="dialog-cancelar" class="text-xl py-1 px-5 rounded-md cursor-pointer transition-all duration-300 bg-neutral-500 hover:bg-neutral-500/80 text-white">Cancelar</button>
          </div>
        </div>
      </section>
    </div>