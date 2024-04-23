@extends('karyawans.layouts.karyawan-base', ['title' => 'Tugas Selesai'])



@section('content-karyawan')
    <div class="container-fluid">
        <div class="card mb-3 mt-3">
            <div class="card-header">
                <h2 class="title-name">Tabel Tugas Selesai</h2>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="tugas_selesai" class="table table-responsive table-bordered mt-3" style="width:100%">
                    <thead>
                        <tr class="text-center text-nowrap table-dark">
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Tugas</th>
                            <th class="text-center">Keterangan Tugas</th>
                            <th class="text-center">Deadline</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tugas as $item)
                            <tr class="text-center text-nowrap">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->nama_tugas }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($item->keterangan_tugas, 10) ?? 'Tidak ada keterangan' }}
                                </td>
                                <td>{{ \Carbon\Carbon::parse($item->deadline_tugas)->locale('id_ID')->isoFormat('D MMMM Y') }}
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('karyawan.tugas.selesai.karyawan.detail', $item->id) }}"
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
        new DataTable('#tugas_selesai', {
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
