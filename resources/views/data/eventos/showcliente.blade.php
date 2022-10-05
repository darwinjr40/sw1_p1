@extends('layouts.cliente')
@section('content')
@if (session('success'))
<div class="alert alert-success">
    <strong>{{session('success')}}</strong>
</div>
@endif
<div class="container" style="font-weight: bold;">
    <h2 style="text-align: center;margin: 0 auto 80px; position: relative; line-height: 60px;color: #555;">Eventos Disponibles</h2>
    <div class="row" style="display: flex;align-items: center;flex-wrap: wrap;justify-content: space-around;">
        @foreach ($eventos as $evento)
        <div class="col-4" style="font-size: 14px;">
            <a href="{{route('tickets.addEvento1', $evento->id)}}"><img src="{{$evento->imagenes[0]->path}}" alt="" style="width: 80%;"></a>
            {{-- <a href=""><img src="{{$evento['imagenes'][0]->path}}" alt="" style="width: 80%;"></a> --}}
            {{-- <h1>$evento</h1> --}}
            <h4 style="color: #555; font-weight: normal">{{$evento->titulo}}</h4>
            <div style="color: #ff523b">
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star"></i>
                <i class="fa fa-star-o"></i>
            </div>
            <h4 style="color: #555; font-weight: normal">Descripcion: {{$evento->descripcion}}</h4>
            {{-- @if ($evento->precio!=0)
                <p style="color: #555"></p>
            @endif --}}
        </div>
        @endforeach
    </div>
</div>

@endsection
