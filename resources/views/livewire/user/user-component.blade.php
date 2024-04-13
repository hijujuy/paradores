<div>
    <x-card cardTitle="Lista Usuarios ({{ count($users) }})">
       <x-slot:cardTools>
          <a wire:click="create"  class="btn btn-primary">
            <i class="fas fa-plus-circle"></i> Crear Usuario
          </a>
       </x-slot>

       <x-table>
          <x-slot:thead>
             <th>Apellido y Nombre</th>
             <th>Email</th>
             <th>Estado</th>
             <th>Contraseña</th>
             <th class="text-center">Rol</th>
          </x-slot>

          @forelse ($users as $user)
              
             <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{!! $user->activeLabel !!}</td>
                <td>
                  <a wire:click='resetPassword({{$user->id}})' class="btn btn-primary btn-sm" title="Editar">
                     <span>Restablecer</span>
                  </a>                  
                </td>
                <td>
                  @if (!$user->roles->count())
                  <div class="d-flex justify-content-center">
                  <div 
                     class="form-control p-1 text-center" 
                     style="width: 90px; border-top-right-radius: 0px; border-bottom-right-radius: 0px;"
                  >Añadir</div>
                  <a 
                     wire:click="showRoles({{ $user->id }})" 
                     class="btn btn-success btn-sm" 
                     style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;"
                     title="Añadir Permiso">
                     <i class="fas fa-plus"></i>
                  </a>
                  </div>
                  @else                  
                  <div class="d-flex justify-content-center">
                     <div 
                        class="form-control p-1 text-center" 
                        style="width: 90px; border-top-right-radius: 0px; border-bottom-right-radius: 0px;"
                     >{{ $user->rolename }}</div>
                     <a wire:click="$dispatch('removerol',{ id: {{ $user->id }}, role_name: '{{ $user->roles[0]->name }}', eventName:'removeRole'})" 
                        class="btn btn-danger btn-sm" 
                        style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" 
                        title="Eliminar">
                        <i class="fas fa-trash-alt"></i>
                     </a>
                  </div>
                  @endif
                </td>
             </tr>

             @empty

             <tr class="text-center">
                <td colspan="10">Sin registros</td>
             </tr>
              
             @endforelse
            
 
        </x-table>
  
        <x-slot:cardFooter>
             {{$users->links()}}
        </x-slot>
    </x-card>


@include('users.modal-role')

@include('users.modal')

</div>


