@extends('layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="h5 text-gray-800">Profile</h4>
        {{-- <a href="{{ route('profile.edit') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a> --}}
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            @include('partials._flash')
            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <h5>Informasi Pengguna</h5>

                <div class="form-group">
                    <label for="username">Username <span class="text-danger">*</span></label>
                    <input type="text" name="username" id="username" class="form-control"
                        value="{{ old('username', auth()->user()->username) }}" required>
                </div>

                <div class="form-group">
                    <label for="nama_lengkap">Nama Lengkap <span class="text-danger">*</span></label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control"
                        value="{{ old('nama_lengkap', auth()->user()->nama_lengkap) }}" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control"
                        value="{{ old('email', auth()->user()->email) }}">
                </div>

                <div class="form-group">
                    <label for="no_hp">No. HP</label>
                    <input type="text" name="no_hp" id="no_hp" class="form-control"
                        value="{{ old('no_hp', auth()->user()->no_hp) }}">
                </div>

                <div class="form-group">
                    <label for="foto">Foto Profil</label>
                    <input type="file" name="foto" id="foto" class="form-control-file">
                    <small class="form-text text-muted">Tipe gambar yang diperbolehkan: jpg, png, jpeg, gif. Ukuran
                        maksimal: 2MB.</small>
                    @if (auth()->user()->foto)
                        <img src="{{ asset('storage/' . auth()->user()->foto) }}" alt="Foto Profil" width="100">
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
            </form>
        </div>
    </div>
@endsection

@include('vendor.toastr.toastr')
