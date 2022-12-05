@extends('layouts.accessControl')

@push('styles')
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        body {
            padding-top: 40px;
            padding-bottom: 40px;
            background-color: #f5f5f5;
        }

        main {
            max-width: 330px;
            padding: 15px;
            margin: auto;
            width: 100%
        }

        main .form-floating:focus-within {
            z-index: 2;
        }

        #enviar {
            top: 10px;
            right: 10px;
        }
    </style>
@endpush

@section('content')
    <form class="text-center" id="formAccessControl" action="{{ route('access.control.store') }}" enctype="multipart/form-data"
        method="POST">
        @csrf
        @method('POST')
        <img class="mb-4" src="{{ asset('img/cne.png') }}" alt="" width="200">
        <h1 class="h3 mb-3 fw-normal">Control de acceso</h1>
        <div class="form-floating mb-3">
            <input type="password" class="form-control" id="identificacion" name="identificacion"
                placeholder="Identificación">
            <label for="identificacion">Identificación</label>
        </div>
        <p class="mt-5 mb-3 text-muted">&copy; 2023-2024</p>
    </form>
    <a class="btn btn-lg btn-primary position-fixed" href="{{ route('login') }}" id="enviar"><i
            class="fa-solid fa-user-gear"></i></a>
@endsection

@push('scripts')
    <script type="module">
        const messageAccessControl = window.messageAccessControl;
        let password = $('input[type="password"]');
        password.click(function() {
            inputFocus()
        })
        const inputFocus = () => {
            password.focus();
            password.on('blur', function() {
                setTimeout(() => {
                    $(this).focus();
                }, 100);
            });
        }
        inputFocus();
        /*$('#enviar').on('click', function() {
            password.off('blur');
            $(this).focus();
        });*/
        $('#formAccessControl').submit(function(event) {
            var fromThis = $(this);
            event.preventDefault();
            event.stopPropagation();
            $.ajax({
                url: fromThis.attr('action'),
                data: fromThis.serialize(),
                type: 'POST',
                dataType: 'json',
                beforeSend: function() {
                    password.attr('disabled', true)
                },
                success: function(json) {
                    messageAccessControl('success', json.message, `${json.accessUser.names} ${json.accessUser.surnames}`);
                },
                error: function(xhr, status) {
                    var errors = $.parseJSON(xhr.responseText);
                    messageAccessControl('error', 'Acceso Denegado', errors.messaje);
                },
                complete: function(xhr, status) {
                    password.attr('disabled', false);
                    fromThis.trigger("reset");
                    document.getElementById('identificacion').focus();
                }
            });
        });
    </script>
@endpush
