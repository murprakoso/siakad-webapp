@extends('layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="h5 text-gray-800">Detail Data Kelas</h4>
        <a href="{{ route('daftar-kelas.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th>Nama Kelas</th>
                        <td>{{ $kelas->nama_kelas }}</td>
                    </tr>
                    <tr>
                        <th>Tingkat</th>
                        <td>{{ $kelas->tingkat }}</td>
                    </tr>
                    <tr>
                        <th>Wali Kelas</th>
                        <td>{{ $kelas->waliKelas->nama_lengkap ?? 'Tidak Diketahui' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
