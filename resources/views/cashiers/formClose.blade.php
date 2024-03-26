<x-modal modalId="modalCloseCashier" modalTitle="Caja">
    <form wire:submit="closeCashier({{ $id }})">
      <div class="form-row">

        <div class="form-group col-6">
            <span class="text-bold">Codigo: </span>
            <span>{{ $code }}</span>
          </div>
          <div class="form-group col-6">
            <span class="text-bold">Nombre:</span>
            <span>{{ $name }}</span>
        </div>
      
      </div>

      <div class="form-group row">
        <label for="cash" class="col-lg-3 col-form-label">Valor en caja:</label>
        <div class="col-lg-9">
          <input wire:model="cash" wire:change="totalUpdated()" id="cash" type="text" class="form-control text-right">
        </div>
        @error('cash')
          <div class="alert alert-danger w-80 mt-2">{{ $message }}</div>
        @enderror
      </div>
      
      <div class="form-group row">
        <label for="total" class="col-lg-3 col-form-label">Total:</label>
        <div class="col-lg-9">
          <input wire:model="total" id="total" type="text" class="form-control text-right">
        </div>
        @error('total')
          <div class="alert alert-danger w-80 mt-2">{{ $message }}</div>
        @enderror
      </div>

      <hr>
      
      <button class="btn btn-primary float-right">Cerrar Caja</button>
    </form>
  </x-modal>