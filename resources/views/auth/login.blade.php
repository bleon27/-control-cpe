@extends('layouts.auth')

@section('content')
<main class="form-signin">
    <form method="POST" action="{{ route('login') }}">
        @method('POST')
        @csrf
        <img class="mb-4" src="{{ asset('img/cne.png') }}" alt="" width="250" >
        <h1 class="h3 mb-3 fw-normal">{{__('Iniciar sesión')}}</h1>

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
            <input type="email" class="form-control" name="email" value="{{ old('email') }}" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">{{__('Correo')}}</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="Contraseña">
            <label for="floatingPassword">{{__('Contraseña')}}</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">{{__('Iniciar sesion')}}</button>
        <p class="mt-5 mb-3 text-muted">{!! __('&copy; 2022') !!}</p>
    </form>
</main>
@endsection
