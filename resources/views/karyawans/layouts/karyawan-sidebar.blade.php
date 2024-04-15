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
        @if ($karyawan === null || $karyawan->user_id === null)
            <a href="{{ route('karyawan.profil') }}" class="sidebar-user">
                <div class="sidebar-user-info">
                    <span class="sidebar-user__title">{{ null }}</span>
                    <span class="sidebar-user__subtitle">{{ $role }}</span>
                </div>
            </a>
        @else
            <a href="{{ route('karyawan.profil') }}" class="sidebar-user">
                <span class="sidebar-user-img">
                    <picture>
                        @if ($karyawan === null || $karyawan->foto_profil === null)
                            <source
                                srcset="https://assets-a1.kompasiana.com/items/album/2021/03/24/blank-profile-picture-973460-1280-605aadc08ede4874e1153a12.png?t=o&v=780"
                                type="image/jpg">
                            <img src="https://assets-a1.kompasiana.com/items/album/2021/03/24/blank-profile-picture-973460-1280-605aadc08ede4874e1153a12.png?t=o&v=780"
                                alt="User Profile" width="50px" height="50px">
                        @else
                            <source srcset="{{ asset('assets/dokumen/foto_profil/' . $karyawan->foto_profil) }}" type="image">
                            <img src="{{ asset('assets/dokumen/foto_profil/' . $karyawan->foto_profil) }}" alt="User Profile"
                                width="50px" height="50px">
                        @endif
                    </picture>
                </span>
                <div class="sidebar-user-info">
                    <span class="sidebar-user__title">{{ $karyawan->nama_lengkap }}</span>
                    <span class="sidebar-user__subtitle">{{ $role }}</span>
                </div>
            </a>
        @endif

    </div>
    <!-- Sidebar navigation-->
    <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
        <ul id="sidebarnav">
            <li class="sidebar-item mt-3">
                <a class="sidebar-link  {{ 'karyawann' == request()->path() ? 'active' : '' }}"
                    href="{{ route('karyawan.dashboard') }}" aria-expanded="false">
                    <span>
                        <i class="bi bi-grid-1x2-fill"></i>
                    </span>
                    <span class="hide-menu">Dashboard</span>
                </a>
            </li>
            <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">Manajemen Proyek</span>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('karyawan.tugas.karyawan') }}"
                    class='sidebar-link {{ Str::startsWith(request()->path(), 'karyawann/tugas-karyawan') ? 'active' : '' }}'>
                    <i class="bi bi-clipboard2-data-fill"></i>
                    <span>Daftar Tugas</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a class="sidebar-link {{ Str::startsWith(request()->path(), 'karyawann/tugas-selesai') ? 'active' : '' }}"
                    href="{{ route('karyawan.tugas.selesai.karyawan') }}" aria-expanded="false">
                    <span>
                        <i class="bi bi-clipboard2-check-fill"></i>
                    </span>
                    <span class="hide-menu">Tugas Selesai</span>
                </a>
            </li>
            <li class="nav-small-cap">
                <i class="ti ti-dots nav-small-cap-icon fs-4"></i>
                <span class="hide-menu">Laporan</span>
            </li>

            <li class="sidebar-item">
                <a class="sidebar-link {{ 'karyawann/hasil-kinerja' == request()->path() ? 'active' : '' }} {{ 'karyawann/hasil-kinerja-detail' == request()->path() ? 'active' : '' }}"
                    href="{{ route('karyawan.hasil.kinerja') }}" aria-expanded="false">
                    <span>
                        <i class="bi bi-file-earmark-person-fill"></i>
                    </span>
                    <span class="hide-menu">Hasil Kinerja Karyawan</span>
                </a>
            </li>
        </ul>
    </nav>
    <!-- End Sidebar navigation -->
</div>
<!-- End Sidebar scroll-->
