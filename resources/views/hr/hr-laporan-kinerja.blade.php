@extends('hr.layouts.hr-base', ['title' => 'Laporan Kinerja Karyawan'])

@section('content-hr')
    <div class="container mt-3">
        @include('hr.layouts.hr-profil-null')
        <div class="page-content">
            <div class="card mt-3">
                <div class="card-header">
                    <h2 class="page-heading">Tabel Laporan Kinerja Karyawan</h2>
                </div>
                <div class="card-body">
                    <div class="mb-5 mt-5">
                        <form action="{{ route('hr.laporan.kinerja') }}" method="GET">
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
                                    <button class="btn btn-primary" type="submit"><i data-feather="search"
                                            class="feather-icon"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <table id="laporankinerjak" class="table display table-responsive table-striped table-bordered mt-3"
                        style="width:100%">
                        <thead>
                            <tr class="text-center text-nowrap align-middle table-dark">
                                <th class="text-center">No</th>
                                <th class="text-center">Periode</th>
                                <th class="text-center">Nama Karyawan</th>
                                <th class="text-center">Nama Bidang</th>
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
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.1/js/buttons.print.min.js"></script>
    <script>
        $('#laporankinerjak').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'excel',
                {
                    extend: 'print',
                    customize: function(win) {
                        var letterhead =
                            '<div style="display: flex; align-items: center; margin-bottom: 20px;">' +
                            '<div style="flex: 1; text-align: left;">' +
                            '<img src="{{ asset('assets/image/mareca.png') }}" style="max-width: 100px;" />' +
                            '</div>' +
                            '<div style="flex: 2; text-align: right;">' +
                            '<h2>CV Mareca Yasa Media</h2>' +
                            '<p>Perumahan Cempaka Arum B5 No. 14, Rancanumpang,<br>Gedebage, Kota Bandung</p>' +
                            '<p style="margin-bottom: 0;"><span style="text-decoration: underline; color: blue;">Phone: +62 813-2032-4274</span></p>' +
                            '</div>' +
                            '</div>' +
                            '<hr style="border: 1px solid blue; margin: 0;">';

                        $(win.document.body).prepend(letterhead);
                        $(win.document.body).find('h1').css({
                            'text-align': 'center',
                            'font-size': '20px'
                        });

                        $(win.document.body).find('table').css('font-size', '10pt');
                        $(win.document.body).find('thead').css({
                            'border': '1px solid black'
                        });

                        $(win.document.body).find('tbody').css({
                            'border': '1px solid black'
                        });

                        $(win.document.body).find('thead th').css({
                            'border': '1px solid black'
                        });

                        $(win.document.body).find('tbody td').css({
                            'border': '1px solid black'
                        });
                    }
                }
            ]
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
