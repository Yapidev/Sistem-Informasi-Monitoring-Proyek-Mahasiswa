<?php

namespace App\Livewire\Student;

use App\Models\Project;
use Livewire\Component;

class ProjectDetail extends Component
{
    public Project $project;

    public function render()
    {
        $project = $this->project->load([
            'student',
            'lecturer',
            'progresses',
            'documents',
        ]);

        return view('livewire.student.project-detail', [
            'project' => $project,
        ])->extends('layouts.app');
    }
}
