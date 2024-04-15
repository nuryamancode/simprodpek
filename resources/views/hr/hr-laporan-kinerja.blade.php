@extends('hr.layouts.hr-base', ['title' => 'Laporan Kinerja Karyawan'])

@section('content-hr')
    <div class="container mt-3">
        @include('hr.layouts.hr-profil-null')
        <div class="page-content">
            <div class="card mt-3">
                <div class="card-header">
                    <h2 class="page-heading">Laporan Kinerja Karyawan</h2>
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
                    <div class="text-end mb-3">
                    </div>
                    <table id="laporankinerja" class="table table-responsive table-striped table-bordered mt-3"
                        style="width:100%">
                        <thead>
                            <tr class="text-center text-nowrap align-middle table-dark">
                                <th class="text-center">No</th>
                                <th class="text-center">Nama Karyawan</th>
                                <th class="text-center">Tanggal Penilaian</th>
                                <th class="text-center">Total Akhir</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($periode as $item)
                                <tr class="text-nowrap align-middle">
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="text-center">{{ $item->karyawan->nama_lengkap }}</td>
                                    <td class="text-center">
                                        {{ \Carbon\Carbon::parse($item->tanggal_periode)->locale('id_ID')->isoFormat('D MMMM Y') }}
                                    </td>
                                    <td class="text-center">{{ $item->totalakhir->total_nilai_akhir}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')
    <script>
        new DataTable('#laporankinerja', {
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
