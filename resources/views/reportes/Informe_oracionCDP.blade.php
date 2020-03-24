
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
</head>
<body>
    <div class="container-fluid">
        <h1><center>Reporte de Oracion</center></h1>        
        <h6>Encargado: {{ Auth::User()->TabCon->NomCon }} {{ Auth::User()->TabCon->ApeCon }}</h6>
 
        @foreach($lista as $key => $list)
        <h4>Casa de Paz {{ $key }}</h4>        
        <table class="table table-striped table-sm">
            <thead style="border:1px dashed; ">
            <tr>
                <th style="font-size: 11px; font-family: font-family: arial">NOMBRES</th>
                <th style="font-size: 11px; font-family: font-family: arial">LUNES</th>
                <th style="font-size: 11px; font-family: font-family: arial">MARTES</th>
                <th style="font-size: 11px; font-family: font-family: arial">MIÉRCOLES</th>
                <th style="font-size: 11px; font-family: font-family: arial">JUEVES</th>
                <th style="font-size: 11px; font-family: font-family: arial">VIERNES</th>
                <th style="font-size: 11px; font-family: font-family: arial">SABADO</th>
                <th style="font-size: 11px; font-family: font-family: arial">DOMINGO</th>
            </tr>
            </thead>
            <tbody>
            @foreach($lista[$key] as $miembros)
            <tr>
            <td style="font-size: 10px; font-family: font-family: arial">{{ $miembros["Nombre"] }}</td>

            @if($miembros["LU"] == "")
                <td style="font-size: 10px; font-family: font-family: arial; color: red; font-weight: 900;">FALTÓ</td>
            @else
                @if ($miembros["LU"] == 0)
                <td style="font-size: 10px; font-family: font-family: arial; color: blue; font-weight: 900;"></td>                
                @else 
                <td style="font-size: 10px; font-family: font-family: arial; color: blue; font-weight: 900;">ASISTIÓ</td>
                @endif                
            @endif

            @if($miembros["MA"] == "")
                <td style="font-size: 10px; font-family: font-family: arial; color: red; font-weight: 900;">FALTÓ</td>
            @else
                @if ( $miembros["MA"]  == 0)
                <td style="font-size: 10px; font-family: font-family: arial; color: blue; font-weight: 900;"></td>                            
                @else 
                <td style="font-size: 10px; font-family: font-family: arial; color: blue; font-weight: 900;">ASISTIÓ</td>
                @endif                
            @endif

            @if($miembros["MI"] == "")
                <td style="font-size: 10px; font-family: font-family: arial; color: red; font-weight: 900;">FALTÓ</td>
            @else
                @if ( $miembros["MI"]  == 0)
                <td style="font-size: 10px; font-family: font-family: arial; color: blue; font-weight: 900;"></td>                            
                @else 
                <td style="font-size: 10px; font-family: font-family: arial; color: blue; font-weight: 900;">ASISTIÓ</td>
                @endif                
            @endif            

            @if($miembros["JU"] == "")                
                <td style="font-size: 10px; font-family: font-family: arial; color: red; font-weight: 900;">FALTÓ</td>
            @else
                @if ( $miembros["JU"]  == 0)
                <td style="font-size: 10px; font-family: font-family: arial; color: blue; font-weight: 900;"></td>                            
                @else 
                <td style="font-size: 10px; font-family: font-family: arial; color: blue; font-weight: 900;">ASISTIÓ</td>
                @endif                
            @endif            
        
            @if($miembros["VI"] == "")
                <td style="font-size: 10px; font-family: font-family: arial; color: red; font-weight: 900;">FALTÓ</td>                
            @else
                @if ( $miembros["VI"]  == 0)
                <td style="font-size: 10px; font-family: font-family: arial; color: blue; font-weight: 900;"></td>            
                @else 
                <td style="font-size: 10px; font-family: font-family: arial; color: blue; font-weight: 900;">ASISTIÓ</td>
                @endif                
            @endif

            @if($miembros["SA"] == "")
                <td style="font-size: 10px; font-family: font-family: arial; color: red; font-weight: 900;">FALTÓ</td>                
            @else
                @if ( $miembros["SA"]  == 0)
                <td style="font-size: 10px; font-family: font-family: arial; color: blue; font-weight: 900;"></td>            
                @else 
                <td style="font-size: 10px; font-family: font-family: arial; color: blue; font-weight: 900;">ASISTIÓ</td>
                @endif                
            @endif

            @if($miembros["DO"] == "")
                <td style="font-size: 10px; font-family: font-family: arial; color: red; font-weight: 900;">FALTÓ</td>
            @else
                @if ( $miembros["DO"]  == 0)
                <td style="font-size: 10px; font-family: font-family: arial; color: blue; font-weight: 900;"></td>                
                @else 
                <td style="font-size: 10px; font-family: font-family: arial; color: blue; font-weight: 900;">ASISTIÓ</td>
                @endif                
            @endif            

            </tr>
            @endforeach
            </tbody>
        </table>        
        <div style="page-break-after:always;"></div>
        @endforeach
            
    </div>
</body>
</html>