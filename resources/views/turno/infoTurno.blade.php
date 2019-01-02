<div class="row">
	<div class="col-md-8">
		<div class="row">
			<div class="col-md-12">
				<h4>{{ $lead->Nombre }}</h4>						
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-md-6">
				<p class="text-muted">{{ $lead->Empresa }}</p>				
			</div>
			<div class="col-sm-6  col-md-6">
				<p class="text-muted">{{ $lead->Correo }}</p>	
			</div>
		</div>
		<div class="row">
			<div class="col-md-12" >
				<strong>Situación actual</strong>		
				<p class="text-muted">{{ $lead->Comentario }}</p>
				<strong>Necesidad del cliente</strong>		
				<p class="text-muted">{{ $lead->Requerimientos }}</p>
			</div>
		</div>		
	</div>
	<div class="col-md-4">	
		<strong>Fecha de Registro</strong>		
		<p class="text-muted">{{ date("d-m-y H:i:s",strtotime($lead->created_at)) }}</p>
		<strong>Fecha de actualizacion</strong>				
		<p class="text-muted">
			@if($lead->updated_at <'2000-01-01')
			 - 
		    @else
		        {{ date("d-m-y H:i:s",strtotime($lead->updated_at)) }}
		    @endif
		</p>
	</div>
</div>



