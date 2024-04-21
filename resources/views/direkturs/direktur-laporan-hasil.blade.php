@extends('direkturs.layouts.direktur-base', ['title' => 'Laporan Kinerja Karyawan'])

@section('content-direktur')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h2 class="title-name">Laporan Kinerja Karyawan</h2>
            </div>
            <div class="card-body">
                <div class="mb-5 mt-5">
                    <form action="{{ route('direktur.laporan.hasil') }}" method="GET">
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
                                <button class="btn btn-primary" type="submit"><i class="bi bi-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <table id="laporanhasil" class="table table-responsive table-striped table-bordered mt-3"
                    style="width:100%">
                    <thead>
                        <tr class="text-center text-nowrap align-middle table-dark">
                            <th class="text-center">No</th>
                            <th class="text-center">Periode</th>
                            <th class="text-center">Nama Karyawan</th>
                            <th class="text-center">Nama Bidang</th>
                            <th class="text-center">Nilai</th>
                            <th class="text-center">Predikat</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($totalakhir as $item)
                            <tr class="text-nowrap align-middle">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $item->periode->periode }}</td>
                                <td>{{ $item->karyawan->nama_lengkap }}</td>
                                <td>{{ $item->karyawan->bidang->nama_bidang }}</td>
                                <td>{{ $item->total_akhir }}</td>
                                <td>
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

@section('direktur-js')
    <script>
        $(document).ready(function() {
            var table = $('#laporanhasil').DataTable({
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
                ],
                dom: 'Bfrtip',
                fixedColumns: {
                    left: 0,
                    right: 1
                },
                scrollX: true,
                scrollXInner: "100%",
                autoWidth: true,
                "bPaginate": true, // Enable pagination
                "bLengthChange": true, // Show number of entries per page dropdown
                "bFilter": true, // Enable search
                "bInfo": true, // Show information (e.g., "Showing 1 to 10 of 50 entries")
                "bAutoWidth": false, // Disable automatic column width calculation
                "border": true,
            });
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
