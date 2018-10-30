
<table>
	<thead>
		<tr>
			<th></th>
			<th>Fecha</th>
			<th>Hora Entrada</th>
			<th>Hora Salida</th>
			<th>Horas</th>
			<th>Justificación</th>
			<th>Acciones</th>
		</tr>
	</thead>
	<tbody>
	@for ($i = 0; $i < $tot ; $i++)
		<tr>
			<td></td>
			<td>{{ date('D d \d\e F', strtotime( $asistencias[$i][0] )) }}</td>
			<td>
			@if(!empty($asistencias[$i][1]))
				{{ date('H:i:s a', strtotime( $asistencias[$i][1] )) }}
			@endif
			</td>
			<td>
			@if(!empty($asistencias[$i][2]))
				{{ date('H:i:s a', strtotime( $asistencias[$i][2] )) }}
			@endif
			</td>
			<td>
				{{ $asistencias[$i][3] }}
			</td>
			<td></td>
			<td></td>
		</tr>
	@endfor()
	</tbody>
</table>
{{ date('H:i:s', strtotime( $totHoras ))}}
<p>{{ $totSeg }} Seg</p>
