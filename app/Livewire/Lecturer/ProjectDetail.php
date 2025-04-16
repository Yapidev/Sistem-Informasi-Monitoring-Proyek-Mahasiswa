<?php

namespace App\Livewire\Lecturer;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectDetail extends Component
{
    use WithPagination;

    public Project $project;

    public $progressSearch, $progressSort = 'desc';
    public $documentSearch, $documentSort = 'desc';

    public function render()
    {
        $project = $this->project->load([
            'student',
            'lecturer',
            'progresses',
            'documents',
        ]);

        $progresses = $project->progresses()
            ->when($this->progressSearch, function ($query) {
                $query->where('description', 'like', '%' . $this->progressSearch . '%');
            })
            ->orderBy('date', $this->progressSort)
            ->paginate(5);

        $documents = $project->documents()
            ->when($this->documentSearch, function ($query) {
                $query->where('file_name', 'like', '%' . $this->documentSearch . '%');
            })
            ->orderBy('created_at', $this->documentSort)
            ->paginate(5);

        return view('livewire.lecturer.project-detail', [
            'project' => $project,
            'progresses' => $progresses,
            'documents' => $documents,
        ])->extends('layouts.app');
    }
}
