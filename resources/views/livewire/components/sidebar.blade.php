<div>
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="#" class="text-nowrap logo-img" wire:navigate>
                <img src="{{ asset('assets/images/mipens_logo.svg') }}" class="dark-logo" width="180" alt="" />
                <img src="{{ asset('assets/images/mipens_logo.svg') }}" class="light-logo" width="180" alt="" />
            </a>
            <div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8 text-muted"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar>
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    @if (auth()->user()->role == 'student')
                        <a class="sidebar-link {{ request()->routeIs('student.dashboard') ? 'active' : '' }}"
                            href="{{ route('student.dashboard') }}" aria-expanded="false" wire:navigate>
                            <span>
                                <i class="ti ti-home"></i>
                            </span>
                            <span class="hide-menu">Home</span>
                        </a>
                    @else
                        <a class="sidebar-link {{ request()->routeIs('lecturer.dashboard') ? 'active' : '' }}"
                            href="{{ route('lecturer.dashboard') }}" aria-expanded="false" wire:navigate>
                            <span>
                                <i class="ti ti-home"></i>
                            </span>
                            <span class="hide-menu">Home</span>
                        </a>

                        <a class="sidebar-link {{ request()->routeIs('lecturer.student') ? 'active' : '' }}"
                            href="{{ route('lecturer.student') }}" aria-expanded="false" wire:navigate>
                            <span>
                                <i class="ti ti-users"></i>
                            </span>
                            <span class="hide-menu">Mahasiswa</span>
                        </a>

                        <a class="sidebar-link {{ request()->routeIs('lecturer.lecturer-list') ? 'active' : '' }}"
                            href="{{ route('lecturer.lecturer-list') }}" aria-expanded="false" wire:navigate>
                            <span>
                                <i class="ti ti-users"></i>
                            </span>
                            <span class="hide-menu">Dosen</span>
                        </a>

                        <a class="sidebar-link {{ request()->routeIs('lecturer.project') && request('status') === null ? 'active' : '' }}"
                            href="{{ route('lecturer.project') }}" aria-expanded="false" wire:navigate>
                            <span>
                                <i class="ti ti-folders"></i>
                            </span>
                            <span class="hide-menu">Project</span>
                        </a>

                        <a class="sidebar-link {{ request()->routeIs('lecturer.project') && request('status') === 'completed' ? 'active' : '' }}"
                            href="{{ route('lecturer.project', ['status' => 'completed']) }}" wire:navigate>
                            <span><i class="ti ti-clock-check"></i></span>
                            <span class="hide-menu">Project Selesai</span>
                        </a>

                        <a class="sidebar-link {{ request()->routeIs('lecturer.project') && request('status') === 'in_progress' ? 'active' : '' }}"
                            href="{{ route('lecturer.project', ['status' => 'in_progress']) }}" wire:navigate>
                            <span><i class="ti ti-clock-cog"></i></span>
                            <span class="hide-menu">Project Dikerjakan</span>
                        </a>

                        <a class="sidebar-link {{ request()->routeIs('lecturer.project') && request('status') === 'not_started' ? 'active' : '' }}"
                            href="{{ route('lecturer.project', ['status' => 'not_started']) }}" wire:navigate>
                            <span><i class="ti ti-clock-x"></i></span>
                            <span class="hide-menu">Project Belum Mulai</span>
                        </a>
                    @endif
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
</div>
