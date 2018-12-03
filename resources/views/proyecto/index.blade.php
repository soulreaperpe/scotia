@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Proyectos
@endsection

@section('main-content')
	<div class="row">
        <div class="col-md-12">            
            <div class="box box-primary">
                <div class="box-header with-border">
                  <i class="fa fa-briefcase"></i><h3 class="box-title"> Proyectos</h3>
                  <div class="box-tools pull-right">
                    <a href="#" onclick="nuevoProyecto()">
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
                                <input class="form-control" id="buscarProyecto" type="text">
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
                            <div class="table-responsive" id="ListaProyecto">                    
                        </div>
                    </div>


                </div>
            <!-- /.box -->
            </div>
        </div>
        <!-- /.col -->
    </div>

	<script>  
	
	    var listarProyecto = function() {
	        $.ajax({
	            type: "get",
	            url: "/proyecto/listar",
	            success: function(data) {            
	                $("#ListaProyecto").empty().html(data);            
	            }
	        });
	    };
	    
	    var buscarProyecto = function() {
	        var x = document.getElementById("buscarProyecto");
	        x.value = x.value.toUpperCase();
	        if (x.value == '') {
	            listarProyecto();
	        } else {
	            $.ajax({
	                type: "get",
	                url: "/proyecto/buscar/" + x.value,
	                success: function(data) {
	                    $("#ListaProyecto").empty().html(data);
	                }
	            });
	        }
	    };
	
	    document.getElementById("buscarProyecto").onkeyup = function() {
	        buscarProyecto()
	    };
	     
	    $(document).ready(function(){
	        listarProyecto();
	    });
	</script>
@endsection
