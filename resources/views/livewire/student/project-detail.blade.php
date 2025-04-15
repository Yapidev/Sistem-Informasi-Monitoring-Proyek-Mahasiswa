<div>
    {{-- Header --}}
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Detail Proyek berjudul "{{ $project->title }}"</h4>
                    <p class="mb-8">{{ $project->description }}</p>
                    <a href="{{ route('student.dashboard') }}" class="btn btn-warning my-2 me-2" wire:navigate>
                        Kembali
                    </a>
                </div>
                <div class="col-3">
                    <div class="text-center mb-n5">
                        <img src="{{ asset('assets/images/breadcrumb/ChatBc.png') }}" class="img-fluid mb-n4">
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Header --}}

    {{-- Create Or Update Progress Modal --}}
    <div class="modal fade animated pulse" id="addProgressModal" tabindex="-1" role="dialog"
        aria-labelledby="addProjectModalTitle" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">
                <div class="modal-header text-bg-primary">
                    <h6 class="modal-title text-white">{{ $modal_title }}</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="notes-box">
                        <div class="notes-content">
                            <div class="row">

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Deskripsi Progress</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" rows="3"
                                        placeholder="Masukkan Deskripsi Progress" wire:model='description'></textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <label for="date" class="form-label">Tanggal</label>
                                <div class="col-md-12 mb-3">
                                    <input type="date" class="form-control @error('date') is-invalid @enderror"
                                        placeholder="Masukkan Tanggal Progress" wire:model='date' />
                                    @error('date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-flex gap-6">
                        <button class="btn bg-danger-subtle text-danger" data-bs-dismiss="modal"
                            wire:click='resetModal'>Batal</button>
                        <button class="btn btn-primary"
                            @if ($modal_title == 'Edit Progres') wire:click='updateProgress' @else
                            wire:click='storeProgress' @endif
                            wire:loading.delay.attr='disabled'>Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Create Or Update Progress Modal --}}

    {{-- Create Or Update Document Modal --}}
    <div class="modal fade animated pulse" id="addDocumentModal" tabindex="-1" role="dialog"
        aria-labelledby="uploadDocumentModalTitle" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content border-0">
                <div class="modal-header text-bg-primary">
                    <h6 class="modal-title text-white">{{ $modal_title }}</h6>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="notes-box">
                        <div class="notes-content">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Judul Dokumen</label>
                                    <input type="text" class="form-control @error('file_name') is-invalid @enderror"
                                        placeholder="Masukkan nama dokumen" wire:model='file_name' />
                                    @error('file_name')
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">File Dokumen</label>
                                    <input type="file" class="form-control @error('file') is-invalid @enderror"
                                        wire:model='file' />
                                    @error('file')
                                        <div class="invalid-feedback" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror

                                    <div wire:loading wire:target="file" class="mt-2">
                                        <small class="text-muted">Mengunggah...</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-flex gap-3">
                        <button class="btn bg-danger-subtle text-danger" data-bs-dismiss="modal"
                            wire:click='resetModal'>Batal</button>
                        <button class="btn btn-primary"
                            @if ($modal_title == 'Edit Dokumen') wire:click='updateDocument' @else
                            wire:click='storeDocument' @endif
                            wire:loading.delay.attr='disabled'>Unggah</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Create Or Update Document Modal --}}

    <div x-data="{ tab: 'progress' }">
        <!-- Nav tabs -->
        <ul class="nav nav-pills flex-column flex-sm-row my-4" role="tablist">
            <li class="nav-item flex-sm-fill text-sm-center">
                <a class="nav-link border border-primary" @click.prevent="tab = 'progress'"
                    :class="{ 'active': tab === 'progress' }" href="#" role="tab">
                    <span>Progres</span>
                </a>
            </li>
            <li class="nav-item flex-sm-fill text-sm-center">
                <a class="nav-link border border-primary" @click.prevent="tab = 'document'"
                    :class="{ 'active': tab === 'document' }" href="#" role="tab">
                    <span>Dokumen</span>
                </a>
            </li>
        </ul>
        <!-- Nav tabs -->

        <!-- Tab panes -->
        <div class="tab-content mt-2">
            <div x-show="tab === 'progress'" :class="{ 'active': tab === 'progress' }" class="tab-pane active"
                id="navpill-11" role="tabpanel">

                {{-- List Progress --}}
                <div class="card w-100 bg-light-info overflow-hidden shadow-none">
                    <div class="card-body py-3">
                        <div class="row justify-content-between align-items-center mb-3">
                            <div class="col-sm-6">
                                <h5 class="fw-semibold mb-9 fs-5">Progres Proyek: {{ $project->title }}</h5>
                                <p class="text-muted mb-0">Dosen Pembimbing:
                                    <strong>{{ $project->lecturer->name }}</strong>
                                </p>
                            </div>
                            <div class="col-sm-6 text-sm-end text-start mt-3 mt-sm-0">
                                <button class="btn btn-primary text-capitalize" wire:click='createProgress'
                                    wire:loading.attr='disabled'>
                                    Tambah Progres
                                </button>
                            </div>
                        </div>

                        @if ($progresses->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-nowrap align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Deskripsi</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($progresses as $progress)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($progress->date)->translatedFormat('d F Y') }}
                                                </td>
                                                <td>{{ $progress->description }}</td>
                                                <td class="d-flex gap-2">
                                                    <button class="btn btn-sm btn-primary"
                                                        wire:click="editProgress({{ $progress->id }})">Edit</button>
                                                    <button class="btn btn-sm btn-danger"
                                                        @click="$dispatch('delete-progress-confirmation', {id: {{ $progress->id }}}).self()">Hapus</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>Tidak ada progres yang tercatat.</p>
                        @endif

                        {{-- Pagination --}}
                        <div class="mt-3">
                            {{ $progresses->links('livewire::bootstrap', data: ['scrollTo' => false]) }}
                        </div>
                    </div>
                </div>
                {{-- List Progress --}}

            </div>
            <div x-show="tab === 'document'" :class="{ 'active': tab === 'document' }" class="tab-pane"
                id="navpill-22" role="tabpanel">

                {{-- List Dokumen --}}
                <div class="card w-100 bg-light-info overflow-hidden shadow-none">
                    <div class="card-body py-3">
                        <div class="row justify-content-between align-items-center mb-3">
                            <div class="col-sm-6">
                                <h5 class="fw-semibold mb-9 fs-5">Dokumen Proyek: {{ $project->title }}</h5>
                                <p class="text-muted mb-0">Dosen Pembimbing:
                                    <strong>{{ $project->lecturer->name }}</strong>
                                </p>
                            </div>
                            <div class="col-sm-6 text-sm-end text-start mt-3 mt-sm-0">
                                <button class="btn btn-primary my-2 text-capitalize" wire:click='createDocument'
                                    wire:loading.attr='disabled'>
                                    Tambah Dokumen</button>
                            </div>
                        </div>

                        @if ($documents->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-nowrap align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Nama File</th>
                                            <th>Link File</th>
                                            <th>Tanggal Upload</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($documents as $doc)
                                            <tr>
                                                <td>{{ $doc->file_name }}</td>
                                                <td>
                                                    <a href="{{ Storage::url($doc->file_path) }}" target="_blank">
                                                        Buka Dokumen
                                                    </a>
                                                </td>
                                                <td>{{ \Carbon\Carbon::parse($doc->created_at)->translatedFormat('d F Y') }}
                                                </td>
                                                <td class="d-flex gap-2">
                                                    <button class="btn btn-sm btn-primary"
                                                        wire:click="editDocument({{ $doc->id }})">Edit</button>
                                                    <button class="btn btn-sm btn-danger"
                                                        @click="$dispatch('delete-document-confirmation', {id: {{ $doc->id }}}).self()">Hapus</button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <p>Tidak ada dokumen yang diunggah.</p>
                        @endif

                        {{-- Pagination --}}
                        <div class="mt-3">
                            {{ $documents->links('livewire::bootstrap', data: ['scrollTo' => false]) }}
                        </div>
                    </div>
                </div>
                {{-- List Dokumen --}}
            </div>
        </div>
    </div>

    {{-- Script --}}
    @script
        <script>
            $wire.on('close-progress-modal', () => {
                $('#addProgressModal').modal('hide');
            });

            $wire.on('open-progress-modal', () => {
                $('#addProgressModal').modal('show');
            });

            $wire.on('delete-progress-confirmation', data => {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Anda tidak dapat mengembalikan data yang dihapus!',
                    icon: "warning",
                    showCancelButton: true,
                    cancelButtonText: "Batal",
                    confirmButtonText: "Hapus"
                }).then((result) => {
                    if (result.value) {
                        $wire.deleteProgress(data.id)
                    }
                });
            });

            // Modal buka/tutup untuk Dokumen
            $wire.on('open-document-modal', () => {
                $('#addDocumentModal').modal('show');
            });

            $wire.on('close-document-modal', () => {
                $('#addDocumentModal').modal('hide');
            });

            // Konfirmasi hapus dokumen
            $wire.on('delete-document-confirmation', data => {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Dokumen yang dihapus tidak dapat dikembalikan!',
                    icon: "warning",
                    showCancelButton: true,
                    cancelButtonText: "Batal",
                    confirmButtonText: "Hapus"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $wire.deleteDocument(data.id);
                    }
                });
            });
        </script>
    @endscript
    {{-- Script --}}
</div>
