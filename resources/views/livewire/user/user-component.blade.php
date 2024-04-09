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
             <th>Creado</th>
             <th>Ultima Modificacion</th>
             <th>Estado</th>
             <th>Rol</th>
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
                <td>{{ $user->rol }}</td>
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


{{-- @include('products.modal') --}}

</div>


