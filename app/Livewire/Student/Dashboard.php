<?php

namespace App\Livewire\Student;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Dashboard extends Component
{
    use WithPagination;

    public $title, $description, $modal_title, $lecturer_id, $status, $project_id;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'lecturer_id' => 'required|exists:users,id',
        'status' => 'in:not_started,in_progress,completed|required',
    ];

    protected $messages = [
        'title.required' => 'Judul proyek wajib diisi.',
        'title.string' => 'Judul proyek harus berupa teks.',
        'title.max' => 'Judul proyek maksimal :max karakter.',

        'description.required' => 'Deskripsi proyek wajib diisi.',
        'description.string' => 'Deskripsi proyek harus berupa teks.',

        'lecturer_id.required' => 'Dosen pembimbing wajib dipilih.',
        'lecturer_id.exists' => 'Dosen pembimbing yang dipilih tidak valid.',

        'status.required' => 'Status proyek wajib dipilih.',
        'status.in' => 'Status proyek tidak valid. Pilih salah satu: Belum Dimulai, Sedang Berlangsung, atau Selesai.',
    ];

    public function render()
    {
        $dosens = User::whereRole('lecturer')
            ->with('lecturer')
            ->get();

        $projects = auth()->user()
            ->projects()
            ->with('lecturer')
            ->paginate(5);

        return view('livewire.student.dashboard', [
            'dosens' => $dosens,
            'projects' => $projects,
        ])
            ->extends('layouts.app');
    }

    public function createProject()
    {
        $this->modal_title = 'Buat Proyek';
        $this->resetModal();
        $this->openModal();
    }

    public function storeProject()
    {
        $this->validate();

        \App\Models\Project::create([
            'title' => $this->title,
            'description' => $this->description,
            'student_id' => auth()->id(), // atau sesuai relasi
            'lecturer_id' => $this->lecturer_id,
            'status' => $this->status,
        ]);

        $this->closeModal();

        session()->flash('success', 'Project berhasil dibuat!');

        $this->resetModal();
    }

    public function editProject($projectId)
    {
        $this->modal_title = 'Edit Proyek';
        $this->resetModal();
        $this->project_id = $projectId;

        $project = \App\Models\Project::findOrFail($projectId);
        $this->title = $project->title;
        $this->description = $project->description;
        $this->lecturer_id = $project->lecturer_id;
        $this->status = $project->status;

        $this->openModal();
    }

    public function updateProject()
    {
        $this->validate();

        $project = \App\Models\Project::findOrFail($this->project_id);
        $project->update([
            'title' => $this->title,
            'description' => $this->description,
            'lecturer_id' => $this->lecturer_id,
            'status' => $this->status,
        ]);

        $this->closeModal();

        session()->flash('success', 'Project berhasil diperbarui!');

        $this->resetModal();
    }

    public function deleteProject($project_id)
    {
        $project = \App\Models\Project::find($project_id);

        if (!$project) {
            session()->flash('error', 'Proyek tidak ditemukan.');
            return;
        }

        if (auth()->id() !== $project->student_id) {
            session()->flash('error', 'Anda tidak memiliki izin untuk menghapus proyek ini.');
            return;
        }

        $project->delete();

        session()->flash('success', 'Proyek berhasil dihapus.');
        $this->dispatch('projectDeleted');
    }

    public function closeModal()
    {
        $this->dispatch('close-modal')->self();
    }

    public function openModal()
    {
        $this->dispatch('open-modal')->self();
    }

    public function resetModal()
    {
        $this->reset(['title', 'description', 'lecturer_id', 'status', 'project_id']);
        $this->resetValidation();
    }
}
