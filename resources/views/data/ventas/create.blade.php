@extends('layouts.cliente')

@section('content')
    @if ($errors->any())
        <strong>¡Revise los campos!</strong>
        <div class="alert alert-dark alert-dismissible fade show" role="alert">
            @foreach ($errors->all() as $error)
                <span class="badge badge-danger">{{ $error }}</span>
            @endforeach
            <button type="button" class="close" data-dismiss="alert" aria-label="Clase">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif
    @if (session('success'))
        <div class="alert alert-success">
            <strong>{{ session('success') }}</strong>
        </div>
    @endif



    <div class="row justify-content-center">
        <div class="col-md-9">
            <div class="card">

                <div class="card-header ">
                    <h4 class="font-weight-bold">Seleccione Metodo de Pago</h4>
                </div>
                {{-- <div class="container"> --}}
                <div style="margin-bottom: 10px; padding: 30px 0px 0px 50px;">
                    {{-- Modales --}}
                    {{-- <div class="row"> --}}
                    {{-- <div class="col-7"> --}}
                    {{-- <h2 class="font-weight-bold" style="margin-left: 30%">{{'das'.$p}}</h2> --}}
                    {{-- </div> --}}
                    {{-- Button Pagar ahora --}}
                    <div class="col-10" style="margin-left: 32%">
                     

                        <div style="margin-block: 10px">
                            <button type="button" class="btn btn-default" data-toggle="modal"
                                data-target="#modalTigoMoney">
                                <img src="{{ asset('img/tigo-money.png') }}" height="30" width="75" />
                            </button>
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalTarjeta">
                                <img src="{{ asset('img/tarjeta.png') }}" height="30" width="75" />
                            </button>
                        </div>

                    </div>
                    {{-- </div> --}}
                    {{-- Modales Fin --}}
                </div>
                {{-- </div> --}}



            </div>
        </div>
    </div>



    <div class="modal fade" id="modalTigoMoney" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><img src="{{ asset('img/tigo-money.png') }}"
                            height="35" width="95" /></h5>
                </div>
                <div class="modal-body">

                    <form action="{{ route('ventas.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-8">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fa fa-address-card"> CI/NIT</i>
                                        </span>
                                        <input type="number" id="nit" name="nit" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fa fa-user-circle"> Nombre</i>
                                        </span>
                                        <input type="text" id="cliente" name="cliente" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fa fa-mobile"> Celular</i>
                                        </span>
                                        <input type="text" id="nro" name="nro" class="form-control">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
                                    <button class="btn btn-info" type="submit"><i class="fa fa-credit-card"
                                            aria-hidden="true"></i> Pagar ahora</button>
                                </div>

                            </div>
                        </div>
                        <input type="hidden" name="pago" value="{{ 'tigo money' }}">
                        <input type="hidden" name="paper_id" value="{{ $p }}">
                        <input type="hidden" name="b" value="{{ json_encode($b) }}">
                        

                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="modalTarjeta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <img src="{{ asset('img/tarjeta.png') }}" height="35" width="95" />
                    </h5>
                </div>
                <div class="modal-body">

                    <form action="{{ route('ventas.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-8">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fa fa-address-card"> CI/NIT</i>
                                        </span>
                                        <input type="number" id="nit" name="ci" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fa fa-user-circle"> Nombre</i>
                                        </span>
                                        <input type="text" id="cliente" name="cliente" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fa fa-credit-card"> Nro Tarjeta</i>
                                        </span>
                                        <input type="text" id="nro" name="nro" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">

                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fa fa-calendar"> Fecha de Expiracion</i>
                                        </span>
                                        <input type="datetime-local" id="expiracion" name="fecha"
                                            class="form-control" value="{{ Date('Y-m-d\TH:i', time()) }}">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fa fa-credit-card"> CVC</i>
                                        </span>
                                        <input type="number" id="cvc" name="cvc" class="form-control"
                                            max="999" min="100">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    <button class="btn btn-info" type="submit"><i class="fa fa-credit-card"
                                            aria-hidden="true"></i> Pagar ahora</button>
                                </div>
                                {{-- oculto --}}
                                <input type="hidden" name="pago" value="{{ 'banco' }}">
                                <input type="hidden" name="paper_id" value="{{ $p }}">
                                <input type="hidden" name="b" value="{{ json_encode($b) }}">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- maps --}}

    {{-- <script async src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap"></script> --}}


    {{-- <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAvUexPfr0cJLlaF08zCb1X3aggukbaIAI&callback=initMap"></script> --}}
    {{-- Fin maps --}}



@stop
@section('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/show-cliente/estilos.css') }}">
    {{-- ejemploblur --}}

@stop
