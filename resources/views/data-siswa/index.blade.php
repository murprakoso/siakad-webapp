@extends('layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="h5 text-gray-800">Data Siswa</h4>
        <a href="{{ route('data-siswa.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus"></i> Tambah Data Siswa
        </a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            {{-- <div class="table-responsive"> --}}
            <table class="table table-bordered table-responsive-md" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="compact">#</th>
                        <th>Nama Lengkap</th>
                        <th>NISN</th>
                        <th>Jurusan</th>
                        <th>Status</th>
                        <th class="center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
            {{-- </div> --}}
        </div>
    </div>
@endsection

@include('vendor.datatable.datatable')
@include('vendor.toastr.toastr')
@push('js')
    <script>
        $(function() {
            // $('#dataTable').DataTable();
            const table = $('#dataTable').DataTable({
                responsive: false,
                scrollX: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('data-siswa.index') }}", // Ubah sesuai dengan route yang tepat
                columns: [{
                        data: 'DT_RowIndex', // Biasanya untuk nomor urut atau ID
                        name: 'id',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_lengkap', // Nama Lengkap Siswa
                        name: 'nama_lengkap'
                    },
                    {
                        data: 'nisn', // NISN Siswa
                        name: 'nisn'
                    },
                    {
                        data: 'jurusan', // Jurusan Siswa
                        name: 'jurusan'
                    },
                    {
                        data: 'status', // Status Siswa (Aktif/Non-Aktif)
                        name: 'status'
                    },
                    {
                        data: 'action', // Kolom untuk aksi seperti edit, delete
                        name: 'action',
                        orderable: false,
                        searchable: false
                    }
                ],
                order: [
                    [0, 'asc']
                ],
                columnDefs: [{
                        targets: "center", // Target kolom "Aksi"
                        className: 'text-center align-middle', // Atur teks di tengah untuk header kolom "Aksi"
                        width: "15%", // Atur lebar kolom "Aksi"
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
                        className: "align-middle", // Pastikan konten di tengah secara vertikal
                    },
                ],
            });

        });
    </script>
@endpush
