@extends('karyawans.layouts.karyawan-base', ['title' => 'Notifikasi'])

@section('content-karyawan')
    <div class="container-fluid">
        <div class="card" style="width: 100%;">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <h6>Notifikasi</h6>
                    </div>
                    <div class="col text-end">
                        @if (!$notifikasi->isEmpty())
                            <form action="{{ route('karyawan.hapus.semua.notifikasi') }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">Hapus Semua</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            <ul class="list-group list-group-flush">
                @if ($notifikasi->isEmpty())
                    <li class="list-group-item">
                        <div class="text-center">
                            <h6>Tidak ada notifikasi</h6>
                        </div>
                    </li>
                @else
                    @foreach ($notifikasi as $item)
                        <a href="{{ route('karyawan.notifikasi.dibaca', $item->id) }}">
                            <li class="list-group-item">
                                <h4>{{ $item->judul }}
                                    @if (!$item->dibaca)
                                        <span class="badge bg-danger">Belum Dibaca</span>
                                    @endif
                                </h4>
                                <p>
                                    {{ $item->pesan }}
                                </p>
                                <small>{{ $item->created_at->locale('id')->diffForHumans() }}</small>
                            </li>
                        </a>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
@endsection
