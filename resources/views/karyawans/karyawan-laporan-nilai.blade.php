@extends('karyawans.layouts.karyawan-base', ['title' => 'Laporan Nilai Kinerja'])

@section('content-karyawan')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h2 class="title-name">Laporan Nilai Kinerja</h2>
            </div>
            <div class="card-body">
                <table id="laporannilai" class="table table-responsive table-striped table-bordered mt-3" style="width:100%">
                    <thead>
                        <tr class="text-center text-nowrap align-middle table-dark">
                            <th class="text-center">No</th>
                            <th class="text-center">Periode</th>
                            <th class="text-center">Nilai</th>
                            <th class="text-center">Predikat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($totalakhir as $item)
                            <tr class="text-nowrap align-middle">
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $item->periode->periode }}</td>
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
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        new DataTable('#laporannilai', {
            fixedColumns: {
                left: 0,
                right: 1
            },
            scrollX: true,
            scrollXInner: "100%",
            autoWidth: false,

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
