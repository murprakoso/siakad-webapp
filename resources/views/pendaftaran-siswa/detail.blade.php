@extends('layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="h5 text-gray-800">Detail Data Siswa</h4>
        <a href="{{ route('pendaftaran-siswa.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th>Nama Lengkap</th>
                        <td>{{ $siswa->siswa->nama_lengkap }}</td>
                    </tr>
                    <tr>
                        <th>NISN</th>
                        <td>{{ $siswa->siswa->nisn }}</td>
                    </tr>
                    <tr>
                        <th>Jenis Kelamin</th>
                        <td>{{ $siswa->siswa->jenis_kelamin }}</td>
                    </tr>
                    <tr>
                        <th>Agama</th>
                        <td>{{ $siswa->siswa->agama->agama ?? 'Tidak Diketahui' }}</td>
                    </tr>
                    <tr>
                        <th>Tempat Lahir</th>
                        <td>{{ $siswa->siswa->tempat_lahir }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Lahir</th>
                        <td>{{ $siswa->siswa->tanggal_lahir }}</td>
                    </tr>
                    <tr>
                        <th>Alamat</th>
                        <td>{{ $siswa->siswa->alamat }}</td>
                    </tr>
                    <tr>
                        <th>No. HP</th>
                        <td>{{ $siswa->siswa->no_hp }}</td>
                    </tr>
                    <tr>
                        <th>Email</th>
                        <td>{{ $siswa->siswa->email }}</td>
                    </tr>
                    <tr>
                        <th>Asal Sekolah</th>
                        <td>{{ $siswa->siswa->asal_sekolah }}</td>
                    </tr>
                    <tr>
                        <th>Jurusan</th>
                        <td>{{ $siswa->siswa->jurusan }}</td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td>{{ $siswa->siswa->status }}</td>
                    </tr>
                    <tr>
                        <th>Foto</th>
                        <td>
                            @if ($siswa->siswa->foto)
                                <img src="{{ asset('storage/' . $siswa->siswa->foto) }}" alt="Foto Siswa"
                                    class="img-thumbnail" style="max-width: 150px;">
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
