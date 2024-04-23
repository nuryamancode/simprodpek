@extends('hr.layouts.hr-base', ['title' => 'Kriteria'])

@section('content-hr')
    <div class="container mt-3">
        @include('hr.layouts.hr-profil-null')
        <div class="page-content">
            <div class="card mt-3">
                <div class="card-header">
                    <h2 class="page-heading">Tabel Kriteria</h2>
                    <p class="p-1">
                        Bobot kriteria tidak boleh melebihi 100%
                    </p>
                </div>
                <div class="card-body">
                    {{-- kriteria direktur --}}
                    <div class="card mb-5 mt-2">
                        <div class="card-header bg-light">
                            <h2 class="page-heading">Kriteria Direktur</h2>
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
                                <div class="alert alert-success mt-2 text-start"
                                    style="margin-left: 45px; margin-right: 45px">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="text-end mb-3">
                                <a href="#" class="btn btn-success" data-bs-target="#modalTambahKriteriaDirektur"
                                    data-bs-toggle="modal">
                                    <i data-feather="plus-circle"></i>
                                    Tambah Data
                                </a>
                            </div>
                            <table id="kriteria_direktur" class="table table-responsive table-bordered border-dark mt-3"
                                style="width:100%">
                                <thead>
                                    <tr class="table-dark">
                                        <th>No</th>
                                        <th>Kriteria</th>
                                        <th>Bobot</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalBobot = 0;
                                    @endphp
                                    @foreach ($kriteriaDirektur as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama_kriteria }}</td>
                                            <td>{{ intval($item->bobot_kriteria) }}</td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-danger" data-confirm-delete="true"
                                                    onclick="konfirmasiHapus('{{ route('hr.delete.kriteria.direktur', $item->id) }}')">
                                                    <i data-feather="trash-2" class="feather-icon"></i>
                                                </a>
                                                <a href="#" class="btn btn-success"
                                                    data-bs-target="#modalEditKriteriaDirektur{{ $item->id }}" data-bs-toggle="modal">
                                                    <i data-feather="edit" class="feather-icon"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @php
                                            $totalBobot += intval($item->bobot_kriteria);
                                        @endphp
                                    @endforeach
                                </tbody>
                                <tfoot class="table-dark">
                                    <td colspan="2" class="text-center">Total Bobot</td>
                                    <td colspan="2" class="text-center">{{ $totalBobot }}</td>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    {{-- kriteria karyawan --}}
                    <div class="card mb-2 mt-5">
                        <div class="card-header bg-light">
                            <h2 class="page-heading">Kriteria Rekan Kerja</h2>
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
                                <div class="alert alert-success mt-2 text-start"
                                    style="margin-left: 45px; margin-right: 45px">
                                    {{ session('success') }}
                                </div>
                            @endif
                            <div class="text-end mb-3">
                                <a href="#" class="btn btn-success" data-bs-target="#modalTambahKriteriaKaryawan"
                                    data-bs-toggle="modal">
                                    <i data-feather="plus-circle"></i>
                                    Tambah Data
                                </a>
                            </div>
                            <table id="kriteria_karyawan" class="table table-responsive table-bordered border-dark mt-3"
                                style="width:100%">
                                <thead>
                                    <tr class="table-dark">
                                        <th>No</th>
                                        <th>Kriteria</th>
                                        <th>Bobot</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $totalBobot = 0;
                                    @endphp
                                    @foreach ($kriteriaRekanKerja as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->nama_kriteria }}</td>
                                            <td>{{ intval($item->bobot_kriteria) }}</td>
                                            <td class="text-center">
                                                <a href="#" class="btn btn-danger" data-confirm-delete="true"
                                                    onclick="konfirmasiHapus('{{ route('hr.delete.kriteria.rekan.kerja', $item->id) }}')">
                                                    <i data-feather="trash-2" class="feather-icon"></i>
                                                </a>
                                                <a href="#" class="btn btn-success"
                                                    data-bs-target="#modalEditKriteriaKaryawan{{ $item->id }}" data-bs-toggle="modal">
                                                    <i data-feather="edit" class="feather-icon"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        @php
                                            $totalBobot += intval($item->bobot_kriteria);
                                        @endphp
                                    @endforeach
                                </tbody>
                                <tfoot class="table-dark">
                                    <td colspan="2" class="text-center">Total Bobot</td>
                                    <td colspan="2" class="text-center">{{ $totalBobot }}</td>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambahKriteriaDirektur" tabindex="-1" aria-labelledby="modalTambahKriteriaDirekturLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalTambahKriteriaDirekturLabel">
                        <i class="bi bi-person-fill-add"></i>
                        Tambah Data Kriteria Direktur
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('hr.save.kriteria.direktur') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Kriteria</label>
                            <input type="text" class="form-control" id="recipient-name" required name="nama_kriteria">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Nilai Preferensi</label>
                            <input type="number" class="form-control" id="recipient-name" required name="bobot" max="100">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @foreach ($kriteriaDirektur as $item)
        <div class="modal fade" id="modalEditKriteriaDirektur{{ $item->id }}" tabindex="-1" aria-labelledby="modalEditKriteriaDirekturLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalEditKriteriaDirekturLabel">
                            <i class="bi bi-pen-fill"></i>
                            Edit Data Kriteria Direktur
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('hr.update.kriteria.direktur', $item->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Nama Kriteria</label>
                                <input type="text" class="form-control" id="recipient-name" required name="nama_kriteria"
                                    value="{{ $item->nama_kriteria }}">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Nilai Preferensi</label>
                                <input type="number" class="form-control" id="recipient-name" required name="bobot_kriteria"
                                    max="100" value="{{ intval($item->bobot_kriteria) }}">
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

    {{-- kriteria karyawan --}}
    <div class="modal fade" id="modalTambahKriteriaKaryawan" tabindex="-1" aria-labelledby="modalTambahKriteriaKaryawanLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalTambahKriteriaKaryawanLabel">
                        <i class="bi bi-person-fill-add"></i>
                        Tambah Data Kriteria Karyawan
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('hr.save.kriteria.rekan.kerja') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Kriteria</label>
                            <input type="text" class="form-control" id="recipient-name" name="nama_kriteria">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Nilai Preferensi</label>
                            <input type="number" class="form-control" id="recipient-name" name="bobot" max="100">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @foreach ($kriteriaRekanKerja as $item)
        <div class="modal fade" id="modalEditKriteriaKaryawan{{ $item->id }}" tabindex="-1" aria-labelledby="modalEditKriteriaKaryawanLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalEditKriteriaKaryawanLabel">
                            <i class="bi bi-pen-fill"></i>
                            Edit Data Kriteria Karyawan
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('hr.update.kriteria.rekan.kerja', $item->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Nama Kriteria</label>
                                <input type="text" class="form-control" id="recipient-name" name="nama_kriteria"
                                    value="{{ $item->nama_kriteria }}">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Nilai Preferensi</label>
                                <input type="number" class="form-control" id="recipient-name" name="bobot_kriteria"
                                    max="100" value="{{ intval($item->bobot_kriteria) }}">
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
        new DataTable('#kriteria_direktur');
        new DataTable('#kriteria_karyawan');

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
