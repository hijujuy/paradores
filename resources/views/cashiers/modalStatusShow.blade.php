<x-modal-primary modalId="modalStatusCashierShow" modalSize="modal-lg">

    <x-slot:header>
        <span class="h2 profile-username text-center mb-2">{{ $cashier->name }}</span>          
        <div class="float-right">
            <b>Tipo de Operacion:</b><span class="ml-2">{{ $operation == 'open' ? 'Apertura' : 'Cierre' }}</span>
        </div>
    </x-slot>

    <ul class="list-group mb-3">
        <li class="list-group-item">
            <div class="row">
                <div class="col">
                    <p><b>Detalles de la Operacion</b></p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <span class="mt-1 mb-1">Fecha: {!! $date !!}</span>
                </div>
                <div class="col-md-4">
                    <span class="mt-1 mb-1">Hora: {!! $time !!}</span>
                </div>
                <div class="col-md-4">
                    <span class="mt-1 mb-1">Usuario: {{ $username }}</span>
                </div>
            </div>            
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
                        <span class="mt-1 mb-1 mr-4">{{ $cash }}</span>
                    </div>
                    <div class="col-md-3 text-right">
                        <span class="mt-1 mb-1 mr-4">{{ $real_cash }}</span>
                    </div>
                    <div class="col-md-3 text-right">
                        <span class="mt-1 mb-1 mr-4">{{ $diff_cash }}</span>
                    </div>
                </div>
                
            </li>
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-3">Debitos</div>
                    <div class="col-md-3 text-right">
                        <p class="mt-1 mb-1 mr-4">{{ $debits }}</p>
                    </div>
                    <div class="col-md-3 text-right">
                        <p class="mt-1 mb-1 mr-4">{{ $real_debits }}</p>
                    </div>
                    <div class="col-md-3 text-right">
                        <p class="mt-1 mb-1 mr-4">{{ $diff_debits }}</p>
                    </div>
                </div>                
            </li>
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-3">Creditos</div>
                    <div class="col-md-3 text-right">
                        <p class="mt-1 mb-1 mr-4">{{ $credits }}</p>
                    </div>
                    <div class="col-md-3 text-right">
                        <p class="mt-1 mb-1 mr-4">{{ $real_credits }}</p>
                    </div>
                    <div class="col-md-3 text-right">
                        <p class="mt-1 mb-1 mr-4">{{ $diff_credits }}</p>
                    </div>
                </div>                
            </li>
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-3">Transferencia</div>
                    <div class="col-md-3 text-right">
                        <p class="mt-1 mb-1 mr-4">{{ $transfers }}</p>
                    </div>
                    <div class="col-md-3 text-right">
                        <p class="mt-1 mb-1 mr-4">{{ $real_transfers }}</p>
                    </div>
                    <div class="col-md-3 text-right">
                        <p class="mt-1 mb-1 mr-4">{{ $diff_transfers }}</p>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="row">
                    <div class="col-md-3">Total</div>
                    <div class="col-md-3 text-right">
                        <p class="mt-1 mb-1 mr-4">{{ $total }}</p>
                    </div>
                    <div class="col-md-3 text-right">
                        <p class="mt-1 mb-1 mr-4">{{ $real_total }}</p>
                    </div>
                    <div class="col-md-3 text-right">
                        <p class="mt-1 mb-1 mr-4">{{ $diff_total }}</p>
                    </div>
                </div>
            </li>
        </li>
    </ul>
 </x-modal-primary>