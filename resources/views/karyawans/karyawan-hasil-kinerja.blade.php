@extends('karyawans.layouts.karyawan-base', ['title' => 'Hasil Kinerja Karyawan'])



@section('content-karyawan')
    <div class="container-fluid">
        <div class="card mb-3 mt-3">
            <div class="card-header">
                <h2 class="title-name">Hasil Kinerja Karyawan</h2>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="hasilkinerja" class="table table-responsive table-bordered mt-3" style="width:100%">
                    <thead>
                        <tr class="table-dark">
                            <th>Tanggal Penilaian</th>
                            <th>Total Nilai Akhir</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($periode as $item)
                            <tr class="text-center text-nowrap">
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_periode)->locale('id_ID')->isoFormat('D MMMM Y') }}
                                </td>
                                <td>{{ $item->totalakhir->total_nilai_akhir ?? 'Belum Dinilai' }}</td>
                                <td class="text-center">
                                    <a href="{{ route('karyawan.detail.hasil.kinerja', $item->id) }}"
                                        class="btn btn-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
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
        new DataTable('#hasilkinerja', {
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
