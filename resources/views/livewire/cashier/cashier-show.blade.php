<x-card cardTitle="Detalles de operaciones">
    <x-slot:cardTools>
       <a href="{{route('cashiers')}}" class="btn btn-primary">
        <i class="fas fa-arrow-circle-left"></i> Regresar
       </a>
    </x-slot>
    
    <div class="row">
        <div class="col-md-4">

            <div class="card card-primary card-outline">
                <div class="card-body box-profile">

                    <h2 class="profile-username text-center mb-2">{{$cashier->name}}</h2>
                
                    <ul class="list-group mb-3">
                        <li class="list-group-item">
                            <b>Estados</b> <a class="float-right"></a>
                        </li>
                        <li class="list-group-item">
                            <b>Articulos</b> 
                            <a class="float-right">
                                
                            </a>
                        </li>

                    </ul>
                    
                </div>
            
            </div>
            
        </div>
        <div class="col-md-8">
            <table class="table text-center">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Operacion</th>
                        <th>Usuario</th>
                        <th>Fecha - Hora</th>
                        <th>Total</th>
                        
                    </tr>
                </thead>
                <tbody>

                    @forelse ($statuses as $status)
                    <tr>
                        <td>{{ $status->id }}</td>
                        <td>{{ $status->operation }}</td>
                        <td>{{ $status->user->name }}</td>
                        <td>{{ $status->date_time }}</td>
                        <td>{{ money($status->total) }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">Sin Registros</td>
                    </tr>
                    @endforelse
                </tbody>
                <tfoot>
                    {{-- {{$statuses->links()}} --}}
                </tfoot>
            </table>
            
        </div>    
    </div>

 </x-card>