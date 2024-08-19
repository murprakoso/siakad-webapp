@extends('layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="h5 text-gray-800">Data Siswa</h4>
        <a href="{{ route('data-siswa.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus"></i> Tambah Data Siswa
        </a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            Data Siswa
        </div>
    </div>
@endsection
