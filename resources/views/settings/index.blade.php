@extends('layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="h5 text-gray-800">Pengaturan Website dan Sekolah</h4>
        <a href="{{ route('settings.edit') }}" class="btn btn-primary btn-sm">
            <i class="fas fa-edit"></i> Edit
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <h5>Pengaturan Sekolah</h5>
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th>Nama Sekolah</th>
                        <td>{{ $settings->school_name }}</td>
                    </tr>
                    <tr>
                        <th>Alamat Sekolah</th>
                        <td>{{ $settings->school_address }}</td>
                    </tr>
                    <tr>
                        <th>Telepon Sekolah</th>
                        <td>{{ $settings->school_phone }}</td>
                    </tr>
                    <tr>
                        <th>Email Sekolah</th>
                        <td>{{ $settings->school_email }}</td>
                    </tr>
                </tbody>
            </table>

            <h5>Pengaturan Website</h5>
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th>Nama Website</th>
                        <td>{{ $settings->site_name }}</td>
                    </tr>
                    <tr>
                        <th>Deskripsi Website</th>
                        <td>{{ $settings->site_description }}</td>
                    </tr>
                    <tr>
                        <th>Logo Website</th>
                        <td>
                            @if ($settings->site_logo)
                                <img src="{{ $settings->site_logo_url }}" alt="Logo" width="100">
                            @else
                                Tidak ada
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Favicon</th>
                        <td>
                            @if ($settings->site_favicon)
                                <link rel="icon" href="{{ $settings->site_favicon_url }}">
                                <img src="{{ $settings->site_favicon_url }}" alt="Favicon" width="16">
                                {{-- <img src="{{ asset('storage/' . $settings->site_favicon_url) }}" alt="Favicon"
                                    width="16"> --}}
                            @else
                                Tidak ada
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>Email Kontak</th>
                        <td>{{ $settings->contact_email }}</td>
                    </tr>
                    <tr>
                        <th>Telepon Kontak</th>
                        <td>{{ $settings->contact_phone }}</td>
                    </tr>
                    <tr>
                        <th>Alamat Kontak</th>
                        <td>{{ $settings->contact_address }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@include('vendor.toastr.toastr')
