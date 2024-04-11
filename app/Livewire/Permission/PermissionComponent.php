<?php

namespace App\Livewire\Permission;

use stdClass;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Builder;

#[Title('Permisos')]
class PermissionComponent extends Component
{
    use WithPagination;

    //Class model
    public $id = 0;
    public $description = '';
    public $name = '';

    //Class Props
    public $search = '';
    public $pagination = 5;

    public function render()
    {
        if ($this->search != '')
        {
            $this->resetPage();
        }

        $permissions = Permission::where('name', 'like', '%'.$this->search.'%')
            ->orWhere('description', 'like', '%'.$this->search.'%')
            ->orderBy('id', 'desc')
            ->paginate($this->pagination);

        return view('livewire.permission.permission-component', compact('permissions'));
    }

    public function create()
    {
        $this->id = 0;

        $this->clean();

        $this->dispatch('open-modal', 'modalPermission');
    }

    public function clean()
    {
        $this->reset('description', 'name');

        $this->resetErrorBag();
    }

    public function store()
    {
        $rules = [
            'description' => 'required|string|max:255',
            'name'  => 'required|string|max:255'
        ];

        $this->validate($rules);

        $permission = Permission::create([
            'description' => strtoupper($this->description),
            'name'  => $this->name
        ]);

        $this->dispatch('close-modal', 'modalPermission');

        $this->dispatch('showAlert', 'Permiso creado');
    }

    public function edit(Permission $permission)
    {
        $this->id = $permission->id;

        $this->description = $permission->description;

        $this->name = $permission->name;

        $this->resetErrorBag();

        $this->dispatch('open-modal', 'modalPermission');
    }

    public function update(Permission $permission)
    {
        $rules = [
            'description' => 'required|string|max:255|unique:permissions,id,'.$this->id,
            'name'  => 'required|string|max:255|unique:permissions,id,'.$this->id
        ];

        $this->validate($rules);

        $permission->name = $this->name;

        $permission->description = $this->description;

        $permission->update();

        $this->dispatch('close-modal', 'modalPermission');

        $this->dispatch('showAlert', 'Permiso actualizado');

        $this->clean();
        
    }

    #[On('destroyPermission')]
    public function destroy($id)
    {
        $permission = Permission::find($id);

        $permission_is_used = Role::whereHas('permissions', function(Builder $query) use ($permission) {
            $query->where('name', '=', $permission->name);
        })->count();

        if (!$permission_is_used) {
            $permission->delete();
            $this->dispatch('showAlert', 'Permiso eliminado');
        } else {
            $message = new stdClass();
            $message->title = 'No se puede eliminar';
            $message->text = 'El permiso no puede ser eliminado porque esta siendo usado.';
            $this->dispatch('showError', $message);
        }
        

    }

}
