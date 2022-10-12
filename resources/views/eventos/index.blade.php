@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Eventos</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            {{-- @can('crear-sector') --}}
                                <a class="btn btn-primary" href="{{ route('eventos.create') }}"> Crear Evento</a>
                            {{-- @endcan --}}
                            <table id="tabla" class="table table-striped mt-2" style="width: 100%">
                                <thead style="background-color: #6777eF">
                                    <tr>
                                        <th style="color:#fff">titulo</th>
                                        <th style="color:#fff">Descripcion</th>
                                        <th style="color:#fff">Estado</th>
                                        <th style="color: #fff">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($evento as $sec)
                                        <tr>
                                            <td>{{ $sec->titulo }}</td>
                                            <td>{{ $sec->descripcion }}</td>
                                            <td >{{$sec->estado}}</td>
                                            <td>

                                                <form action="{{ route('eventos.destroy', $sec->id) }}" method="POST">
                                                    @csrf                                                    
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('eventos.edit', $sec->id) }}" title="modificar">
                                                        <i class="fa fa-fw fa-edit"></i>
                                                    </a>
                                                    
                                                    {{-- <a class="btn btn-sm btn-success"
                                                        href="{{ route('eventos.generarReporte', $sec->id) }}" title="Reporte">
                                                        <i class="fa fa-file" aria-hidden="true"></i>
                                                    </a> --}}
                                                    
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" title="eliminar">
                                                        <i class="fa fa-fw fa-trash"></i> </button>
                                                </form>
                                                {{-- {!! Form::open(['method'=>'DELETE','route'=>['eventos.destroy',$sec->id],'style'=>'display:inline']) !!}
                                                        {!! Form::submit('Borrar',['Class'=>'btn btn-danger btn-sm']) !!}
                                                    {!! Form::close() !!} --}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>

                            </table>
                            {{-- {{ $evento->links() }} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


