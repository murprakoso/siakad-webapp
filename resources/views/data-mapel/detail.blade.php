@extends('layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="h5 text-gray-800">Detail Data Mata Pelajaran</h4>
        <a href="{{ route('data-mapel.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th>Kode Mapel</th>
                        <td>{{ $mapel->kode_mapel }}</td>
                    </tr>
                    <tr>
                        <th>Nama Mapel</th>
                        <td>{{ $mapel->nama_mapel }}</td>
                    </tr>
                    <tr>
                        <th>Jurusan</th>
                        <td>{{ $mapel->jurusan }}</td>
                    </tr>
                    <tr>
                        <th>Guru Pengajar</th>
                        <td>{{ $mapel->guru->nama_lengkap ?? 'Tidak Diketahui' }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
