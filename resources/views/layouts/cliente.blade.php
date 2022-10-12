<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://use.fontawesome.com/908890c963.js"></script>
    @yield('css')

        <!-- Bootstrap 4.1.1 -->
        <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="{{ asset('assets/css/@fortawesome/fontawesome-free/css/all.css') }}" rel="stylesheet" type="text/css">
        {{-- <link href="//fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('assets/css/iziToast.min.css') }}">
        <link href="{{ asset('assets/css/sweetalert.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}

    <title>Eticket</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="{{ asset('img/logo.png') }}" width="85" >
            </a>
            <a class="navbar-brand" href="{{route('eventos.index')}}" data-id="{{ \Auth::id() }}">
              <i class="fa fa-calendar"></i>Home</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                {{-- <div class="navbar-nav">
                    <a class="nav-link active" aria-current="page" href="#"><i class="fa fa-shopping-cart" aria-hidden="true"></i></a>
                </div> --}}
            </div>
            <form class="d-flex">
                <input class="form-control me-2" type="search" placeholder="Buscar Evento" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Buscar</button>
            </form>
            <br>
            <div>
                @if (Route::has('login'))
                    <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                        @auth
                            <a href="{{ url('logout') }}" class="dropdown-item has-icon text-danger"
                                onclick="event.preventDefault(); localStorage.clear();  document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> Cerrar Sesion
                            </a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
                                {{ csrf_field() }}
                            </form>
                        @else
                            <a href="{{ route('login') }}" class="btn btn-outline-secondary" >Iniciar Sesion</a>
                            @if (Route::has('register'))
                            {{-- <a href="{{ route('clientes.create') }}" class="btn btn-outline-secondary">Registrarse</a> --}}
                            @endif
                        @endauth
                    </div>
                @endif
            </div>
        </div>
    </nav>
    <div class="main-content">
        {{-- <p>{{session('eventos')}}</p> --}}
        <br> @yield('content') <br>
    </div>
    <!---Footer-->
    <div class="footer">
        <div class="container">
            <div class="row">
                <div class="footer-col-1">
                    <h3>Descarga nuestra App</h3>
                    <p>Descarga la App android y IOS en tu Smartphone.</p>
                    <div class="app-logo">
                        <i class="fa fa-apple" aria-hidden="true"></i>
                        <i class="fa fa-play" aria-hidden="true"></i>
                    </div>
                </div>
                <div class="footer-col-3">
                    <h3>Enlaces utiles</h3>
                    <ul>
                        <li>Cupones</li>
                        <li>Blogs</li>
                        <li>Unete al Afiliado </li>
                        <li>Politica de Devoluciones</li>
                    </ul>
                </div>
                <div class="footer-col-4">
                    <h3>Redes Sociales</h3>
                    <ul>
                        <li><i class="fa fa-facebook-official" aria-hidden="true"></i></li>
                        <li><i class="fa fa-twitter"></i></li>
                        <li><i class="fa fa-instagram"></i></li>
                        <li><i class="fa fa-youtube"></i></li>
                    </ul>
                </div>
            </div>
            <hr>
            <p class="author"> author:2022</p>
        </div>
    </div>

    <!----js par toggle menu------->
    {{-- <script>


        var buscador=JSON.encode({{Session('eventos')}})
        console.log(buscador);
    </script> --}}

</body>

<script src="{{ asset('assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/js/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
<script src="{{ asset('assets/js/iziToast.min.js') }}"></script>
<script src="{{ asset('assets/js/select2.min.js') }}"></script>
<script src="{{ asset('assets/js/jquery.nicescroll.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<!-- Template JS File -->
{{-- <script src="{{ asset('web/js/stisla.js') }}"></script>
<script src="{{ asset('web/js/scripts.js') }}"></script>
<script src="{{ mix('assets/js/profile.js') }}"></script>
<script src="{{ mix('assets/js/custom/custom.js') }}"></script> --}}
@yield('scripts')

</html>
</html>
