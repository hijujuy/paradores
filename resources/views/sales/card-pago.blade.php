<div class="card card-info">
    <div class="card-header py-1">
        <h3 class="card-title">
          <i class="fas fa-wallet"></i>
          Pago

        </h3>

        <div class="card-tools d-flex justify-content-center align-self-center">

            <span class="mr-2">Total: <b>{{money($total)}}</b></span>

           @livewire('sale.currency',['total'=>$total])
            
        </div>
    </div>
    <div class="card-body pt-1 pb-2">
        <div class="row">
            <div class="col-md-3">
                <label class="mb-0 ml-2" for="payment">Tipo:</label>
            </div>
            <div class="col-md-4">
                <label class="mb-0 ml-2" for="payment">Referencia:</label>
            </div>
            <div class="col-md-4">
                <label class="mb-0 ml-2" for="payment">Monto:</label>
            </div>
        </div>

        @forelse ($this->payments as $index => $payment)
        <div class="row">
            <div class="col-md-3">
                <input type="text" class="form-control form-control-border" value="{{ $payment->name }}" readonly>
            </div>                    
            <div class="col-md-4">
                <input 
                    type="text" 
                    class="form-control form-control-border"
                    wire:model="payments.{{ $index }}.reference"
                    value="{{ $payment->reference }}" 
                    placeholder="referencia ..." 
                >
            </div>
            <div class="col-md-4">
                <input
                    type="text" 
                    wire:model="payments.{{ $index }}.amount"
                    wire:keyup="calculateTotalPayment"
                    class="form-control form-control-border text-right" 
                    value="{{ $payment->amount }}"
                >    
            </div>
            <div class="col-md-1">
                <!-- Boton para eliminar el medio de pago -->
                <button 
                    wire:click="removePayment({{ $index }})"
                    type="button"
                    class="btn btn-danger btn-sm"
                    title="Eliminar">
                <i class="fas fa-trash-alt"></i>
            </button>
            </div>
        </div>    
        @empty
        <div class="row">
            <div class="col">
                <hr>
            </div>
        </div>
        @endforelse

        <div class="row mt-2">
            <div class="col-md-7">
                <div class="btn-group">
                    <button type="button" class="btn btn-primary"><i class="fas fa-plus-circle"></i> Medio de Pago</button>
                    <button type="button" class="btn btn-primary dropdown-toggle dropdown-icon" data-toggle="dropdown">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu" role="menu">
                        @forelse ($payment_types as $payment_type)
                        <a class="dropdown-item" wire:click="addPayment({{ $payment_type->id }})">{{ $payment_type->name }}</a>
                        @empty
                        <a class="dropdown-item">Sin medios de pago</a>
                        @endforelse                      
                    </div>
                  </div>
            </div>
            <div class="col-md-4">
                <input 
                    type="text" 
                    class="form-control  text-right {{ $total_payment_error ? 'border border-danger':'' }}" 
                    wire:model.live="total_payment"
                    readonly                    
                >
            </div>
        </div>        
    </div>
</div>
