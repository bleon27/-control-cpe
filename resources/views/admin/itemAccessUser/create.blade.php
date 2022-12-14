@extends('layouts.app')

@push('styles')
    <style>
        #createItem label {
            width: 200px
        }

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
            <div class="card mb-4">
                <div class="card-header">
                    Asignar items
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-3">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="accessUser" name="accessUser"
                                    placeholder="Ingrese la cedula del usuario">
                                <label for="accessUser">Ingrese la cedula del usuario</label>
                            </div>
                        </div>
                        <div class="col-7 d-flex align-items-center">
                            <h4 id="usuarioSeleccionado" class="w-100 text-center"></h4>
                        </div>
                        <div class="col-2 d-flex align-items-center">
                            <a class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle"
                                role="button">Lista de ítems</a>
                        </div>
                    </div>
                    {{-- $dataTable->table(attributes:['style'=>'width:100%']) --}}
                    <table id="table-temp" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Nombre</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Serie</th>
                                <th>Cod. CNE</th>
                                <th>Ram</th>
                                <th>Disco</th>
                                <th>Cant.</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>id</th>
                                <th>Nombre</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Serie</th>
                                <th>Cod. CNE</th>
                                <th>Ram</th>
                                <th>Disco</th>
                                <th>Cant.</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                    </table>
                    <div class="form-floating my-3">
                        <textarea class="form-control" placeholder="Leave a comment here" id="observacion" name="observacion"></textarea>
                        <label for="observacion">***OBSERVACIONES
                        </label>
                    </div>
                    <button class="btn btn-primary" id="registrar">Registrar</button>
                </div>
            </div>
        </div>


    </main>
@endsection

@section('modal')
    <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
        tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel">Seleccione los items que desee asignar</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <table id="table-items" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Serie</th>
                                <th>Cod. CNE</th>
                                <th>Ram</th>
                                <th>Disco</th>
                                <th>Cant.</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Marca</th>
                                <th>Modelo</th>
                                <th>Serie</th>
                                <th>Cod. CNE</th>
                                <th>Ram</th>
                                <th>Disco</th>
                                <th>Cant.</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <div class="modal-footer">
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script type="module" src="{{ asset('packages/DataTables-1.12.1/Responsive-2.3.0/js/dataTables.responsive.js') }}"></script>
    <script type="module" src="{{ asset('packages/DataTables-1.12.1/Responsive-2.3.0/js/responsive.bootstrap5.js') }}"></script>

    {{-- $dataTable->scripts(attributes:['type'=>'module','defer']) --}}
    <script type="module">
        $(function(){
            {{--
            const intervalLaravelDataTables = setInterval(myTimer, 300);
            function myTimer() {
                if(typeof window.LaravelDataTables!==undefined){
                    usarDatatable();
                    tempDelete();
                    clearInterval(intervalLaravelDataTables);
                }
            }

            var tempItems_table;
            const usarDatatable = () => {
                tempItems_table = window.LaravelDataTables["TempItems-table"];
            }
            --}}
            var idClient = 0;
            var urlTempItemsAccessUser = "{{ route('itemsAccessUser.create.ajaxTemp', '_accessUser') }}";
            var tempItems_table;
            function temp(){
                /*
                table_items.clear().draw();
                table_items.colReorder.reset();
                */
                if (tempItems_table != null)
                    tempItems_table.destroy();
                var url = urlTempItemsAccessUser.replace('_accessUser', idClient);
                console.log(url)
                tempItems_table = $('#table-temp').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: url,
                    language: {url:"{{ asset('packages/DataTables-1.12.1/locale/es.json') }}"},
                    columnDefs: [{
                        "data": "id",
                        "targets": [0],
                    },{
                        "data": "name",
                        "targets": [1]
                    },{
                        "data": "brand",
                        "targets": [2]
                    },{
                        "data": "model",
                        "targets": [3]
                    },{
                        "data": "serie",
                        "targets": [4]
                    },{
                        "data": "cne_code",
                        "targets": [5]
                    },{
                        "data": "ram",
                        "targets": [6]
                    },{
                        "data": "disk",
                        "targets": [7]
                    },{
                        "data": "amount",
                        "targets": [8]
                    },{
                        "data": "actions",
                        "targets": [9]
                    }],
                    "buttons": []
                });
            }
            temp()
            var urlItemsAccessUser = "{{ route('itemsAccessUser.create.ajaxItem') }}";

            var table_items
            function items(){
                if (table_items != null)
                    table_items.destroy();
                table_items = $('#table-items').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: {
                        type: "POST",
                        url: urlItemsAccessUser,
                        data: {
                            _token: "{{ csrf_token() }}",
                            _method: 'POST',
                            accessUser: [idClient]
                        }
                    },
                    language: {url:"{{ asset('packages/DataTables-1.12.1/locale/es.json') }}"},
                    columnDefs: [{
                        "data": "id",
                        "targets": [0]
                    },{
                        "data": "name",
                        "targets": [1]
                    },{
                        "data": "brand",
                        "targets": [2]
                    },{
                        "data": "model",
                        "targets": [3]
                    },{
                        "data": "serie",
                        "targets": [4]
                    },{
                        "data": "cne_code",
                        "targets": [5]
                    },{
                        "data": "ram",
                        "targets": [6]
                    },{
                        "data": "disk",
                        "targets": [7]
                    },/*{
                        "data": null,
                        "targets": [8],
                        render: function(data, type, row) {
                            return `<input type="text" class="form-control cantidad" id="floatingInput" placeholder="1" value="1">`;
                        }
                    }*/{
                        "data": "amount",
                        "targets": [8]
                    },{
                        "data": "actions",
                        "targets": [9]
                    }],
                    "buttons": []
                });
            }

            items()
            $('#accessUser').keyup(function(e){
                if (e.which === 13) {
                    var url = "{{ route('access.user.showAjax', '_accessUser') }}";
                    url = url.replace('_accessUser', $(this).val());
                    $.ajax({
                        url: url,
                        type: 'GET',
                        beforeSend: function () {
                            insertBlockUI()
                        },
                        success: function (json) {
                            var nombres = `${json.accessUser.names} ${json.accessUser.surnames}`;
                            idClient = json.accessUser.id;
                            $('#usuarioSeleccionado').html(nombres);
                            temp();
                            items();
                        },
                        error: function (xhr, status) {
                            var errors = $.parseJSON(xhr.responseText);
                            var textErrores = "";
                            var cont = 0;
                            $.each(errors.errors, function (key, value) {
                                if (cont == 0) {
                                    textErrores += value;
                                    cont++
                                } else {
                                    textErrores += "<br>" + value
                                }
                            });
                            idClient = 0
                            temp();
                            items();
                            messageAccessControl('error', 'Error', textErrores, null, 5000);
                        },
                        complete: function (xhr, status) {
                            //fromThis.trigger("reset");
                            $.unblockUI()
                        }
                    });
                }
            });
            table_items.on('click', '.btn-assign', function (e){
                var cantidad = $(this).parent().parent().find('.cantidad').val();
                $.ajax({
                    url: "{{ route('tempItems.store') }}",
                    type: 'POST',
                    data: {
                        _method: "POST",
                        _token: "{{ csrf_token() }}",
                        id: $(this).parent().parent().data('id'),
                        idClient: idClient,
                        cantidad: cantidad,
                    },
                    beforeSend: function () {
                        insertBlockUI();
                    },
                    success: function (json) {
                        table_items.ajax.reload( null, false );
                        tempItems_table.ajax.reload();
                    },
                    error: function (xhr, status) {
                        var errors = $.parseJSON(xhr.responseText);
                        var textErrores = "";
                        var cont = 0;
                        $.each(errors.errors, function (key, value) {
                            if (cont == 0) {
                                textErrores += value;
                                cont++
                            } else {
                                textErrores += "<br>" + value
                            }
                        });
                        messageAccessControl('error', 'Error', textErrores, null, 5000);
                    },
                    complete: function (xhr, status) {
                        //fromThis.trigger("reset");
                        $.unblockUI()
                    }
                });
            });
            tempItems_table.on('click', '.delete-item', function (e){
                e.preventDefault();
                e.stopPropagation();
                var url = $(this).attr('href');
                $.ajax({
                    url: url,
                    type: 'DELETE',
                    data: {
                        _method: "DELETE",
                        _token: "{{ csrf_token() }}",
                    },
                    beforeSend: function () {
                        insertBlockUI();
                    },
                    success: function (json) {
                        table_items.ajax.reload( null, false );
                        tempItems_table.ajax.reload();
                    },
                    error: function (xhr, status) {
                        var errors = $.parseJSON(xhr.responseText);
                        var textErrores = "";
                        var cont = 0;
                        $.each(errors.errors, function (key, value) {
                            if (cont == 0) {
                                textErrores += value;
                                cont++
                            } else {
                                textErrores += "<br>" + value
                            }
                        });
                        messageAccessControl('error', 'Error', textErrores, null, 5000);
                    },
                    complete: function (xhr, status) {
                        //fromThis.trigger("reset");
                        $.unblockUI()
                    }
                });
            });
            $('#registrar').click(function(){
                var observacion = null;
                if($('#observacion').val()!=''){
                    observacion = $('#observacion').val();
                }
                $.ajax({
                    url: "{{ route('itemsAccessUser.store') }}",
                    type: 'POST',
                    data: {
                        _method: "POST",
                        _token: "{{ csrf_token() }}",
                        idCliente: idClient,
                        observacion: observacion,
                    },
                    beforeSend: function () {
                        insertBlockUI();
                    },
                    success: function (json) {
                        table_items.ajax.reload( null, false );
                        tempItems_table.ajax.reload();
                    },
                    error: function (xhr, status) {
                        var errors = $.parseJSON(xhr.responseText);
                        var textErrores = "";
                        var cont = 0;
                        $.each(errors.errors, function (key, value) {
                            if (cont == 0) {
                                textErrores += value;
                                cont++
                            } else {
                                textErrores += "<br>" + value
                            }
                        });
                        messageAccessControl('error', 'Error', textErrores, null, 5000);
                    },
                    complete: function (xhr, status) {
                        //fromThis.trigger("reset");
                        $.unblockUI()
                    }
                });
            });
        });
    </script>
@endpush
