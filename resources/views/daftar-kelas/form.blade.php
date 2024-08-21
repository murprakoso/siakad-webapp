@extends('layout')
@php
    $isEdit = isset($kelas);
    $formAction = $isEdit ? route('daftar-kelas.update', $kelas->id) : route('daftar-kelas.store');
    $formMethod = $isEdit ? 'PUT' : 'POST';
@endphp

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="h5 text-gray-800">{{ $isEdit ? 'Edit Data Kelas' : 'Tambah Data Kelas' }}</h4>
        <!-- Tombol Kembali dengan Ikon -->
        <a href="{{ route('daftar-kelas.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            @include('partials._flash')

            {{ html()->form($formMethod, $formAction)->class('form')->attribute('autocomplete', 'off')->open() }}
            <div class="row">
                <!-- Kolom Kiri -->
                <div class="col-md-6">
                    <div class="form-group">
                        {{ html()->label('Nama Kelas <span class="text-danger">*</span>', 'nama_kelas')->class('form-label') }}
                        {{ html()->text('nama_kelas', old('nama_kelas', $isEdit ? $kelas->nama_kelas : ''))->class('form-control')->placeholder('Masukkan Nama Kelas')->required() }}
                    </div>

                    <div class="form-group">
                        {{ html()->label('Tingkat <span class="text-danger">*</span>', 'tingkat')->class('form-label') }}
                        {{ html()->select('tingkat', ['X' => 'X', 'XI' => 'XI', 'XII' => 'XII'], old('tingkat', $isEdit ? $kelas->tingkat : ''))->class('form-control')->required() }}
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-6">
                    <div class="form-group">
                        {{ html()->label('Wali Kelas <span class="text-danger">*</span>', 'wali_kelas_id')->class('form-label') }}
                        {{ html()->select('wali_kelas_id', $guruOptions, old('wali_kelas_id', $isEdit ? $kelas->wali_kelas_id : ''))->class('form-control')->required() }}
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
