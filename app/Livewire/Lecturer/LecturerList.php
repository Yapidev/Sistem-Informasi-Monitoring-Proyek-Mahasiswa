<?php

namespace App\Livewire\Lecturer;

use Livewire\Component;
use Livewire\WithPagination;

class LecturerList extends Component
{
    use WithPagination;

    public $search, $sort = 'desc';

    public function render()
    {
        $lecturers = \App\Models\User::query()
            ->where('role', 'lecturer')
            ->when($this->search, function ($query) {
                $query->where(function ($query) {
                    $query->where('name', 'like', '%' . $this->search . '%');
                });
            })
            ->with('lecturer')
            ->orderBy('name')
            ->orderBy('created_at', $this->sort)
            ->paginate(5);

        return view('livewire.lecturer.lecturer-list', [
            'lecturers' => $lecturers
        ])
            ->extends('layouts.app');
    }
}
