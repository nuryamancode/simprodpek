@extends('hr.layouts.hr-base', ['title' => 'Kelola Penilai'])

@section('content-hr')
    <div class="container mt-3">
        @include('hr.layouts.hr-profil-null')
        <div class="page-content">
            <div class="card mt-3">
                <div class="card-header bg-light">
                    <h2 class="page-heading ">Tabel Kelola Penilai</h2>
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
                        </div>
                    @endif
                    <div class="card mt-2 mb-5">
                        <div class="card-header bg-light">
                            <h2 class="page-heading ">Tabel Periode</h2>
                        </div>
                        <div class="card-body">
                            <div class="text-end mb-3">
                                <a href="#" class="btn btn-success" data-bs-target="#modalTambahPeriode"
                                    data-bs-toggle="modal">
                                    <i data-feather="plus-circle"></i>
                                    Tambah Data
                                </a>
                            </div>
                            <table id="periode" class="table table-striped table-bordered mt-3" style="width:100%">
                                <thead>
                                    <tr class="table-dark">
                                        <th>No</th>
                                        <th>Periode</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($periode as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->periode }}</td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-danger" data-confirm-delete="true"
                                                    onclick="konfirmasiHapus('{{ route('hr.delete.periode', $item->id) }}')">
                                                    <i data-feather="trash-2" class="feather-icon"></i>
                                                </a>
                                                <a href="#" class="btn btn-success"
                                                    data-bs-target="#modalEditPeriode{{ $item->id }}"
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
                    <div class="card mt-2 mb-5">
                        <div class="card-header bg-light">
                            <h2 class="page-heading">Tabel Penilai</h2>
                        </div>
                        <div class="card-body">
                            <div class="text-end mb-3">
                                <a href="#" class="btn btn-success" data-bs-target="#modalTambah"
                                    data-bs-toggle="modal">
                                    <i data-feather="plus-circle"></i>
                                    Tambah Data
                                </a>
                            </div>
                            <table id="kelolapenilai" class="table table-striped table-bordered mt-3" style="width:100%">
                                <thead>
                                    <tr class="table-dark">
                                        <th>No</th>
                                        <th>Periode</th>
                                        <th>Jenis Penilai</th>
                                        <th>Jenis Dinilai</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($kelolapenilai as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->periode->periode }}</td>
                                            <td>{{ $item->jenispenilaian->nama_penilai }}</td>
                                            <td>{{ $item->jenis_dinilai }}</td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-danger" data-confirm-delete="true"
                                                    onclick="konfirmasiHapus('{{ route('hr.delete.kelola.penilai', $item->id) }}')">
                                                    <i data-feather="trash-2" class="feather-icon"></i>
                                                </a>
                                                <a href="#" class="btn btn-success"
                                                    data-bs-target="#modalEdit{{ $item->id }}" data-bs-toggle="modal">
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
        </div>
    </div>

    <div class="modal fade" id="modalTambahPeriode" tabindex="-1" aria-labelledby="modalTambahPeriodeLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalTambahPeriodeLabel">
                        <i class="bi bi-database-fill-add"></i>
                        Tambah Data Periode
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('hr.save.periode') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Periode</label>
                            <input type="number" required name="periode" id="periode" class="form-control">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @foreach ($periode as $item)
        <div class="modal fade" id="modalEditPeriode{{ $item->id }}" tabindex="-1"
            aria-labelledby="modalEditPeriodeLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalEditPeriodeLabel">
                            <i class="bi bi-pen-fill"></i>
                            Edit Data Periode
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('hr.update.periode', $item->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Periode</label>
                                <input type="number" name="periode" id="periode" class="form-control"
                                    value="{{ $item->periode }}">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Ubah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalTambahLabel">
                        <i class="bi bi-database-fill-add"></i>
                        Tambah Data Penilai
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('hr.save.kelola.penilai') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Periode</label>
                            <select name="periode_id" id="periode_id" class="form-select">
                                @if (count($periode) > 0)
                                    @foreach ($periode as $item)
                                        <option value="{{ $item->id }}">{{ $item->periode }}</option>
                                    @endforeach
                                @else
                                    <option value="" disabled selected>Data tidak ada</option>
                                @endif
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Jenis Penilai</label>
                            <select name="jenis_penilai_id" id="" class="form-select">
                                @if (count($jenispenilaian) > 0)
                                    @foreach ($jenispenilaian as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_penilai }}</option>
                                    @endforeach
                                @else
                                    <option value="" disabled selected>Data tidak ada</option>
                                @endif
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Jenis Dinilai</label>
                            <select name="jenis_dinilai" id="" class="form-select">
                                <option value="Karyawan To Rekan Kerja">Karyawan To Rekan Kerja</option>
                                <option value="Direktur To Karyawan">Direktur To Karyawan</option>
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


    @foreach ($periode as $item)
        <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-labelledby="modalEditLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalEditLabel">
                            <i class="bi bi-pen-fill"></i>
                            Edit Data Penilai
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('hr.update.kelola.penilai', $item->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Periode</label>
                                <select name="periode_id" id="periode_id" class="form-select">
                                    @if (count($periode) > 0)
                                        @foreach ($periode as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_periode }}</option>
                                        @endforeach
                                    @else
                                        <option value="" disabled selected>Data tidak ada</option>
                                    @endif
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Jenis Penilai</label>
                                <select name="jenis_penilai_id" id="" class="form-select">
                                    @if (count($jenispenilaian) > 0)
                                        @foreach ($jenispenilaian as $item)
                                            <option value="{{ $item->id }}">{{ $item->nama_penilai }}</option>
                                        @endforeach
                                    @else
                                        <option value="" disabled selected>Data tidak ada</option>
                                    @endif
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Jenis Dinilai</label>
                                <select name="jenis_dinilai" id="" class="form-select">
                                    <option value="Karyawan To Rekan Kerja">Karyawan To Rekan Kerja</option>
                                    <option value="Direktur To Karyawan">Direktur To Karyawan</option>
                                </select>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Ubah</button>
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
        new DataTable('#kelolapenilai');
        new DataTable('#periode');

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
