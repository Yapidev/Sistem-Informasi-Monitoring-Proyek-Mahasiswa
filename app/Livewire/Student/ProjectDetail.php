<?php

namespace App\Livewire\Student;

use App\Models\Progress;
use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;

class ProjectDetail extends Component
{
    use WithPagination;

    public Project $project;
    public $date, $description, $progress_id;
    public $modal_title;

    protected $rules = [
        'date' => 'required|date',
        'description' => 'required|string|min:10',
    ];

    protected $messages = [
        'date.required' => 'Tanggal wajib diisi.',
        'date.date' => 'Format tanggal tidak valid.',
        'description.required' => 'Deskripsi wajib diisi.',
        'description.string' => 'Deskripsi harus berupa teks.',
        'description.min' => 'Deskripsi minimal :min karakter.',
    ];

    public function render()
    {
        $project = $this->project->load([
            'student',
            'lecturer',
            'progresses',
        ]);

        $progresses = $project->progresses()->paginate(5);

        return view('livewire.student.project-detail', [
            'project' => $project,
            'progresses' => $progresses,
        ])->extends('layouts.app');
    }

    public function openModal()
    {
        $this->dispatch('open-modal')->self();
    }

    public function closeModal()
    {
        $this->dispatch('close-modal')->self();
    }

    public function resetModal()
    {
        $this->reset(['date', 'description', 'progress_id']);
        $this->resetValidation();
    }

    public function createProgress()
    {
        $this->modal_title = 'Tambah Progres';
        $this->resetModal();
        $this->openModal();
    }

    public function storeProgress()
    {
        $this->validate();

        Progress::create([
            'project_id' => $this->project->id,
            'date' => $this->date,
            'description' => $this->description,
        ]);

        session()->flash('success', 'Progres berhasil ditambahkan.');
        $this->closeModal();
        $this->resetModal();
    }

    public function editProgress($progress_id)
    {
        $this->modal_title = 'Edit Progres';
        $this->resetModal();
        $this->progress_id = $progress_id;

        $progress = Progress::findOrFail($progress_id);
        $this->date = $progress->date;
        $this->description = $progress->description;

        $this->openModal();
    }

    public function updateProgress()
    {
        $this->validate();

        $progress = Progress::findOrFail($this->progress_id);
        $progress->update([
            'date' => $this->date,
            'description' => $this->description,
        ]);

        session()->flash('success', 'Progres berhasil diperbarui.');
        $this->closeModal();
        $this->resetModal();
    }

    public function deleteProgress($progress_id)
    {
        $progress = Progress::find($progress_id);

        if (!$progress) {
            session()->flash('error', 'Data progres tidak ditemukan.');
            return;
        }

        $progress->delete();
        session()->flash('success', 'Progres berhasil dihapus.');
        $this->dispatch('progressDeleted');
    }
}
