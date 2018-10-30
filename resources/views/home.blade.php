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
               		<div class="form-group">
               	  		<label>Proyecto</label>
               	  		<select class="form-control">
               	   			<option>option 1</option>
               	   			<option>option 2</option>
               	   			<option>option 3</option>
               	   			<option>option 4</option>
               	   			<option>option 5</option>
               	  		</select>
               		</div>
               		<div class="form-group">
               	  		<label>Colaborador</label>
               	  		<select class="form-control">
               	   			<option>option 1</option>
               	   			<option>option 2</option>
               	   			<option>option 3</option>
               	   			<option>option 4</option>
               	   			<option>option 5</option>
               	  		</select>
               		</div>
               		<div class="form-group">
               	  		<label>Turno</label>
               	  		<select class="form-control">
               	   			<option>option 1</option>
               	   			<option>option 2</option>
               	   			<option>option 3</option>
               	   			<option>option 4</option>
               	   			<option>option 5</option>
               	  		</select>
               		</div>
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <div class="row">
                        <div class="col-xs-4 col-xs-offset-4">
                            <button type="submit" class="btn btn-primary btn-block btn-flat">Marcar</button>
                        </div><!-- /.col -->
                    </div>
                </form>


            </div><!-- /.login-box-body -->

        </div><!-- /.login-box -->
    </div>

    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
    </body>

@endsection