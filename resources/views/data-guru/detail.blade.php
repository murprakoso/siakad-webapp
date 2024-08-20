@extends('layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="h5 text-gray-800">Detail Data Guru</h4>
        <a href="{{ route('data-guru.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th>Nama Lengkap</th>
                        <td>{{ $guru->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <th>NIP</th>
                        <td>{{ $guru->nip }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>{{ $guru->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <th>Agama</th>
                        <td>{{ $guru->agama->name ?? 'Tidak Diketahui' }}</td>
                    </tr>
                    <tr>
                        <th>Tempat Lahir</th>
                        <td>{{ $guru->tempat_lahir }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahir</th>
                        <td>{{ \Carbon\Carbon::parse($guru->tanggal_lahir)->format('d-m-Y') }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $guru->alamat }}</td>
                    </tr>
                    <tr>
                        <th>No. HP</th>
                        <td>{{ $guru->no_hp }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $guru->email }}</td>
                    </tr>
                    <tr>
                        <th>Jabatan</th>
                        <td>{{ $guru->jabatan }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ $guru->status }}</td>
                    </tr>
                    <tr>
                        <th>Foto</th>
                        <td>
                            @if ($guru->foto)
                                <img src="{{ asset('storage/' . $guru->foto) }}" alt="Foto Guru" class="img-thumbnail"
                                    style="max-width: 150px;">
                            @else
                                Tidak ada foto
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
