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

        #razon_recepcion {
            height: 100px;
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
@endsection

@section('modal')
    <div class="modal fade" id="modalRecepcion" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel2">Recepción de equipos informaticos</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h4 id="titulo_recepcion"></h4>
                    <div class="form-floating my-3">
                        <textarea class="form-control" placeholder="Leave a comment here" id="razon_recepcion" rows="10"
                            name="razon_recepcion"></textarea>
                        <label for="razon_recepcion">***OBSERVACIONES</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" id="registrar_recepcion">Registrar</button>
                </div>
            </div>
        </div>
    </div>
    <a class="btn btn-primary" data-bs-toggle="modal" href="#modalRecepcion" role="button">Open first modal</a>
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
            btnEliminarItem();
            btnFichaAsignacion();
            btnFichaRecpcion();
        }

        const btnEliminarItem = () => {
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
                        eliminarItem(fromThis);
                    }
                });
            });
        }

        const eliminarItem = (fromThis) => {
            $.ajax({
                url: fromThis.attr('href'),
                type: 'DELETE',
                data: {
                    _method: 'DELETE',
                    _token: $('meta[name="csrf-token"]').attr('content'),
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

        const btnFichaAsignacion = () => {
            itemUsers_table.on('click', '.ficha-asignacion', function (e) {
                e.preventDefault();
                e.stopPropagation();
                var btnThis = $(this);
                var xhr = new XMLHttpRequest();
                xhr.open('GET', btnThis.attr('href'), true);
                xhr.responseType = 'blob';
                insertBlockUI();
                xhr.onload = function (e) {
                    if (this.status == 200) {
                        var blob = new Blob([this.response], {
                            type: 'application/pdf'
                        });
                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(blob);
                        link.download = "Usuarios con acceso al CPE.pdf";
                        link.click();
                    } else {
                        messageAccessControl('error', 'Error', 'Error de conexión', null, 5000);
                    }
                    $.unblockUI();
                };
                xhr.send();
            });
        }

        const btnFichaRecpcion = () => {
            var urlFichaRecepcion='';
            itemUsers_table.on('click', '.registrar-recepcion', function (e) {
                e.preventDefault();
                e.stopPropagation();
                var btnThis = $(this);
                urlFichaRecepcion = btnThis.attr('href');
                //btnThis.parent().parent().data('id');
                var id = btnThis.parent().parent().parent().attr('id');
                $('#titulo_recepcion').html(`Recepción Nº ${id}`);
                $('#modalRecepcion').modal('show');
            });

            $('#registrar_recepcion').click(function(){
                var razon = $('#razon_recepcion').val();
                if(razon == ''){
                    razon = null;
                }
                $.ajax({
                    url: urlFichaRecepcion,
                    type: 'POST',
                    data: {
                        _method: 'PUT',
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        razon: $('#razon_recepcion').val()
                    },
                    beforeSend: function () {
                        insertBlockUI();
                    },
                    success: function (json) {
                        itemUsers_table.ajax.reload();
                        messageAccessControl('success', json.message);
                        $('#modalRecepcion').modal('hide');
                        //$('#razon_recepcion').val('');
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
            });
        }

    </script>
@endpush
