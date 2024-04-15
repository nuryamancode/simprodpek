<aside class="left-sidebar" data-sidebarbg="skin6" style="background-color: #212529">
    <div class="scroll-sidebar" data-sidebarbg="skin6">
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li class="nav-small-cap">
                    <span class="hide-menu text-white">Menu</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link {{ Str::startsWith(request()->path(), 'hr') ? 'active' : '' }}"
                        href="{{ route('hr.dashboard') }}">
                        <i data-feather="home" class="feather-icon text-white"></i>
                        <span class="hide-menu text-white">Dashboard</span>
                    </a>
                </li>
                <li class="list-divider bg-white"></li>
                <li class="nav-small-cap">
                    <span class="hide-menu text-white">Data Master</span>
                </li>
                <li class="sidebar-item"> <a
                        class="sidebar-link {{ Str::startsWith(request()->path(), 'hr/kriteria') ? 'active' : '' }}"
                        href="{{ route('hr.kriteria') }}">
                        <i data-feather="folder" class="feather-icon text-white"></i>
                        <span class="hide-menu text-white">Kelola Kriteria</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a
                        class="sidebar-link sidebar-link {{ Str::startsWith(request()->path(), 'hr/sub-kriteria') ? 'active' : '' }}"
                        href="#">
                        <i data-feather="check-square" class="feather-icon text-white"></i>
                        <span class="hide-menu text-white">Kelola Sub Kriteria</span>
                    </a>
                    <ul class="collapse">
                        <li class="p-3"><a href="" style="padding-left: 30px;" class="text-white">Left Sidebar</a></li>
                        <li class="p-3"><a href="" style="padding-left: 30px;" class="text-white">Horizontal Sidebar</a></li>
                    </ul>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link {{ Str::startsWith(request()->path(), 'hr/manajemen-user') ? 'active' : '' }}"
                        href="{{ route('hr.manajemen.user') }}"><i data-feather="clipboard"
                            class="feather-icon text-white"></i>
                        <span class="hide-menu text-white">Manajemen User</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link {{ Str::startsWith(request()->path(), 'hr/data-karyawan') ? 'active' : '' }}"
                        href="{{ route('hr.data.karyawan') }}"><i data-feather="clipboard"
                            class="feather-icon text-white"></i>
                        <span class="hide-menu text-white">Data Karyawan</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link {{ Str::startsWith(request()->path(), 'hr/bidang') ? 'active' : '' }}"
                        href="{{ route('hr.bidang') }}"><i data-feather="clipboard"
                            class="feather-icon text-white"></i>
                        <span class="hide-menu text-white">Data Bidang</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <span class="hide-menu text-white">Penilaian</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link {{ Str::startsWith(request()->path(), 'hr/kelola-penilaian-detail') ? 'active' : '' }}"
                        href="{{ route('hr.kelola.penilaian') }}"><i data-feather="clipboard"
                            class="feather-icon text-white"></i>
                        <span class="hide-menu text-white">Kelola Penilaian</span>
                    </a>
                </li>
                <li class="nav-small-cap">
                    <span class="hide-menu text-white">Report</span>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link sidebar-link {{ Str::startsWith(request()->path(), 'hr/laporan-kinerja') ? 'active' : '' }}"
                        href="{{ route('hr.laporan.kinerja') }}">
                        <i data-feather="clipboard" class="feather-icon text-white"></i>
                        <span class="hide-menu text-white">Laporan Hasil Kinerja</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
