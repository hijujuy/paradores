<div>
    <x-card cardTitle="Lista Permisos ({{ count($permissions) }})">
       <x-slot:cardTools>
          <a href="#" class="btn btn-primary" wire:click='create'>
            <i class="fas fa-plus-circle"></i> Crear Permiso
          </a>
       </x-slot>

       <x-table>
          <x-slot:thead>
             <th>Descripcion</th>
             <th>Ruta</th>
             <th>Creación</th>
             <th>Ultima Modificación</th>
             <th colspan="2">Acciones</th>
          </x-slot>

          @forelse ($permissions as $permission)
              
             <tr>
                <td>{{ $permission->description }}</td>
                <td>{{ $permission->name }}</td>
                <td>{{ $permission->created_at->format('d/m/Y - H:i') }}</td>
                <td>{{ $permission->updated_at->format('d/m/Y - H:i') }}</td>
                <td>
                    <a wire:click='edit({{ $permission->id }})' class="btn btn-primary btn-sm" title="Editar">
                        <i class="far fa-edit"></i>
                    </a>
                </td>
                <td>
                    <a wire:click="$dispatch('delete',{id: {{ $permission->id }}, eventName:'destroyPermission'})" class="btn btn-danger btn-sm" title="Eliminar">
                        <i class="far fa-trash-alt"></i>
                    </a>
                </td>
             </tr>

             @empty

             <tr class="text-center">
                <td colspan="6">Sin registros</td>
             </tr>
              
             @endforelse
            
 
        </x-table>
  
        <x-slot:cardFooter>
             {{$permissions->links()}}
        </x-slot>
    </x-card>


@include('permissions.modal')

</div>


