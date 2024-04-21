@extends('hr.layouts.hr-base', ['title' => 'Kelola Hasil Penilaian'])

@section('content-hr')
    <div class="container mt-3">
        @include('hr.layouts.hr-profil-null')
        <div class="page-content">
            <div class="card mt-3">
                <div class="card-header">
                    <h2 class="page-heading">Tabel Kelola Hasil Penilaian</h2>
                </div>
                <div class="card-body">
                    <div class="mb-5 mt-5">
                        <form action="{{ route('hr.hasil.penilaian') }}" method="GET">
                            @csrf
                            <div class="mb-3">
                                <label for="filter" class="form-label">Filter Periode</label>
                                <div class="input-group">
                                    <select name="filter" id="filter" onchange="this.form.submit()" class="form-select">
                                        @if ($totalakhir !== null && !$totalakhir->isEmpty())
                                            @foreach ($totalakhir->unique('periode_id') as $item)
                                                <option value="{{ $item->periode->periode }}"
                                                    @if ($periode_pilih == $item->periode->periode) selected @endif>
                                                    {{ $item->periode->periode }}</option>
                                            @endforeach
                                        @else
                                            <option value="" disabled selected>Periode belum ada</option>
                                        @endif
                                    </select>
                                    <button class="btn btn-primary" type="submit"><i data-feather="search" class="feather-icon"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <table id="kelolahasilpenilaian" class="table table-responsive table-striped table-bordered mt-3"
                        style="width:100%">
                        <thead>
                            <tr class="text-center text-nowrap align-middle table-dark">
                                <th class="text-center">No</th>
                                <th class="text-center">Periode</th>
                                <th class="text-center">Nama Karyawan</th>
                                <th class="text-center">Nama Bidang</th>
                                <th class="text-center">Nilai Direktur</th>
                                <th class="text-center">Nilai Karyawan</th>
                                <th class="text-center">Total Akhir</th>
                                <th class="text-center">Predikat</th>
                                <th class="text-center">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if ($totalakhir !== null && !$totalakhir->isEmpty())
                                @foreach ($totalakhir as $item)
                                    <tr class="text-nowrap align-middle">
                                        <td>{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $item->periode->periode }}</td>
                                        <td class="text-center">{{ $item->karyawan->nama_lengkap }}</td>
                                        <td class="text-center">{{ $item->karyawan->bidang->nama_bidang }}</td>
                                        <td class="text-center">{{ $item->hasildirektur->total_akhir }}</td>
                                        <td class="text-center">{{ $item->hasilrekankerja->total_akhir_semua }}</td>
                                        <td class="text-center">{{ $item->total_akhir }}</td>
                                        <td class="text-center">
                                            @if ($item->total_akhir >= 4.01 && $item->total_akhir <= 5.0)
                                                <span class="fw-bold">A</span>
                                            @elseif($item->total_akhir >= 3.01 && $item->total_akhir <= 4.0)
                                                <span class="fw-bold">B</span>
                                            @elseif($item->total_akhir >= 2.01 && $item->total_akhir <= 3.0)
                                                <span class="fw-bold">C</span>
                                            @elseif($item->total_akhir >= 1.01 && $item->total_akhir <= 2.0)
                                                <span class="fw-bold">D</span>
                                            @elseif($item->total_akhir >= 0.0 && $item->total_akhir <= 1.0)
                                                <span class="fw-bold">E</span>
                                            @endif
                                        </td>
                                        <td class="text-center">
                                            @if ($item->total_akhir >= 4.01 && $item->total_akhir <= 5.0)
                                                <span class="bg-success rounded p-2 text-white">Naik Gaji</span>
                                            @else
                                                <span class="bg-danger p-2 rounded text-white">Tidak Naik Gaji</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        new DataTable('#kelolahasilpenilaian', {
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
