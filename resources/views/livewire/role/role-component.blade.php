<div class="row">
    <div class="col-md-7">
        <x-card cardTitle="Lista Roles ({{ count($roles) }})">
           <x-slot:cardTools>
              <a href="#" class="btn btn-primary" wire:click='create'>
                <i class="fas fa-plus-circle"></i> Crear Rol
              </a>
           </x-slot>
    
           <x-table>
              <x-slot:thead>
                 <th>Nombre</th>
                 <th>Creación</th>
                 <th>Modificación</th>
                 <th colspan="3" class="text-center">Acciones</th>
              </x-slot>
    
              @forelse ($roles as $role)                  
                 <tr>
                    <td>{{ $role->name }}</td>
                    <td>{{ $role->created_at->format('d/m/Y') }}</td>
                    <td>{{ $role->updated_at->format('d/m/Y') }}</td>
                    <td>
                        <a wire:click="select({{ $role->id }})" class="btn btn-success btn-sm" title="Ver Permisos">
                            <i class="fas fa-list"></i>
                        </a>
                    </td>
                    <td>
                        <a wire:click="edit({{ $role->id }})" class="btn btn-primary btn-sm" title="Editar">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                    <td>
                        <a wire:click="$dispatch('delete',{id: {{ $role->id }}, eventName:'destroyRole'})" class="btn btn-danger btn-sm" title="Eliminar">
                            <i class="fas fa-trash-alt"></i>
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
                 {{$roles->links()}}
            </x-slot>
        </x-card>        
        
    </div>{{-- /Div Column-7 --}}

    <div class="col-md-5">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Permisos [ {{ $name }} ]</h3>
            <div class="card-tools">
                <a wire:click="showPermissions" class="btn btn-primary">
                    <i class="fas fa-plus-circle"></i> Añadir Permiso    
                </a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body p-0">
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 10px">#</th>
                        <th>Descripcion</th>
                        <th style="width: 40px">Quitar</th>
                    </tr>
                </thead>
                <tbody>
                  @forelse ($permissions as $key => $permission)
                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $permission->description }}</td>
                        <td>
                            <a wire:click="$dispatch('delete',{id: {{ $permission->id }}, eventName:'revokePermission'})" class="btn btn-danger btn-sm" title="Quitar Permiso">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                  @empty
                    <tr><td colspan="3" class="text-center">SIN PERMISOS</td></tr>
                  @endforelse                
                </tbody>
            </table>
          </div>
          <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>

    @include('roles.modal')

    @include('roles.modal-permission')

</div>
