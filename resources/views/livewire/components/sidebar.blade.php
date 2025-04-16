<div>
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="#" class="text-nowrap logo-img" wire:navigate>
                <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/dark-logo.svg"
                    class="dark-logo" width="180" alt="" />
                <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/dark-logo.svg"
                    class="light-logo" width="180" alt="" />
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

                        <a class="sidebar-link {{ request()->routeIs('lecturer.project') ? 'active' : '' }}"
                            href="{{ route('lecturer.project') }}" aria-expanded="false" wire:navigate>
                            <span>
                                <i class="ti ti-folders"></i>
                            </span>
                            <span class="hide-menu">Project</span>
                        </a>
                    @endif
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
</div>
