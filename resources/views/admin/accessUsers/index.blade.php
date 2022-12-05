@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('packages/DataTables-1.12.1/Responsive-2.3.0/css/responsive.bootstrap5.css') }}">
@endpush

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pb-5 py-md-4 pt-5">
        <div class="container">
            <div class="card">
                <div class="card-header">{{ __('Control de acceso de usuarios') }}</div>
                <div class="card-body">
                    <div class="btn-group" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-success crear"><i class="fa-solid fa-user-plus"></i></button>
                        <button type="button" class="btn btn-primary report-pdf"><i
                                class="bi bi-file-earmark-pdf-fill"></i></button>
                        <button type="button" class="btn btn-primary barcode-pdf"><i class="bi bi-upc-scan"></i></button>
                    </div>
                    {{ $dataTable->table(attributes: ['style' => 'width:100%']) }}
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script type="module" src="{{ asset('packages/DataTables-1.12.1/Responsive-2.3.0/js/dataTables.responsive.js') }}"></script>
    <script type="module" src="{{ asset('packages/DataTables-1.12.1/Responsive-2.3.0/js/responsive.bootstrap5.js') }}"></script>
    {{ $dataTable->scripts(attributes: ['type' => 'module', 'defer']) }}
    <script type="module">
        import {usarDatatable} from '/js/accessUser/index.js';
        const intervalLaravelDataTables = setInterval(myTimer, 300);
        function myTimer() {
            if(typeof window.LaravelDataTables!==undefined){
                usarDatatable("{{ route('access.user.create') }}", "{{ route('access.users.pdf') }}", "{{ route('access.users.barcode') }}");
                clearInterval(intervalLaravelDataTables);
            }
        }
    </script>
@endpush
