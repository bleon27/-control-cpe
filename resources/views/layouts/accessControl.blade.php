<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/x-icon" href="{{ asset('img/cne.png') }}">
    <title>{{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('packages/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('packages/bootstrap-icons/font/bootstrap-icons.css') }}">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    @stack('styles')
</head>

<body>
    <main class="d-flex flex-nowrap">
        <div class="container mt-5">
            @yield('content')
        </div>

    </main>
    <script type="module">
        let messageAccessControl = (icon, title, text) => {
            Swal.fire({
                position: 'center',
                icon: icon,
                title: title,
                text: text,
                showConfirmButton: false,
                timer: 1500
            });
        }
        window.messageAccessControl = messageAccessControl;
    </script>
    @stack('scripts')

</body>

</html>
