<x-modal modalId="modalRole" modalTitle="Rol">
    <form wire:submit={{ $id == 0 ? "store" : "update($id)" }}>
        
        <div class="form-row">
            {{-- Input Nombre --}}
            <div class="form-group col-6">
                <label for="name">Nombre</label>
                <input wire:model='name' type="text" class="form-control" placeholder="nombre" id="name">
                @error('name')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>            
        </div>

        <hr>
        <button class="btn btn-primary float-right">{{ $id == 0 ? 'Guardar' : 'Editar' }}</button>
    </form>
</x-modal>
