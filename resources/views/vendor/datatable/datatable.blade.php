@push('css')
    <link href="{{ asset('dist/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <style>
        #dataTable_wrapper,
        .dt-bootstrap4 {
            padding: .2rem !important;
        }
    </style>
@endpush

@push('js')
    <script src="{{ asset('dist/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('dist/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
@endpush
