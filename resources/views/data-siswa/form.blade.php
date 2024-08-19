@extends('layout')
@php
    $isEdit = isset($data_siswa);
    $formAction = $isEdit ? route('data-siswa.update', $data_siswa->id) : route('data-siswa.store');
    $formMethod = $isEdit ? 'PUT' : 'POST';
@endphp
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="h5 text-gray-800">{{ $isEdit ? 'Edit Data Siswa' : 'Tambah Data Siswa' }}</h4>
        <!-- Tombol Kembali dengan Ikon -->
        <a href="{{ route('data-siswa.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            @include('partials._flash')

            {{-- {{ html()->form($formMethod, $formAction)->class('form')->open() }} --}}
            {{ html()->form($formMethod, $formAction)->class('form')->attribute('enctype', 'multipart/form-data')->attribute('autocomplete', 'off')->open() }}
            <div class="row">
                <!-- Kolom Kiri -->
                <div class="col-md-6">
                    <div class="form-group">
                        {{ html()->label('Nama Lengkap <span class="text-danger">*</span>', 'nama_lengkap')->class('form-label') }}
                        {{ html()->text('nama_lengkap', old('nama_lengkap', $isEdit ? $data_siswa->nama_lengkap : ''))->class('form-control')->placeholder('Masukkan Nama Lengkap')->required() }}
                    </div>

                    <div class="form-group">
                        {{ html()->label('NISN <span class="text-danger">*</span>', 'nisn')->class('form-label') }}
                        {{ html()->text('nisn', old('nisn', $isEdit ? $data_siswa->nisn : ''))->class('form-control')->placeholder('Masukkan NISN')->required() }}
                    </div>

                    <div class="form-group">
                        {{ html()->label('Password <span class="text-danger">*</span>', 'password')->class('form-label') }}
                        {{ html()->password('password')->class('form-control')->placeholder($isEdit ? 'Kosongkan jika tidak ingin mengubah password' : 'Masukkan Password')->required(!$isEdit) }}
                    </div>

                    <div class="form-group">
                        {{ html()->label('Tanggal Masuk', 'tanggal_masuk')->class('form-label') }}
                        {{ html()->date('tanggal_masuk', old('tanggal_masuk', $isEdit ? $data_siswa->tanggal_masuk : ''))->class('form-control')->placeholder('Tanggal Masuk') }}
                    </div>

                    <div class="form-group">
                        {{ html()->label('Jenis Kelamin <span class="text-danger">*</span>', 'jenis_kelamin')->class('form-label') }}
                        {{ html()->select('jenis_kelamin', ['laki-laki' => 'Laki-laki', 'perempuan' => 'Perempuan'], old('jenis_kelamin', $isEdit ? $data_siswa->jenis_kelamin : ''))->class('form-control')->required() }}
                    </div>

                    <div class="form-group">
                        {{ html()->label('Agama <span class="text-danger">*</span>', 'id_agama')->class('form-label') }}
                        {{ html()->select('id_agama', $agamaOptions, old('id_agama', $isEdit ? $data_siswa->id_agama : ''))->class('form-control')->required() }}
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-6">
                    <div class="form-group">
                        {{ html()->label('Tempat Lahir', 'tempat_lahir')->class('form-label') }}
                        {{ html()->text('tempat_lahir', old('tempat_lahir', $isEdit ? $data_siswa->tempat_lahir : ''))->class('form-control')->placeholder('Masukkan Tempat Lahir') }}
                    </div>

                    <div class="form-group">
                        {{ html()->label('Tanggal Lahir <span class="text-danger">*</span>', 'tanggal_lahir')->class('form-label') }}
                        {{ html()->date('tanggal_lahir', old('tanggal_lahir', $isEdit ? $data_siswa->tanggal_lahir : ''))->class('form-control')->required() }}
                    </div>

                    <div class="form-group">
                        {{ html()->label('Alamat', 'alamat')->class('form-label') }}
                        {{ html()->textarea('alamat', old('alamat', $isEdit ? $data_siswa->alamat : ''))->class('form-control')->placeholder('Masukkan Alamat') }}
                    </div>

                    <div class="form-group">
                        {{ html()->label('No. HP', 'no_hp')->class('form-label') }}
                        {{ html()->text('no_hp', old('no_hp', $isEdit ? $data_siswa->no_hp : ''))->class('form-control')->placeholder('Masukkan No. HP')->maxlength(20) }}
                    </div>

                    <div class="form-group">
                        {{ html()->label('Email', 'email')->class('form-label') }}
                        {{ html()->email('email', old('email', $isEdit ? $data_siswa->email : ''))->class('form-control')->placeholder('Masukkan Email') }}
                    </div>

                    <div class="form-group">
                        {{ html()->label('Asal Sekolah <span class="text-danger">*</span>', 'asal_sekolah')->class('form-label') }}
                        {{ html()->text('asal_sekolah', old('asal_sekolah', $isEdit ? $data_siswa->asal_sekolah : ''))->class('form-control')->placeholder('Masukkan Asal Sekolah')->required() }}
                    </div>

                    <div class="form-group">
                        {{ html()->label('Jurusan', 'jurusan')->class('form-label') }}
                        {{ html()->select('jurusan', ['IPA' => 'IPA', 'IPS' => 'IPS'], old('jurusan', $isEdit ? $data_siswa->jurusan : ''))->class('form-control') }}
                    </div>

                    <div class="form-group">
                        {{ html()->label('Status <span class="text-danger">*</span>', 'status')->class('form-label') }}
                        {{ html()->select('status', ['aktif' => 'Aktif', 'non-aktif' => 'Non-Aktif'], old('status', $isEdit ? $data_siswa->status : ''))->class('form-control')->required() }}
                    </div>

                    <div class="form-group">
                        {{ html()->label('Foto', 'foto')->class('form-label') }}
                        {{ html()->file('foto')->class('form-control-file') }}
                        <small class="form-text text-muted">
                            Format yang diizinkan: jpeg, png, jpg. Maksimal ukuran: 2MB.
                        </small>
                    </div>

                </div>
            </div>

            <div class="form-group">
                <!-- Tombol Simpan/Update dengan Ikon -->
                {{ html()->button('<i class="fas fa-save"></i> ' . ($isEdit ? 'Update' : 'Simpan'))->class('btn btn-primary btn-sm')->type('submit') }}
            </div>

            {{ html()->form()->close() }}
        </div>
    </div>
@endsection
