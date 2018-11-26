@extends('adminlte::layouts.auth')

@section('htmlheader_title')
    Marcacion
@endsection

@section('content')
    <body class="hold-transition login-page">
    <div id="app" v-cloak>
        <div class="login-box">
           

            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> {{ trans('adminlte_lang::message.someproblems') }}<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="login-box-body">
            	<div class="login-logo">
                	<a href="#">Marcación<b> | </b>AlfaGl</a>
            	</div><!-- /.login-logo -->


                <form action="{{ url('/login') }}" method="post">
               		<div class="form-group proyectos">
               	  		<label>Proyecto</label>
               	  		<select class="form-control">
               	  			<option value=""></option>
               	  			@foreach($proyectos as $proyecto)
               	   				<option value="{{$proyecto->id}}">{{$proyecto->nombre}}</option>
               	   			@endforeach
               	  		</select>
               		</div>
               		<div class="form-group empleados">
               	  		<label>Empleado</label>
               	  		<select class="form-control">
               	  		</select>
               		</div>
               		<div class="form-group turnos">
               	  		<label>Turno</label>
               	  		<select class="form-control">
               	  		</select>
               		</div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row">
                        <div class="col-xs-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Entrada</button>
                        </div><!-- /.col -->
                        <div class="col-xs-4 col-xs-offset-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Salida</button>
                        </div><!-- /.col -->
                    </div>
                </form>


            </div><!-- /.login-box-body -->

        </div><!-- /.login-box -->
    </div>

    <script>
    	$(document).ready(function(){
        	getProyectos();
    	});

    	function getProyectos() {
    		
        };



			    $(".proyectos select").change(function() {
					$(".empleados select").empty();
					$.getJSON('asistencia/marcacion/proyecto/'+$(".proyectos select").val()+'/empleados',function(data){
					    $.each(data, function(key,value){
							$(".empleados select").append('<option value="'+value['idEmpleado']+'">'+value['apellidos']+', '+value['nombres']+'</option>');
					    });
					});
			    });

			    $(".proyectos select").change(function() {
					$(".turnos select").empty();
					$.getJSON('asistencia/marcacion/proyecto/'+$(".proyectos select").val()+'/turnos',function(data){
					    $.each(data, function(key,value){
							$(".turnos select").append('<option value="'+value['id']+'">'+value['codigo']+'</option>');
					    });
					});
			    });
			






    </script>
    </body>

@endsection