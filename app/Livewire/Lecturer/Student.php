<?php

namespace App\Livewire\Lecturer;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Student extends Component
{
    use WithPagination;

    public $search, $sort = 'desc';

    public function render()
    {
        $students = User::query()
            ->where('role', 'student')
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->with('student')
            ->orderBy('name')
            ->orderBy('created_at', $this->sort)
            ->paginate(5);

        return view('livewire.lecturer.student', [
            'students' => $students,
        ])
            ->extends('layouts.app');
    }
}
