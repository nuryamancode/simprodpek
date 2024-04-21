@extends('karyawans.layouts.karyawan-base', ['title' => 'Dashboard'])



@section('content-karyawan')
    <div class="container-fluid">
        <h2 class="text-uppercase main-title mt-3 mb-3">Dashboard</h2>
        @if ($karyawan === null || $karyawan->alamat === null)
            <div class="alert alert-danger">
                Harap melengkapi profil anda, <a href="{{ route('karyawan.profil') }}" class="btn btn-danger">Lengkapi
                    Profil</a>
            </div>
        @endif
        <!--  Row 1 -->
        <div class="row">
            <div class="col">
                <div class="card overflow-hidden rounded-2">
                    <div class="card-body pt-3 p-4">
                        <div class="row">
                            <div class="col-9">
                                <h6 class="fw-semibold fs-4">Jumlah Tugas Proyek</h6>
                                <div>{{ $jumlahtugas }}</div>
                            </div>
                            <div class="col text-center">
                                <div class="d-flex align-items-center justify-content-end">
                                    <i class="bi bi-clipboard2-data-fill fs-8 text-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card overflow-hidden rounded-2">
                    <div class="card-body pt-3 p-4">
                        <div class="row">
                            <div class="col-8">
                                <h6 class="fw-semibold fs-4">Jumlah Tugas Proyek Selesai</h6>
                                <div>{{ $jumlahtugasselesai }}</div>
                            </div>
                            <div class="col text-center">
                                <div class="d-flex align-items-center justify-content-end">
                                    <i class="bi bi-clipboard2-check-fill fs-8 text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col d-flex align-items-strech">
                <div class="card w-100">
                    <div class="card-body">
                        <div class="d-sm-flex d-block align-items-center justify-content-between mb-9">
                            <div class="mb-3 mb-sm-0">
                                <h5 class="card-title fw-semibold">Penilaian</h5>
                            </div>
                        </div>
                        <canvas id="laporanChart" class="stats ct-charts position-relative" width="400" height="200">
                        </canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var labels = [];
        var datasets = [];

        @foreach ($totalakhir_per_periode as $periode => $totalakhir)
            labels.push("{{ $periode }}");
            var data = [];
            @foreach ($totalakhir as $item)
                data.push({{ $item->total_akhir }});
            @endforeach
            datasets.push({
                label: 'Periode {{ $periode }}',
                data: data,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            });
        @endforeach

        var ctx = document.getElementById('laporanChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: datasets
            },
            options: {
                indexAxis: 'y',
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                elements: {
                    bar: {
                        borderWidth: 2,
                    }
                },
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                    },
                    title: {
                        display: true,
                        text: 'Penilaian Per Periode'
                    }
                }
            }
        });
    </script>
@endsection
