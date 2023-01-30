<nav class="navbar navbar-expand-lg bg-body-tertiary gradient-navbar-2">

    <div class="container-fluid">

        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/lotus.webp" alt="{{ config('app.name') }}" width="60" height="48">
        </a>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                <li class="nav-item">
                    <a class="nav-link active text-navbar-color" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-navbar-color" href="#">Lugares Parqueo</a>
                </li>

                @if (Auth::user()->role_id == 1)
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-navbar-color" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Administracion  
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item text-navbar-color" href="{{ route('users') }}">Empleados</a></li>
                            <li><a class="dropdown-item text-navbar-color" href="#">Horarios</a></li>
                            <li><a class="dropdown-item text-navbar-color" href="{{ route('rolesView') }}">Roles</a></li>
                        </ul>
                    </li>
                @endif

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-navbar-color" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Clientes
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item text-navbar-color" href="#">Vehiculos</a></li>
                    </ul>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-navbar-color">Proveedores</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle text-navbar-color" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Configuración
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item text-navbar-color" href="{{ route('cities') }}">Ciudades</a></li>
                        <li><a class="dropdown-item text-navbar-color" href="#">Core</a></li>
                        <li><a class="dropdown-item text-navbar-color" href="#">Informes</a></li>
                        <li><a class="dropdown-item text-navbar-color" href="#">Paises</a></li>
                        <li><a class="dropdown-item text-navbar-color" href="#">Promociones</a></li>
                        <li><a class="dropdown-item text-navbar-color" href="#">Tipos Vehiculos</a></li>
                    </ul>
                </li>

            </ul>

            <div class="d-flex">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 px-5">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-navbar-color" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('images/avatar1.jpg') }}" width="50" height="50" class="rounded-circle" alt="{{ Auth::user()->name }} {{ Auth::user()->last_name }}">
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item text-navbar-color fw-bold" href="#">{{ Auth::user()->name }}</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-navbar-color" href="{{ route('profile') }}">Perfil</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <a class="dropdown-item text-navbar-color" href="#" onclick="this.closest('form').submit()">Cerrar Sesión</a>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</nav>