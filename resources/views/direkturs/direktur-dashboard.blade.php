@extends('direkturs.layouts.direktur-base', ['title' => 'Dashboard'])

@section('content-direktur')
    <div class="container-fluid">
        <h2 class="text-uppercase main-title mt-3 mb-3">Dashboard</h2>
        @if ($direktur === null || $direktur->alamat === null)
            <div class="alert alert-danger">
                Harap melengkapi profil anda, <a href="{{ route('direktur.profil') }}" class="btn btn-danger">Lengkapi
                    Profil</a>
            </div>
        @endif
        <div class="row">
            <div class="col-sm-6 col-xl-3">
                <div class="card overflow-hidden rounded-2">
                    <div class="card-body pt-3 p-4">
                        <div class="row">
                            <div class="col-5">
                                <h6 class="fw-semibold fs-4">Jumlah Klien</h6>
                                <div>{{ $jumlahklien }}</div>
                            </div>
                            <div class="col text-center">
                                <div class="d-flex align-items-center justify-content-end">
                                    <i class="bi bi-people-fill fs-8 text-info"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card overflow-hidden rounded-2">
                    <div class="card-body pt-3 p-4">
                        <div class="row">
                            <div class="col-5">
                                <h6 class="fw-semibold fs-4">Jumlah Proyek</h6>
                                <div>{{ $jumlahproyek }}</div>
                            </div>
                            <div class="col text-center">
                                <div class="d-flex align-items-center justify-content-end">
                                    <i class="bi bi-people-fill fs-8 text-danger"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card overflow-hidden rounded-2">
                    <div class="card-body pt-3 p-4">
                        <div class="row">
                            <div class="col-9">
                                <h6 class="fw-semibold fs-4">Jumlah Proyek Selesai</h6>
                                <div>{{ $jumlahproyekselesai }}</div>
                            </div>
                            <div class="col text-center">
                                <div class="d-flex align-items-center justify-content-end">
                                    <i class="bi bi-people-fill fs-8 text-success"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-3">
                <div class="card overflow-hidden rounded-2">
                    <div class="card-body pt-3 p-4">
                        <div class="row">
                            <div class="col-8">
                                <h6 class="fw-semibold fs-4">Jumlah Proyek Selesai</h6>
                                <div>{{ $jumlahproyekproses }}</div>
                            </div>
                            <div class="col text-center">
                                <div class="d-flex align-items-center justify-content-end">
                                    <i class="bi bi-people-fill fs-8 text-warning"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
