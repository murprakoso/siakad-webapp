@extends('layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="h5 text-gray-800">Data Pendaftaran Siswa Baru</h4>
        <a href="{{ route('pendaftaran-siswa.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus"></i> Tambah Data Pendaftaran
        </a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <table class="table table-bordered table-responsive-md" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="compact">#</th>
                        <th class="center">Foto</th>
                        <th>Nama Lengkap</th>
                        <th>NISN</th>
                        {{-- <th>Jurusan</th> --}}
                        <th class="center">Status Pendaftaran</th>
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
            const table = $('#dataTable').DataTable({
                responsive: false,
                scrollX: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('pendaftaran-siswa.index') }}", // Ubah ke route yang sesuai
                columns: [
                    { data: 'DT_RowIndex', name: 'id', orderable: false, searchable: false },
                    { data: 'foto', name: 'foto' },
                    { data: 'siswa.nama_lengkap', name: 'siswa.nama_lengkap' },
                    { data: 'siswa.nisn', name: 'siswa.nisn' },
                    // { data: 'siswa.jurusan', name: 'siswa.jurusan' },
                    { data: 'status', name: 'status' },
                    { data: 'action', name: 'action', orderable: false, searchable: false }
                ],
                order: [[0, 'asc']],
                columnDefs: [
                    { targets: "center", className: 'text-center align-middle', width: "15%" },
                    { targets: "compact", className: 'text-center align-middle', width: "5%" },
                    { targets: "nosort", orderable: false },
                    { targets: ["_all"], className: "align-middle" },
                ],
            });
        });
    </script>
@endpush
