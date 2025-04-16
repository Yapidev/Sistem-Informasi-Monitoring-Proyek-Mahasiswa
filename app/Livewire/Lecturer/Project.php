<?php

namespace App\Livewire\Lecturer;

use Livewire\Component;

class Project extends Component
{
    public function render()
    {
        return view('livewire.lecturer.project')
            ->extends('layouts.app');
    }
}
