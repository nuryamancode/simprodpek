@extends('hr.layouts.hr-base', ['title' => 'Kelola Penilaian'])

@section('content-hr')
    <div class="container mt-3">
        @include('hr.layouts.hr-profil-null')
        <div class="page-content">
            <div class="card mt-3">
                <div class="card-header">
                    <h2 class="page-heading">Tabel Kelola Penilaian</h2>
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
                    <table id="kelolapenilaian" class="table table-responsive table-striped table-bordered mt-3"
                        style="width:100%">
                        <thead>
                            <tr class="text-center text-nowrap align-middle table-dark">
                                <th class="text-center">No</th>
                                <th class="text-center">Nama Karyawan</th>
                                <th class="text-center">Tanggal Penilaian</th>
                                <th class="text-center">Status Penilaian</th>
                                <th class="text-center">Total Akhir</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($periode as $item)
                                <tr class="text-nowrap align-middle">
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $item->karyawan->nama_lengkap }}</td>
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($item->tanggal_periode)->locale('id_ID')->isoFormat('D MMMM Y') }}
                                    </td>
                                    <td class="text-center">
                                        @if ($item->status_periode === 'Sudah Dinilai')
                                        <span class="status-done">{{ $item->status_periode }}</span>
                                        @elseif($item->status_periode === 'Belum Dinilai')
                                        <span class="status-reject">{{ $item->status_periode }}</span>
                                        @else
                                        <span class="">Status bermasalah</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $item->totalakhir->total_nilai_akhir ?? 'Belum Dinilai'}}</td>
                                    <td class="text-center">
                                        @if ($item->status_periode == 'Sudah Dinilai')
                                            <a href="{{ route('hr.detail.kelola.penilaian', $item->id) }}"
                                                class="btn btn-primary">
                                                <i data-feather="eye" class="feather-icon"></i>
                                            </a>
                                        @endif
                                        @if ($item->status_periode == 'Belum Dinilai')
                                            <a href="#" class="btn btn-success"
                                                data-bs-target="#modalEdit{{ $item->id }}" data-bs-toggle="modal">
                                                <i data-feather="edit" class="feather-icon"></i>
                                            </a>
                                        @endif
                                        <a href="#" class="btn btn-danger" data-confirm-delete="true"
                                            onclick="konfirmasiHapus('{{ route('hr.delete.kelola.penilaian', $item->id) }}')">
                                            <i data-feather="trash-2" class="feather-icon"></i>
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
                    <form action="{{ route('hr.save.kelola.penilaian') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Nama Lengkap</label>
                            <select name="karyawan_id" id="recipient-name" class="form-select">
                                @foreach ($karyawan as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_lengkap }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Tanggal Periode</label>
                            <input type="date" class="form-control" id="recipient-name" name="tanggal_periode">
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
                            <i class="bi bi-person-fill-add"></i>
                            Tambah Data
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('hr.update.kelola.penilaian', $item->id) }}" method="POST">
                            @csrf
                            @method('put')
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Nama Karyawan</label>
                                <select name="karyawan_id" id="recipient-name" class="form-select">
                                    @foreach ($karyawan as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_lengkap }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Tanggal Periode</label>
                                <input type="date" class="form-control" id="recipient-name" name="tanggal_periode"
                                    value="{{ isset($item) ? $item->tanggal_periode : '' }}">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Edit</button>
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
        new DataTable('#kelolapenilaian', {
            fixedColumns: {
                left: 0,
                right: 1
            },
            scrollX: true,
            scrollXInner: "100%",
            autoWidth: true,

        });

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
