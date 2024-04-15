@extends('hr.layouts.hr-base', ['title' => 'Manajemen User'])

@section('content-hr')
    <div class="container mt-3">
        @include('hr.layouts.hr-profil-null')
        <div class="page-content">
            <div class="card mt-3">
                <div class="card-header">
                    <h2 class="page-heading">Tabel Manajemen User</h2>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger mt-2" style="margin-left: 45px; margin-right: 45px">
                            <ul class="text-start">
                                @foreach ($errors->all() as $item)
                                    <li>{{ $item }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success mt-2 text-start" style="margin-left: 45px; margin-right: 45px">
                            {{ session('success') }}
                            {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
                        </div>
                    @endif
                    <div class="text-end mb-3">
                        <a href="#" class="btn btn-success" data-bs-target="#modalTambah" data-bs-toggle="modal">
                            <i data-feather="plus-circle"></i>
                            Tambah Data
                        </a>
                    </div>
                    <table id="manageuser" class="table table-striped table-bordered mt-3" style="width:100%">
                        <thead>
                            <tr class="table-dark">
                                <th>No</th>
                                <th>Nama Lengkap</th>
                                <th>Email</th>
                                <th>Verifikasi Email</th>
                                <th>Peran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->role === 'Direktur' ? ($item->direktur ? $item->direktur->nama_lengkap : 'Belum Ditambahkan') : ($item->role === 'Karyawan' ? ($item->karyawan ? $item->karyawan->nama_lengkap : 'Belum Ditambahkan') : 'Belum Ditambahkan') }}
                                    </td>
                                    <td>{{ $item->email }}</td>
                                    <td>
                                        @if($item->role === 'Direktur')
                                            {!! $item->email_verified_at
                                                ? '<span class="verifikasi-done">Sudah Terverifikasi</span>'
                                                : '<span class="verifikasi-not">Tidak Verifikasi</span>' !!}
                                        @elseif($item->role === 'Karyawan')
                                            {!! $item->email_verified_at
                                                ? '<span class="verifikasi-done">Sudah Terverifikasi</span>'
                                                : '<span class="verifikasi-not">Belum Terverifikasi</span>' !!}
                                        @endif
                                    </td>

                                    <td>{{ $item->role }}</td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-danger" data-confirm-delete="true"
                                            onclick="konfirmasiHapus('{{ route('hr.delete.manajemen.user', $item->id) }}')">
                                            <i data-feather="trash-2" class="feather-icon"></i>
                                        </a>
                                        <a href="#" class="btn btn-success" data-bs-target="#modalEdit{{ $item->id }}"
                                            data-bs-toggle="modal">
                                            <i data-feather="edit" class="feather-icon"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalTambahLabel">
                        <i class="bi bi-person-fill-add"></i>
                        Tambah Data
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('hr.save.manajemen.user') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" id="recipient-name" name="name">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Email</label>
                            <input type="text" class="form-control" id="recipient-name" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Password</label>
                            <input type="password" class="form-control" id="recipient-name" name="password">
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">Peran/Role</label>
                            <select class="form-select" aria-label="Default select example" name="role">
                                <option value="Direktur">Direktur</option>
                            </select>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @foreach ($user as $item)
        <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-labelledby="modalEditLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalEditLabel">
                            <i class="bi bi-pen-fill"></i>
                            Edit Data
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('hr.update.manajemen.user', $item->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="recipient-name" name="name"
                                    value="{{ $item->role === 'Direktur' ? ($item->direktur ? $item->direktur->nama_lengkap : 'Belum Ditambahkan') : ($item->role === 'Karyawan' ? ($item->karyawan ? $item->karyawan->nama_lengkap : 'Belum Ditambahkan') : 'Belum Ditambahkan') }}">
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Email</label>
                                <input type="text" class="form-control" id="recipient-name" name="email"
                                    value="{{ $item->email }}">
                            </div>
                            <div class="mb-3">
                                <div class="accordion" id="accordionPanelsStayOpenExample">
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <a class="btn btn-accordion" style="width: 100%; height:40px" href="#" data-bs-toggle="collapse"
                                                data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true"
                                                aria-controls="panelsStayOpen-collapseOne">
                                                Change Password
                                            </a>
                                        </h2>
                                        <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse">
                                            <div class="accordion-body">
                                                <label for="message-text" class="col-form-label">Password</label>
                                                <input type="password" class="form-control" id="recipient-name"
                                                    name="password" value="{{ $item->password }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection

@section('js')
    <script>
        new DataTable('#manageuser');

        function konfirmasiHapus(deleteUrl) {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Apakah kamu yakin ingin menghapus ?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#435ebe',
                cancelButtonColor: '#dc3545',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location = deleteUrl;
                }
            });
        }
    </script>
@endsection
