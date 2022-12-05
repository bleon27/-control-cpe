<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="{{ route('dashboard') }}"><img src="{{ asset('img/cne.png') }}"
            class="img-fluid" alt="" style="max-width: 100px;"></a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
        data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            @guest
                <a class="nav-link px-3" href="{{ route('login') }}">{{ __('Iniciar sesión') }}</a>
            @else
                <form action="{{ asset('logout') }}" method="post">
                    @method('POST')
                    @csrf
                    <a class="nav-link px-3" href="{{ route('logout') }}"
                        onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Cerrar sesión') }}</a>
                </form>
            @endguest

        </div>
    </div>
</header>
