<?php

namespace App\Livewire\Home;

use Livewire\Component;
use Livewire\Attributes\Title;

#[Title('Inicio')]
class Initial extends Component
{
    public function render()
    {
        return view('livewire.home.initial');
    }
}
