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
                        <div class="col-xs-4 marcacion">
                          <input class="btn btn-primary btn-block btn-flat marcar invisible" type="button" value="Entrada">
                        </div><!-- /.col -->
                        <div class="col-xs-4 reporte">
                        	<input class="btn btn-primary btn-block btn-flat getReporte invisible" type="button" value="Reporte">
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

    </script>
    </body>

@endsection