<x-modal modalId="modalPermission" modalTitle="Permiso">
    <form wire:submit={{ $id == 0 ? "store" : "update($id)" }}>
        
        <div class="form-row">
            {{-- Input Description --}}
            <div class="form-group col-6">
                <label for="description">Descripción</label>
                <input wire:model='description' type="text" class="form-control" placeholder="Descripcion del permiso" id="description">
                @error('description')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">
            {{-- Input Nombre --}}
            <div class="form-group col-6">
                <label for="name">Ruta</label>
                <input wire:model='name' type="text" class="form-control" placeholder="nombre de ruta" id="name">
                @error('name')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>            
        </div>

        <hr>
        <button class="btn btn-primary float-right">{{ $id == 0 ? 'Guardar' : 'Editar' }}</button>
    </form>
</x-modal>
