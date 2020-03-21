
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
        <h1><center>Reporte de Oracion {{ $codcdp }}</center></h1>        
        <h6>Encargado: {{ Auth::User()->TabCon->NomCon }} {{ Auth::User()->TabCon->ApeCon }}</h6>
        <h6>Lider: {{ $nombres }}</h6>
            <table class="table table-striped table-sm">
            <thead style="border:1px dashed; ">
                <tr >                
                <th style="font-size: 12px; font-family: font-family: arial">NOMBRES</th>
                <th style="font-size: 12px; font-family: font-family: arial">ASISTENCIA</th>
                <th style="font-size: 12px; font-family: font-family: arial">DÍA</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($cdp as $c)
            <tr>
                <?php                 
                    $dia = date( "w", strtotime($c->FecAsi));                    
                ?>  

                <td style="font-size: 11px; font-family: font-family: arial">{{ $c->NomApeCon }}</td>

                @if ( $c->Asistio  === 0)                  
                <td style="font-size: 11px; font-family: font-family: arial; color: red; font-weight: 900;">FALTÓ</td>
                @else 
                <td style="font-size: 11px; font-family: font-family: arial; color: blue; font-weight: 900;">ASISTIÓ</td>
                @endif
                
                @if($dia === "1")
                <td style="font-size: 11px; font-family: font-family: arial"><?php echo "Lunes"; ?></td>
                @elseif($dia === "2")
                <td style="font-size: 11px; font-family: font-family: arial"><?php echo "Martes"; ?></td>
                @elseif($dia === "3")
                <td style="font-size: 11px; font-family: font-family: arial"><?php echo "Miércoles"; ?></td>
                @elseif($dia === "4")
                <td style="font-size: 11px; font-family: font-family: arial"><?php echo "Jueves"; ?></td>
                @elseif($dia === "5")
                <td style="font-size: 11px; font-family: font-family: arial"><?php echo "Viernes"; ?></td>
                @elseif($dia === "6")
                <td style="font-size: 11px; font-family: font-family: arial"><?php echo "Sabado"; ?></td>
                @elseif($dia === "0")
                <td style="font-size: 11px; font-family: font-family: arial"><?php echo "Domingo"; ?></td>
                @endif                
            </tr>
            @endforeach                
            
            </tbody>
            </table>
    </div>
</body>
</html>