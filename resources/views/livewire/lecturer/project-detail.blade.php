<div>
    {{-- Header --}}
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Detail Proyek berjudul "{{ $project->title }}"</h4>
                    <p class="mb-8">Deskripsi: {{ $project->description }}</p>
                    <p class="mb-8">Nama Mahasiswa: {{ $project->student->name }}</p>
                    <a href="{{ route('lecturer.project') }}" class="btn btn-outline-secondary my-2 me-2" wire:navigate>
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
                        </div>

                        {{-- Pencarian & Filter --}}
                        <div class="row mb-3">
                            <div class="col-md-9">
                                <input type="text" class="form-control bg-white"
                                    placeholder="Cari Progres berdasarkan deskripsi..."
                                    wire:model.live="progressSearch" />
                            </div>
                            <div class="col-md-3 mt-2 mt-md-0">
                                <select class="form-select bg-white" wire:model.live="progressSort">
                                    <option value="desc">Terbaru</option>
                                    <option value="asc">Terlama</option>
                                </select>
                            </div>
                        </div>
                        {{-- End Pencarian & Filter --}}

                        @if ($progresses->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-nowrap align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Deskripsi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($progresses as $progress)
                                            <tr>
                                                <td>{{ \Carbon\Carbon::parse($progress->date)->translatedFormat('d F Y') }}
                                                </td>
                                                <td>{{ $progress->description }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            @if ($searchProgress)
                                <p>Tidak ada progres yang ditemukan.</p>
                            @else
                                <p>Tidak ada progres yang tercatat.</p>
                            @endif
                        @endif

                        {{-- Pagination --}}
                        <div class="mt-3">
                            {{ $progresses->links('livewire::bootstrap', data: ['scrollTo' => false]) }}
                        </div>
                    </div>
                </div>
                {{-- List Progress --}}

            </div>
            <div x-show="tab === 'document'" :class="{ 'active': tab === 'document' }" class="tab-pane" id="navpill-22"
                role="tabpanel">

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
                        </div>

                        {{-- Pencarian & Filter --}}
                        <div class="row mb-3">
                            <div class="col-md-9">
                                <input type="text" class="form-control bg-white"
                                    placeholder="Cari Dokumen berdasarkan nama file..."
                                    wire:model.live="documentSearch" />
                            </div>
                            <div class="col-md-3 mt-2 mt-md-0">
                                <select class="form-select bg-white" wire:model.live="documentSort">
                                    <option value="desc">Terbaru</option>
                                    <option value="asc">Terlama</option>
                                </select>
                            </div>
                        </div>
                        {{-- End Pencarian & Filter --}}

                        @if ($documents->count() > 0)
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-nowrap align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Nama File</th>
                                            <th>Link File</th>
                                            <th>Tanggal Upload</th>
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
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            @if ($searchDocument)
                                <p>Tidak ada dokumen yang ditemukan.</p>
                            @else
                                <p>Tidak ada dokumen yang diunggah.</p>
                            @endif
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
