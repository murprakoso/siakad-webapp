@extends('layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="h5 text-gray-800">Data Mapel</h4>
        <a href="{{ route('data-mapel.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus"></i> Tambah Data Mapel
        </a>
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            {{-- <div class="table-responsive"> --}}
            <table class="table table-bordered table-responsive-md" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="compact">#</th>
                        <th>Kode Mapel</th>
                        <th>Nama Mapel</th>
                        <th>Jurusan</th>
                        <th>Guru</th>
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
            // Inisialisasi DataTable untuk modul Mapel
            const table = $('#dataTable').DataTable({
                responsive: false,
                scrollX: true,
                processing: true,
                serverSide: true,
                ajax: "{{ route('data-mapel.index') }}", // Sesuaikan dengan route yang tepat
                columns: [{
                        data: 'DT_RowIndex', // Nomor urut
                        name: 'id',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'kode_mapel', // Kode Mapel
                        name: 'kode_mapel'
                    },
                    {
                        data: 'nama_mapel', // Nama Mapel
                        name: 'nama_mapel'
                    },
                    {
                        data: 'jurusan', // Jurusan IPA/IPS
                        name: 'jurusan'
                    },
                    {
                        data: 'guru', // Nama Guru yang mengajar mapel
                        name: 'guru'
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
