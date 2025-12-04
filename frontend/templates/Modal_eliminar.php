<div id="modal-eliminar" class="fixed inset-0 z-90 bg-black/70 flex justify-center items-center hidden">
  <div id="dialog-modal-eliminar" class="bg-neutral-400 flex justify-center items-center flex-col gap-5 p-5 rounded-md shadow-lg shadow-black/50">
    <!-- Mensaje dialog -->
    <div class="flex justify-center items-center flex-col gap-1">
      <p class="text-2xl font-semibold">¿Seguro que deseas eliminar este producto?</p>
      <p class="text-xl">Esta acción no podrá revertirse.</p>
    </div>
    <!-- Botones -->
    <div class="text-xl flex justify-center items-center gap-5">
      <button id="btn-dialog-eliminar" class="py-1 px-2 cursor-pointer bg-red-500 text-white rounded-md transition-all duration-200 hover:bg-red-600/80">Eliminar</button>
      <button id="btn-dialog-cancelar" class="py-1 px-2 cursor-pointer bg-gray-500 text-white rounded-md transition-all duration-200 hover:bg-gray-600/80">Cancelar</button>
    </div>
  </div>
</div>