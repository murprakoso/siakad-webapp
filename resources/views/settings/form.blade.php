@extends('layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="h5 text-gray-800">
            {{ isset($settings) ? 'Edit Pengaturan Website dan Sekolah' : 'Tambah Pengaturan Website dan Sekolah' }}</h4>
        <a href="{{ route('settings.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            @include('partials._flash')
            <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <h5>Pengaturan Sekolah</h5>
                <div class="form-group">
                    <label for="school_name">Nama Sekolah <span class="text-danger">*</span></label>
                    <input type="text" name="school_name" id="school_name" class="form-control"
                        value="{{ old('school_name', $settings->school_name ?? '') }}" required>
                </div>

                <div class="form-group">
                    <label for="school_address">Alamat Sekolah</label>
                    <input type="text" name="school_address" id="school_address" class="form-control"
                        value="{{ old('school_address', $settings->school_address ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="school_phone">Telepon Sekolah</label>
                    <input type="text" name="school_phone" id="school_phone" class="form-control"
                        value="{{ old('school_phone', $settings->school_phone ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="school_email">Email Sekolah</label>
                    <input type="email" name="school_email" id="school_email" class="form-control"
                        value="{{ old('school_email', $settings->school_email ?? '') }}">
                </div>

                <h5>Pengaturan Website</h5>
                <div class="form-group">
                    <label for="site_name">Nama Website <span class="text-danger">*</span></label>
                    <input type="text" name="site_name" id="site_name" class="form-control"
                        value="{{ old('site_name', $settings->site_name ?? '') }}" required>
                </div>

                <div class="form-group">
                    <label for="site_description">Deskripsi Website</label>
                    <textarea name="site_description" id="site_description" class="form-control">{{ old('site_description', $settings->site_description ?? '') }}</textarea>
                </div>

                {{-- <div class="form-group">
                    <label for="site_logo">Logo Website</label>
                    <input type="file" name="site_logo" id="site_logo" class="form-control-file">
                    @if (isset($settings->site_logo))
                        <img src="{{ $settings->site_logo_url }}" alt="Logo" width="100">
                    @endif
                </div>

                <div class="form-group">
                    <label for="site_favicon">Favicon</label>
                    <input type="file" name="site_favicon" id="site_favicon" class="form-control-file">
                    @if (isset($settings->site_favicon))
                        <img src="{{ $settings->site_favicon_url }}" alt="Favicon" width="16">
                    @endif
                </div> --}}

                <div class="form-group">
                    <label for="site_logo">Logo Website</label>
                    <input type="file" name="site_logo" id="site_logo" class="form-control-file">
                    <small class="form-text text-muted">Tipe gambar yang diperbolehkan: jpg, png, jpeg, gif. Ukuran
                        maksimal: 2MB.</small>
                    @if (isset($settings->site_logo))
                        <img src="{{ $settings->site_logo_url }}" alt="Logo" width="100">
                    @endif
                </div>

                <div class="form-group">
                    <label for="site_favicon">Favicon</label>
                    <input type="file" name="site_favicon" id="site_favicon" class="form-control-file">
                    <small class="form-text text-muted">Tipe gambar yang diperbolehkan: ico. Ukuran: 16x16 piksel.</small>
                    @if (isset($settings->site_favicon))
                        <img src="{{ $settings->site_favicon_url }}" alt="Favicon" width="16">
                    @endif
                </div>

                <div class="form-group">
                    <label for="contact_email">Email Kontak</label>
                    <input type="email" name="contact_email" id="contact_email" class="form-control"
                        value="{{ old('contact_email', $settings->contact_email ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="contact_phone">Telepon Kontak</label>
                    <input type="text" name="contact_phone" id="contact_phone" class="form-control"
                        value="{{ old('contact_phone', $settings->contact_phone ?? '') }}">
                </div>

                <div class="form-group">
                    <label for="contact_address">Alamat Kontak</label>
                    <textarea name="contact_address" id="contact_address" class="form-control">{{ old('contact_address', $settings->contact_address ?? '') }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Simpan Pengaturan</button>
            </form>
        </div>
    </div>
@endsection

@include('vendor.toastr.toastr')
