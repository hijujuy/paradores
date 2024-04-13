<x-modal modalId="modalUser" modalTitle="User">
    <form wire:submit={{ $user_id == 0 ? "store" : "changePassword($user_id)" }}>

        @if (!$user_id)
        <div class="form-row">

            {{-- Input Nombre --}}
            <div class="form-group col">
                <label for="name">Apellido y Nombre:</label>
                <input wire:model='name' type="text" class="form-control" placeholder="Nombre" id="name" name="name">
                @error('name')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>
            
        </div>

        <div class="form-row">

            {{-- Input Email --}}
            <div class="form-group col">
                <label for="email">Email:</label>
                <input wire:model='email' type="text" class="form-control" placeholder="Email" id="email" name="email">
                @error('email')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>

        </div>

        @endif

        <div class="form-row">

            {{-- Input Password --}}
            <div class="form-group col-6">
                <label for="password">
                    @if ($user_id)
                    <span>Nueva Contraseña:</span>                        
                    @else
                    <span>Contraseña:</span>
                    @endif                    
                </label>
                <div class="input-group">
                    <input wire:model='password' type="{{ $hide_password ? 'password' : 'text' }}" class="form-control" id="password"  name="password">
                    <div class="input-group-append">
                        <button wire:click="togglePassword" class="btn btn-outline-primary" type="button">
                            <i class="fas fa-{{ $hide_password ? 'eye' : 'eye-slash' }}"></i>
                        </button>
                    </div>
                </div>
                
                @error('password')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>

            {{-- Input Password --}}
            <div class="form-group col-6">
                <label for="password-confirm">
                    @if ($user_id)
                    <span>Confirmar Nueva Contraseña:</span>
                    @else
                    <span>Confirmar Contraseña:</span>
                    @endif                    
                </label>
                <div class="input-group">
                    <input wire:model='password_confirmation' type="{{ $hide_password_confirmation ? 'password' : 'text' }}" class="form-control" id="password-confirm"  name="password_confirmation">
                    <div class="input-group-append">
                        <button wire:click="togglePasswordConfirmation" class="btn btn-outline-primary" type="button">
                            <i class="fas fa-{{ $hide_password_confirmation ? 'eye' : 'eye-slash' }}"></i>
                        </button>
                    </div>
                </div>
                @error('password_confirmation')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>

        </div>

        @if (!$user_id)
        <div class="form-row">

            {{-- Select Rol --}}
            <div class="form-group col">
                <label for="role_id">Seleccionar Rol:</label>
                <select wire:model="role_id" name="role_id" id="role_id" class="form-control">
                    @foreach ($roles as $role)
                    <option value="{{ $role->id }}">{{ $role->name }}</option>
                    @endforeach
                </select>

                @error('role_id')
                    <div class="alert alert-danger w-100 mt-2">{{ $message }}</div>
                @enderror
            </div>
            
        </div>
        @endif
        
        <hr>
        <button class="btn btn-primary float-right">Guardar</button>
    </form>
</x-modal>
