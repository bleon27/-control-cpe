@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('packages/DataTables-1.12.1/Responsive-2.3.0/css/responsive.bootstrap5.css') }}">
    <style>
        table.dataTable.table-striped>tbody>tr.odd.assigned>* {
            box-shadow: inset 0 0 0 9999px rgb(237 165 56 / 90%);
        }

        table.dataTable>tbody>tr.by_assigning>* {
            box-shadow: inset 0 0 0 9999px rgb(25 155 23 / 90%);
            color: black;
        }
    </style>
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

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Asignacion de equipos</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="POST">
                        @method('POST')
                        @csrf
                        <div class="mb-3">
                            <table class="table table-striped" id="tabla-asignar">
                                <thead>
                                    <tr>
                                        <th>{{ __('Nombre') }}</th>
                                        <th>{{ __('Marca') }}</th>
                                        <th>{{ __('Modelo') }}</th>
                                        <th>{{ __('Serie') }}</th>
                                        <th>{{ __('Cod. Cne') }}</th>
                                        <th>{{ __('Estado') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div class="mb-3">
                            <label for="asignarUsuario" class="col-form-label">Asignar al usuario</label>
                            <input type="text" class="form-control" id="asignarUsuario" name="asignarUsuario">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Send message</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="module" src="{{ asset('packages/DataTables-1.12.1/Responsive-2.3.0/js/dataTables.responsive.js') }}"></script>
    <script type="module" src="{{ asset('packages/DataTables-1.12.1/Responsive-2.3.0/js/responsive.bootstrap5.js') }}"></script>

    {{ $dataTable->scripts(attributes: ['type' => 'module', 'defer']) }}
    <script type="module">
        const intervalLaravelDataTables = setInterval(myTimer, 300);
        function myTimer() {
            if(typeof window.LaravelDataTables!==undefined){
                usarDatatable();
                clearInterval(intervalLaravelDataTables);
            }
        }

        var itemUsers_table;
        const usarDatatable = () => {
            itemUsers_table = window.LaravelDataTables["itemusers-table"];
            console.log('sdfds')
            btnEliminarItem('{{ csrf_token() }}');
            //btnAsignItem();
        }

        const btnEliminarItem = (_token) => {
            itemUsers_table.on('click', '.delete-item', function (e){
                e.preventDefault();
                e.stopPropagation();
                var fromThis = $(this);
                Swal.fire({
                title: '¿Desea eliminar el item?',
                    icon: 'question',
                    showDenyButton: true,
                    showCancelButton: false,
                    confirmButtonText: 'Si',
                    denyButtonText: `No`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        eliminarItem(fromThis, _token);
                    }
                });
            });
        }

        const eliminarItem = (fromThis, _token) => {
            $.ajax({
                url: fromThis.attr('href'),
                type: 'DELETE',
                data: {
                    _method: 'DELETE',
                    _token: _token,
                },
                beforeSend: function () {
                    insertBlockUI();
                },
                success: function (json) {
                    itemUsers_table.ajax.reload();
                    messageAccessControl('success', json.message);
                },
                error: function (xhr, status) {
                    var errors = $.parseJSON(xhr.responseText);
                    var textErrores = "";
                    var cont = 0;
                    $.each(errors.errors, function (key, value) {
                        if (cont == 0) {
                            textErrores += value;
                            cont++;
                        } else {
                            textErrores += "<br>" + value;
                        }
                    });
                    messageAccessControl('error', 'Error', textErrores, null, 5000);
                },
                complete: function (xhr, status) {
                    $.unblockUI();
                }
            });
        }

        const btnAsignItem = () =>{
            itemUsers_table.on('click', '.btn-assign', function (e){
                e.preventDefault();
                e.stopPropagation();
                var btnThis = $(this);
                //<td>${btnThis.data('codigo')}</td>
                var tbody = `
                    <tr>
                        <td>${btnThis.data('nombre')}</td>
                        <td>${btnThis.data('marca')}</td>
                        <td>${btnThis.data('modelo')}</td>
                        <td>${btnThis.data('serie')}</td>
                        <td>${btnThis.data('codigocne')}</td>
                        <td>${btnThis.data('estado')}</td>
                    </tr>
                `;
                $('#tabla-asignar tbody').html(tbody);

            });
        }

        const asignItem = (fromThis, _token) => {
            $.ajax({
                url: fromThis.attr('href'),
                type: 'DELETE',
                data: {
                    _method: 'DELETE',
                    _token: _token,
                },
                beforeSend: function () {
                    insertBlockUI();
                },
                success: function (json) {
                    itemUsers_table.ajax.reload();
                    messageAccessControl('success', json.message);
                },
                error: function (xhr, status) {
                    var errors = $.parseJSON(xhr.responseText);
                    var textErrores = "";
                    var cont = 0;
                    $.each(errors.errors, function (key, value) {
                        if (cont == 0) {
                            textErrores += value;
                            cont++;
                        } else {
                            textErrores += "<br>" + value;
                        }
                    });
                    messageAccessControl('error', 'Error', textErrores, null, 5000);
                },
                complete: function (xhr, status) {
                    $.unblockUI();
                }
            });
        }

        $('#asignarUsuario').click(function(){
            $(this).val();
            var url = "{{ route('item.show', '_idUser') }}";
            url = url.replace(url, $(this).val());
            $.ajax({
                url: url,
                type: 'GET',
                success: function (json) {
                    itemUsers_table.ajax.reload();
                },
                error: function (xhr, status) {
                    var errors = $.parseJSON(xhr.responseText);
                    var textErrores = "";
                    var cont = 0;
                    $.each(errors.errors, function (key, value) {
                        if (cont == 0) {
                            textErrores += value;
                            cont++;
                        } else {
                            textErrores += "<br>" + value;
                        }
                    });
                    messageAccessControl('error', 'Error', textErrores, null, 5000);
                }
            });
        });
    </script>
@endpush
