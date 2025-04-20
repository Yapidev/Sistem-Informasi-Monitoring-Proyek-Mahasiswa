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

    {{-- Card Informasi --}}
    <div class="d-flex border-bottom title-part-padding px-0 mb-3 align-items-center">
        <div>
            <h4 class="mb-0 fs-5">Informasi</h4>
        </div>
    </div>

    <div class="row gx-3">
        @php
            $cards = [
                ['title' => 'Total Mahasiswa', 'value' => $totalMahasiswa, 'icon' => 'ti-users', 'bg' => 'bg-primary'],
                ['title' => 'Total Dosen', 'value' => $totalDosen, 'icon' => 'ti-users', 'bg' => 'bg-success'],
                ['title' => 'Total Proyek', 'value' => $totalProject, 'icon' => 'ti-folders', 'bg' => 'bg-warning'],
                [
                    'title' => 'Proyek Selesai',
                    'value' => $totalProjectCompleted,
                    'icon' => 'ti-folders',
                    'bg' => 'bg-danger',
                ],
                [
                    'title' => 'Proyek Sedang Dikerjakan',
                    'value' => $totalProjectInProgress,
                    'icon' => 'ti-folders',
                    'bg' => 'bg-info',
                ],
                [
                    'title' => 'Proyek Sedang di Ajukan',
                    'value' => $totalProjectNotStarted,
                    'icon' => 'ti-folders',
                    'bg' => 'bg-secondary',
                ],
            ];
        @endphp

        @foreach ($cards as $card)
            <div class="col-md-4 col-lg-2 col-6 mb-3">
                <div class="card text-white {{ $card['bg'] }} h-100 rounded">
                    <div class="card-body p-4 d-flex flex-column justify-content-between">
                        <div>
                            <i class="ti {{ $card['icon'] }} fs-8"></i>
                            <h3 class="card-title mt-3 mb-0 text-white">{{ $card['value'] }}</h3>
                        </div>
                        <p class="card-text text-white-50 fs- fw-normal mt-3">
                            {{ $card['title'] }}
                        </p>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{-- Card Informasi --}}

    {{-- Menu --}}
    <div class="d-flex border-bottom title-part-padding px-0 mb-3 align-items-center">
        <div>
            <h4 class="mb-0 fs-5">Menu</h4>
        </div>
    </div>

    @php
        $menus = [
            [
                'title' => 'Mahasiswa',
                'desc' => 'Klik untuk melihat daftar mahasiswa',
                'icon' => 'ti-users',
                'bg' => 'bg-primary',
                'href' => route('lecturer.student'),
            ],
            [
                'title' => 'Dosen',
                'desc' => 'Klik untuk melihat daftar dosen',
                'icon' => 'ti-users',
                'bg' => 'bg-success',
                'href' => route('lecturer.lecturer-list'),
            ],
            [
                'title' => 'Proyek',
                'desc' => 'Klik untuk melihat daftar proyek',
                'icon' => 'ti-folders',
                'bg' => 'bg-warning',
                'href' => route('lecturer.project'),
            ],
            [
                'title' => 'Proyek Selesai',
                'desc' => 'Klik untuk melihat proyek yang sudah selesai',
                'icon' => 'ti-folders',
                'bg' => 'bg-danger',
                'href' => route('lecturer.project', ['status' => 'completed']),
            ],
            [
                'title' => 'Proyek Sedang Dikerjakan',
                'desc' => 'Klik untuk melihat proyek yang sedang dikerjakan',
                'icon' => 'ti-folders',
                'bg' => 'bg-info',
                'href' => route('lecturer.project', ['status' => 'in_progress']),
            ],
            [
                'title' => 'Proyek Sedang di Ajukan',
                'desc' => 'Klik untuk melihat proyek yang sedang di ajukan',
                'icon' => 'ti-folders',
                'bg' => 'bg-secondary',
                'href' => route('lecturer.project', ['status' => 'not_started']),
            ],
        ];
    @endphp

    <div class="row">
        @foreach ($menus as $menu)
            <div class="col-md-4 d-flex align-items-stretch mb-3">
                <a href="{{ $menu['href'] }}" class="card {{ $menu['bg'] }} text-white w-100 card-hover"
                    wire:navigate>
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <i class="ti {{ $menu['icon'] }} display-6"></i>
                            <div class="ms-auto">
                                <i class="ti ti-arrow-right fs-8"></i>
                            </div>
                        </div>
                        <div class="mt-4">
                            <h4 class="card-title mb-1 text-white">{{ $menu['title'] }}</h4>
                            <h6 class="card-text fw-normal text-white-50">
                                {{ $menu['desc'] }}
                            </h6>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
    {{-- Menu --}}


</div>
