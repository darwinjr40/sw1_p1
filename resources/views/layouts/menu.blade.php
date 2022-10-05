<li class="side-menus {{ Request::is('*') ? 'active' : '' }}">
    <a class="nav-link" href="/">
        <i class=" fas fa-building"></i><span>Dashboard</span>
    </a>

    <a class="nav-link" href="{{route('home')}}">
        <i class=" fas fa-building"></i><span>Casita</span>
    </a>

    {{-- <a class="nav-link" href="{{route('usuarios.index')}}">
        <i class=" fas fa-users"></i><span>Usuarios</span>
    </a>


    <a class="nav-link" href="{{route('categoriaEventos.index')}}">
        <i class=" fas fa-bars"></i><span>Categoria Eventos</span>
    </a>

    <a class="nav-link" href="{{route('sectors.index')}}">
        <i class="fa fa-object-group"></i><span>Sectores del Eventos</span>
    </a>

    <a class="nav-link" href="{{route('espacios.index')}}">
        <i class="fa fa-puzzle-piece"></i><span>Espacios de Sectores</span>
    </a>


    <a class="nav-link" href="{{route('contactos.index')}}">
        <i class=" fas fa-address-book"></i><span>Contactos</span>
    </a> --}}

    <a class="nav-link" href="{{route('eventos.index')}}">
        <i class="fa fa-calendar"></i><span>Eventos</span>
    </a>
{{-- 
    <a class="nav-link" href="{{ route('imagens.index') }}">
        <i class="fa fa-clone"></i><span>Imagenes</span>
    </a>

    <a class="nav-link" href="{{ route('ubicacions.index') }}">
        <i class=" fas fa-map-marker"></i><span>Ubicacion</span>
    </a>

    <a class="nav-link" href="{{ route('clientes.index') }}">
        <i class="fa fa-users"></i><span>Clientes</span>
    </a>
    <a class="nav-link" href="{{ route('tipoPagos.index') }}">
        <i class="fa fa-credit-card"></i><span>Tipo de Pago</span>
    </a>
    <a class="nav-link" href="{{ route('datosPagos.index') }}">
        <i class="fa fa-folder"></i><span>Pagos Realizados</span>
    </a> --}}
</li>
