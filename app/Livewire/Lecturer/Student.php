<?php

namespace App\Livewire\Lecturer;

use Livewire\Component;

class Student extends Component
{
    public function render()
    {
        return view('livewire.lecturer.student')
            ->extends('layouts.app');
    }
}
