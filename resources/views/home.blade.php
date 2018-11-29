@extends('adminlte::layouts.auth')

@section('htmlheader_title')
    Marcacion
@endsection

@section('content')
    <body class="hold-transition login-page">
    <div id="app" v-cloak>
        <div class="login-box">
           
            

            <div class="login-box-body">
            	<div class="login-logo">
                	<a href="#">Marcación<b> | </b>AlfaGl</a>
            	</div><!-- /.login-logo -->
            	

                <form id="formMarcacion" action="#" method="post">
               		<div class="form-group proyectos">
               	  		<label>Proyecto</label>
               	  		<select class="form-control" name="Proyecto">
               	  			<option value=""></option>
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
		$(".proyectos select").change(function() {	
			$(".empleados select").empty();
			if ($(".proyectos select").val() > 0) {
    			
				$(".empleados select").append('<option value=""></option>');		
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
			$(".turnos select").empty();
			$(".turnos select").append('<option value=""></option>');


			if ($(".proyectos select").val() > 0 && $(".empleados select").val() > 0) {


				$.getJSON('asistencia/marcacion/proyecto/'+$(".proyectos select").val()+'/turnos',function(data){
			    	$.each(data, function(key,value){
						$(".turnos select").append('<option value="'+value['id']+'">'+value['codigo']+'</option>');
			    	});
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
        	var id = $( "#leadID" ).val();        
        	var data = $( "#formMarcacion" ).serialize();
        	$.post( "asistencia/marcacion/marcar", data, function(data){
            	if ($.isEmptyObject(data.error)) {
                	alert(data.success);
                	listarLeads();
                	$("#myModalMd").modal("hide");
            	} else {
                	//printErrorMsg(data.error);
                	$(".print-error-msg").find("ul").html('');
                	$(".print-error-msg").css('display','block');
                	$.each( data.error, function( key, value ) {
                    	$(".print-error-msg").find("ul").append('<li>'+value+'</li>');
                	});
                	setTimeout(function() {
                    	$(".print-error-msg").fadeOut(1500);
                	},3000);
                	$('.actualizarLead').prop('disabled', false);
            	}

        	});         
    	}); 




    </script>
    </body>

@endsection