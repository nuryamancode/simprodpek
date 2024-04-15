@extends('direkturs.layouts.direktur-base', ['title' => 'Kelola Penilaian'])


@section('content-direktur')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h2 class="title-name">Tabel Kelola Penilaian</h2>
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
                </div>
                <table id="periode" class="table table-responsive table-bordered mt-3 table table-striped nowrap"
                    style="width:100%">
                    <thead>
                        <tr class="text-center table-dark">
                            <th class="text-center">No</th>
                            <th class="text-center">Nama Karyawan</th>
                            <th class="text-center">Tanggal Penilaian</th>
                            <th class="text-center">Status Penilaian</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($periode as $item)
                            <tr>
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
                                <td class="text-center">
                                    @if ($item->status_periode == 'Belum Dinilai')
                                        <a href="{{ route('direktur.penilaian', $item->id) }}" class="btn btn-primary">
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

@section('direktur-js')
    <script>
        new DataTable('#periode', {
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
