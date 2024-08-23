@extends('layout')
@php
    $isEdit = isset($keuangan); // Periksa apakah form ini untuk edit atau tambah data baru
    $formAction = $isEdit ? route('data-keuangan-siswa.update', $keuangan->id) : route('data-keuangan-siswa.store');
    $formMethod = $isEdit ? 'PUT' : 'POST';
@endphp

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="h5 text-gray-800">{{ $isEdit ? 'Edit Data Keuangan Siswa' : 'Tambah Data Keuangan Siswa' }}</h4>
        <!-- Tombol Kembali dengan Ikon -->
        <a href="{{ route('data-keuangan-siswa.index') }}" class="btn btn-secondary btn-sm">
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
                        {{ html()->label('Nama Siswa <span class="text-danger">*</span>', 'id_siswa')->class('form-label') }}
                        {{ html()->select('id_siswa', $siswaOptions, old('id_siswa', $isEdit ? $keuangan->id_siswa : ''))->class('form-control')->required() }}
                    </div>

                    <div class="form-group">
                        {{ html()->label('Jumlah Pembayaran <span class="text-danger">*</span>', 'jumlah_pembayaran')->class('form-label') }}
                        {{ html()->number('jumlah_pembayaran', old('jumlah_pembayaran', $isEdit ? $keuangan->jumlah_pembayaran : ''), 0, null, '0.01')->class('form-control')->placeholder('Masukkan Jumlah Pembayaran')->required() }}
                    </div>
                </div>

                <!-- Kolom Kanan -->
                <div class="col-md-6">
                    <div class="form-group">
                        {{ html()->label('Tanggal Pembayaran <span class="text-danger">*</span>', 'tanggal_pembayaran')->class('form-label') }}
                        {{ html()->date('tanggal_pembayaran', old('tanggal_pembayaran', $isEdit ? $keuangan->tanggal_pembayaran : now()->format('Y-m-d')))->class('form-control')->required() }}
                    </div>

                    <div class="form-group">
                        {{ html()->label('Status Pembayaran <span class="text-danger">*</span>', 'status_pembayaran')->class('form-label') }}
                        {{ html()->select('status_pembayaran', $statusOptions, old('status_pembayaran', $isEdit ? $keuangan->status_pembayaran : ''))->class('form-control')->required() }}
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
