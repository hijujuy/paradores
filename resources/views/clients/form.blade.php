<x-modal modalId="modalClient" modalTitle="Cliente" modalSize="modal-lg">
    <form wire:submit={{ $id == 0 ? "store" : "update($id)" }}>
        <div class="form-row">

            {{-- Input Nombre --}}
            <div class="form-group col-6">
                <label for="name">Apellido y Nombre:</label>
                <input wire:model='name' type="text" class="form-control" placeholder="Nombre" id="name">
                @error('name')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input Documento --}}
            <div class="form-group col-6">
                <label for="identity">Documento:</label>
                <input wire:model='identity' type="text" class="form-control" placeholder="Documento" id="identity">
                @error('identity')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">

            {{-- Input CUIL --}}
            <div class="form-group col-6">
                <label for="tax_code">CUIL:</label>
                <input wire:model='tax_code' type="text" class="form-control" placeholder="CUIL" id="tax_code">
                @error('tax_code')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input Email --}}
            <div class="form-group col-6">
                <label for="email">Email:</label>
                <input wire:model='email' type="text" class="form-control" placeholder="Email" id="email">
                @error('email')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-row">

            {{-- Input Telefono --}}
            <div class="form-group col-6">
                <label for="phone">Telefono:</label>
                <input wire:model='phone' type="text" class="form-control" placeholder="Telefono" id="phone">
                @error('phone')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input Empresa --}}
            <div class="form-group col-6">
                <label for="business">Empresa:</label>
                <input wire:model='business' type="text" class="form-control" placeholder="Empresa" id="business">
                @error('business')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>

        </div>

        <hr>
        <button class="btn btn-primary float-right">{{ $id == 0 ? 'Guardar' : 'Editar' }}</button>
    </form>
</x-modal>
