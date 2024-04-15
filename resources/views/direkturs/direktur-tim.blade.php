@extends('direkturs.layouts.direktur-base', ['title' => 'Daftar Tim'])


@section('content-direktur')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header">
                <h2 class="title-name">Tabel Daftar Tim</h2>
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
                <div class="text-end mb-3">
                    <a href="#" class="btn btn-success" data-bs-target="#modalTambah" data-bs-toggle="modal">
                        <i class="bi bi-person-fill-add"></i>
                        Tambah Data
                    </a>
                </div>
                <table id="timtabel" class="table table-responsive table-bordered mt-3 table table-striped nowrap"
                    style="width:100%">
                    <thead>
                        <tr class="text-center table-dark">
                            <th class="text-center">Nama Tim</th>
                            <th class="text-center">Nama Anggota & Divisi</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tim as $items)
                            <tr>
                                <td class="text-center">{{ $items->nama_tim }}</td>
                                <td>
                                    <ol>
                                        @foreach ($items->karyawan as $karyawans)
                                            <li>{{ $karyawans->nama_lengkap }} - {{ $karyawans->bidang->nama_bidang }}</li>
                                        @endforeach
                                    </ol>
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-danger" data-confirm-delete="true"
                                        onclick="konfirmasiHapus('')">
                                        <i class="bi bi-trash-fill"></i>
                                    </a>
                                    <a href="#" class="btn btn-success" data-bs-target="#modalEdit"
                                        data-bs-toggle="modal">
                                        <i class="bi bi-pen-fill"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
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
                    <form action="{{ route('direktur.save.tim') }}" method="POST" enctype="multipart/form-data"
                        id="formTambah">
                        @csrf
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Nama Tim</label>
                            <input type="text" class="form-control" id="recipient-name" name="nama_tim">
                        </div>
                        <div class="mb-3">
                            <label for="recipient-name" class="col-form-label">Pilih Anggota Tim</label>
                            <div id="inputSelectContainer">
                                <select name="karyawan_id[]" class="form-select">
                                    @if (count($mkaryawann) > 0)
                                        @foreach ($mkaryawann as $mkaryawann)
                                            <option value="{{ $mkaryawann->id }}">{{ $mkaryawann->nama_lengkap }} -
                                                {{ $mkaryawann->bidang->nama_bidang ?? 'Belum ada' }}</option>
                                        @endforeach
                                    @else
                                        <option value="" disabled selected>Data tidak ada</option>
                                    @endif
                                </select>
                            </div>
                            <button type="button" class="btn btn-secondary mt-2" id="tambahInputSelect">Tambah
                                Input</button>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>



    {{-- @foreach ($tim as $item)
        <div class="modal fade" id="modalEdit{{ $item->id_klien }}" tabindex="-1" aria-labelledby="modalEditLabel"
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
                        <form action="{{ route('direktur.update.klien', $item->id_klien) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Nama Lengkap</label>
                                <input type="text" class="form-control" id="recipient-name" name="name"
                                    value="{{ $item->nama_klien }}">
                            </div>
                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Email</label>
                                <input type="email" class="form-control" id="recipient-name" name="email"
                                    value="{{ $item->email }}">
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Alamat Lengkap</label>
                                <textarea class="form-control" placeholder="Masukkan alamat disini..." id="floatingTextarea" name="alamat">{{ $item->alamat }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">No Handphone</label>
                                <input type="text" class="form-control" id="recipient-name" name="nomor_handphone"
                                    value="{{ $item->nomor_handphone }}">
                            </div>
                            <div class="mb-3">
                                <label for="message-text" class="col-form-label">Berkas Klien</label>
                                <input type="file" class="form-control" id="recipient-name" name="berkas_klien">
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach --}}

@endsection

@section('direktur-js')
    <script>
        new DataTable('#timtabel', {
            fixedColumns: {
                left: 0,
                right: 1
            },
            scrollX: true,
            scrollXInner: "100%",
            autoWidth: false,
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


        document.addEventListener("DOMContentLoaded", function() {
            const tambahInputSelectBtn = document.getElementById('tambahInputSelect');
            const inputSelectContainer = document.getElementById('inputSelectContainer');

            tambahInputSelectBtn.addEventListener('click', function() {
                const newSelect = document.createElement('select');
                newSelect.setAttribute('name', 'karyawan_id[]');
                newSelect.classList.add('form-select', 'mt-2');
                inputSelectContainer.appendChild(newSelect);

                // Cloning options from the original select
                const originalSelect = document.querySelector('select[name="karyawan_id[]"]');
                originalSelect.querySelectorAll('option').forEach(option => {
                    const newOption = option.cloneNode(true);
                    newSelect.appendChild(newOption);
                });
            });
        });
    </script>
@endsection
