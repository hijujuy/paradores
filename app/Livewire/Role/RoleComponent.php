<?php

namespace App\Livewire\Role;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Eloquent\Builder;

#[Title('Roles')]
class RoleComponent extends Component
{
    use WithPagination;

    //Class model
    public $id = 0;
    public $name = '';

    //Class Props
    public $search = '';
    public $pagination = 5;
    public $permissions = [];
    public $leftPermissions = [];
    public $permissions_selected = [];

    public function render()
    {
        if ($this->search != '')
        {
            $this->resetPage();
        }

        $roles = Role::where('name', 'like', '%'.$this->search.'%')
            ->orderBy('id', 'desc')
            ->paginate($this->pagination);

        return view('livewire.role.role-component', compact('roles'));
    }

    public function clean()
    {
        $this->reset('id', 'name');

        $this->resetErrorBag();
    }

    public function create()
    {
        $this->clean();

        $this->dispatch('open-modal', 'modalRole');
    }

    public function store()
    {
        $rules = [
            'name'  => 'required|string|max:255'
        ];

        $this->validate($rules);

        $permission = Role::create([
            'name'  => $this->name
        ]);

        $this->dispatch('close-modal', 'modalRole');

        $this->dispatch('showAlert', 'Rol creado');
    }

    public function edit(Role $role)
    {
        $this->id = $role->id;

        $this->name = $role->name;

        $this->resetErrorBag();

        $this->dispatch('open-modal', 'modalRole');
    }

    public function update(Role $role)
    {
        $rules = [
            'name'  => 'required|string|max:255|unique:permissions,id,'.$this->id
        ];

        $this->validate($rules);

        $role->name = $this->name;

        $role->update();

        $this->dispatch('close-modal', 'modalRole');

        $this->dispatch('showAlert', 'Rol actualizado');

        $this->clean();
        
    }

    #[On('destroyRole')]
    public function destroy($id)
    {
        $role = Role::find($id);

        $role_is_used = User::whereHas('roles', function(Builder $query) use ($role) {
            $query->where('name', '=', $role->name);
        })->count();

        if (!$role_is_used) {
            $role->delete();
            $this->dispatch('showAlert', 'Rol eliminado');
        } else {
            $message = [
                'title' => 'No se puede eliminar',
                'text'  => 'El rol no puede ser eliminado porque esta siendo aplicado.'
            ];
            $this->dispatch('showError', $message);
        }

    }

    public function select(Role $role)
    {
        $this->id = $role->id;

        $this->name = $role->name;

        $this->reset('permissions');

        $this->permissions = $role->permissions;
    }

    public function showPermissions()
    {
        if(!$this->id){
            $message = [
                'title' => 'No seleccionó ningun rol.',
                'text'  => "Debe seleccionar un rol haciendo click en algun boton de permisos ",
                'icon'  => '<i class="fas fa-list"></i>'
            ];
            $this->dispatch('showError', $message);
        }
        else{
            $permission_ids = collect($this->permissions)
                ->map(function($permission) { return $permission->id; });

            $this->leftPermissions = Permission::select('id', 'description', 'name')
                ->whereNotIn('id', $permission_ids)
                ->get();

            $this->reset('permissions_selected');
            
            $this->dispatch('open-modal', 'modalPermissions');
        }        
    }

    public function addPermission(Role $role)
    {
        foreach ($this->permissions_selected as $key => $permission_id) {
            $permission = Permission::find($permission_id);
            $role->givePermissionTo($permission);
        }

        $role->save();

        $this->select($role);

        $this->dispatch('close-modal', 'modalPermissions');
    }

    #[On('revokePermission')]
    public function revokePermission($id)
    {
        $permission = Permission::find($id);

        $role = Role::find($this->id);

        $role->revokePermissionTo($permission);

        $this->select($role);

        $this->dispatch('showAlert', 'Permiso revocado');

    }

}
