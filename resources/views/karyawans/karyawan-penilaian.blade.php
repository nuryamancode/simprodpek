@extends('karyawans.layouts.karyawan-base', ['title' => 'Penilaian Rekan Kerja'])

@section('content-karyawan')
    <div class="container-fluid">
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
                <h2 class="title-name">Penilaian Rekan Kerja</h2>
            </div>
            <div class="card-body">
                @if ($subkriteria === null)
                    <div class="text-center">
                        <h1 class="main-title">Data Kosong</h1>
                    </div>
                @else
                    <form action="{{ route('karyawan.hasil.penilaian') }}" method="post">
                        @csrf
                        <input type="hidden" name="penilaian_id" value="{{ $penilaian_id }}">
                        <div id="penilaian">
                            @foreach ($sub as $item)
                                @if (
                                    !$loop->first &&
                                        $item->kriteriaRekanKerja->nama_kriteria !== $sub[$loop->index - 1]->kriteriaRekanKerja->nama_kriteria)
                        </div>
                @endif

                @if (
                    $loop->first ||
                        $item->kriteriaRekanKerja->nama_kriteria !== $sub[$loop->index - 1]->kriteriaRekanKerja->nama_kriteria)
                    <div class="card-header">
                        <h3 class="font-bold">{{ $item->kriteriaRekanKerja->nama_kriteria }}</h3>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                @endif

                <div class="row">
                    <div class="" style="width: 100%;">


                        <li class="list-group-item"><span class="fw-bold text-dark">{{ $item->nama_subkriteria }}</span> -
                            {{ $item->pertanyaan }}</li>
                    </div>
                    <div class="" style="width: 100%; height: 50px">
                        <li class="list-group-item text-start">
                            {{-- <input type="number" name="subkriteria_id[]" value="{{ $item->id_subkriteria }}"> --}}
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="nilai[{{ $item->id }}]"
                                    id="1_{{ $item->id }}" value="1" required>
                                <label class="form-check-label" for="1_{{ $item->id }}">1</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="nilai[{{ $item->id }}]"
                                    id="2_{{ $item->id }}" value="2" required>
                                <label class="form-check-label" for="2_{{ $item->id }}">2</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="nilai[{{ $item->id }}]"
                                    id="3_{{ $item->id }}" value="3" required>
                                <label class="form-check-label" for="3_{{ $item->id }}">3</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="nilai[{{ $item->id }}]"
                                    id="4_{{ $item->id }}" value="4" required>
                                <label class="form-check-label" for="4_{{ $item->id }}">4</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="nilai[{{ $item->id }}]"
                                    id="5_{{ $item->id }}" value="5" required>
                                <label class="form-check-label" for="5_{{ $item->id }}">5</label>
                            </div>
                        </li>
                    </div>
                </div>
                @if ($loop->last)
                    </ul>
            </div>
            @endif
            @endforeach
        </div>

        <div class="d-grid gap-2">
            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                data-bs-target="#persetujuanModal">Kirim</button>
        </div>
        <div class="modal fade" id="persetujuanModal" tabindex="-1" aria-labelledby="persetujuanModalLabel"
            aria-hidden="true">
            <div class="modal-dialog  modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                    </div>
                    <div class="modal-body">
                        <p>Apakah anda kamu sudah yakin menilainya?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-success">Yakin</button>
                    </div>
                </div>
            </div>
        </div>
        </form>
        @endif
    </div>
    </div>
    </div>
@endsection

@section('direktur-js')
    <script></script>
@endsection
