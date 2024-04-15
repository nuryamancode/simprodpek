@extends('hr.layouts.hr-base', ['title' => 'Sub Kriteria'])

@section('content-hr')
    <div class="container mt-3">
        @include('hr.layouts.hr-profil-null')
        <div class="page-content">
            <div class="card mt-3">
                <div class="card-header">
                    <h2 class="page-heading">Tabel Sub Kriteria</h2>
                    <p class="p-4">Lorem ipsum dolor sit amet consectetur adipisicing elit. Placeat enim, vel nisi quis, minus
                        voluptas
                        ullam perspiciatis ut incidunt ex voluptate. Eos esse nulla ut iusto, enim quasi voluptatum. Asperiores.
                    </p>
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
                            {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button> --}}
                        </div>
                    @endif
                    <div class="text-end mb-3">
                        <a href="#" class="btn btn-success" data-bs-target="#modalTambah" data-bs-toggle="modal">
                            <i data-feather="plus-circle"></i>
                            Tambah Data
                        </a>
                    </div>
                    <table id="subkriteriatable" class="table table-responsive table-bordered mt-3" style="width:100%">
                        <thead>
                            <tr class="table-dark">
                                <th>No</th>
                                <th>Kriteria</th>
                                <th>Sub Kriteria</th>
                                <th>Pertanyaan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($sub as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td >{{ $item->kriteria->nama_kriteria }}</td>
                                    <td>{{ $item->nama_subkriteria }}</td>
                                    <td>{{ $item->pertanyaan }}</td>
                                    <td class="text-center">
                                        <a href="#" class="btn btn-danger" data-confirm-delete="true"
                                            onclick="konfirmasiHapus('{{ route('hr.delete.sub.kriteria', $item->id) }}')">
                                            <i data-feather="trash-2" class="feather-icon"></i>
                                        </a>
                                        <a href="#" class="btn btn-success"
                                            data-bs-target="#modalEdit{{ $item->id }}" data-bs-toggle="modal">
                                            <i data-feather="edit" class="feather-icon"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalTambahLabel">
                        <i class="bi bi-person-fill-add"></i>
                        Tambah Data
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('hr.save.sub.kriteria') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="kriteria_id" class="form-label">Kriteria</label>
                            <select name="kriteria_id" class="form-select">
                                @if (count($kri) > 0)
                                    @foreach ($kri as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_kriteria }}</option>
                                    @endforeach
                                @else
                                    <option value="" disabled selected>Data tidak ada</option>
                                @endif
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="nama_sub" class="form-label">Sub Kriteria</label>
                            <input type="text" name="nama_sub" class="form-control">
                        </div>
                        <div class="mb-3">
                            <label for="nama_sub" class="form-label">Pertanyaan</label>
                            <textarea class="form-control" placeholder="" id="floatingTextarea" name="pertanyaan" style="height: 80px"></textarea>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    @foreach ($sub as $item)
        <div class="modal fade" id="modalEdit{{ $item->id }}" tabindex="-1" aria-labelledby="modalEditLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="modalEditLabel">
                            <i class="bi bi-pen-fill"></i>
                            Edit Data
                        </h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('hr.update.sub.kriteria', $item->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="nama_sub" class="form-label">Sub Kriteria</label>
                                <textarea class="form-control" placeholder="" id="floatingTextarea" name="nama_sub" style="height: 80px">{{ $item->nama_subkriteria }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="nama_sub" class="form-label">Pertanyaan</label>
                                <textarea class="form-control" placeholder="" id="floatingTextarea" name="pertanyaan" style="height: 80px">{{ $item->pertanyaan }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="kriteria" class="col-form-label">Kriteria</label>
                                <select name="kriteria_id" id="kriteria" class="form-select">
                                    <option value="{{ $item->kriteria->id }}" selected>
                                        {{ $item->kriteria->nama_kriteria }}</option>
                                    @foreach ($kri as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_kriteria }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Ubah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

@endsection

@section('js')
    <script>
        new DataTable('#subkriteriatable');

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
