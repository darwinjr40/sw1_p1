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


    <div class="row justify-content-center" >
        <div class="col-md-9">
            <div class="card" >

                <div class="card-header ">
                    <h4 class="font-weight-bold">EVENTOS</h4>
                </div>
                {{-- <div class="container"> --}}
                <h3 style="text-align: center">Lista de fotos Subidas</h3>
                <div style="margin-bottom: 10px; padding: 30px 0px 0px 50px;">
                    <span style="" class="btn btn-primary btn-sm" data-toggle="modal"
                        data-target="#modalAgregarArchivos">
                        {{-- <span class="fas fa-plus-circle"></span> --}}
                        <span class="fas fa-fw fa-plus"></span>
                        Imagenes
                    </span>
                </div>
                {{-- </div> --}}


                {{-- Table de Imagenes --}}
                <div class="col-sm-12" style="margin-bottom: 10px; padding: 10px 50px 50px 50px;">

                    <table class="table table-striped" id="imagenes" border="5">
                        <thead class="thead" style="background-color: #6777eF">
                            <tr>
                                <th style="color:#fff">Nro</th>
                                {{-- <th style="color:#fff">url</th> --}}
                                <th style="color:#fff">imagen</th>
                                <th style="color:#fff">acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($files as $file)
                                <tr>
                                    <td>{{ $file->id }}</td>
                                    {{-- <td>{{ $file->url }}</td> --}}
                                    <td class="border px-14">
                                        <img src="{{ $file->url }}" alt="" width="60%">
                                    </td>
                                    <td>
                                        <form action="{{ route('papers.destroy', $file) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a class="btn btn-sm btn-dark" href="{{ $file->url ? $file->url : '#' }}"><i
                                                    class="fa fa-fw fa-eye"></i></a>
                                            <button type="submit" class="btn btn-danger btn-sm"><i
                                                    class="fa fa-fw fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {{-- Fin Imagenes --}}
            </div>
        </div>
    </div>


    {{-- !--Modal para agregar Fotos --> --}}
    <div class="jumbtron jumbotron-fluid">
        <div class="modal fade" id="modalAgregarArchivos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Imagen</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>

                    <div class="modal-body">

                        <form id="frmImagenes" action="{{ route('papers.store') }}" enctype="multipart/form-data"
                            method="post">
                            @csrf
                            <input type="file" name="files[]" id="archivos" multiple required>
                            <br>
                            <br>
                            <input name="paper_id" type="hidden" value="{{ $paper_id }}" class="hidden">
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
                                <button type="submit" class="btn btn-primary">guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin Modal para agregar Imagenes -->

@endsection
