<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Spatie\Permission\Models\Role;

#[Title('Usuarios')]
class UserComponent extends Component
{
    use WithPagination;

    public $user_id = 0;
    public $role_id = 0;
    public $roles = [];

    public $pagination = 5;
    public $search = '';

    public function render()
    {
        $users = User::where('name', 'like', '%'.$this->search.'%')            
            ->paginate($this->pagination);
        
        return view('livewire.user.user-component', compact('users'));
    }

    public function showRoles($id)
    {
        $this->user_id = $id;
        $this->roles = Role::all();
        $this->dispatch('open-modal', 'modalRole');
    }

    public function assignRole()
    {
        $user = User::find($this->user_id);

        $role = Role::find($this->role_id);

        $user->assignRole($role->name);

        $this->reset('user_id', 'role_id', 'roles');

        $this->dispatch('close-modal', 'modalRole');
    }

    #[On('removeRole')]
    public function removeRole($id, $role_name)
    {
        $user = User::find($id);

        $user->removeRole($role_name);
    }

}
