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
                    <h4 class="font-weight-bold">Tus Fotos</h4>
                </div>
                {{-- <div class="container"> --}}
                <div style="margin-bottom: 10px; padding: 30px 0px 0px 50px;">
                    {{-- Modales --}}
                    {{-- <div class="row"> --}}
                    {{-- <div class="col-7"> --}}
                    <h2 class="font-weight-bold" style="margin-left: 30%">Metodos de Pago</h2>
                    {{-- </div> --}}
                    {{-- Button Pagar ahora --}}
                    <div class="col-10" style="margin-left: 0%">
                        <form action="{{ route('ventas.preStore') }}" method="POST">
                            @csrf
                            <div class="col-sm-12" style="margin-bottom: 10px; padding: 10px 50px 50px 50px;">
                                <button class="btn btn-info" type="submit"><i class="fa fa-credit-card"
                                        aria-hidden="true"></i>
                                    Pagar ahora</button>
                                {{-- Table de Imagenes --}}
                                <input id="evento" type="hidden" name="paper_id" value="{{ $paper_id }}">
                                <table class="table table-striped" id="imagenes" border="5">
                                    <thead class="thead" style="background-color: #6777eF">
                                        <tr>
                                            <th style="color:#fff; width: 10%">Nro</th>
                                            {{-- <th style="color:#fff">url</th> --}}
                                            <th style="color:#fff">imagen</th>
                                            {{-- <th style="color:#fff; width: 5%">acciones</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($apareces as $a)
                                            <tr>
                                                {{-- <td>{{ $a->url }}</td> --}}
                                                @if ($a->venta_id == 0)
                                                    <td align="center" style="padding-top: 12%">
                                                        <input type="checkbox" name="b[]"
                                                            value="{{ $a->paper_file_id }}">
                                                    </td>
                                                    <td class="border px-14">
                                                        <img src="{{ $a->url }}" alt="" class="ejemploblur"
                                                            width="60%">
                                                    </td>
                                                @else
                                                    <td></td>
                                                    <td class="border px-14">
                                                        <img src="{{ $a->url }}" alt="" width="60%">
                                                        <a class="btn btn-sm btn-dark"
                                                            href="{{ $a->url ? $a->url : '#' }}"><i
                                                                class="fa fa-fw fa-eye"></i></a>
                                                    </td>
                                                @endif

                                                {{-- <td> --}}
                                                    {{-- <form action="{{ route('papers.destroy', $file->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <a class="btn btn-sm btn-dark" href="{{ $file->url ? $file->url : '#' }}"><i
                                                            class="fa fa-fw fa-eye"></i></a>
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="fa fa-fw fa-trash"></i></button>
                                                </form> --}}
                                                {{-- </td> --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            {{-- Fin Imagenes --}}

                            {{-- oculto --}}
                            {{-- <input id="evento" type="hidden" name="evento_id"
                                    value="{{ isset($ubicaciones) ? $ubicaciones[0]->evento_id : '' }}"> --}}
                        </form>

                        {{-- <div style="margin-block: 10px">
                            <button type="button" class="btn btn-default" data-toggle="modal"
                                data-target="#modalTigoMoney">
                                <img src="{{ asset('img/tigo-money.png') }}" height="30" width="75" />
                            </button>
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#modalTarjeta">
                                <img src="{{ asset('img/tarjeta.png') }}" height="30" width="75" />
                            </button>
                        </div> --}}

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
                                        <input type="number" id="ci" name="ci" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fa fa-user-circle"> Nombre</i>
                                        </span>
                                        <input type="text" id="nombre" name="nombre" class="form-control">
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
                        <input type="checkbox" name="items[]">

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
                                        <input type="number" id="ci" name="ci" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fa fa-user-circle"> Nombre</i>
                                        </span>
                                        <input type="text" id="nombre" name="nombre" class="form-control">
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
                                        <input type="datetime-local" id="expiracion" name="expiracion"
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
