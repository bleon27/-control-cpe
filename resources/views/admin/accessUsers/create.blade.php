@extends('layouts.app')

@push('styles')
    <style>
        #createAccessUser label {
            width: 200px
        }
    </style>
@endpush

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pb-5 py-md-4 pt-5">
        <div class="container">
            <div class="card mb-4">
                <div class="card-header">
                    Registro unitario de usuarios
                </div>
                <form action="{{ route('access.user.store') }}" method="POST" id="createAccessUser">
                    <div class="card-body">
                        @csrf
                        @method('POST')
                        <div class="row mt-3">
                            <div class="col-6 align-items-center d-flex mb-3">
                                <label for="inputNombresCompletos" class="col-form-label">Nombres</label>
                                <input type="text" id="inputNombresCompletos" name="nombres"
                                    class="form-control ms-2" autocomplete="off"
                                    aria-describedby="nombres_completosHelpInline">
                            </div>
                            <div class="col-6 align-items-center d-flex mb-3">
                                <label for="inputNombresCompletos" class="col-form-label">Apellidos</label>
                                <input type="text" id="inputNombresCompletos" name="apellidos"
                                    class="form-control ms-2" autocomplete="off"
                                    aria-describedby="nombres_completosHelpInline">
                            </div>
                            <div class="col-6 align-items-center d-flex mb-3">
                                <label for="inputCedula" class="col-form-label">Cédula</label>
                                <input type="text" id="inputCedula" name="cedula" class="form-control ms-2"
                                    autocomplete="off" aria-describedby="cedulaHelpInline">
                            </div>
                            <div class="col-6 align-items-center d-flex mb-3">
                                <label for="inputNumeroDocumento" class="col-form-label">Numero de documento</label>
                                <input type="text" id="inputNumeroDocumento" name="numero_documento"
                                    class="form-control ms-2" autocomplete="off"
                                    aria-describedby="numero_documentoHelpInline">
                            </div>
                            <div class="col-6 align-items-center d-flex mb-3">
                                <label for="inputUnidad" class="col-form-label">Unidad</label>
                                <input type="text" id="inputUnidad" name="unidad" class="form-control ms-2"
                                    autocomplete="off" aria-describedby="unidadHelpInline">
                            </div>
                            <div class="col-6 align-items-center d-flex mb-3">
                                <label for="inputCargo" class="col-form-label">Cargo</label>
                                <input type="text" id="inputCargo" name="cargo" class="form-control ms-2"
                                    autocomplete="off" aria-describedby="cargoHelpInline">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-primary">Registrar</button>
                    </div>
                </form>
            </div>
            <div class="card">
                <div class="card-header">
                    Registro masivo de usuarios
                </div>
                <div class="card-body">
                    <form action="{{ route('access.user.import') }}" id="formImpor" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="input-group mb-3">
                            <input class="form-control" type="file" id="formFile"
                                aria-describedby="inputGroupFileAddon04" aria-label="Upload" name="file">
                            <button class="btn btn-outline-secondary" type="submit"
                                id="inputGroupFileAddon04">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script type="module" src="{{ asset('js/accessUser/create.js') }}"></script>
@endpush
