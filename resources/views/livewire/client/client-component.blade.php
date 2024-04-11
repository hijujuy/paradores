<div>
    <x-card cardTitle="Listado clientes ({{$this->totalRegistros}})">
       <x-slot:cardTools>
         @can('client.create')
         <a href="#" class="btn btn-primary" wire:click='create'>
           <i class="fas fa-plus-circle"></i> Crear 
         </a>             
         @endcan
       </x-slot>

       <x-table>
          <x-slot:thead>
             <th>ID</th>
             <th>Nombre</th>
             <th>DNI</th>
             <th>Email</th>
             <th>Telefono</th>
             <th width="3%">...</th>
             <th width="3%">...</th>
             @can('client.delete')
             <th width="3%">...</th>                 
             @endcan 
          </x-slot>

          @forelse ($clients as $client)
              
             <tr>
                <td>{{ $client->id }}</td>
                <td>{{ $client->name }}</td>
                <td>{{ $client->identity }}</td>
                <td>{{ $client->email }}</td>
                <td>{{ $client->phone }}</td>
                <td>
                    <a href="#" class="btn btn-success btn-sm" title="Ver">
                        <i class="far fa-eye"></i>
                    </a>
                </td>
                <td>
                    <a href="#" wire:click='edit({{$client->id}})' class="btn btn-primary btn-sm" title="Editar">
                        <i class="far fa-edit"></i>
                    </a>
                </td>
                @can('client.delete')
                <td>
                    <a wire:click="$dispatch('delete',{id: {{$client->id}}, eventName:'destroyClient'})" class="btn btn-danger btn-sm" title="Eliminar">
                        <i class="far fa-trash-alt"></i>
                    </a>
                </td>
                @endcan
             </tr>

          @empty

             <tr class="text-center">
                <td colspan="8">Sin registros</td>
             </tr>
              
          @endforelse
 
       </x-table>
 
       <x-slot:cardFooter>
            {{$clients->links()}}
       </x-slot>
    </x-card>

    @include('clients.form')

</div>
