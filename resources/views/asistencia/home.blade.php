@extends('adminlte::layouts.auth')

@section('htmlheader_title')
    Marcacion
@endsection

@section('content')
    <body class="hold-transition login-page">
    <div id="app" v-cloak>
        <div class="login-box">
        	<div class="login-logo">
        		<a href="/home">
            	<img src="{{asset('/img/logoAlfaGl-2.png')}}" alt="dnp-logo"/>
                </a>	
            </div> 
            <div class="login-box-body">
            	    	
<!--
				<a href="#">Marcación<b> | </b>AlfaGl</a>
				<img src="{{asset('/img/logoAlfaGl.png')}}" alt="dnp-logo"/>
/.login-logo -->
            	
				 <p class="login-box-msg"> Marcación</p>
                <form id="formMarcacion" action="#" method="post">
                	<input id="tipo_marcacion" name="tipo_marcacion" value="tipoMarcacion" type="hidden" />
               		<div class="form-group proyectos">
               	  		<label>Proyecto</label>
               	  		<select class="form-control" name="Proyecto">
               	  			<option selected="true" disabled="disabled">Elegir Proyecto</option>
               	  			@foreach($proyectos as $proyecto)
               	   				<option value="{{$proyecto->id}}">{{$proyecto->nombre}}</option>
               	   			@endforeach
               	  		</select>
               		</div>
               		<div class="form-group empleados">
               	  		<label>Empleado</label>
               	  		<select class="form-control" name="Empleado" disabled="true">
               	  		</select>
               		</div>
               		<div class="form-group turnos">
               	  		<label>Turno</label>
               	  		<select class="form-control" name="Turno" disabled="">
               	  		</select>
               		</div>
               		<div class="alert alert-danger print-error-msg" style="display:none">
  						<ul></ul>
					</div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row">
                        <div class="col-xs-4 marcar">
                        	<input class="btn btn-primary btn-block btn-flat marcarEntrada invisible" type="button" value="Entrada">
                        </div><!-- /.col -->
                    </div>
                </form>


            </div><!-- /.login-box-body -->

        </div><!-- /.login-box -->
    </div>

    <script>
    	$(document).ready(function() {
    		$('.select2').select2();
		});

		$(".proyectos select").change(function() {	
			$(".empleados select").empty();
			if ($(".proyectos select").val() > 0) {
    			
				$(".empleados select").append('<option selected="true" disabled="disabled">Elegir Empleado</option>');		
			$.getJSON('asistencia/marcacion/proyecto/'+$(".proyectos select").val()+'/empleados',function(data){				
			    $.each(data, function(key,value){
					$(".empleados select").append('<option value="'+value['idEmpleado']+'">'+value['apellidos']+', '+value['nombres']+'</option>');
			    });
			});
			$('.empleados select').prop("disabled", false);






			} else {

				$('.empleados select').prop("disabled", true);
				$('.turnos select').prop("disabled", true);
				$(".empleados select").empty();
				$(".turnos select").empty();
				$('.marcarEntrada').addClass('invisible');

			}
			
		});


		$(".empleados select").change(function() {
			$('.marcarEntrada').addClass('invisible');
			$(".turnos select").empty();
			$(".turnos select").append('<option selected="true" disabled="disabled">Elegir Turno</option>');

			if ($(".proyectos select").val() > 0 && $(".empleados select").val() > 0) {


				$.getJSON('asistencia/marcacion/proyecto/'+$(".proyectos select").val()+'/turnos',function(data){
			    	$.each(data, function(key,value){
						$(".turnos select").append('<option value="'+value['id']+'">'+value['codigo']+'</option>');
			    	});
				});

				var idEmpleado = $(".empleados select").val();
				$.ajax({					
        			type: 'get',
        			url: '/asistencia/marcacion/tipoMarcacion/' + idEmpleado,
        			success: function(data) {
            			$('#tipo_marcacion').val(data.tipoMarcacion);
            			$('.marcarEntrada').val(data.tipoMarcacion);
        			}
    			});


				$('.turnos select').prop("disabled", false);

			} else {

				$('.turnos select').prop("disabled", true);
				$('.marcarEntrada').addClass('invisible');

			}

		});


		$(".turnos select").change(function() {	
			if ($(".proyectos select").val() > 0 && $(".empleados select").val() > 0 && $(".turnos select").val() > 0) {				
				$('.marcarEntrada').removeClass('invisible');

			} else {

				$('.marcarEntrada').addClass('invisible');

			}

			 
		});

		$('.marcar').on('click', '.marcarEntrada', function(event){        
        	event.preventDefault();    
        	var data = $( "#formMarcacion" ).serialize();
        	$.post( "asistencia/marcacion/marcar", data, function(data){
            	location.reload();
        	});         
    	}); 




    </script>
    </body>

@endsection