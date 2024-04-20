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
                    </div>
                @endif
                {{-- <div class="mb-5">
                    <form id="" action=""{{ route('direktur.kelola.penilaian') }} method="GET">
                        @csrf
                        <div class="mb-3">
                            <label for="inputGroupFile04" class="form-label fw-bold">Pilih Periode</label>
                            <div class="input-group">
                                <select class="form-select" id="floatingSelectGrid" name="pilihperiode"
                                    onchange="this.form.submit()">
                                    @if (!$periode->isEmpty())
                                        <option disabled selected>Pilih Periode</option>
                                        @foreach ($periode as $periode)
                                            <option value="{{ $periode->periode }}"
                                                @if ($pilihperiode == $periode->periode) selected @endif>
                                                {{ $periode->periode }}</option>
                                        @endforeach
                                    @else
                                        <option disabled selected>Periode Tidak Tersedia</option>
                                    @endif
                                </select>
                                <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div> --}}
                <div class="text-end mb-5">
                </div>
                <table id="periode" class="table table-responsive table-bordered mt-3 table table-striped nowrap"
                    style="width:100%">
                    <thead>
                        <tr class="text-center table-dark">
                            <th class="text-center">No</th>
                            <th class="text-center">Periode</th>
                            <th class="text-center">Nama Karyawan</th>
                            <th class="text-center">Bidang</th>
                            <th class="text-center">Status Penilaian</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($penilaian as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td class="text-center">{{ $item->periode }}</td>
                                <td class="table-striped-columns">
                                    @foreach ($karyawan as $item2)
                                        <ul>
                                            <li>{{ $item2->nama_lengkap }}</li>
                                        </ul>
                                    @endforeach
                                </td>
                                <td class="table-striped-columns">
                                    @foreach ($karyawan as $item3)
                                        <ul>
                                            <li>{{ $item3->bidang->nama_bidang }}</li>
                                        </ul>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    @foreach ($karyawan as $item4)
                                        <ul>
                                            <li>
                                                @php
                                                    $tahapsatu = \App\Models\Penilaian\PenilaianKaryawan::where(
                                                        'karyawan_id',
                                                        $item4->id,
                                                    )
                                                        ->where('periode_id', $item->id)
                                                        ->first();
                                                @endphp
                                                @if (!$tahapsatu || $tahapsatu->status_penilaian == 'Belum dinilai')
                                                    <span class="bg-danger p-1 rounded text-white"> Belum Dinilai</span>
                                                @else
                                                    <span class="bg-success p-1 rounded text-white">Sudah Dinilai</span>
                                                @endif
                                            </li>
                                        </ul>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    @foreach ($karyawan as $item5)
                                        <ul>
                                            <li>
                                                @php
                                                    $tahapsatu = \App\Models\Penilaian\PenilaianKaryawan::where(
                                                        'karyawan_id',
                                                        $item5->id,
                                                    )
                                                        ->where('periode_id', $item->id)
                                                        ->first();
                                                @endphp
                                                @if (!$tahapsatu || $tahapsatu->status_penilaian == 'Belum dinilai')
                                                    <form action="{{ route('direktur.penilaian.satu', $item->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        <input type="hidden" name="karyawan_id"
                                                            value="{{ $item5->id }}">
                                                        <input type="hidden" name="periode_id" value="{{ $item->id }}">
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
