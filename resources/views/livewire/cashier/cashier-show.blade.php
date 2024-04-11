<div>
<x-card cardTitle="{{$this->cashier->name}}">
    <x-slot:cardTools>
       <a href="{{route('cashiers')}}" class="btn btn-primary">
        <i class="fas fa-arrow-circle-left"></i> Regresar
       </a>
    </x-slot>
    
    <div class="row">
        <div class="col">
            <table class="table table-hover text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Operacion</th>
                        <th>Usuario</th>
                        <th>Fecha - Hora</th>
                        <th>Registrado</th>
                        <th>Real</th>
                        <th>Diferencia</th>                        
                    </tr>
                </thead>
                <tbody>
                    @forelse ($statuses as $status)
                    @can('view', $status)
                    <tr wire:click="showById({{ $status->id }})">
                        <td>{{ $status->id }}</td>
                        <td>{{ $status->operation == 'open' ? 'Abrió' : 'Cerró' }}</td>
                        <td>{{ $status->user->name }}</td>
                        <td>{{ $status->date.' '.$status->time }}</td>
                        <td>{{ money($status->total) }}</td>
                        <td>{{ money($status->real_total) }}</td>
                        <td>{{ money($status->diff_total) }}</td>
                    </tr>                        
                    @endcan
                    @empty
                    <tr>
                        <td colspan="5">Sin Registros</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    {{$statuses->links()}}
                </tfoot>
            </table>
            
        </div>    
    </div>

</x-card>
 
@include('cashiers.modalStatusShow')

</div>