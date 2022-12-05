@extends('layouts.app')

@push('styles')
    <style>
        .fs-18pt {
            font-size: 18pt
        }

        .fs-50pt {
            font-size: 50pt
        }

        .btn-primary {
            background-color: #2560a4;
            border-color: #2560a4;
        }
    </style>
@endpush

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pb-5 py-md-4 pt-5">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Dashboard</h1>
        </div>
        <div class="container">
            <div class="row d-flex justify-content-center">
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <a class="btn btn-primary w-100 py-4 mb-3 fs-18pt" href="{{ route('users.index') }}">
                        <i class="fa-solid fa-users fs-50"></i><br>{{ __('Usuarios') }}</a>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <a class="btn btn-primary w-100 py-4 mb-3 fs-18pt" href="#">
                        <i class="fa-solid fa-address-book fs-50"></i><br>{{ __('Acceso Usuarios') }}</a>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-6">
                    <a class="btn btn-primary w-100 py-4 mb-3 fs-18pt" href="#">
                        <i class="fa-solid fa-rectangle-list fs-50"></i><br>{{ __('Control Accesos') }}</a>
                </div>
            </div>

        </div>
    </main>
@endsection

@push('scripts')
@endpush
