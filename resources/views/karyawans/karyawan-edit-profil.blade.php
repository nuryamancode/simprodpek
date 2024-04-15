@extends('karyawans.layouts.karyawan-base', ['title' => 'Edit Profil Karyawan'])



@section('content-karyawan')
    <div class="container-fluid">
        @if ($karyawan === null || $karyawan->alamat === null)
            <div class="alert alert-danger mb-3 mt-3">
                Harap melengkapi profil anda
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col">
                        <h2 clas s="title-name mb-3">Edit Profil</h2>
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
                    </div>
                </div>
                <form action="{{ route('karyawan.update.profil') }}" method="POST" enctype="multipart/form-data">
                    @if (isset($karyawan))
                        @method('PUT')
                    @endif
                    @csrf
                    <div class="row">
                        <div class="col-3">
                            <div class="img-profil">
                                @if ($karyawan === null || $karyawan->foto_profil === null)
                                    <img id="previewImage"
                                        src="https://assets-a1.kompasiana.com/items/album/2021/03/24/blank-profile-picture-973460-1280-605aadc08ede4874e1153a12.png?t=o&v=780"
                                        alt="User Profile" width="200px" height="200px">
                                @else
                                    <img id="previewImage" src="{{ asset('assets/dokumen/foto_profil/' . $karyawan->foto_profil) }}"
                                        alt="User Profile" width="200px" height="200px">
                                @endif
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Alamat Lengkap</label>
                                <input type="text" class="form-control" id="exampleInputEmail1" name="alamat"
                                    aria-describedby="emailHelp" value="{{ $karyawan->alamat ?? '' }}">
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">No Handphone</label>
                                <input type="text" class="form-control" name="no_handphone" id="exampleInputPassword1"
                                    value="{{ $karyawan->no_handphone ?? '' }}">
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Nama Lengkap</label>
                                <input type="name" class="form-control" id="exampleInputEmail1" name="nama_lengkap"
                                    aria-describedby="emailHelp" value="{{ $karyawan->nama_lengkap ?? '' }}">
                            </div>
                        </div>
                        <div class="d-flex justify-content-between">
                            <div class="d-flex justify-content-start mt-3 mb-4">
                                <div class="btn btn-primary btn-rounded">
                                    <label class="form-label text-white m-1" for="customFile1">Choose file</label>
                                    <input type="file" class="form-control d-none" id="customFile1" name="foto_profil"
                                        onchange="previewFile()">

                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary">Ubah</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewFile() {
            var input = document.getElementById('customFile1');
            var preview = document.getElementById('previewImage');

            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            };

            reader.readAsDataURL(input.files[0]);
        }
    </script>
@endsection
