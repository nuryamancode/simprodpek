<style>
    .sidebar-user__title {
        width: 100px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
</style>
<div class="left-sidebar">
    <div class="sidebar-footer">
        @if ($direktur === null || $direktur->user_id === null)
            <a href="{{ route('direktur.profil') }}" class="sidebar-user">
                <div class="sidebar-user-info">
                    <span class="sidebar-user__title">{{ null }}</span>
                    <span class="sidebar-user__subtitle">{{ $role }}</span>
                </div>
            </a>
        @else
            <a href="{{ route('direktur.profil') }}" class="sidebar-user">
                <span class="sidebar-user-img">
                    <picture>
                        @if ($direktur === null || $direktur->foto_profil === null)
                            <source
                                srcset="https://assets-a1.kompasiana.com/items/album/2021/03/24/blank-profile-picture-973460-1280-605aadc08ede4874e1153a12.png?t=o&v=780"
                                type="image/jpg">
                            <img src="https://assets-a1.kompasiana.com/items/album/2021/03/24/blank-profile-picture-973460-1280-605aadc08ede4874e1153a12.png?t=o&v=780"
                                alt="User Profile" width="50px" height="50px">
                        @else
                            <source srcset="{{ asset('assets/dokumen/foto_profil/' . $direktur->foto_profil) }}"
                                type="image">
                            <img src="{{ asset('assets/dokumen/foto_profil/' . $direktur->foto_profil) }}" alt="User Profile"
                                width="50px" height="50px">
                        @endif
                    </picture>
                </span>
                <div class="sidebar-user-info">
                    <span class="sidebar-user__title">{{ $direktur->nama_lengkap }}</span>
                    <span class="sidebar-user__subtitle">{{ $role }}</span>
                </div>
            </a>
        @endif

    </div>
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
        <ul id="sidebarnav">
            <li class="sidebar-item mt-3">
                <a class="sidebar-link  {{ 'direktur' == request()->path() ? 'active' : '' }}"
                    href="{{ route('direktur.dashboard') }}" aria-expanded="false">
                    <span>
                        <i class="bi bi-grid-1x2-fill"></i>
                    </span>
                    <span class="hide-menu">Dashboard</span>
                </a>
            </li>
            <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">MANAJEMEN PROYEK</span>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link {{ Str::startsWith(request()->path(), 'direktur/proyek') ? 'active' : '' }}"
                    href="{{ route('direktur.proyek') }}" aria-expanded="false">
                    <span>
                        <i class="bi bi-file-earmark-person-fill"></i>
                    </span>
                    <span class="hide-menu">Daftar Proyek</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link {{ 'direktur/kalender-proyek' == request()->path() ? 'active' : '' }}"
                    href="{{ route('direktur.kalender.proyek') }}" aria-expanded="false">
                    <span>
                        <i class="bi bi-file-earmark-person-fill"></i>
                    </span>
                    <span class="hide-menu">Kalender Proyek</span>
                </a>
            </li>
            <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">DATA MASTER</span>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link {{ Str::startsWith(request()->path(), 'direktur/klien') ? 'active' : '' }}"
                    href="{{ route('direktur.klien') }}" aria-expanded="false">
                    <span>
                        <i class="bi bi-file-earmark-person-fill"></i>
                    </span>
                    <span class="hide-menu">Daftar Klien</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link {{ Str::startsWith(request()->path(), 'direktur/tim') ? 'active' : '' }}"
                    href="{{ route('direktur.tim') }}" aria-expanded="false">
                    <span>
                        <i class="bi bi-file-earmark-person-fill"></i>
                    </span>
                    <span class="hide-menu">Daftar Tim</span>
                </a>
            </li>
            <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">Penilaian</span>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link {{ Str::startsWith(request()->path(), 'direktur/penilaian') ? 'active' : '' }}"
                    href="{{ route('direktur.kelola.penilaian') }}" aria-expanded="false">
                    <span>
                        <i class="bi bi-file-earmark-person-fill"></i>
                    </span>
                    <span class="hide-menu">Penilaian</span>
                </a>
            </li>
            <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">REPORT</span>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link {{ 'direktur/laporan-selesai' == request()->path() ? 'active' : '' }}"
                    href="{{ route('direktur.laporan.proyek') }}" aria-expanded="false">
                    <span>
                        <i class="bi bi-file-earmark-person-fill"></i>
                    </span>
                    <span class="hide-menu">Laporan Proyek Selesai</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link {{ 'direktur/laporan-hasil' == request()->path() ? 'active' : '' }}"
                    href="{{ route('direktur.laporan.hasil') }}" aria-expanded="false">
                    <span>
                        <i class="bi bi-file-earmark-person-fill"></i>
                    </span>
                    <span class="hide-menu">Laporan Kinerja Karyawan</span>
                </a>
            </li>
        </ul>
    </nav>
    <!-- End Sidebar navigation -->
</div>
<!-- End Sidebar scroll-->
