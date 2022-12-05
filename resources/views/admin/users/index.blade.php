@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('packages/DataTables-1.12.1/Responsive-2.3.0/css/responsive.bootstrap5.css') }}">
@endpush

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pb-5 py-md-4 pt-5">
        <div class="container">
            <div class="card">
                <div class="card-header">{{ __('Gestion de Usuarios') }}</div>
                <div class="card-body">
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
@endpush
