@extends('layout')
@php
    $isEdit = isset($data_guru);
    $formAction = $isEdit ? route('data-guru.update', $data_guru->id) : route('data-guru.store');
    $formMethod = $isEdit ? 'PUT' : 'POST';
@endphp
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="h5 text-gray-800">{{ $isEdit ? 'Edit Data Guru' : 'Tambah Data Guru' }}</h4>
        <!-- Tombol Kembali dengan Ikon -->
        <a href="{{ route('data-guru.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            @include('partials._flash')

            {{-- Form untuk Data Guru --}}
            {{ html()->form($formMethod, $formAction)->class('form')->attribute('enctype', 'multipart/form-data')->attribute('autocomplete', 'off')->open() }}
            <div class="row">
                <!-- Kolom Kiri -->
                <div class="col-md-6">
                    <div class="form-group">
                        {{ html()->label('Nama Lengkap <span class="text-danger">*</span>', 'nama_lengkap')->class('form-label') }}
                        {{ html()->text('nama_lengkap', old('nama_lengkap', $isEdit ? $data_guru->nama_lengkap : ''))->class('form-control')->placeholder('Masukkan Nama Lengkap')->required() }}
                    </div>

                    <div class="form-group">
                        {{ html()->label('Username <span class="text-danger">*</span>', 'username')->class('form-label') }}
                        {{ html()->text('username', old('username', $isEdit ? $data_guru->username : ''))->class('form-control')->placeholder('Masukkan Username')->required() }}
                    </div>

                    <div class="form-group">
                        {{ html()->label('Password <span class="text-danger">*</span>', 'password')->class('form-label') }}
                        {{ html()->password('password')->class('form-control')->placeholder($isEdit ? 'Kosongkan jika tidak ingin mengubah password' : 'Masukkan Password')->required(!$isEdit) }}
                    </div>

                    <div class="form-group">
                        {{ html()->label('Jabatan Akademik <span class="text-danger">*</span>', 'jabatan_akademik')->class('form-label') }}
                        {{ html()->text('jabatan_akademik', old('jabatan_akademik', $isEdit ? $data_guru->jabatan_akademik : ''))->class('form-control')->placeholder('Masukkan Jabatan Akademik')->required() }}
                    </div>

                    <div class="form-group">
                        {{ html()->label('Jenis Kelamin <span class="text-danger">*</span>', 'jenis_kelamin')->class('form-label') }}
                        {{ html()->select('jenis_kelamin', ['Laki-laki' => 'Laki-laki', 'Perempuan' => 'Perempuan'], old('jenis_kelamin', $isEdit ? $data_guru->jenis_kelamin : ''))->class('form-control')->required() }}
                    </div>

                    <div class="form-group">
                        {{ html()->label('Agama <span class="text-danger">*</span>', 'id_agama')->class('form-label') }}
                        {{ html()->select('id_agama', $agamaOptions, old('id_agama', $isEdit ? $data_guru->id_agama : ''))->class('form-control')->required() }}
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-6">
                    <div class="form-group">
                        {{ html()->label('Tempat Lahir <span class="text-danger">*</span>', 'tempat_lahir')->class('form-label') }}
                        {{ html()->text('tempat_lahir', old('tempat_lahir', $isEdit ? $data_guru->tempat_lahir : ''))->class('form-control')->placeholder('Masukkan Tempat Lahir')->required() }}
                    </div>

                    <div class="form-group">
                        {{ html()->label('Tanggal Lahir <span class="text-danger">*</span>', 'tanggal_lahir')->class('form-label') }}
                        {{ html()->date('tanggal_lahir', old('tanggal_lahir', $isEdit ? $data_guru->tanggal_lahir : ''))->class('form-control')->required() }}
                    </div>

                    <div class="form-group">
                        {{ html()->label('NIP', 'nip')->class('form-label') }}
                        {{ html()->text('nip', old('nip', $isEdit ? $data_guru->nip : ''))->class('form-control')->placeholder('Masukkan NIP (opsional)') }}
                    </div>

                    <div class="form-group">
                        {{ html()->label('Alamat', 'alamat')->class('form-label') }}
                        {{ html()->textarea('alamat', old('alamat', $isEdit ? $data_guru->alamat : ''))->class('form-control')->placeholder('Masukkan Alamat') }}
                    </div>

                    <div class="form-group">
                        {{ html()->label('No. HP', 'no_hp')->class('form-label') }}
                        {{ html()->text('no_hp', old('no_hp', $isEdit ? $data_guru->no_hp : ''))->class('form-control')->placeholder('Masukkan No. HP')->maxlength(20) }}
                    </div>

                    <div class="form-group">
                        {{ html()->label('Email', 'email')->class('form-label') }}
                        {{ html()->email('email', old('email', $isEdit ? $data_guru->email : ''))->class('form-control')->placeholder('Masukkan Email') }}
                    </div>

                    <div class="form-group">
                        {{ html()->label('Status <span class="text-danger">*</span>', 'status')->class('form-label') }}
                        {{ html()->select('status', ['Aktif' => 'Aktif', 'Non-aktif' => 'Non-aktif'], old('status', $isEdit ? $data_guru->status : ''))->class('form-control')->required() }}
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
