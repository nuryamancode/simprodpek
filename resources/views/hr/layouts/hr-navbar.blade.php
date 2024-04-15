<header class="topbar" data-navbarbg="skin6">
    <nav class="navbar top-navbar navbar-expand-lg bg-white">
        <div class="navbar-header" data-logobg="skin6">
            <a class="nav-toggler waves-effect waves-light d-block d-lg-none" href="javascript:void(0)"><i
                    class="ti-menu ti-close"></i></a>
            <!-- Logo -->
            <div class="navbar-brand" style="background-color: #212529;">
                <a href="{{ route('hr.dashboard') }}">
                    <img src="{{ asset('assets/image/simprodpek.png') }}" alt="" class="img-fluid mt-5" width="80%">
                </a>
            </div>
            <!-- End Logo -->

            <!-- Toggle which is visible on mobile only -->
            <a class="topbartoggler d-block d-lg-none waves-effect waves-light" href="javascript:void(0)"
                data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i
                    class="ti-more"></i></a>
        </div>
        <!-- End Logo -->
        <div class="navbar-collapse collapse" id="navbarSupportedContent">
            <!-- toggle and nav items -->
            <ul class="navbar-nav float-left me-auto ms-3 ps-1">
                <!-- Notification -->
                <!-- End Notification -->
                <!-- create new -->
            </ul>
            <!-- Right side toggle and nav items -->
            <ul class="navbar-nav float-end">
                <!-- User profile and search -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="javascript:void(0)" data-bs-toggle="dropdown"
                        aria-haspopup="true" aria-expanded="false">
                        @if ($hr === null || $hr->foto_profil === null)
                            <img src="https://assets-a1.kompasiana.com/items/album/2021/03/24/blank-profile-picture-973460-1280-605aadc08ede4874e1153a12.png?t=o&v=780"
                                alt="User Profile" width="40" class="rounded-circle">
                        @else
                            <img src="{{ asset('assets/dokumen/foto_profil/' . $hr->foto_profil) }}" alt="User Profile"
                                width="40"class="rounded-circle">
                        @endif
                        <span class="ms-2 d-none d-lg-inline-block">
                            <span class="text-dark">
                                @if ($hr->nama_lengkap === null)
                                    Nama Tidak ada
                                @else
                                    {{ $hr->nama_lengkap }}
                                @endif
                            </span> <i data-feather="chevron-down" class="svg-icon"></i></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-right user-dd animated flipInY">
                        <a class="dropdown-item" href="{{ route('hr.profil') }}"><i data-feather="user"
                                class="svg-icon me-2 ms-1"></i>
                            My Profile</a>
                        <div class="dropdown-divider"></div>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"><i data-feather="power"
                                class="svg-icon me-2 ms-1"></i>
                            Logout</a>
                        <div class="dropdown-divider"></div>
                    </div>
                </li>
                <!-- User profile and search -->
            </ul>
        </div>
    </nav>
</header>
