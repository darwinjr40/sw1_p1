<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        body{
            border: 0;
            padding: 0;
        }
        .page-breack{
            page-break-after: always;
        }
        .img{
            width: 100px;
            height: 100px;
        }
        .titulo{
            border: 2px solid #701375;
            border-radius: 2px;
            
        }
        .titulo h1{
            text-align: center;
        }
        .table{
            width: 100%;
            border: 1px solid #701375;
            text-align: center;
        }

        .table tr, td{
            border: 1px solid #701375;
            height: 60px;

        }
    </style>
</head>
<body>

    <header class="titulo">
        <h1> Reporte de Evento: </h1>
        <h1> {{$evento->titulo}} </h1>
    </header>
    <div class="page-brack">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Cliente</th>
                    {{-- <th scope="col">Evento</th> --}}
                    <th scope="col">Ubicacion</th>
                    <th scope="col">Sector</th>
                    <th scope="col">Espacio</th>
                    <th scope="col">Compra</th>
                    <th scope="col">Ingreso</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lista as $ticket)
                <tr>
                    <td>{{ $ticket->cliente }}</td>
                    {{-- <td>{{ $ticket->evento }}</td> --}}
                    <td>{{$ticket->ubicacion}}</td>
                    <td>{{$ticket->sector}}</td>
                    <td>{{$ticket->espacio}}</td>
                    <td>{{$ticket['created_at']}}</td>
                    <td>{{$ticket->fecha_lectura}}</td>                    
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    
</body>
</html>