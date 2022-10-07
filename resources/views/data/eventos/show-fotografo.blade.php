@extends('layouts.cliente')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            <strong>{{ session('success') }}</strong>
        </div>
    @endif

    {{-- !--Modal para agregar Fotos --> --}}
    <div class="jumbtron jumbotron-fluid">
        {{-- <div class="container"> --}}
        <h3 style="text-align: center">Lista de fotos</h3>
        <div style="margin-bottom: 10px">
            <span style="" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalAgregarArchivos">
                {{-- <span class="fas fa-plus-circle"></span> --}}
                <span class="fas fa-fw fa-plus"></span>
                Imagenes
            </span>
        </div>
        {{-- </div> --}}
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

                        <form id="frmImagenes" action="#" enctype="multipart/form-data"
                            method="post">
                            @csrf
                            <input type="file" name="files[]" id="archivos" multiple required>
                            <br>
                            <br>
                            {{-- <input name="evento_id" type="hidden" value="{{ $evento->id }}"> --}}
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

    {{-- Table de Imagenes --}}
    <div class="col-sm-12">

        <table class="table table-striped" id="imagenes" border="5">
            <thead class="thead" style="background-color: #6777eF">
                <tr>
                    <th style="color:#fff">Nro</th>
                    <th style="color:#fff">url</th>
                    <th style="color:#fff">acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($files as $file)
                    <tr>
                        <td>{{ $file->id }}</td>
                        <td>{{ $file->url }}</td>
                        <td>
                            <form action="{{ route('imagens.destroy', $file) }}" method="POST">
                              @csrf
                              @method('DELETE')
                              <a class="btn btn-sm btn-dark" href="{{ $file->url ? $file->url : '#' }}"><i
                                      class="fa fa-fw fa-eye"></i></a>
                              <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>



    </div>
    {{-- Fin Imagenes --}}
@endsection
