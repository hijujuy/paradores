<div>

  <x-card cardTitle="Lista Cajas ({{ $this->totalCashiers }})" >
      
      <x-slot:cardTools>
          <a href="#" class="btn btn-primary" wire:click="create">
              <i class="fas fa-plus-circle"></i> Agregar Caja
          </a>
      </x-slot:cardTools>

      <div class="row">
        @if ($totalCashiers)
        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px;">
          @foreach ($cashiers as $cashier)
            <!-- small card -->
            <div class="small-box {{ $cashier->open ? 'bg-success' : 'bg-primary' }}">
              <div class="inner" style="width: 300px;">
                <h4>{{ $cashier->code }}</h4>
                <p>{{ $cashier->name }}</p>
                <p class="h5 badge badge-warning">Estado: {{ $cashier->open ? 'Abierta' : 'Cerrada' }}</p>
              </div>              
              <div class="icon">
                <i class="fas fa-cash-register"></i>
              </div>
                            
              <div class="small-box-footer">
                <div class="row">
                  <div class="col-sm-6">
                    <button 
                      wire:click="showCashier({{ $cashier->id }})"
                      class="btn btn-secondary m-2"
                      type="button"
                    >
                      {{ !$cashier->open ? 'Abrir Caja' : 'Cerrar Caja'}}
                    </button>
                  </div>
                  <div class="col-sm-6">
                    <a
                      href="{{ route('cashiers.show', $cashier) }}"
                      class="btn btn-secondary m-2"
                    >
                      Ver estados
                  </a>
                  </div>
                </div>
                
                
              </div>
            </div>
          @endforeach
        </div>
        @else
        <div class="col text-center">
          Sin Registros
        </div>
        @endif
      </div>    
    <x-slot:cardFooter>
    </x-slot:cardFooter>

  </x-card>

  <x-modal modalId="modalCashier" modalTitle="Cajas">
    <form wire:submit={{ $id == 0 ? "store" : "update($id)" }}>
      <div class="form-row">
          <div class="form-group col-12">
              <label for="code">Codigo:</label>
              <input wire:model="code" id="code" type="text" class="form-control"
                  placeholder="Codigo Caja">
              @error('code')
                  <div class="alert alert-danger w-80 mt-2">{{ $message }}</div>
              @enderror
          </div>
      </div>
      <div class="form-row">
          <div class="form-group col-12">
              <label for="name">Nombre:</label>
              <input wire:model="name" id="name" type="text" class="form-control"
                  placeholder="Nombre Caja">
              @error('name')
                  <div class="alert alert-danger w-80 mt-2">{{ $message }}</div>
              @enderror
          </div>
      </div>
      <hr>
      <button class="btn btn-primary float-right">{{ $id == 0 ? 'Guardar' : 'Actualizar' }}</button>
    </form>
  </x-modal>

  @include('cashiers.modalStatusCreate')

  <x-modal modalId="modalShowCashier" modalTitle="Caja">
    <form wire:submit="openCashier({{ $id }})">
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
          <input 
            wire:model="cash" 
            wire:change="cashUpdated()" 
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
          <input wire:model="total" id="total" type="text" class="form-control text-right @error('total') border border-danger @enderror">
          @error('total')
            <div class="alert alert-danger w-80 mt-2">{{ $message }}</div>
          @enderror
        </div>        
      </div>

      <hr>
      
      <button class="btn btn-primary float-right">Abrir Caja</button>
    </form>
  </x-modal>

  <x-modal modalId="modalCloseCashierComplete" modalTitle="Caja">
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
        <label for="cash" class="col-lg-3 col-form-label">Efectivo:</label>
        <div class="col-lg-9">
          <input wire:model="cash" wire:change="totalUpdated()" id="cash" type="text" class="form-control text-right">
        </div>
        @error('cash')
          <div class="alert alert-danger w-80 mt-2">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group row">
          <label for="debits" class="col-lg-3 col-form-label">Debitos:</label>
          <div class="col-lg-9">
            <input wire:model="debits" wire:change="totalUpdated()" id="debits" type="text" class="form-control text-right">
          </div>  
          @error('debits')
            <div class="alert alert-danger w-80 mt-2">{{ $message }}</div>
          @enderror
      </div>

      <div class="form-group row">
        <label for="credits" class="col-lg-3 col-form-label">Creditos:</label>
        <div class="col-lg-9">
          <input wire:model="credits" wire:change="totalUpdated()" id="credits" type="text" class="form-control text-right">
        </div>
        @error('credits')
          <div class="alert alert-danger w-80 mt-2">{{ $message }}</div>
        @enderror
      </div>

      <div class="form-group row">
        <label for="transfers" class="col-lg-3 col-form-label">Transferencias:</label>
        <div class="col-lg-9">
          <input wire:model="transfers" wire:change="totalUpdated()" id="transfers" type="text" class="form-control text-right">
        </div>
        @error('transfers')
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

  @include('cashiers.modalStatusClose')
  
</div>
