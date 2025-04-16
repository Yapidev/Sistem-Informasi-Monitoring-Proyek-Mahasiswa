<?php

namespace App\Livewire\Lecturer;

use Livewire\Component;
use Livewire\WithPagination;

class Project extends Component
{
    use WithPagination;

    public $search;

    public function render()
    {
        $projects = \App\Models\Project::query()
            ->with('lecturer')
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', 'desc')
            ->paginate(5);

        return view('livewire.lecturer.project', [
            'projects' => $projects,
        ])
            ->extends('layouts.app');
    }
}
