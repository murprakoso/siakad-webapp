@extends('layout')
@php
    use App\Helpers\Helper;
@endphp
@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="h5 text-gray-800">Detail Data Keuangan Siswa</h4>
        <a href="{{ route('data-keuangan-siswa.index') }}" class="btn btn-secondary btn-sm">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="card-body">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th>Nama Siswa</th>
                        <td>{{ $keuangan->siswa->nama_lengkap ?? 'Tidak Diketahui' }}</td>
                    </tr>
                    <tr>
                        <th>Jumlah Pembayaran</th>
                        {{-- <td>Rp {{ number_format($keuangan->jumlah_pembayaran, 2, ',', '.') }}</td> --}}
                        <td>{{ Helper::formatCurrency($keuangan->jumlah_pembayaran) }}</td>
                    </tr>
                    <tr>
                        <th>Tanggal Pembayaran</th>
                        {{-- <td>{{ $keuangan->tanggal_pembayaran->format('d M Y') }}</td> --}}
                        <td>{{ $keuangan->tanggal_pembayaran }}</td>
                    </tr>
                    <tr>
                        <th>Status Pembayaran</th>
                        <td>
                            @php
                                $statusOptions = \App\Models\Keuangan::getStatusOptions();
                                $statusLabel =
                                    $statusOptions[$keuangan->status_pembayaran] ??
                                    ucfirst($keuangan->status_pembayaran);

                                $badgeColor = '';
                                if ($keuangan->status_pembayaran === 'lunas') {
                                    $badgeColor = 'badge-success';
                                } elseif ($keuangan->status_pembayaran === 'menunggak') {
                                    $badgeColor = 'badge-danger';
                                } elseif ($keuangan->status_pembayaran === 'belum_bayar') {
                                    $badgeColor = 'badge-warning';
                                } else {
                                    $badgeColor = 'badge-secondary';
                                }
                            @endphp
                            <span class="badge {{ $badgeColor }}">{{ $statusLabel }}</span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
