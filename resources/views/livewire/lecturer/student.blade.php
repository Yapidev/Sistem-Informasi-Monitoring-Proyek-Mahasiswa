<div>
    {{-- Header --}}
    <div class="card bg-light-info shadow-none position-relative overflow-hidden">
        <div class="card-body px-4 py-3">
            <div class="row align-items-center">
                <div class="col-9">
                    <h4 class="fw-semibold mb-8">Daftar Mahasiswa</h4>
                    <p class="mb-8">Ini adalah halaman yang berisi daftar mahasiswa</p>
                    <a href="{{ route('lecturer.dashboard') }}" class="btn btn-outline-secondary my-2 me-2" wire:navigate>
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

    {{-- List Mahasiswa --}}
    <div class="card w-100 bg-light-info overflow-hidden shadow-none">
        <div class="card-body py-3">

            {{-- Pencarian & Filter --}}
            <div class="row mb-3">
                <div class="col-md-9">
                    <input type="search" class="form-control bg-white" placeholder="Cari Mahasiswa berdasarkan nama..."
                        wire:model.live="search" />
                </div>
                <div class="col-md-3 mt-2 mt-md-0">
                    <select class="form-select bg-white" wire:model.live="sort">
                        <option value="desc">Terbaru</option>
                        <option value="asc">Terlama</option>
                    </select>
                </div>
            </div>
            {{-- End Pencarian & Filter --}}

            @if ($students->count() > 0)
                <div class="table-responsive">
                    <table class="table table-striped table-hover table-nowrap align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>NRP</th>
                                <th>Jurusan</th>
                                <th>Email</th>
                                <th>No. Telpon</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($students as $student)
                                <tr>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->student->student_number }}</td>
                                    <td>{{ $student->student->major }}</td>
                                    <td>{{ $student->email }}</td>
                                    <td>{{ $student->student->phone }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                @if ($search)
                    <p>Tidak ada Mahasiswa yang ditemukan.</p>
                @else
                    <p>Tidak ada Mahasiswa yang tercatat.</p>
                @endif
            @endif

            {{-- Pagination --}}
            <div class="mt-3">
                {{ $students->links('livewire::bootstrap', data: ['scrollTo' => false]) }}
            </div>
        </div>
    </div>
    {{-- List Mahasiswa --}}
</div>
