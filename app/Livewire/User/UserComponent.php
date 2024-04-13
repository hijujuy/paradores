<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\On;
use Livewire\WithPagination;
use Livewire\Attributes\Title;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

#[Title('Usuarios')]
class UserComponent extends Component
{
    use WithPagination;

    public $user_id = 0;
    public $name = '';
    public $email = '';
    public $password = '';
    public $password_confirmation = '';
    public $role_id = 0;
    public $roles = [];
    public $hide_password = true;
    public $hide_password_confirmation = true;

    public $pagination = 5;
    public $search = '';

    public function render()
    {
        $users = User::where('name', 'like', '%'.$this->search.'%')
            ->orderBy('id', 'desc')
            ->paginate($this->pagination);
        
        return view('livewire.user.user-component', compact('users'));
    }

    public function clean()
    {
        $this->reset('user_id', 'name', 'email', 'password', 'password_confirmation', 'role_id', 'hide_password', 'hide_password_confirmation');
    }

    public function create()
    {
        $this->clean();

        $this->resetErrorBag();

        $this->roles = Role::all();

        $this->dispatch('open-modal', 'modalUser');
    }

    public function togglePassword()
    {
        $this->hide_password = !$this->hide_password;
    }

    public function togglePasswordConfirmation()
    {
        $this->hide_password_confirmation = !$this->hide_password_confirmation;
    }
    
    public function store()
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|numeric|exists:roles,id'
        ];

        $this->validate($rules);

        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);

        $role = Role::find($this->role_id);

        $user->assignRole($role->name);

        $user->save();

        $this->clean();

        $this->dispatch('showAlert', 'Usuario creado con exito.');

        $this->dispatch('close-modal', 'modalUser');
    }

    public function resetPassword(User $user)
    {
        $this->clean();

        $this->user_id = $user->id;

        $this->dispatch('open-modal', 'modalUser');
    }

    public function changePassword(User $user)
    {
        $rules = [
            'password' => 'required|string|min:8|confirmed',
        ];

        $this->validate($rules);

        $user->password = Hash::make($this->password);

        $user->save();

        $this->clean();

        $this->dispatch('showAlert', 'Constraseña restablecida.');

        $this->dispatch('close-modal', 'modalUser');
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
