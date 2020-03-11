
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
    <div class="container">
        <p style="text-align: right; font-size: 12px" >Fecha de impresión: {{ $fecha }}</p>
        <p style="text-align: right; font-size: 12px">Fecha del reporte: {{ $informes->FecInf }}</p>
            <div class="form-group">
                <p style="font-size: 14px;"><strong>CASA DE PAZ: {{ $informes->CodCasPaz }}</strong></p>
            </div>                                 
            <h4 style="color: red; font-size: 16px;">NOMBRE DEL LIDERAZGO</h4>
            <div class="form-group">
                <label style=" font-size: 12px;" for="exampleInputEmail1"><strong>MENTOR: </strong> {{ $mentor->ApeCon }} {{ $mentor->NomCon }}</label>
            </div>
            <div class="form-group">
                <label style=" font-size: 12px;" for="exampleInputEmail1"><strong>LIDER: </strong> {{ $lider->ApeCon }} {{ $lider->NomCon }}</label>
            </div>   
            <h4 style="color: red; font-size: 16px;">TEMA Y OFRENDA</h4>
            <div class="form-group">
                <label style=" font-size: 12px;" for="exampleInputEmail1"><strong>TEMA: </strong> {{ $informes->TemaSem }}</label>                
            </div>
            <div class="form-group">
                <label style=" font-size: 12px;" for="exampleInputEmail1"><strong>OFRENDA: </strong> S/.{{ $informes->OfreReu }}</label>
            </div>
            <h4 style="color: red; font-size: 16px;">ASISTENCIA</h4>
            <div class="form-group">
                <label style=" font-size: 12px;" for="exampleInputEmail1"><strong>ASISTIERON: </strong> {{ $informes->TotAsiReu }} MIEMBROS</label>
            </div>
            <div class="form-group">
                <label style=" font-size: 12px;" for="exampleInputEmail1"><strong>NO ASISTIERON: </strong> {{ $informes->TotAusReu }} MIEMBROS</label>
            </div>
            <table class="table table-striped table table-sm">
            <thead>
                <tr>
                <th scope="col">NOMBRES</th>
                <th scope="col">ASISTIO</th>
                <th scope="col">TIPO DE CONGREGANTE</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($asistencia as $asis)
                    <tr>
                        <td style="font-size: 11px;"> {{ $asis->ApeCon }} {{ $asis->NomCon }}</td>
                        @if ($asis->AsiReu === 'NO')
                        <td style="color: red; font-size: 11px;">{{ $asis->AsiReu }}</td>
                        @elseif ($asis->AsiReu === 'SI')
                        <td style="color: blue; font-size: 11px;">{{ $asis->AsiReu }}</td>
                        @elseif ($asis->AsiReu === 'JU')
                        <td style="color: blue; font-size: 11px;">{{ $asis->AsiReu }}</td>
                        @endif
                        <td style="font-size: 11px;">{{ $asis->TipCon }}</td>
                    </tr>
                @endforeach
            </tbody>
            </table>
                          
    </div>
</body>
</html>