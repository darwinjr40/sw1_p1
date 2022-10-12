@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Crear Eventos</h3>
        </div>
        <div class="section-body">
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            @if ($errors->any())
                                <div class="alert alert-dark alert-dismissible fade show" role="alert">
                                    <strong>¡Revise los campos!</strong>
                                    @foreach ($errors->all() as $error)
                                        <span class="badge badge-danger">{{ $error }}</span>
                                    @endforeach
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Clase">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif

                            <div class="formulario__mensaje" id="mensajeEvento">
                                <p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena
                                    el
                                    formulario correctamente. </p>
                            </div>
                            
                            <form id="frmEventos" action="{{ route('eventos.update', $evento->id) }}" method="POST">
                                @method('PUT')
                                @csrf
                                {{-- mensaje error de js --}}
                                

                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-8">
                                        
                                        
                                        <div class="form-group">
                                            <div class="input-group" id="grupo__titulo">
                                                <span class="input-group-text">
                                                    <i class="fa fa-users"> Titulo</i>
                                                </span>
                                                <input type="text" name="titulo" class="form-control"
                                                    value="{{ old('titulo', $evento->titulo) }}">
                                                <i class="formulario__validacion-estado fas"></i>
                                                @error('capacidad')
                                                    <small style="color: red">*{{ $message }}</small>
                                                @enderror
                                            </div>
                                            <p id="titulo" class="formulario__input-error">*letras, espacios y puede llevar
                                                acentos(minimo 4 y maximo 40 caracteres).</p>
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="fa fa-bars"> Descripcion</i>
                                                </span>
                                                <textarea name="descripcion" id="descripcion" style="height: 100px;width: 450PX;" class="form-control">
                                                {{ $evento->descripcion }}</textarea>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="fa fa-bars"> Estado</i>
                                                </span>
                                                <select name="estado" id="estado" class="form-control">
                                                    <option value="{{ $evento->estado }}">{{ old('estado', $evento->estado) }}</option>
                                                    {{-- <option value="{{($evento->estado == 'desactivado')? 'activado': 'desactivado'}}">{{ ($evento->estado == 'desactivado')? 'activado': 'desactivado'  }}</option> --}}
                                                    <option value="inicio">Inicio</option>
                                                    <option value="proceso">Proceso</option>
                                                    <option value="fin">Fin</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="fa fa-bars"> Categoria</i>
                                                </span>
                                                <select name="id_categoria" id="id_categoria" class="form-control">
                                                    @foreach ($categorias as $item)
                                                        <option value="{{ $item->id }}">{{ $item->nombre }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-text">
                                                    <i class="fa fa-bars"> Contacto</i>
                                                </span>
                                                <select name="id_contacto" id="id_contacto" class="form-control">
                                                    @foreach ($contactos as $item)
                                                        <option value="{{ $item->id }}">
                                                            {{ $item->nombre }}-{{ $item->numero }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                            <a href="{{ route('eventos.index') }}" class="btn btn-danger">Cancelar</a>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>


    <div class="card">
        <div class="card-body">

            <!--Modal para agregar Ubicaciones -->
            <div class="jumbtron jumbotron-fluid">
                <h3 style="text-align: center">Lista de Ubicaciones</h3>
                <div style="margin-bottom: 10px">
                    <span class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modalAgregarUbicaciones">
                        {{-- <span class="fas fa-plus-circle"></span> --}}
                        <span class="fas fa-fw fa-plus"></span>
                        Ubicaciones
                    </span>
                </div>


                <div class="modal fade" id="modalAgregarUbicaciones" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Crear Ubicacion</h5>
                            </div>

                            <div class="modal-body">

                                <form id="frmArchivos" action="{{ route('ubicacions.store') }}"
                                    enctype="multipart/form-data" method="post">
                                    @csrf

                                    <div class="form-group">
                                        <div class="input-group" id="grupo__nombre">
                                            <span class="input-group-text">
                                                <i class="fa fa-users"> Nombre</i>
                                            </span>
                                            <input type="text" name="nombre" class="form-control">
                                            <i class="formulario__validacion-estado fas"></i>
                                            @error('nombre')
                                                <small style="color: red">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <p id="nombre" class="formulario__input-error">*El nombre tiene que ser de 4 a 40
                                            letras y solo puede contener letras, espacios y puede llevar acentos.</p>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group" id="grupo__direccion">
                                            <span class="input-group-text">
                                                <i class="fa fa-users"> Direccion</i>
                                            </span>
                                            <input type="text" name="direccion" class="form-control">
                                            <i class="formulario__validacion-estado fas"></i>
                                            @error('direccion')
                                                <small style="color: red">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <p id="direccion" class="formulario__input-error">*La direccion contener entre 5 y
                                            50 caracteres.</p>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group" id="grupo__telefono">
                                            <span class="input-group-text">
                                                <i class="fa fa-users"> Telefono</i>
                                            </span>
                                            <input type="text" name="telefono" class="form-control">
                                            <i class="formulario__validacion-estado fas"></i>
                                            @error('telefono')
                                                <small style="color: red">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <p id="telefono" class="formulario__input-error">*El telefono solo puede contener
                                            entre 7 y 14 dígitos.</p>
                                    </div>

                                    <div class="form-group">
                                        <div class="input-group" id="grupo__capacidad">
                                            <span class="input-group-text">
                                                <i class="fa fa-users"> capacidad</i>
                                            </span>
                                            <input type="text" name="capacidad" class="form-control">
                                            <i class="formulario__validacion-estado fas"></i>
                                            @error('capacidad')
                                                <small style="color: red">*{{ $message }}</small>
                                            @enderror
                                        </div>
                                        <p id="capacidad" class="formulario__input-error">*Solo acepta Numeros desde 10
                                            hasta 999999.</p>
                                    </div>
                                    {{-- mensaje error de js --}}
                                    <div class="formulario__mensaje" id="formulario__mensaje">
                                        <p><i class="fas fa-exclamation-triangle"></i> <b>Error:</b> Por favor rellena el
                                            formulario correctamente. </p>
                                    </div>
                                    {{-- Mapa Google --}}
                                    <div class="form-group">
                                        {{ Form::label('Seleccione la ubicacion') }}
                                        <div id="map" style="width: 100%; height: 500px;"></div>
                                    </div>
                                    {{-- ocultos --}}
                                    <input id="latitud" name="latitud" type="hidden" value="-17.783290">
                                    <input id="longitud" name="longitud" type="hidden" value="-63.182073">
                                    <input name="evento_id" type="hidden" value="{{ $evento->id }}">


                                    {{-- botones --}}
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-primary">guardar</button>
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">cerrar</button>
                                    </div>

                                </form>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin Modal para agregar Ubicaciones -->

            {{-- Inicio table de Ubicaciones --}}
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-striped" id="ubicaciones" border="3">
                        <thead class="thead" style="background-color: #6777eF">
                            <tr>
                                <th style="color:#fff">Nro</th>
                                <th style="color:#fff">Nombre</th>
                                <th style="color:#fff">Direccion</th>
                                <th style="color:#fff">Telefono</th>
                                <th style="color:#fff">Capacidad</th>
                                <th style="color:#fff">Capacidad Disponible</th>
                                <th style="color:#fff">Precio</th>
                                
                                <th style="color:#fff">acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($ubicacions as $ubicacion)
                                <tr>
                                    <td>{{ $ubicacion->id }}</td>

                                    <td>{{ $ubicacion->nombre }}</td>
                                    <td>{{ $ubicacion->direccion }}</td>
                                    <td>{{ $ubicacion->telefono }}</td>
                                    <td>{{ $ubicacion->capacidad }}</td>
                                    <td>{{ $ubicacion->capacidad_disponible }}</td>
                                    <td>{{ $ubicacion->precio }}</td>
                                    
                                    {{-- <td>{{ $ubicacion->latitud }}</td>
                                    <td>{{ $ubicacion->longitud }}</td> --}}
                                    <td>
                                        <form action="{{ route('ubicacions.destroy', $ubicacion['id']) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <a class="btn btn-sm btn-primary"
                                                href="{{ route('sectors.indexUbicacion', $ubicacion['id']) }}"><i
                                                    class="fas fa-fw fa-plus" title="add Sectores"></i>
                                            </a>

                                            <a class="btn btn-sm btn-dark "
                                                href="{{ route('ubicacions.show', $ubicacion['id']) }}" title="detalles">
                                                <i class="fa fa-fw fa-eye"></i>
                                            </a>


                                            <a class="btn btn-sm btn-success"
                                                href="{{ route('ubicacions.editEvento', $ubicacion['id'], $evento['id']) }}"
                                                title="modificar">
                                                <i class="fa fa-fw fa-edit"></i>
                                            </a>

                                            
                                            <button type="submit" class="btn btn-danger btn-sm" title="eliminar">
                                                <i class="fa fa-fw fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <hr>

                </div>

                {{-- Fin table de Ubicaciones --}}

                {{-- !--Modal para agregar Fotos --> --}}
                <div class="jumbtron jumbotron-fluid">
                    {{-- <div class="container"> --}}
                    <h3 style="text-align: center">Lista de fotos</h3>
                    <div style="margin-bottom: 10px">
                        <span style="" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#modalAgregarArchivos">
                            {{-- <span class="fas fa-plus-circle"></span> --}}
                            <span class="fas fa-fw fa-plus"></span>
                            Imagenes
                        </span>
                    </div>

                    {{-- </div> --}}


                    <div class="modal fade" id="modalAgregarArchivos" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Imagen</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">

                                    <form id="frmImagenes" action="{{ route('imagens.store') }}"
                                        enctype="multipart/form-data" method="post">
                                        @csrf
                                        <input type="file" name="files[]" id="archivos" multiple required>
                                        <br>
                                        <br>
                                        <input name="evento_id" type="hidden" value="{{ $evento->id }}">
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">cerrar</button>
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
                                    <td>{{ $file->path }}</td>

                                    <td>
                                        <form action="{{ route('imagens.destroy', $file) }}" method="POST">
                                            <a class="btn btn-sm btn-dark"
                                                href="{{ $file->path ? $file->path : '#' }}"><i
                                                    class="fa fa-fw fa-eye"></i></a>
                                            {{-- <a class="btn btn-sm btn-success" href="{{ route('imagens.edit', $file) }}"><i
                                                    class="fa fa-fw fa-edit"></i> </a> --}}
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"><i
                                                    class="fa fa-fw fa-trash"></i> </button>
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
@endsection


@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap5.min.css">
    {{-- validacion FrontEnd --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('css/Ubicacion/estilos.css') }}">
@stop

@section('scripts')
    {{-- Validacion FrontEnd --}}
    <script type="text/javascript" src="{{ asset('js/Ubicacion/create1.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/Evento/create1.js') }}"></script>

    {{-- maps --}}
    <script type="text/javascript" src="{{ asset('js/map/mapa2.js') }}"></script>
    <script async src="https://maps.googleapis.com/maps/api/js?key=&callback=initMap"></script>
    {{-- <script async src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAvUexPfr0cJLlaF08zCb1X3aggukbaIAI&callback=initMap"></script> --}}
    {{-- Fin maps --}}


    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/responsive.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#ubicaciones').DataTable({
                responsive: true,
                autoWidth: false,
                "order": [
                    [0, "desc"]
                ],
                "language": {
                    "lengthMenu": "Mostrar _MENU_  registros por pagina",
                    "zeroRecords": "Nada encontrado - disculpa",
                    "info": "Mostrando la pagina _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de _MAX_ regsitros totales)",
                    "search": "Buscar:",
                    "paginate": {
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });
        });

        $(document).ready(function() {
            $('#imagenes').DataTable({
                responsive: true,
                autoWidth: false,
                "order": [
                    [0, "desc"]
                ],
                "language": {
                    "lengthMenu": "Mostrar _MENU_  registros por pagina",
                    "zeroRecords": "Nada encontrado - disculpa",
                    "info": "Mostrando la pagina _PAGE_ de _PAGES_",
                    "infoEmpty": "No hay registros disponibles",
                    "infoFiltered": "(filtrado de _MAX_ regsitros totales)",
                    "search": "Buscar:",
                    "paginate": {
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });
        });
    </script>
@stop
