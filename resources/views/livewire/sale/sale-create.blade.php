<div>

   @if (!$this->cashier->open)
   <x-card cardTitle="No hay caja abierta" cardTitleClass="h5">

      <x-slot:cardTools>
         <a href="{{route('cashiers')}}" class="btn btn-danger btn-sm mr-2">
            <i class="fas fa-cash-register"></i> Abrir caja
         </a>
      </x-slot>

      {{-- CONTENT --}}
      <div class="row">
        {{-- COLUMNA DETALLES ERROR --}}
        <div class="col">
            <p class="h5">No se encontró ninguna caja abierta para el usuario. Para abrir una caja, haga click 
               <a href="{{ route('cashiers') }}" class="text-warning">aquí</a>
            </p>
        </div>
      </div>
      
      <x-slot:cardFooter>          
      </x-slot>

   </x-card>

   @else
   
   <x-card cardIcon={{ true }} cardIconClass="fa-cash-register" cardTitle="{{ $this->cashier->code ?? '' }}">

      <x-slot:cardTools>
         <a href="{{route('sales.list')}}" class="btn btn-primary btn-sm mr-2">
           <i class="fas fa-shopping-cart"></i> Ir a ventas 
         </a>
         <a href="#" class="btn btn-sm btn-danger" wire:click='clear'>
           <i class="fas fa-trash"></i> Cancelar venta 
         </a>
      </x-slot>

      {{-- CONTENT --}}
      <div class="row">
        {{-- COLUMNA DETALLES VENTA --}}
        <div class="col">
         <div class="row">
            <div class="col-md-6">
               {{-- Card cliente --}}
               @livewire('sale.client')
            </div>
            <div class="col-md-6">
               {{-- Card pago --}}
               @include('sales.card-pago')
            </div>
         </div>
         <div class="row">
            <div class="col">
               {{-- Card details --}}
               @include('sales.card-details')           
            </div>
         </div>
        </div>
      </div>
      
      <x-slot:cardFooter>           
      </x-slot>

   </x-card>

   {{-- MODAL PRODUCTOS --}}
   @include('sales.list-products')

   @endif

</div>
