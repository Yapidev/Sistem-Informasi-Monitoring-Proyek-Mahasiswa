<?php

namespace App\Livewire\Lecturer;

use Livewire\Component;
use Livewire\WithPagination;

class Project extends Component
{
    use WithPagination;

    public $search, $status, $sort = 'desc';

    protected $queryString = ['status'];

    public function render()
    {
        $projects = \App\Models\Project::query()
            ->when($this->status === 'completed', fn($q) => $q->where('status', 'completed'))
            ->when($this->status === 'in_progress', fn($q) => $q->where('status', 'in_progress'))
            ->when($this->status === 'not_started', fn($q) => $q->where('status', 'not_started'))
            ->with('lecturer')
            ->when($this->search, function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%');
            })
            ->orderBy('created_at', $this->sort)
            ->paginate(5);

        return view('livewire.lecturer.project', [
            'projects' => $projects,
        ])
            ->extends('layouts.app');
    }

    public function getTitleProperty()
    {
        return match ($this->status) {
            'completed' => 'Daftar Proyek Selesai',
            'in_progress' => 'Daftar Proyek Sedang Dikerjakan',
            'not_started' => 'Daftar Proyek Belum Dimulai',
            default => 'Daftar Proyek Mahasiswa',
        };
    }

    public function getDescriptionProperty()
    {
        return match ($this->status) {
            'completed' => 'Ini adalah halaman yang berisi daftar proyek yang telah selesai dikerjakan.',
            'in_progress' => 'Ini adalah halaman yang berisi daftar proyek yang sedang dalam proses pengerjaan.',
            'not_started' => 'Ini adalah halaman yang berisi daftar proyek yang belum dimulai.',
            default => 'Ini adalah halaman yang berisi daftar semua proyek mahasiswa.',
        };
    }
}
