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
                    <button class="btn btn-primary my-2 text-capitalize" wire:click='createProgress'
                        wire:loading.attr='disabled'>
                        Tambah Progres</button>
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
    {{-- Create Or Update Progress Modal --}}
</div>
