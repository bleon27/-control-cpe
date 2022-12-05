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
                    Edicion de usuarios
                </div>
                <form action="{{ route('access.user.update', $accessUser->id) }}" method="POST" id="editAccessUser">
                    <div class="card-body">
                        @csrf
                        @method('PUT')
                        <div class="row mt-3">
                            <div class="col-6 align-items-center d-flex mb-3">
                                <label for="inputNombresCompletos" class="col-form-label">Nombres</label>
                                <input type="text" id="inputNombresCompletos" name="nombres_completos"
                                    class="form-control ms-2" autocomplete="off" aria-describedby="nombres_completosHelpInline"
                                    value="{{ $accessUser->names }}">
                            </div>
                            <div class="col-6 align-items-center d-flex mb-3">
                                <label for="inputNombresCompletos" class="col-form-label">Apellidos</label>
                                <input type="text" id="inputNombresCompletos" name="nombres_completos"
                                    class="form-control ms-2" autocomplete="off" aria-describedby="nombres_completosHelpInline"
                                    value="{{ $accessUser->surnames }}">
                            </div>
                            <div class="col-6 align-items-center d-flex mb-3">
                                <label for="inputCedula" class="col-form-label">Cédula</label>
                                <input type="text" id="inputCedula" name="cedula" class="form-control ms-2" autocomplete="off"
                                    aria-describedby="cedulaHelpInline" value="{{ $accessUser->ci }}">
                            </div>
                            <div class="col-6 align-items-center d-flex mb-3">
                                <label for="inputNumeroDocumento" class="col-form-label">Numero de documento</label>
                                <input type="text" id="inputNumeroDocumento" name="numero_documento"
                                    class="form-control ms-2" autocomplete="off" aria-describedby="numero_documentoHelpInline"
                                    value="{{ $accessUser->document_number }}">
                            </div>
                            <div class="col-6 align-items-center d-flex mb-3">
                                <label for="inputUnidad" class="col-form-label">Unidad</label>
                                <input type="text" id="inputUnidad" name="unidad" class="form-control ms-2" autocomplete="off"
                                    aria-describedby="unidadHelpInline" value="{{ $accessUser->unit }}">
                            </div>
                            <div class="col-6 align-items-center d-flex mb-3">
                                <label for="inputCargo" class="col-form-label">Cargo</label>
                                <input type="text" id="inputCargo" name="cargo" class="form-control ms-2" autocomplete="off"
                                    aria-describedby="cargoHelpInline" value="{{ $accessUser->position }}">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script type="module" src="{{ asset('js/accessUser/edit.js') }}"></script>
@endpush
