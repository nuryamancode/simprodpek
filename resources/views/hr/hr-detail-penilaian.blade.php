@extends('hr.layouts.hr-base', ['title' => 'Detail Penilaian'])

@section('content-hr')
    <div class="container-fluid">
        <span class="mb-3"><a href="{{ route('hr.kelola.penilaian') }}" class="btn-primary">
            <i data-feather="arrow-left" class="feather-icon"></i>
                Kembali</a>
        </span>
        <div class="card mt-3">
            <div class="card-body">
                <div class="card">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $item)
                                    <li>
                                        {{ $item }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h2 class="main-title">Detail Penilaian</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row justify-between">
                            <div class="col-4">
                                <div class="text p-3">
                                    <label for="proyek" class="form-label">Tamggal Penilaian</label>
                                    <h6 class="title-sub text-uppercase" id="proyek">
                                        {{ \Carbon\Carbon::parse($periode->tanggal_periode)->locale('id_ID')->isoFormat('D MMMM Y') }}
                                    </h6>
                                    
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="text p-3">
                                    <label for="proyek" class="form-label">Nama Karyawan</label>
                                    <h6 class="title-sub text-uppercase" id="proyek">
                                        {{ $periode->karyawan->nama_lengkap }}
                                    </h6>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="text p-3">
                                    <label for="proyek" class="form-label">Total Nilai Akhir</label>
                                    <h6 class="title-sub text-uppercase" id="proyek">
                                        {{ $totalakhir->first()->total_nilai_akhir }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h2 class="main-title">Penilaian</h2>
                            </div>
                            <div class="col text-end">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <table id="kelolapenilaian" class="table table-responsive table-striped table-bordered mt-3"
                        style="width:100%">
                        <thead>
                            <tr class="table-dark">
                                <th class="text-center">Kriteria</th>
                                <th class="text-center">Total Nilai Per Kriteria</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($totalhasilkriteria as $item)
                                <tr class="text-center">
                                    <td>{{ $item->kriteria->nama_kriteria }}</td>
                                    <td>{{ $item->total_nilai_perkriteria }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
