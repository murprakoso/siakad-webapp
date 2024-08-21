@extends('layout')
@php
    $isEdit = isset($data_mapel);
    $formAction = $isEdit ? route('data-mapel.update', $data_mapel->id) : route('data-mapel.store');
    $formMethod = $isEdit ? 'PUT' : 'POST';
@endphp
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="h5 text-gray-800">{{ $isEdit ? 'Edit Data Mapel' : 'Tambah Data Mapel' }}</h4>
        <!-- Tombol Kembali dengan Ikon -->
        <a href="{{ route('data-mapel.index') }}" class="btn btn-secondary btn-sm">
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
                        {{ html()->label('Kode Mapel <span class="text-danger">*</span>', 'kode_mapel')->class('form-label') }}
                        {{ html()->text('kode_mapel', old('kode_mapel', $isEdit ? $data_mapel->kode_mapel : ''))->class('form-control')->placeholder('Masukkan Kode Mapel')->required() }}
                    </div>

                    <div class="form-group">
                        {{ html()->label('Nama Mapel <span class="text-danger">*</span>', 'nama_mapel')->class('form-label') }}
                        {{ html()->text('nama_mapel', old('nama_mapel', $isEdit ? $data_mapel->nama_mapel : ''))->class('form-control')->placeholder('Masukkan Nama Mapel')->required() }}
                    </div>

                    <div class="form-group">
                        {{ html()->label('Jurusan <span class="text-danger">*</span>', 'jurusan')->class('form-label') }}
                        {{ html()->select('jurusan', ['IPA' => 'IPA', 'IPS' => 'IPS'], old('jurusan', $isEdit ? $data_mapel->jurusan : ''))->class('form-control')->required() }}
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-6">
                    <div class="form-group">
                        {{ html()->label('Guru Pengajar <span class="text-danger">*</span>', 'id_guru')->class('form-label') }}
                        {{ html()->select('id_guru', $guruOptions, old('id_guru', $isEdit ? $data_mapel->id_guru : ''))->class('form-control')->required() }}
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
