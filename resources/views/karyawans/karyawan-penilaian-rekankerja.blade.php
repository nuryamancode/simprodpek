@extends('karyawans.layouts.karyawan-base', ['title' => 'Penilaian Rekan Kerja Karyawan'])



@section('content-karyawan')
    <div class="container-fluid">
        <div class="card mb-3 mt-3">
            <div class="card-header">
                <h2 class="title-name">Penilaian Rekan Kerja Karyawan</h2>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <table id="hasilkinerja" class="table table-responsive table-bordered mt-3" style="width:100%">
                    <thead>
                        <tr class="table-dark">
                            <th>No</th>
                            <th>Periode</th>
                            <th>Nama Karyawan</th>
                            <th>Nama Bidang</th>
                            <th>Nama Tim</th>
                            <th>Status Penilaian</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($tim->isEmpty())
                            {{ null }}
                        @else
                            @foreach ($penilai as $item)
                                <tr class="text-center text-nowrap">
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->periode->periode }}</td>
                                    <td>
                                        @php
                                            $uniqueNames = collect([]);
                                        @endphp
                                        @foreach ($tim as $tims)
                                            @php
                                                $uniqueNames = $uniqueNames->merge($tims->karyawan);
                                            @endphp
                                        @endforeach

                                        @foreach ($uniqueNames->unique('nama_lengkap') as $item1)
                                            <ul>
                                                <li>{{ $item1->nama_lengkap }}</li>
                                            </ul>
                                        @endforeach
                                    </td>
                                    <td>
                                        @php
                                            $uniqueNames = collect([]);
                                        @endphp
                                        @foreach ($tim as $tims)
                                            @php
                                                $uniqueNames = $uniqueNames->merge($tims->karyawan);
                                            @endphp
                                        @endforeach

                                        @foreach ($uniqueNames->unique('nama_lengkap') as $item2)
                                            <ul>
                                                <li>{{ $item1->bidang->nama_bidang }}</li>
                                            </ul>
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach ($tim as $tims)
                                            @foreach ($tims->karyawan->unique('nama_tim') as $item3)
                                                <ul>
                                                    <li>{{ $tims->nama_tim }}</li>
                                                </ul>
                                            @endforeach
                                        @endforeach
                                    </td>
                                    <td>
                                        @php
                                            $uniqueNames = collect([]);
                                        @endphp
                                        @foreach ($tim as $tims)
                                            @php
                                                $uniqueNames = $uniqueNames->merge($tims->karyawan);
                                            @endphp
                                        @endforeach

                                        @foreach ($uniqueNames->unique('nama_lengkap') as $item4)
                                            <ul>
                                                @php
                                                    $tahapsatu = \App\Models\Penilaian\PenilaianRekanKerja::where(
                                                        'karyawan_id',
                                                        $item4->id,
                                                    )
                                                        ->where('periode_id', $item->periode_id)
                                                        ->where('karyawan_menilai_id', $karyawan->id) // Penilai yang sedang login
                                                        ->first();

                                                    // Mengabaikan penilaian oleh penilai yang sedang login
                                                    $evaluatedByOthers = \App\Models\Penilaian\PenilaianRekanKerja::where(
                                                        'karyawan_id',
                                                        $item4->id,
                                                    )
                                                        ->where('periode_id', '!=', $item->periode_id)
                                                        ->where('karyawan_menilai_id', $karyawan->id) // Mengabaikan penilaian oleh penilai yang sedang login
                                                        ->exists();

                                                    // Jika tidak ada penilaian oleh karyawan yang sedang login dan juga tidak ada penilaian oleh karyawan lain
                                                    if (!$tahapsatu && !$evaluatedByOthers) {
                                                        $statusPenilaian = 'Belum Dinilai';
                                                    } else {
                                                        $statusPenilaian = 'Sudah Dinilai';
                                                    }
                                                @endphp
                                                <li>
                                                    @if ($statusPenilaian == 'Belum Dinilai')
                                                        <span class="bg-danger p-1 rounded text-white">Belum Dinilai</span>
                                                    @else
                                                        <span class="bg-success p-1 rounded text-white">Sudah Dinilai</span>
                                                    @endif
                                                </li>
                                            </ul>
                                        @endforeach
                                    </td>
                                    <td>
                                        @php
                                            $uniqueNames = collect([]);
                                        @endphp
                                        @foreach ($tim as $tims)
                                            @php
                                                $uniqueNames = $uniqueNames->merge($tims->karyawan);
                                            @endphp
                                        @endforeach

                                        @foreach ($uniqueNames->unique('nama_lengkap') as $item5)
                                            <ul>
                                                @php
                                                    // Mengecek apakah karyawan tersebut sudah dinilai oleh penilai yang sedang login
                                                    $tahapsatu = \App\Models\Penilaian\PenilaianRekanKerja::where(
                                                        'karyawan_id',
                                                        $item5->id,
                                                    )
                                                        ->where('periode_id', $item->periode_id) // Penilai yang sedang login
                                                        ->where('karyawan_menilai_id', $karyawan->id) // Penilai yang sedang login
                                                        ->first();

                                                    // Mengabaikan penilaian oleh penilai yang sedang login
                                                    $evaluatedByOthers = \App\Models\Penilaian\PenilaianRekanKerja::where(
                                                        'karyawan_id',
                                                        $item5->id,
                                                    )
                                                        ->where('periode_id', '!=', $item->periode_id)
                                                        ->where('karyawan_menilai_id', $karyawan->id)  // Mengabaikan penilaian oleh penilai yang sedang login
                                                        ->exists();

                                                    // Jika tidak ada penilaian oleh karyawan yang sedang login dan juga tidak ada penilaian oleh karyawan lain
                                                    if (!$tahapsatu && !$evaluatedByOthers) {
                                                        $statusPenilaian = 'Belum Dinilai';
                                                    } else {
                                                        $statusPenilaian = 'Sudah Dinilai';
                                                    }
                                                @endphp
                                                <li>
                                                    @if ($statusPenilaian == 'Belum Dinilai')
                                                        <form action="{{ route('karyawan.penilaian.satu', $item->periode_id) }}"
                                                            method="POST">
                                                            @csrf
                                                            <input type="hidden" name="karyawan_id"
                                                                value="{{ $item5->id }}">
                                                            <input type="hidden" name="periode_id"
                                                                value="{{ $item->periode_id }}">
                                                            <button type="submit" class="btn btn-dark fs-4">
                                                                <i class="bi bi-plus-circle-dotted"></i>
                                                            </button>
                                                        </form>
                                                    @else
                                                        <span class="btn btn-success disabled">
                                                            <i class="bi bi-check-circle"></i>
                                                        </span>
                                                    @endif
                                                </li>
                                            </ul>
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        @endif
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
