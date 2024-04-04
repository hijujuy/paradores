<x-modal-primary modalId="modalStatusClose" modalSize="modal-lg">

  <form wire:submit="closeCashier({{ $id }})">
    
    <x-slot:header>
      <div class="d-flex flex-row">
        <div class="h3">{{ $name }}</div>
      </div>
    </x-slot>

    <ul class="list-group mb-2">
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-5">
                      <span class="mt-1 mb-1"><b class="mr-2">Fecha - Hora:</b>{!! $date_time !!}</span>
                    </div>
                    <div class="col-md-3">
                      <span class="mt-1 mb-1"><b class="mr-2">Usuario:</b>{{ $username }}</span>
                    </div>
                    <div class="col-md-4">
                      <b class="mr-2">Tipo de Operacion:</b><span class="ml-2">CIERRE</span>
                    </div>
                </div>        
            </li>
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-3 text-center border-right"></div>
                    <div class="col-md-3 text-center border-right">Registrado</div>
                    <div class="col-md-3 text-center border-right">Real</div>
                    <div class="col-md-3 text-center">Diferencia</div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-3">Efectivo</div>
                    <div class="col-md-3 text-right">
                      <span name="cash" class="form-control border-0 mr-4" readonly>{{ $cash }}</span>
                    </div>
                    <div class="col-md-3">
                      <input 
                        wire:model="real_cash"
                        wire:change="realUpdated('cash')"
                        type="text" 
                        name="real_cash" 
                        id="real_cash"
                        class="form-control form-control-border text-right align-top">
                    </div>
                    <div class="col-md-3 text-right">
                      <span name="diff_cash" class="form-control border-0 mr-4" readonly>{{ $diff_cash }}</span>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-3">Debitos</div>
                    <div class="col-md-3 text-right">
                      <span name="debits" class="form-control border-0 mr-4" readonly>{{ $debits }}</span>
                    </div>
                    <div class="col-md-3 text-right">
                      <input 
                        wire:model="real_debits"
                        wire:change="realUpdated('debits')"
                        type="text" 
                        name="real_debits" 
                        id="real_debits"
                        class="form-control form-control-border text-right align-top">
                    </div>
                    <div class="col-md-3 text-right">
                      <span name="diff_debits" class="form-control border-0 mr-4" readonly>{{ $diff_debits }}</span>
                    </div>
                </div>                
            </li>
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-3">Creditos</div>
                    <div class="col-md-3 text-right">
                      <span name="credits" class="form-control border-0" readonly>{{ $credits }}</span>
                    </div>
                    <div class="col-md-3 text-right">
                      <input 
                        wire:model="real_credits"
                        wire:change="realUpdated('credits')"
                        type="text" 
                        name="real_credits" 
                        id="real_credits"
                        class="form-control form-control-border text-right align-top">
                    </div>
                    <div class="col-md-3 text-right">
                      <span name="diff_credits" class="form-control border-0" readonly>{{ $diff_credits }}</span>
                    </div>
                </div>                
            </li>
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-3">Transferencia</div>
                    <div class="col-md-3 text-right">
                      <span name="transfers" class="form-control border-0" readonly>{{ $transfers }}</span>
                    </div>
                    <div class="col-md-3 text-right">
                      <input 
                        wire:model="real_transfers"
                        wire:change="realUpdated('transfers')"
                        type="text" 
                        name="real_transfers" 
                        id="real_transfers"
                        class="form-control form-control-border text-right align-top">
                    </div>
                    <div class="col-md-3 text-right">
                      <span name="diff_transfers" class="form-control border-0" readonly>{{ $diff_transfers }}</span>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-3">Total</div>
                    <div class="col-md-3 text-right">
                      <span name="total" class="form-control border-0" readonly>{{ $total }}</span>
                    </div>
                    <div class="col-md-3 text-right">
                      <span name="real_total" class="form-control border-0" readonly>{{ $real_total }}</span>
                    </div>
                    <div class="col-md-3 text-right">
                      <span name="diff_total" class="form-control border-0" readonly>{{ $diff_total }}</span>
                    </div>
                </div>
            </li>
    </ul>
    
    <button class="btn btn-primary float-right">Cerrar Caja</button>
  </form>

</x-modal-primary>