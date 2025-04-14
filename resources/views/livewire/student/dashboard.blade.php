<div>
    {{-- Header Content --}}
    <div class="card w-100 bg-light-info overflow-hidden shadow-none">
        <div class="card-body py-3">
            <div class="row justify-content-between align-items-center">
                <div class="col-sm-6">
                    <h5 class="fw-semibold mb-9 fs-5">Halo {{ auth()->user()->name }}</h5>
                    <p class="mb-9">
                        Selamat datang di Aplikasi MiPENS. Aplikasi Monitoring Proyek Mahasiswa.
                    </p>
                    <button class="btn btn-primary" wire:click='createProject' wire:loading.delay.attr='disabled'>
                        Buat Proyek
                    </button>
                </div>
                <div class="col-sm-5">
                    <div class="position-relative mb-n7 text-end">
                        <img src="{{ asset('assets/images/backgrounds/welcome-bg2.png') }}" alt=""
                            class="img-fluid">
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Header Content --}}

    {{-- Create Or Update Project Modal --}}
    <div class="modal fade animated pulse" id="addProjectModal" tabindex="-1" role="dialog"
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
                                    <label class="form-label">Judul Proyek</label>
                                    <input type="text" class="form-control @error('title') is-invalid @enderror"
                                        placeholder="Masukkan Judul Proyek" wire:model='title' />
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Deskripsi Proyek</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror" rows="3"
                                        placeholder="Masukkan Deskripsi Proyek" wire:model='description'></textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Dosen Pembimbing</label>
                                    <select name="dosen" id="dosen"
                                        class="form-select @error('lecturer_id') is-invalid @enderror"
                                        wire:model='lecturer_id'>
                                        <option>Pilih Dosen Pembimbing</option>
                                        @foreach ($dosens as $dosen)
                                            <option value="{{ $dosen->lecturer->id }}"
                                                @if ($dosen->lecturer->id == $lecturer_id) selected @endif>
                                                {{ $dosen->lecturer->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('lecturer_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" id="status"
                                        class="form-select @error('status') is-invalid @enderror" wire:model='status'>
                                        <option>Pilih Status</option>
                                        <option value="not_started">Belum dimulai</option>
                                        <option value="in_progress">Sedang dikerjakan</option>
                                        <option value="completed">Selesai</option>
                                    </select>
                                    @error('status')
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
                            @if ($modal_title == 'Edit Proyek') wire:click='updateProject' @else
                            wire:click='storeProject' @endif
                            wire:loading.delay.attr='disabled'>Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Create Or Update Project Modal --}}

    {{-- List Projects --}}
    <div class="card w-100 bg-light-info overflow-hidden shadow-none">
        <div class="card-body py-3">
            <div class="row justify-content-between align-items-center mb-3">
                <div class="col-sm-6">
                    <h5 class="fw-semibold mb-9 fs-5">Daftar Proyek</h5>
                </div>
            </div>

            @if ($projects->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-nowrap table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Judul Proyek</th>
                                <th>Dosen Pembimbing</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $project)
                                <tr>
                                    <td>{{ $project->title }}</td>
                                    <td>{{ $project->lecturer->name }}</td>
                                    <td>{{ $project->status_label }}</td>
                                    <td class="d-flex gap-2">
                                        <button class="btn btn-primary btn-sm"
                                            wire:click='editProject({{ $project->id }})'
                                            wire:loading.attr='disabled'>Edit</button>
                                        <a href="{{ route('student.project.detail', $project->id) }}"
                                            class="btn btn-warning btn-sm" wire:navigate>Lihat</a>
                                        <button class="btn btn-danger btn-sm"
                                            @click="$dispatch('delete-confirmation', {id: {{ $project->id }}}).self()">Hapus</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p>Tidak ada proyek yang ditemukan.</p>
            @endif
            {{-- Pagination --}}
            <div class="mt-3">
                {{ $projects->links('livewire::bootstrap') }}
            </div>
        </div>
    </div>
    {{-- List Projects --}}

    {{-- Script --}}
    @script
        <script>
            $wire.on('close-modal', () => {
                $('#addProjectModal').modal('hide');
            });

            $wire.on('open-modal', () => {
                $('#addProjectModal').modal('show');
            });

            $wire.on('delete-confirmation', data => {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: 'Anda tidak dapat mengembalikan data yang dihapus!',
                    icon: "warning",
                    showCancelButton: true,
                    cancelButtonText: "Batal",
                    confirmButtonText: "Hapus"
                }).then((result) => {
                    if (result.value) {
                        $wire.deleteProject(data.id)
                    }
                });
            });
        </script>
    @endscript
    {{-- Script --}}
</div>
