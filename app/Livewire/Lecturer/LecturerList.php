<?php

namespace App\Livewire\Lecturer;

use Livewire\Component;

class LecturerList extends Component
{
    public function render()
    {
        return view('livewire.lecturer.lecturer-list')
            ->extends('layouts.app');
    }
}
