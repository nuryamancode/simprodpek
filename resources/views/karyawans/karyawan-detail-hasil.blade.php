@extends('karyawans.layouts.karyawan-base', ['title' => 'Detail Hasil Kinerja'])

@section('content-karyawan')
    <div class="container-fluid">
        <span class="mb-3"><a href="{{ route('karyawan.hasil.kinerja') }}" class="btn-primary">
                <i class="bi bi-caret-left-fill"></i>
                Kembali</a>
        </span>
        <div class="card mt-3">
            <div class="card-body">
                <div class="card">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $item)
                                    <li>
                                        {{ $item }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h2 class="main-title">Detail Hasil Kinerja</h2>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row justify-between">
                            <div class="col">
                                <div class="text p-3">
                                    <label for="proyek" class="form-label">Tanggal Penilaian</label>
                                    <h6 class="title-sub text-uppercase" id="proyek">
                                        {{ \Carbon\Carbon::parse($periode->tanggal_periode)->locale('id_ID')->isoFormat('D MMMM Y') }}
                                    </h6>
                                </div>
                            </div>
                            <div class="col">
                                <div class="text p-3">
                                    <label for="proyek" class="form-label">Total Nilai Akhir</label>
                                    <h6 class="title-sub text-uppercase" id="proyek">
                                        {{ $periode->totalakhir->total_nilai_akhir }}
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h2 class="main-title">Penilaian</h2>
                            </div>
                            <div class="col text-end">
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="charts align-item-center d-flex justify-content-center mb-5">
                            <div class="row">
                                <div class="col">
                                    <div class="justify-content-center d-flex">
                                        <div id="breakup"></div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <div class="d-flex align-items-center justify-content-center">
                                            @foreach ($totalhasilkriteria as $index => $item)
                                                <div class="me-4">
                                                    <span class="round-8 bg-{{ $index % 5 == 0 ? 'primary' : ($index % 5 == 1 ? 'warning' : ($index % 5 == 2 ? 'danger' : ($index % 5 == 3 ? 'success' : 'dark'))) }} rounded-circle me-2 d-inline-block" style="width: 10px; height: 10px; color:{{ $index % 5 == 0 ? '#007bff' : ($index % 5 == 1 ? '#ffc107' : ($index % 5 == 2 ? '#dc3545' : ($index % 5 == 3 ? '#28a745' : '#004085'))) }}"></span>
                                                    <span class="fs-2 text-{{ $index % 5 == 0 ? 'primary' : ($index % 5 == 1 ? 'warning' : ($index % 5 == 2 ? 'danger' : ($index % 5 == 3 ? 'success' : ''))) }}" style="color:{{ $index % 5 == 0 ? '#007bff' : ($index % 5 == 1 ? '#ffc107' : ($index % 5 == 2 ? '#dc3545' : ($index % 5 == 3 ? '#28a745' : '#004085'))) }}">{{ $item->kriteria->nama_kriteria }}</span>                                                    
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <table id="hasilkinerja" class="table table-responsive table-striped table-bordered mt-3"
                            style="width:100%">
                            <thead>
                                <tr class="table-dark">
                                    <th class="text-center">Kriteria</th>
                                    <th class="text-center">Total Nilai Per Kriteria</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($totalhasilkriteria as $item)
                                    <tr class="text-center">
                                        <td>{{ $item->kriteria->nama_kriteria }}</td>
                                        <td>{{ $item->total_nilai_perkriteria }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
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
            autoWidth: true,
        });

        var seriesData = [];
        var labelsData = [];
        @foreach ($totalhasilkriteria as $item)
            seriesData.push({{ $item->total_nilai_perkriteria }});
            labelsData.push("{{ $item->kriteria->nama_kriteria }}");
        @endforeach

        var breakup = {
            color: "#adb5bd",
            series: seriesData,
            labels: labelsData,
            chart: {
                width: 380,
                type: "donut",
                fontFamily: "Plus Jakarta Sans, sans-serif",
                foreColor: "#adb0bb",
            },
            plotOptions: {
                pie: {
                    startAngle: 0,
                    endAngle: 360,
                    donut: {
                        size: '75%',
                    },
                },
            },
            stroke: {
                show: false,
            },
            dataLabels: {
                enabled: false,
            },
            legend: {
                show: false,
            },
            colors: ["#5d87ff", "#ffae1f", "#fa896b", "#13deb9", "#2a3547"], // Opsional: atur warna sesuai kebutuhan
            responsive: [{
                breakpoint: 991,
                options: {
                    chart: {
                        width: 150,
                    },
                },
            }],
            tooltip: {
                theme: "dark",
                fillSeriesColor: false,
            },
        };

        // Membuat grafik dengan data dan opsi yang telah dikonfigurasi
        var chart = new ApexCharts(document.querySelector("#breakup"), breakup);
        chart.render();
    </script>
@endsection
