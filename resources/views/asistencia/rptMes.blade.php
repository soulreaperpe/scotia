<div class="row">
	<div class="col-md-3 pull-right">
		<h4><b>Total Trabajado:</b> {{ $totHoras }}</h4>
	</div>
</div>
<table class="table">
	<thead>
		<tr>
			<th></th>
			<th>Fecha</th>
			<th>Hora Entrada</th>
			<th>Hora Salida</th>
			<th>Horas</th>
			<th>Justificación</th>
		</tr>
	</thead>
	<tbody>
	@for ($i = 0; $i < $tot ; $i++)
		<tr 
		@if ( date('D', strtotime( $asistencias[$i][0] )) == 'Sun')
			class="active"
		@elseif(empty($asistencias[$i][1]) && (date('Y-m-d',strtotime($asistencias[$i][0])))<date('Y-m-d') )
			class="danger"
		@endif
		>
			<td>
			@if(!empty($asistencias[$i][1]))
				<a href="#" onclick="detaAsisDia('{{ date('d-m-Y', strtotime( $asistencias[$i][0] )) }}',{{ $cardid }})"><i class="fa fa-file-text-o" aria-hidden="true"></i></a>
			@endif
			</td>
			<td>{{ date('D d \d\e F', strtotime( $asistencias[$i][0] )) }}</td>
			<td>
			@if(!empty($asistencias[$i][1]))
				<span class="time"><i class="fa fa-clock-o"></i> {{ date('H:i:s a', strtotime( $asistencias[$i][1] )) }} </span>				
			@endif
			</td>
			<td>
			@if(!empty($asistencias[$i][2]) && $asistencias[$i][1] != $asistencias[$i][2])
				<span class="time"><i class="fa fa-clock-o"></i> {{ date('H:i:s a', strtotime( $asistencias[$i][2] )) }} </span>				
			@endif
			</td>
			<td>
				{{ $asistencias[$i][3] }}
			</td>
			<td>{{ $asistencias[$i][4] }}</td>
		</tr>
	@endfor()
	</tbody>
</table>
