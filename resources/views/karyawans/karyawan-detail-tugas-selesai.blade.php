@extends('karyawans.layouts.karyawan-base', ['title' => 'Detail Daftar Tugas'])



@section('content-karyawan')
<div class="container-fluid">
    <span class="mb-3"><a href="{{ route('karyawan.tugas.karyawan') }}" class="btn-primary">
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
                            <h2 class="main-title">Detail Tugas</h2>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row justify-between">
                        <div class="col-4">
                            <div class="text p-3">
                                <label for="proyek" class="form-label">Nama Proyek</label>
                                <h6 class="title-sub text-uppercase" id="proyek">
                                    {{ $tugas->proyek->nama_proyek }}
                                </h6>
                                <label for="proyek" class="form-label mt-3">Nama Klien</label>
                                <h6 class="title-sub text-uppercase" id="proyek">
                                    {{ $tugas->proyek->klien->nama_klien }}
                                </h6>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="text p-3">
                                <label for="proyek" class="form-label">Nama Penanggung Jawab</label>
                                <h6 class="title-sub text-uppercase" id="proyek">{{ $tugas->karyawan->nama_lengkap }}
                                </h6>
                                <label for="proyek" class="form-label mt-3">Tugas</label>
                                <h6 class="title-sub text-uppercase">
                                    {{ $tugas->nama_tugas }}
                                </h6>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="text p-3">
                                <label for="proyek" class="form-label">Divisi</label>
                                <h6 class="title-sub text-uppercase" id="proyek">
                                    {{ $tugas->karyawan->bidang->nama_bidang ?? 'Belum ditambahkan' }}
                                </h6>
                                <label for="proyek" class="form-label mt-3">Deadline Tugas</label>
                                <h6 class="title-sub text-uppercase">
                                    {{ \Carbon\Carbon::parse($tugas->deadline_tugas)->locale('id_ID')->isoFormat('D MMMM Y') }}
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
                            <h2 class="main-title">Tugas</h2>
                        </div>
                        <div class="col text-end">
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">File Tugas</label>
                        <div>
                            <label for="recipient-name" class="col-form-label">
                            @if ($tugas->upload_berkas === null)
                                    File Kosong
                                    @else
                                    <a href="{{ route('karyawan.tugas.download.hasil', $tugas->upload_berkas) }}" class="justify-content-center align-content-center">
                                        @if (in_array(pathinfo($tugas->upload_berkas, PATHINFO_EXTENSION), ['docx', 'doc']))
                                        <img src="{{ asset('assets/image/icons/word.png') }}" alt="" srcset="" width="18px">
                                        {{ $tugas->upload_berkas }}
                                        @elseif(pathinfo($tugas->upload_berkas, PATHINFO_EXTENSION) == 'pdf')
                                        <img src="{{ asset('assets/image/icons/pdf.png') }}" alt="" srcset="" width="18px">
                                        {{ $tugas->upload_berkas }}
                                        @elseif(in_array(pathinfo($tugas->upload_berkas, PATHINFO_EXTENSION), ['xlsx', 'xls', 'csv']))
                                        <img src="{{ asset('assets/image/icons/excel.png') }}" alt="" srcset="" width="18px">
                                        {{ $tugas->upload_berkas }}
                                        @elseif(in_array(pathinfo($tugas->upload_berkas, PATHINFO_EXTENSION), ['zip', 'rar']))
                                        <img src="{{ asset('assets/image/icons/zip.png') }}" alt="" srcset="" width="18px">
                                        {{ $tugas->upload_berkas }}
                                        @elseif(in_array(pathinfo($tugas->upload_berkas, PATHINFO_EXTENSION), ['jpeg', 'png']))
                                        <img src="{{ asset('assets/image/icons/image.png') }}" alt="" srcset="" width="18px">
                                        {{ $tugas->upload_berkas }}
                                        @endif
                                    </a>
                                    @endif
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection