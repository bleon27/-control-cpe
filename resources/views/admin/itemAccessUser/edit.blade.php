@extends('layouts.app')

@push('styles')
    <style>
        #edititem label {
            width: 200px
        }
    </style>
@endpush

@section('content')
    <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 pb-5 py-md-4 pt-5">
        <div class="container">
            <div class="card mb-4">
                <div class="card-header">
                    Editar Items
                </div>
                <form action="{{ route('item.update', $item->id) }}" method="POST" id="edititem">
                    <div class="card-body">
                        @csrf
                        @method('PUT')
                        <div class="row mt-3">
                            <div class="col-6 align-items-center d-flex mb-3">
                                <label for="inputNombre" class="col-form-label">Nombre</label>
                                <input type="text" id="inputNombre" name="nombre" class="form-control ms-2"
                                    autocomplete="off" aria-describedby="nombreHelpInline" value="{{ $item->name }}">
                            </div>
                            <div class="col-6 align-items-center d-flex mb-3">
                                <label for="inputMarca" class="col-form-label">Marca</label>
                                <input type="text" id="inputMarca" name="marca" class="form-control ms-2"
                                    autocomplete="off" aria-describedby="marcaHelpInline" value="{{ $item->brand }}">
                            </div>
                            <div class="col-6 align-items-center d-flex mb-3">
                                <label for="inputModelo" class="col-form-label">Modelo</label>
                                <input type="text" id="inputModelo" name="modelo" class="form-control ms-2"
                                    autocomplete="off" aria-describedby="modeloHelpInline" value="{{ $item->model }}">
                            </div>
                            <div class="col-6 align-items-center d-flex mb-3">
                                <label for="inputSerie" class="col-form-label">Serie</label>
                                <input type="text" id="inputSerie" name="serie" class="form-control ms-2"
                                    autocomplete="off" aria-describedby="serieHelpInline" value="{{ $item->serie }}">
                            </div>
                            <div class="col-6 align-items-center d-flex mb-3">
                                <label for="inputCodigoCne" class="col-form-label">Cod. CNE</label>
                                <input type="text" id="inputCodigoCne" name="codigo_cne" class="form-control ms-2"
                                    autocomplete="off" aria-describedby="codigoCneHelpInline" value="{{ $item->cne_code }}">
                            </div>
                            <div class="col-6 align-items-center d-flex mb-3">
                                <label for="inputProcesador" class="col-form-label">Procesador</label>
                                <input type="text" id="inputProcesador" name="procesador" class="form-control ms-2"
                                    autocomplete="off" aria-describedby="procesadorHelpInline"
                                    value="{{ $item->processor }}">
                            </div>
                            <div class="col-6 align-items-center d-flex mb-3">
                                <label for="inputRam" class="col-form-label">Ram</label>
                                <input type="text" id="inputRam" name="ram" class="form-control ms-2"
                                    autocomplete="off" aria-describedby="remHelpInline" value="{{ $item->ram }}">
                            </div>
                            <div class="col-6 align-items-center d-flex mb-3">
                                <label for="inputDisco" class="col-form-label">Disco</label>
                                <input type="text" id="inputDisco" name="disco" class="form-control ms-2"
                                    autocomplete="off" aria-describedby="discoHelpInline" value="{{ $item->disk }}">
                            </div>
                            <div class="col-6 align-items-center d-flex mb-3">
                                <label for="selectEstado" class="col-form-label">Estado{{ $item->state }}</label>
                                <select class="form-select ms-2" aria-label="Default select example" id="selectEstado"
                                    name="estado">
                                    @if (is_null($item->state))
                                        <option selected></option>
                                    @endif
                                    @foreach ($estados as $estado)
                                        @if (Str::lower($item->state) == Str::lower($estado))
                                            <option value="{{ $estado }}" selected>{{ $estado }}</option>
                                        @else
                                            <option value="{{ $estado }}">{{ $estado }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <button class="btn btn-primary">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </main>
@endsection

@push('scripts')
    <script type="module" src="{{ asset('js/items/edit.js') }}"></script>
@endpush
