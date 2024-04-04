<x-modal modalId="modalStatusCreate" modalTitle="Caja">
    <form wire:submit="openCashier({{ $id }})">
      <div class="form-row">

        <div class="form-group col-6">
            <span class="text-bold">Codigo: </span>
            <span>{{ $cashier->code }}</span>
          </div>
          <div class="form-group col-6">
            <span class="text-bold">Nombre:</span>
            <span>{{ $cashier->name }}</span>
        </div>
      
      </div>

      <div class="form-group row">
        <label for="cash" class="col-lg-3 col-form-label">Efectivo:</label>
        <div class="col-lg-9">
          <input 
            wire:model="cash" 
            wire:change="totalUpdated()" 
            id="cash" 
            type="text" 
            class="form-control text-right @error('cash') border border-danger @enderror">
            @error('cash')
            <div class="alert alert-danger w-80 mt-2 alert-dismissible fade show">
              {{ $message }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            @enderror
        </div>        
      </div>
      
      <div class="form-group row">
        <label for="total" class="col-lg-3 col-form-label">Total:</label>
        <div class="col-lg-9">
          <input wire:model="total" id="total" type="text" class="form-control text-right @error('total') border border-danger @enderror" readonly>
          @error('total')
            <div class="alert alert-danger w-80 mt-2">{{ $message }}</div>
          @enderror
        </div>        
      </div>

      <hr>
      
      <button class="btn btn-primary float-right">Abrir Caja</button>
    </form>
  </x-modal>