<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link {{ Helpers::activeRoute('dashboard', 'active') }}" aria-current="page"
                    href="{{ route('dashboard') }}">
                    <span data-feather="home"></span>
                    <i class="bi bi-grid-3x3-gap-fill"></i> {{ __('Dashboard') }}
                </a>
            </li>
            <li class="nav-item btn-group dropend">
                <a type="button"
                    class="nav-link dropdown-toggle {{ Helpers::activeRoute(['users.index', 'user.create', 'user.edit'], 'active') }}"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-users-gear"></i> {{ __('Usuarios') }}
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item {{ Helpers::activeRoute(['users.index'], 'active') }}"
                            href="{{ route('users.index') }}">Ver</a></li>
                    <li><a class="dropdown-item {{ Helpers::activeRoute(['user.create'], 'active') }}"
                            href="{{ route('user.create') }}">Crear</a></li>
                </ul>
            </li>
            <li class="nav-item btn-group dropend">
                <a type="button"
                    class="nav-link dropdown-toggle {{ Helpers::activeRoute(['access.user.index', 'access.user.create', 'access.user.edit'], 'active') }}"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-users"></i> {{ __('Accesos usuarios') }}
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item {{ Helpers::activeRoute(['access.user.index'], 'active') }}"
                            href="{{ route('access.user.index') }}">Ver</a></li>
                    <li><a class="dropdown-item {{ Helpers::activeRoute(['access.user.create'], 'active') }}"
                            href="{{ route('access.user.create') }}">Crear</a></li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Helpers::activeRoute(['access.control.index'], 'active') }}"
                    href="{{ route('access.control.index') }}">
                    <i class="fa-solid fa-users-rectangle"></i> {{ __('Control de accesos') }}
                </a>
            </li>

            <li class="nav-item btn-group dropend">
                <a type="button"
                    class="nav-link dropdown-toggle {{ Helpers::activeRoute(['items.index', 'items.create', 'items.edit'], 'active') }}"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-cubes"></i> {{ __('Inventario') }}
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item {{ Helpers::activeRoute(['items.index'], 'active') }}"
                            href="{{ route('items.index') }}">{{ __('Ver') }}</a>
                    </li>
                    <li><a class="dropdown-item {{ Helpers::activeRoute(['items.create'], 'active') }}"
                            href="{{ route('items.create') }}">{{ __('Crear') }}</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item btn-group dropend">
                <a type="button"
                    class="nav-link dropdown-toggle {{ Helpers::activeRoute(['itemsAccessUser.index', 'itemsAccessUser.create'], 'active') }}"
                    data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-cubes"></i> {{ __('Asignacion') }}
                </a>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item {{ Helpers::activeRoute(['itemsAccessUser.index'], 'active') }}"
                            href="{{ route('itemsAccessUser.index') }}">{{ __('Ver') }}</a>
                    </li>
                    <li><a class="dropdown-item {{ Helpers::activeRoute(['itemsAccessUser.create'], 'active') }}"
                            href="{{ route('itemsAccessUser.create') }}">{{ __('Crear') }}</a>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
