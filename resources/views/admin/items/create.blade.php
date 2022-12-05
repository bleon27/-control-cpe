@extends('layouts.app')

@push('styles')
    <style>
        #createItem label {
            width: 200px
        }
    </style>
@endpush

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pb-5 py-md-4 pt-5">
        <div class="container">
            <div class="card mb-4">
                <div class="card-header">
                    Registro unitario de items
                </div>
                <form action="{{ route('item.store') }}" method="POST" id="createItem">
                    <div class="card-body">
                        @csrf
                        @method('POST')
                        <div class="row mt-3">
                            <div class="col-6 align-items-center d-flex mb-3">
                                <label for="inputNombre" class="col-form-label">Nombre</label>
                                <input type="text" id="inputNombre" name="nombre" class="form-control ms-2"
                                    autocomplete="off" aria-describedby="nombreHelpInline">
                            </div>
                            <div class="col-6 align-items-center d-flex mb-3">
                                <label for="inputMarca" class="col-form-label">Marca</label>
                                <input type="text" id="inputMarca" name="marca" class="form-control ms-2"
                                    autocomplete="off" aria-describedby="marcaHelpInline">
                            </div>
                            <div class="col-6 align-items-center d-flex mb-3">
                                <label for="inputModelo" class="col-form-label">Modelo</label>
                                <input type="text" id="inputModelo" name="modelo" class="form-control ms-2"
                                    autocomplete="off" aria-describedby="modeloHelpInline">
                            </div>
                            <div class="col-6 align-items-center d-flex mb-3">
                                <label for="inputSerie" class="col-form-label">Serie</label>
                                <input type="text" id="inputSerie" name="serie" class="form-control ms-2"
                                    autocomplete="off" aria-describedby="serieHelpInline">
                            </div>
                            <div class="col-6 align-items-center d-flex mb-3">
                                <label for="inputCodigoCne" class="col-form-label">Cod. CNE</label>
                                <input type="text" id="inputCodigoCne" name="codigo_cne" class="form-control ms-2"
                                    autocomplete="off" aria-describedby="codigoCneHelpInline">
                            </div>
                            <div class="col-6 align-items-center d-flex mb-3">
                                <label for="inputProcesador" class="col-form-label">Procesador</label>
                                <input type="text" id="inputProcesador" name="procesador" class="form-control ms-2"
                                    autocomplete="off" aria-describedby="procesadorHelpInline">
                            </div>
                            <div class="col-6 align-items-center d-flex mb-3">
                                <label for="inputRam" class="col-form-label">Ram</label>
                                <input type="text" id="inputRam" name="ram" class="form-control ms-2"
                                    autocomplete="off" aria-describedby="remHelpInline">
                            </div>
                            <div class="col-6 align-items-center d-flex mb-3">
                                <label for="inputDisco" class="col-form-label">Disco</label>
                                <input type="text" id="inputDisco" name="disco" class="form-control ms-2"
                                    autocomplete="off" aria-describedby="discoHelpInline">
                            </div>
                            <div class="col-6 align-items-center d-flex mb-3">
                                <label for="selectEstado" class="col-form-label">Estado</label>
                                <select class="form-select ms-2" aria-label="Default select example" id="selectEstado"
                                    name="estado">
                                    <option selected></option>
                                    @foreach ($estados as $estado)
                                        <option value="{{ $estado }}" selected>{{ $estado }}</option>
                                    @endforeach
                                </select>
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
                    Registro masivo de Items
                </div>
                <div class="card-body">
                    <form action="{{ route('items.import') }}" id="formImpor" method="POST" enctype="multipart/form-data">
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
    <script type="module" src="{{ asset('js/items/create.js') }}"></script>
@endpush
