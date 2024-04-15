@extends('karyawans.layouts.karyawan-base', ['title' => 'Daftar Tugas'])



@section('content-karyawan')
    <div class="container-fluid">
        <div class="card mb-3 mt-3">
            <div class="card-header">
                <h2 class="title-name">Tabel Daftar Tugas</h2>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="daftar_tugas" class="table table-responsive table-bordered mt-3" style="width:100%">
                    <thead>
                        <tr class="table-dark">
                            <th>No</th>
                            <th>Nama Proyek</th>
                            <th>Nama Tugas</th>
                            <th>Keterangan Tugas</th>
                            <th>Deadline Tugas</th>
                            <th>Divisi</th>
                            <th>Status Tugas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tugas as $item)
                            <tr class="text-center text-nowrap">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->proyek->nama_proyek ?? 'Tidak ada' }}</td>
                                <td>{{ $item->nama_tugas }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($item->keterangan_tugas, 10) ?? 'Tidak ada keterangan' }}
                                </td>
                                <td>{{ \Carbon\Carbon::parse($item->deadline_tugas)->locale('id_ID')->isoFormat('D MMMM Y') }}
                                </td>
                                <td>{{ $item->karyawan->bidang->nama_bidang ?? 'Belum ditambahkan' }}</td>
                                <td>
                                    @if ($item->status_tugas === 'Proses')
                                        <span class="status-waiting">{{ $item->status_tugas }}</span>
                                    @elseif($item->status_tugas === 'Selesai')
                                        <span class="status-done">{{ $item->status_tugas }}</span>
                                    @elseif ($item->status_tugas === 'Revisi')
                                        <span class="status-reject">{{ $item->status_tugas }}</span>
                                    @elseif($item->status_tugas === 'Review')
                                        <span class="status-review">{{ $item->status_tugas }}</span>
                                    @else
                                        <span class="">Status bermasalah</span>
                                    @endif
                                </td>

                                <td class="text-center">
                                    @if ($item->status_tugas === 'Selesai')
                                        <a href="{{ route('karyawan.tugas.selesai.karyawan.detail', $item->id) }}"
                                            class="btn btn-primary">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('karyawan.tugas.karyawan.detail', $item->id) }}"
                                            class="btn btn-primary">
                                            <i class="bi bi-eye"></i>
                                        </a>
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
        new DataTable('#daftar_tugas', {
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
