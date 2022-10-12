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
                    <h4 class="font-weight-bold">EVENTOS</h4>
                </div>
                {{-- <div class="container"> --}}
                <h3 style="text-align: center">Fotografos</h3>

                {{-- </div> --}}


                {{-- Table de Imagenes --}}
                <div class="col-sm-12" style="margin-bottom: 10px; padding: 10px 50px 50px 50px;">

                    <table class="table table-striped" id="imagenes" border="5">
                        <thead class="thead" style="background-color: #6777eF">
                            <tr>
                                <th style="color:#fff; ">Nro</th>
                                {{-- <th style="color:#fff">url</th> --}}
                                <th style="color:#fff">nombre</th>
                                <th style="color:#fff;">gmail</th>
                                <th style="color:#fff;">acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fotografos as $f)
                                <tr>
                                    <td>{{ $f->id }}</td>
                                    <td>{{ $f->user->name }}</td>
                                    <td>{{ $f->user->email }}</td>
                                    {{-- <td>{{ $file->url }}</td> --}}
                                    {{-- <td class="border px-14">
                                      <img src="{{ $f->user-> }}" alt="" class="ejemploblur" width="60%">
                                  </td> --}}
                                    <td>
                                        <a class="btn btn-sm btn-dark" href="{{route('aparece.mostrarFotografias', [$f->id, $paper_id])}}"><i
                                                class="fa fa-fw fa-eye"></i></a>
                                        {{-- <form action="{{ route('papers.destroy', $f->id) }}" method="POST">
                                          @csrf
                                          @method('DELETE')
                                          <button type="submit" class="btn btn-danger btn-sm"><i
                                                  class="fa fa-fw fa-trash"></i></button>
                                      </form> --}}
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
@endsection

@section('css')
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/show-cliente/estilos.css') }}"> --}}
    {{-- ejemploblur --}}

@stop
