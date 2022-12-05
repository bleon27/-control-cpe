@extends('layouts.app')

@push('styles')
    <style>
        .col-form-label {
            width: 200px
        }
    </style>
@endpush

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pb-5 py-md-4 pt-5">
        <div class="container">
            <div class="card mb-4">
                <div class="card-header">
                    Registro de usuarios
                </div>
                <form action="{{ route('user.store') }}" method="POST" id="createUser">
                    <div class="card-body">
                        @csrf
                        @method('POST')
                        <div class="row mt-3">
                            <div class="col-4 align-items-center d-flex mb-3">
                                <label for="inputNombres" class="col-form-label">Nombres</label>
                                <input type="text" id="inputNombres" name="nombres" class="form-control ms-2"
                                    autocomplete="off" aria-describedby="nombres_completosHelpInline">
                            </div>
                            <div class="col-4 align-items-center d-flex mb-3">
                                <label for="inputApellidos" class="col-form-label">Apellidos</label>
                                <input type="text" id="inputApellidos" name="apellidos" class="form-control ms-2"
                                    autocomplete="off" aria-describedby="apellidosHelpInline">
                            </div>
                            <div class="col-4 align-items-center d-flex mb-3">
                                <label for="inputCargo" class="col-form-label">Rol</label>
                                <select class="ms-2 form-select" name="rol" aria-label="Default select example">
                                    <option>{{ __('Seleccione un Rol') }}</option>
                                    @foreach ($roles as $role)
                                        <option value="{{ $role->id }}">{{ $role->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 align-items-center d-flex mb-3">
                                <label for="inputCedula" class="col-form-label">Correo Electronico</label>
                                <input type="text" id="inputCedula" autocomplete="off" name="correo"
                                    class="form-control ms-2" aria-describedby="cedulaHelpInline">
                            </div>
                            <div class="col-6 align-items-center d-flex mb-3">
                                <label for="inputCedula" class="col-form-label">Cédula</label>
                                <input type="text" id="inputCedula" autocomplete="off" name="cedula"
                                    class="form-control ms-2" aria-describedby="cedulaHelpInline">
                            </div>
                            <div class="col-6 align-items-center d-flex mb-3">
                                <label for="inputUnidad" class="col-form-label">Unidad</label>
                                <input type="text" id="inputUnidad" autocomplete="off" name="unidad"
                                    class="form-control ms-2" aria-describedby="unidadHelpInline">
                            </div>
                            <div class="col-6 align-items-center d-flex mb-3">
                                <label for="inputCargo" class="col-form-label">Cargo</label>
                                <input type="text" id="inputCargo" autocomplete="off" name="cargo"
                                    class="form-control ms-2" aria-describedby="cargoHelpInline">
                            </div>
                            <div class="col-6 align-items-center d-flex mb-3">
                                <label for="inputCargo" class="col-form-label">Contraseña</label>
                                <input type="text" id="inputCargo" autocomplete="off" name="contrasena"
                                    class="form-control ms-2" aria-describedby="cargoHelpInline">
                            </div>
                            <div class="col-6 align-items-center d-flex mb-3">
                                <label for="inputCargo" class="col-form-label">Confirmar Contraseña</label>
                                <input type="text" id="inputCargo" autocomplete="off" name="confirmar_contrasena"
                                    class="form-control ms-2" aria-describedby="cargoHelpInline">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button class="btn btn-primary">Registrar</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script type="module" src="{{ asset('js/users/create.js') }}"></script>
@endpush
