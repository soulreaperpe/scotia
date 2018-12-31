<div class="row">
    <div class="col-md-3 pull-right">
        <h4><b>Horas:</b></h4>
    </div>
</div>
<table class="table">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Hora Entrada</th>
            <th>Hora Salida</th>
            <th>Tardanza(min)</th>
            <th>Horas</th>
            <th>Observación</th>
        </tr>
    </thead>
    <tbody>
            @foreach($marcacions as $marcacion)
            <tr> 
                <td>
                    {{ date('d-m-Y', strtotime( $marcacion->dia)) }}
                </td>
                <td>
                    @if (!is_null( $marcacion->entrada))
                        {{date('H:i:s', strtotime( $marcacion->entrada))}}
                    @else
                        -
                    @endif
                </td>
                <td>
                    @if (!is_null($marcacion->salida))
                         {{date('H:i:s', strtotime( $marcacion->salida))}}
                    @else
                        -
                    @endif
                </td>
                <td>{{ $marcacion->minutosTardanza}}</td>
                <td>{{$marcacion->horasEfectivas.'h '.$marcacion->minutosEfectivos.'m' }}</td>
                <td>{{$marcacion->observacion}}</td>
            </tr>
            @endforeach
    </tbody>
</table>
