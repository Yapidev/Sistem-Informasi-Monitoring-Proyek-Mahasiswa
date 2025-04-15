<?php

namespace App\Livewire\Student;

use App\Models\Progress;
use App\Models\Project;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Livewire\WithPagination;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Livewire;

class ProjectDetail extends Component
{
    use WithPagination;
    use WithFileUploads;

    public Project $project;
    public $date, $description, $progress_id;
    public $file_name, $file, $document_id;
    public $modal_title;
    public $progressSearch, $progressSort = 'desc';
    public $documentSearch, $documentSort = 'desc';

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

        return view('livewire.student.project-detail', [
            'project' => $project,
            'progresses' => $progresses,
            'documents' => $documents,
        ])->extends('layouts.app');
    }

    public function openProgressModal()
    {
        $this->dispatch('open-progress-modal')->self();
    }

    public function closeProgressModal()
    {
        $this->dispatch('close-progress-modal')->self();
    }

    public function resetProgressModal()
    {
        $this->reset(['date', 'description', 'progress_id']);
        $this->resetValidation();
    }

    public function openDocumentModal()
    {
        $this->dispatch('open-document-modal')->self();
    }

    public function closeDocumentModal()
    {
        $this->dispatch('close-document-modal')->self();
    }

    public function resetDocumentModal()
    {
        $this->reset(['file_name', 'file', 'document_id']);
        $this->resetValidation();
    }


    public function createProgress()
    {
        $this->modal_title = 'Tambah Progres';
        $this->resetProgressModal();
        $this->openProgressModal();
    }

    public function storeProgress()
    {
        $this->validate();

        Progress::create([
            'project_id' => $this->project->id,
            'date' => $this->date,
            'description' => $this->description,
        ]);

        $this->closeProgressModal();
        $this->resetProgressModal();

        LivewireAlert::title('Berhasil')
            ->text('Progres berhasil ditambahkan.')
            ->success()
            ->show();
    }

    public function editProgress($progress_id)
    {
        $this->modal_title = 'Edit Progres';
        $this->resetProgressModal();
        $this->progress_id = $progress_id;

        $progress = Progress::findOrFail($progress_id);
        $this->date = $progress->date;
        $this->description = $progress->description;

        $this->openProgressModal();
    }

    public function updateProgress()
    {
        $this->validate();

        $progress = Progress::findOrFail($this->progress_id);
        $progress->update([
            'date' => $this->date,
            'description' => $this->description,
        ]);

        $this->closeProgressModal();
        $this->resetProgressModal();

        LivewireAlert::title('Berhasil')
            ->text('Progres berhasil diperbarui.')
            ->success()
            ->show();
    }

    public function deleteProgress($progress_id)
    {
        $progress = Progress::find($progress_id);

        if (!$progress) {
            session()->flash('error', 'Data progres tidak ditemukan.');
            return;
        }

        $progress->delete();

        LivewireAlert::title('Berhasil')
            ->text('Progres berhasil dihapus.')
            ->success()
            ->show();
    }

    public function createDocument()
    {
        $this->modal_title = 'Tambah Dokumen';
        $this->resetDocumentModal();
        $this->openDocumentModal();
    }

    public function storeDocument()
    {
        $this->validate([
            'file_name' => 'required|string|max:255',
            'file' => 'required|file|mimes:pdf,doc,docx,ppt,pptx,xls,xlsx|max:10240', // max 10MB
        ]);

        $filePath = $this->file->store('documents', 'public');

        \App\Models\Document::create([
            'project_id' => $this->project->id,
            'file_name' => $this->file_name,
            'file_path' => $filePath,
        ]);

        $this->resetDocumentModal();
        $this->closeDocumentModal();

        LivewireAlert::title('Berhasil')
            ->text('Dokumen berhasil diunggah.')
            ->success()
            ->show();
    }

    public function editDocument($id)
    {
        $this->resetDocumentModal();
        $this->modal_title = 'Edit Dokumen';
        $this->document_id = $id;

        $doc = \App\Models\Document::findOrFail($id);
        $this->document_id = $doc->id;
        $this->file_name = $doc->file_name;

        $this->openDocumentModal();
    }

    public function updateDocument()
    {
        $doc = \App\Models\Document::findOrFail($this->document_id);

        $rules = ['file_name' => 'required|string|max:255'];
        if ($this->file) {
            $rules['file'] = 'file|mimes:pdf,doc,docx,xlsx,xls,ppt,pptx|max:2048';
        }

        $this->validate($rules);

        $data = ['file_name' => $this->file_name];

        if ($this->file) {
            // Hapus file lama
            if ($doc->file_path && Storage::disk('public')->exists($doc->file_path)) {
                Storage::disk('public')->delete($doc->file_path);
            }

            $data['file_path'] = $this->file->store('documents', 'public');
        }

        $doc->update($data);

        $this->resetDocumentModal();
        $this->closeDocumentModal();

        LivewireAlert::title('Berhasil')
            ->text('Dokumen berhasil diperbarui.')
            ->success()
            ->show();
    }

    public function deleteDocument($id)
    {
        $doc = \App\Models\Document::findOrFail($id);

        if ($doc->file_path && Storage::disk('public')->exists($doc->file_path)) {
            Storage::disk('public')->delete($doc->file_path);
        }

        $doc->delete();

        LivewireAlert::title('Berhasil')
            ->text('Dokumen berhasil dihapus.')
            ->success()
            ->show();
    }
}
