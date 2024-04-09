<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Title;

#[Title('Usuarios')]
class UserComponent extends Component
{
    use WithPagination;

    public function render()
    {
        $users = User::paginate(5);

        return view('livewire.user.user-component', compact('users'));
    }
}
