<?php

namespace App\Livewire\Lecturer;

use App\Models\Project;
use App\Models\User;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $totalMahasiswa = User::where('role', 'student')
            ->count();
        $totalDosen = User::where('role', 'lecturer')
            ->count();
        $totalProject = auth()->user()
            ->lecturer
            ->projects()
            ->count();
        $totalProjectNotStarted = auth()->user()
            ->lecturer
            ->projects()
            ->where('status', 'not_started')
            ->count();
        $totalProjectInProgress = auth()->user()
            ->lecturer
            ->projects()
            ->where('status', 'in_progress')
            ->count();
        $totalProjectCompleted = auth()->user()
            ->lecturer
            ->projects()
            ->where('status', 'completed')
            ->count();
        return view('livewire.lecturer.dashboard', [
            'totalMahasiswa' => $totalMahasiswa,
            'totalDosen' => $totalDosen,
            'totalProject' => $totalProject,
            'totalProjectNotStarted' => $totalProjectNotStarted,
            'totalProjectInProgress' => $totalProjectInProgress,
            'totalProjectCompleted' => $totalProjectCompleted,
        ])
            ->extends('layouts.app');
    }
}
