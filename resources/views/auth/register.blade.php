@extends('layouts.auth')

@section('content')
    <main class="form-signin">
        <form method="POST" action="{{ route('register') }}">
            @method('POST')
            @csrf
            <img class="mb-4" src="{{ asset('img/cne.png') }}" alt="" width="250" >
            <h1 class="h3 mb-3 fw-normal">{{__('Registro')}}</h1>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="form-floating">
                <input type="text" class="form-control" name="name" style="border-radius: 0.25rem 0.25rem 0px 0px;margin-bottom: -1px;" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">{{__('Nombre')}}</label>
            </div>
            <div class="form-floating">
                <input type="email" class="form-control" name="email" style="border-radius: 0px;margin-bottom: -1px;" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">{{__('Correo')}}</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" name="password" style="border-radius: 0px;margin-bottom: -1px;" id="floatingPassword" placeholder="Contraseña">
                <label for="floatingPassword">{{__('Contraseña')}}</label>
            </div>
            <div class="form-floating">
                <input type="password" class="form-control" name="password_confirmation" id="floatingConfirmPassword" placeholder="Contraseña">
                <label for="floatingConfirmPassword">{{__('Confirmar contraseña')}}</label>
            </div>
            <button class="w-100 btn btn-lg btn-primary" type="submit">{{__('Registrar')}}</button>
            <p class="mt-5 mb-3 text-muted">{!! __('&copy; 2022') !!}</p>
        </form>
    </main>
@endsection
