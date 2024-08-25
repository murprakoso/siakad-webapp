{{-- @extends('layout')

@section('content')
    <h4 class="h4 mb-2 text-gray-800">Beranda</h4>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Beranda</h6>
        </div>
        <div class="card-body">
            Beranda
        </div>
    </div>
@endsection --}}


@extends('layout')

@section('content')
    <h4 class="h4 mb-2 text-gray-800">Beranda</h4>
    <div class="card shadow mb-4">
        <div class="card-body">

            @auth('operator')
                <div class="row">
                    <div class="col-md-4">
                        @if ($user->foto)
                            <img src="{{ asset('storage/' . $user->foto) }}" alt="{{ $user->nama_lengkap }}" class="img-thumbnail"
                                width="250">
                        @else
                            <img src="{{ asset('dist/img/undraw_profile.svg') }}" alt="Default Image" class="img-thumbnail">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <h5 class="mb-3">Selamat datang, {{ $user->nama_lengkap }}!</h5>
                        <p><strong>Username:</strong> {{ $user->username }}</p>
                        <p><strong>Email:</strong> {{ $user->email ?? 'Belum diatur' }}</p>
                        <p><strong>No HP:</strong> {{ $user->no_hp ?? 'Belum diatur' }}</p>
                        <p><strong>Status:</strong> {{ ucfirst($user->status) }}</p>
                        <p><strong>Role:</strong> {{ ucfirst($user->role) }}</p>
                    </div>
                </div>
            @endauth

            @auth('guru')
                <div class="row">
                    <div class="col-md-4">
                        @if ($user->foto)
                            <img src="{{ asset('storage/' . $user->foto) }}" alt="{{ $user->nama_lengkap }}"
                                class="img-thumbnail">
                        @else
                            <img src="{{ asset('dist/img/undraw_profile.svg') }}" alt="Default Image" class="img-thumbnail">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <h5 class="mb-3">Selamat datang, {{ $user->nama_lengkap }}!</h5>

                        <!-- Informasi Umum -->
                        <p><strong>Username:</strong> {{ $user->username }}</p>
                        <p><strong>Email:</strong> {{ $user->email ?? 'Belum diatur' }}</p>
                        <p><strong>No HP:</strong> {{ $user->no_hp ?? 'Belum diatur' }}</p>

                        @if (Auth::guard('guru')->check())
                            <!-- Informasi Khusus Guru -->
                            <p><strong>NIP:</strong> {{ $user->nip ?? 'Belum diatur' }}</p>
                            <p><strong>Jabatan Akademik:</strong> {{ $user->jabatan_akademik }}</p>
                            <p><strong>Jenis Kelamin:</strong> {{ $user->jenis_kelamin }}</p>
                            <p><strong>Tempat, Tanggal Lahir:</strong> {{ $user->tempat_lahir }},
                                {{ \Carbon\Carbon::parse($user->tanggal_lahir)->format('d M Y') }}</p>
                            <p><strong>Alamat:</strong> {{ $user->alamat ?? 'Belum diatur' }}</p>
                        @endif

                        <p><strong>Status:</strong> {{ ucfirst($user->status) }}</p>
                    </div>
                </div>
            @endauth

            @auth('siswa')
                <div class="row">
                    <div class="col-md-4">
                        @if ($user->foto)
                            <img src="{{ asset('storage/' . $user->foto) }}" alt="{{ $user->nama_lengkap }}"
                                class="img-thumbnail">
                        @else
                            <img src="{{ asset('dist/img/undraw_profile.svg') }}" alt="Default Image" class="img-thumbnail">
                        @endif
                    </div>
                    <div class="col-md-8">
                        <h5 class="mb-3">Selamat datang, {{ $user->nama_lengkap }}!</h5>

                        <!-- Informasi Umum -->
                        <p><strong>NISN:</strong> {{ $user->nisn }}</p>
                        <p><strong>Email:</strong> {{ $user->email ?? 'Belum diatur' }}</p>
                        <p><strong>No HP:</strong> {{ $user->no_hp ?? 'Belum diatur' }}</p>
                        <p><strong>Asal Sekolah:</strong> {{ $user->asal_sekolah }}</p>

                        <!-- Informasi Khusus Siswa -->
                        @if (Auth::guard('siswa')->check())
                            <p><strong>Tanggal Masuk:</strong>
                                {{ $user->tanggal_masuk ? \Carbon\Carbon::parse($user->tanggal_masuk)->format('d M Y') : 'Belum diatur' }}
                            </p>
                            <p><strong>Jenis Kelamin:</strong> {{ ucfirst($user->jenis_kelamin) }}</p>
                            <p><strong>Tempat, Tanggal Lahir:</strong> {{ $user->tempat_lahir }},
                                {{ \Carbon\Carbon::parse($user->tanggal_lahir)->format('d M Y') }}</p>
                            <p><strong>Alamat:</strong> {{ $user->alamat ?? 'Belum diatur' }}</p>
                            <p><strong>Jurusan:</strong> {{ $user->jurusan ?? 'Belum diatur' }}</p>
                        @endif

                        <p><strong>Status:</strong> {{ ucfirst($user->status) }}</p>
                    </div>
                </div>
            @endauth
        </div>
    </div>
@endsection
