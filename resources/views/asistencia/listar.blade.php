<table class="table">
	<thead>
		<tr>
			<th>Codigo</th>			
			<th>Empleado</th>		
			<th>Turno</th>		
			<th>Entrada</th>	
			<th>Salida</th>	
			<th>Tardanza(mins)</th>	
			<th>Horas Efectivas</th>				
		</tr>
	</thead>
	<tbody>	
@if(!empty($asistencias))	
	
	@foreach($asistencias as $asistencia)
	<tr>
	@if($asistencia->cardid>0)
		<td><i class="fa fa-credit-card" aria-hidden="true"> {{$asistencia->cardid}}</i></td>
		<td>			
			<i class="fa  fa-user" aria-hidden="true"></i> {{$asistencia->nombre.' '.$asistencia->apellido}}
		</td>
		<td>
			<a href="#" onclick="editarEvenAsis({{ $asistencia->id }})">		
			@if($asistencia->event_point_id==1)
				<i class="fa fa-sign-in" aria-hidden="true"></i> Entrada
			@elseif($asistencia->event_point_id==2)
				Salida <i class="fa fa-sign-out" aria-hidden="true"></i>
			@endif	
			</a>
		</td>
		<td>{{ date('d-m-Y H:i:s', strtotime( $asistencia->time)) }}</td>
	@else
		<td><i class="fa  fa-times" aria-hidden="true"></i></td>
		<td>					
			<i class="fa  fa-user-secret" aria-hidden="true"></i>
		</td>
		<td>
			<i class="fa fa-dot-circle-o" aria-hidden="true"></i> Pulsador		
		</td>
		<td>{{ date('d-m-Y H:i', strtotime( $asistencia->time)) }}</td>
	@endif
	<td>{{ $asistencia->description }}</td>
	</tr>
	@endforeach	
@endif

	</tbody>
</table>
<div class="box-footer" align="center"  id="pg-asist">
    {{ $asistencias->links() }}
 </div>