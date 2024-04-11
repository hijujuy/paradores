<x-modal modalId="modalRole" modalTitle="Roles">
  <form wire:submit="assignRole">
    <!-- Select multiple-->
    <div class="form-group">
      <label>Selecione un Rol</label>
      <select wire:model.live="role_id" class="form-control" size="5">
        @foreach($roles as $role)
        <option value="{{ $role->id }}">{{ $role->name }}</option>
        @endforeach
      </select>
    </div>
    
    <hr>
    <button class="btn btn-primary float-right">{{ 'Asignar' }}</button>
  </form>
</x-modal>
  