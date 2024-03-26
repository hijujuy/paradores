<div>

    <x-card cardTitle="Lista Categorias ({{ $totalRegistros }})" >

        <x-slot:cardTools>
            <a href="#" class="btn btn-primary" wire:click="create">
                <i class="fas fa-plus-circle"></i> Crear Categoria
            </a>
        </x-slot:cardTools>

        <x-table>

            <x-slot:thead>
                <th>Nro</th>
                <th>Nombre</th>
                <th width="3%">...</th>
                <th width="3%">...</th>
                <th width="3%">...</th>
            </x-slot>

            @forelse ($categories as $category)
                <tr>
                    <td>{{ $category->id }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <a class="btn btn-success btn-sm" title="ver">
                            <i class="far fa-eye"></i>
                        </a>
                    </td>
                    <td>
                        <a wire:click="edit({{ $category->id }})" class="btn btn-primary btn-sm" title="editar">
                            <i class="fas fa-edit"></i>
                        </a>
                    </td>
                    <td>
                        <a 
                            wire:click="$dispatch('delete', {id:{{ $category->id }}, eventName:'destroyCategory'})" 
                            class="btn btn-danger btn-sm" title="eliminar">
                            <i class="fas fa-trash-alt"></i>
                        </a>
                    </td>
                </tr>

            @empty
                <tr class="text-center">
                    <td colspan="5">Sin Registros</td>
                </tr>
            @endforelse

        </x-table>

        <x-slot:cardFooter>
          {{ $categories->links() }}
        </x-slot:cardFooter>

    </x-card>

    <x-modal modalId="modalCategory" modalTitle="Categorias">
        <form wire:submit={{ $id == 0 ? "store" : "update($id)" }}>
            <div class="form-row">
                <div class="form-group col-12">
                    <label for="name">Nombre:</label>
                    <input wire:model="name" id="name" type="text" class="form-control"
                        placeholder="Nombre Categoria">
                    @error('name')
                        <div class="alert alert-danger w-80 mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <hr>
            <button class="btn btn-primary float-right">{{ $id == 0 ? 'Guardar' : 'Actualizar' }}</button>
        </form>
    </x-modal>

</div>
