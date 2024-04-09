<x-modal modalId="modalPermissions" modalTitle="Permisos">
  <form wire:submit="addPermission({{ $id }})">
    <!-- Select multiple-->
    <div class="form-group">
      <label>Selecione Permiso/s</label>
      <select wire:model.live="permissions_selected" multiple class="form-control">
        @foreach($leftPermissions as $permission)
        <option value="{{ $permission->id }}">{{ $permission->description }}</option>
        @endforeach
      </select>
    </div>
    
    <hr>
    <button class="btn btn-primary float-right">{{ 'Añadir' }}</button>
  </form>
</x-modal>
