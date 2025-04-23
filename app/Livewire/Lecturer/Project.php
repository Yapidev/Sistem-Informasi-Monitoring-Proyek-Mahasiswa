<?php

namespace App\Livewire\Lecturer;

use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Component;
use Livewire\WithPagination;

class Project extends Component
{
    use WithPagination;

    public $search, $status, $sort = 'desc';

    protected $queryString = ['status'];

    public function render()
    {
        $projects = auth()->user()
            ->lecturer
            ->projects()
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

    public function confirm($projectId)
    {
        $project = \App\Models\Project::findOrFail($projectId);

        if ($project->status === 'not_started') {
            LivewireAlert::asConfirm()
                ->title('Konfirmasi Pengajuan Proyek?')
                ->text('judul proyek: ' . $project->title)
                ->withConfirmButton('Konfirmasi')
                ->withDenyButton('Batalkan')
                ->onConfirm('updateStatus', "$projectId")
                ->show();
        } elseif ($project->status === 'in_progress') {
            LivewireAlert::asConfirm()
                ->title('Konfirmasi Proyek Selesai?')
                ->question()
                ->text('judul proyek: ' . $project->title)
                ->withConfirmButton('Konfirmasi')
                ->withDenyButton('Batalkan')
                ->onConfirm('updateStatus', "$projectId")
                ->show();
        }
    }

    public function updateStatus($projectId)
    {
        $id = $projectId[0];
        $project = \App\Models\Project::findOrFail($id);

        if ($project->status === 'not_started') {
            $project->update(['status' => 'in_progress']);
            LivewireAlert::title('Berhasil')
                ->text('Proyek berhasil dikonfirmasi!')
                ->success()
                ->show();
        } elseif ($project->status === 'in_progress') {
            $project->update(['status' => 'completed']);
            LivewireAlert::title('Berhasil')
                ->text('Proyek berhasil dikonfirmasi!')
                ->success()
                ->show();
        }
    }
}
