<?php

namespace App\Livewire\Components;

use Livewire\Component;

class Navbar extends Component
{
    public function render()
    {
        return view('livewire.components.navbar', [
            'user' => auth()->user()
        ]);
    }

    public function logout()
    {
        auth()->logout();
        return $this->redirect('login', navigate: true);
    }
}
