<div>
    <x-card cardTitle="Lista Usuarios ({{ count($users) }})">
       <x-slot:cardTools>
          <a href="#" class="btn btn-primary" wire:click='create'>
            <i class="fas fa-plus-circle"></i> Crear Usuario
          </a>
       </x-slot>

       <x-table>
          <x-slot:thead>
             <th>Apellido y Nombre</th>
             <th>Email</th>
             <th>Contraseña</th>
             <th>Creación</th>
             <th>Modificación</th>
             <th>Estado</th>
             <th class="text-center">Rol</th>
          </x-slot>

          @forelse ($users as $user)
              
             <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    @if (Route::has('password.request'))
                    <a  
                        class="btn btn-success btn-sm" 
                        title="Restablecer Contraseña"
                        href="{{ route('password.request') }}">
                        Restablecer
                    </a>
                    @else
                    <a  
                        class="btn btn-success btn-sm" 
                        title="Restablecer Contraseña"
                        href="#" disabled>
                        Restablecer
                    </a>
                    @endif
                </td>
                <td>{{ $user->created_at->format('d/m/Y - H:i') }}</td>
                <td>{{ $user->updated_at->format('d/m/Y - H:i') }}</td>
                <td>{!! $user->activeLabel !!}</td>
                <td>
                  @if (!$user->roles->count())
                  <div class="d-flex">
                  <div 
                     class="form-control p-1 text-center" 
                     style="width: 90px; border-top-right-radius: 0px; border-bottom-right-radius: 0px;"
                  >Añadir</div>
                  <a 
                     wire:click="showRoles({{ $user->id }})" 
                     class="btn btn-success btn-sm" 
                     style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;"
                     title="Ver Permisos">
                     <i class="fas fa-plus"></i>
                  </a>
                  </div>
                  @else                  
                  <div class="d-flex">
                     <div 
                        class="form-control p-1 text-center" 
                        style="width: 90px; border-top-right-radius: 0px; border-bottom-right-radius: 0px;"
                     >{{ $user->roles[0]->name }}</div>
                     <a wire:click="$dispatch('removerol',{ id: {{ $user->id }}, role_name: '{{ $user->roles[0]->name }}', eventName:'removeRole'})" class="btn btn-danger btn-sm" style="border-top-left-radius: 0px; border-bottom-left-radius: 0px;" title="Eliminar">
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

</div>


