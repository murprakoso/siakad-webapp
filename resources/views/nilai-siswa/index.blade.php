@extends('layout')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4 class="h5 text-gray-800">Data Nilai Siswa</h4>
        {{-- <a href="{{ route('absensi-siswa.create') }}" class="btn btn-sm btn-primary">
            <i class="fas fa-plus"></i> Tambah Data Absensi
        </a> --}}
    </div>
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="filter-kelas">Filter Nama Kelas</label>
                    <select id="filter-kelas" class="form-control">
                        <option value="">Semua Kelas</option>
                        @foreach ($kelas as $row)
                            <option value="{{ $row->id }}">{{ $row->nama_kelas }}</option>
                        @endforeach
                        {{-- <option value="10">Kelas 10</option> --}}
                        {{-- <option value="11">Kelas 11</option>
                        <option value="12">Kelas 12</option> --}}
                        <!-- Tambahkan opsi kelas lainnya sesuai kebutuhan -->
                    </select>
                </div>
            </div>

            <table class="table table-bordered table-responsive-md" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th class="compact">#</th>
                        <th>Nama Siswa</th>
                        {{-- <th>Tanggal</th> --}}
                        {{-- <th>Status</th> --}}
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
                ajax: "{{ route('nilai-siswa.index') }}", // Route untuk data absensi
                columns: [{
                        data: 'DT_RowIndex', // Untuk nomor urut
                        name: 'id',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'nama_lengkap', // Nama Lengkap Siswa (berasal dari relasi siswa)
                        name: 'nama_lengkap'
                    },
                    // {
                    //     data: 'tanggal', // Tanggal absensi
                    //     name: 'tanggal'
                    // },
                    // {
                    //     data: 'status', // Status absensi (Hadir/Izin/Sakit/Alpha)
                    //     name: 'status'
                    // },
                    {
                        data: 'action', // Kolom aksi untuk edit, hapus
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
                        className: 'text-center align-middle',
                        width: "15%",
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
                        className: "align-middle", // Posisikan teks di tengah secara vertikal
                    },
                ],
            });
        });
    </script>
@endpush
