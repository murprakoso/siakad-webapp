@extends('layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="h5 text-gray-800">Data Keuangan Siswa</h4>
        <a href="{{ route('data-keuangan-siswa.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus"></i> Tambah Data Keuangan Siswa
        </a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <table class="table table-bordered table-responsive-md" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="compact">#</th>
                        <th>Nama Siswa</th>
                        <th>Jumlah Pembayaran</th>
                        <th>Tanggal Pembayaran</th>
                        <th>Status Pembayaran</th>
                        <th class="center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
@endsection

@include('vendor.datatable.datatable')
@include('vendor.toastr.toastr')
@push('js')
    <script>
        $(function() {
            // Inisialisasi DataTable untuk modul Data Keuangan Siswa
            const table = $('#dataTable').DataTable({
                responsive: false,
                scrollX: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('data-keuangan-siswa.index') }}", // Sesuaikan dengan route yang tepat
                columns: [{
                        data: 'DT_RowIndex', // Nomor urut
                        name: 'id',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'siswa', // Nama Siswa
                        name: 'siswa'
                    },
                    {
                        data: 'jumlah_pembayaran', // Jumlah Pembayaran
                        name: 'jumlah_pembayaran'
                    },
                    {
                        data: 'tanggal_pembayaran', // Tanggal Pembayaran
                        name: 'tanggal_pembayaran'
                    },
                    {
                        data: 'status_pembayaran', // Status Pembayaran
                        name: 'status_pembayaran'
                    },
                    {
                        data: 'action', // Kolom aksi seperti edit dan delete
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [
                    [0, 'asc']
                ],
                columnDefs: [{
                        targets: "center", // Target kolom Aksi
                        className: 'text-center align-middle',
                        width: "15%", // Lebar kolom aksi
                    },
                    {
                        targets: "compact",
                        className: 'text-center align-middle',
                        width: "5%"
                    },
                    {
                        targets: "nosort",
                        orderable: false,
                    },
                    {
                        targets: ["_all"],
                        className: "align-middle", // Vertikal tengah pada semua kolom
                    },
                ],
            });
        });
    </script>
@endpush
