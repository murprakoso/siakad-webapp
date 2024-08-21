@extends('layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="h5 text-gray-800">Data Kelas</h4>
        <a href="{{ route('daftar-kelas.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus"></i> Tambah Data Kelas
        </a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <table class="table table-bordered table-responsive-md" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="compact">#</th>
                        <th>Nama Kelas</th>
                        <th>Tingkat</th>
                        <th>Wali Kelas</th>
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
            // Inisialisasi DataTable untuk modul Kelas
            const table = $('#dataTable').DataTable({
                responsive: false,
                scrollX: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('daftar-kelas.index') }}", // Sesuaikan dengan route yang tepat
                columns: [{
                        data: 'DT_RowIndex', // Nomor urut
                        name: 'id',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_kelas', // Nama Kelas
                        name: 'nama_kelas'
                    },
                    {
                        data: 'tingkat', // Tingkat Kelas
                        name: 'tingkat'
                    },
                    {
                        data: 'wali_kelas', // Nama Wali Kelas
                        name: 'wali_kelas'
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
