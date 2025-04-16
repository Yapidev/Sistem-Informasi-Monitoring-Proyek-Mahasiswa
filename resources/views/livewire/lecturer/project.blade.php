<div>
    {{-- Header --}}
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">{{ $this->title }}</h4>
                    <p class="mb-8">{{ $this->description }}</p>
                    <a href="{{ route('lecturer.dashboard') }}" class="btn btn-warning my-2 me-2" wire:navigate>
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

    {{-- List Projects --}}
    <div class="card w-100 bg-light-info overflow-hidden">
        <div class="card-body py-3">
            <div class="row justify-content-between align-items-center mb-3">
                <div class="col-sm-6">
                    <h5 class="fw-semibold mb-9 fs-5">Daftar Proyek</h5>
                </div>
            </div>
            {{-- Pencarian & Filter --}}
            <div class="row mb-3">
                <div class="col-md-9">
                    <input type="text" class="form-control bg-white" placeholder="Cari judul proyek..."
                        wire:model.live="search">
                </div>
                <div class="col-md-3 mt-2 mt-md-0">
                    <select class="form-select bg-white" wire:model.live="sortOrder">
                        <option value="desc">Terbaru</option>
                        <option value="asc">Terlama</option>
                    </select>
                </div>
            </div>
            {{-- End Pencarian & Filter --}}

            @if ($projects->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-nowrap table-hover align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Judul Proyek</th>
                                <th>Dosen Pembimbing</th>
                                <th>Status</th>
                                <th>Tanggal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($projects as $project)
                                <tr>
                                    <td>{{ $project->title }}</td>
                                    <td>{{ $project->lecturer->name }}</td>
                                    <td>{{ $project->status_label }}</td>
                                    <td>{{ \Carbon\Carbon::parse($project->created_at)->translatedFormat('d F Y') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                @if ($search)
                    <p>Tidak ada proyek yang ditemukan.</p>
                @else
                    <p>Tidak ada proyek yang tercatat.</p>
                @endif
            @endif
            {{-- Pagination --}}
            <div class="mt-3">
                {{ $projects->links('livewire::bootstrap', data: ['scrollTo' => false]) }}
            </div>
        </div>
    </div>
    {{-- List Projects --}}
</div>
