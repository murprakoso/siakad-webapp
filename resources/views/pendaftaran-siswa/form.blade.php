@extends('layout')

@php
    $isEdit = isset($data_siswa);
    $formAction = $isEdit ? route('pendaftaran-siswa.update', $data_siswa->id) : route('pendaftaran-siswa.store');
    $formMethod = $isEdit ? 'PUT' : 'POST';
@endphp

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="h5 text-gray-800">{{ $isEdit ? 'Edit Pendaftaran Siswa' : 'Tambah Pendaftaran Siswa' }}</h4>
        <a href="{{ route('pendaftaran-siswa.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            @include('partials._flash')

            {{-- Form --}}
            {{ html()->form($formMethod, $formAction)->class('form')->attribute('enctype', 'multipart/form-data')->attribute('autocomplete', 'off')->open() }}

            <div class="row">
                <!-- Kolom Kiri -->
                <div class="col-md-6">
                    <div class="form-group">
                        {{ html()->label('Nama Lengkap <span class="text-danger">*</span>', 'nama_lengkap')->class('form-label') }}
                        {{ html()->text('nama_lengkap', old('nama_lengkap', $data_siswa->siswa->nama_lengkap ?? ''))->class('form-control')->placeholder('Masukkan Nama Lengkap')->required() }}
                    </div>

                    <div class="form-group">
                        {{ html()->label('NISN <span class="text-danger">*</span>', 'nisn')->class('form-label') }}
                        {{ html()->text('nisn', old('nisn', $data_siswa->siswa->nisn ?? ''))->class('form-control')->placeholder('Masukkan NISN')->required() }}
                    </div>

                    <div class="form-group">
                        {{ html()->label('Password <span class="text-danger">*</span>', 'password')->class('form-label') }}
                        {{ html()->password('password')->class('form-control')->placeholder($isEdit ? 'Kosongkan jika tidak ingin mengubah password' : 'Masukkan Password')->required(!$isEdit) }}
                    </div>

                    <div class="form-group">
                        {{ html()->label('Jenis Kelamin <span class="text-danger">*</span>', 'jenis_kelamin')->class('form-label') }}
                        {{ html()->select('jenis_kelamin', ['laki-laki' => 'Laki-laki', 'perempuan' => 'Perempuan'], old('jenis_kelamin', $data_siswa->siswa->jenis_kelamin ?? ''))->class('form-control')->required() }}
                    </div>

                    <div class="form-group">
                        {{ html()->label('Agama <span class="text-danger">*</span>', 'id_agama')->class('form-label') }}
                        {{ html()->select('id_agama', $agamaOptions, old('id_agama', $data_siswa->siswa->id_agama ?? ''))->class('form-control')->required() }}
                    </div>

                    <div class="form-group">
                        {{ html()->label('No. HP', 'no_hp')->class('form-label') }}
                        {{ html()->text('no_hp', old('no_hp', $data_siswa->siswa->no_hp ?? ''))->class('form-control')->placeholder('Masukkan No. HP')->maxlength(20) }}
                    </div>

                    <div class="form-group">
                        {{ html()->label('Email', 'email')->class('form-label') }}
                        {{ html()->email('email', old('email', $data_siswa->siswa->email ?? ''))->class('form-control')->placeholder('Masukkan Email') }}
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-6">
                    <div class="form-group">
                        {{ html()->label('Tempat Lahir', 'tempat_lahir')->class('form-label') }}
                        {{ html()->text('tempat_lahir', old('tempat_lahir', $data_siswa->siswa->tempat_lahir ?? ''))->class('form-control')->placeholder('Masukkan Tempat Lahir') }}
                    </div>

                    <div class="form-group">
                        {{ html()->label('Tanggal Lahir <span class="text-danger">*</span>', 'tanggal_lahir')->class('form-label') }}
                        {{ html()->date('tanggal_lahir', old('tanggal_lahir', $data_siswa->siswa->tanggal_lahir ?? ''))->class('form-control')->required() }}
                    </div>

                    <div class="form-group">
                        {{ html()->label('Alamat', 'alamat')->class('form-label') }}
                        {{ html()->textarea('alamat', old('alamat', $data_siswa->siswa->alamat ?? ''))->class('form-control')->placeholder('Masukkan Alamat') }}
                    </div>

                    <div class="form-group">
                        {{ html()->label('Asal Sekolah <span class="text-danger">*</span>', 'asal_sekolah')->class('form-label') }}
                        {{ html()->text('asal_sekolah', old('asal_sekolah', $data_siswa->siswa->asal_sekolah ?? ''))->class('form-control')->placeholder('Masukkan Asal Sekolah')->required() }}
                    </div>

                    {{-- <div class="form-group">
                        {{ html()->label('Jurusan', 'jurusan')->class('form-label') }}
                        {{ html()->select('jurusan', ['' => '--Pilih Jurusan--', 'IPA' => 'IPA', 'IPS' => 'IPS'], old('jurusan', $isEdit ? $data_siswa->siswa->jurusan : ''))->class('form-control') }}
                    </div> --}}

                    <div class="form-group">
                        {{ html()->label('Status <span class="text-danger">*</span>', 'status')->class('form-label') }}
                        {{ html()->select('status', ['aktif' => 'Aktif', 'non-aktif' => 'Non-Aktif'], old('status', $data_siswa->status ?? ''))->class('form-control')->required() }}
                    </div>

                    <div class="form-group">
                        {{ html()->label('Foto', 'foto')->class('form-label') }}
                        {{ html()->file('foto')->class('form-control-file') }}
                        <small class="form-text text-muted">
                            Format yang diizinkan: jpeg, png, jpg. Maksimal ukuran: 2MB.
                        </small>
                        @if ($isEdit && $data_siswa->siswa->foto)
                            @php
                                $fotoUrl = Storage::disk('public')->url($data_siswa->siswa->foto);
                            @endphp
                            <div class="mt-2">
                                <img src="{{ $fotoUrl }}" alt="Foto Siswa" class="img-thumbnail"
                                    style="max-width: 100px; max-height: 100px;">
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="form-group">
                <!-- Tombol Simpan/Update -->
                {{ html()->button('<i class="fas fa-save"></i> ' . ($isEdit ? 'Update' : 'Simpan'))->class('btn btn-primary btn-sm')->type('submit') }}
            </div>

            {{ html()->form()->close() }}
        </div>
    </div>
@endsection
