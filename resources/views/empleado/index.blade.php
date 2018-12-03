@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Empleados
@endsection

@section('main-content')
	<div class="row">
        <div class="col-md-12">            
            <div class="box box-primary">
                <div class="box-header with-border">
                  <i class="fa fa-users"></i><h3 class="box-title"> Empleados</h3>
                  <div class="box-tools pull-right">
                    <a href="#" onclick="nuevoEmpleado()">
                        <i class="fa fa-plus">
                        </i>
                        <span>
                            Nuevo
                        </span>
                    </a>
                  </div>
                </div>
                <div class="box-body">  
                    <div class="row">
                        <div class="col-md-4 col-sm-6 pull-right">
                            <div class="input-group">
                                <input class="form-control" id="buscarEmpleado" type="text">
                                    <span class="input-group-addon">
                                        <i class="fa fa-search">
                                        </i>
                                    </span>
                                </input>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-md-12">
                            <div class="table-responsive" id="ListaEmpleado">                    
                        </div>
                    </div>


                </div>
            <!-- /.box -->
            </div>
        </div>
        <!-- /.col -->
    </div>

	<script>  
	
	    var listarEmpleado = function() {
	        $.ajax({
	            type: "get",
	            url: "/empleado/listar",
	            success: function(data) {            
	                $("#ListaEmpleado").empty().html(data);            
	            }
	        });
	    };
	    
	    var buscarEmpleado = function() {
	        var x = document.getElementById("buscarEmpleado");
	        x.value = x.value.toUpperCase();
	        if (x.value == '') {
	            listarEmpleado();
	        } else {
	            $.ajax({
	                type: "get",
	                url: "/empleado/buscar/" + x.value,
	                success: function(data) {
	                    $("#ListaEmpleado").empty().html(data);
	                }
	            });
	        }
	    };
	
	    document.getElementById("buscarEmpleado").onkeyup = function() {
	        buscarEmpleado()
	    };
	     
	    $(document).ready(function(){
	        listarEmpleado();
	    });
	</script>
@endsection
