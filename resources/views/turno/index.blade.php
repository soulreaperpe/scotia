@extends('adminlte::layouts.app')

@section('htmlheader_title')
	Turnos
@endsection

@section('main-content')
	<div class="row">
        <div class="col-md-12">            
            <div class="box box-primary">
                <div class="box-header with-border">
                  <i class="fa fa-clock-o"></i><h3 class="box-title"> Turnos</h3>
                  <div class="box-tools pull-right">
                    <a href="#" onclick="nuevoTurno()">
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
                                <input class="form-control" id="buscarTurno" type="text">
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
                            <div class="table-responsive" id="ListaTurno">                    
                        </div>
                    </div>


                </div>
            <!-- /.box -->
            </div>
        </div>
        <!-- /.col -->
    </div>

	<script>  
	
	    var listarTurno = function() {
	        $.ajax({
	            type: "get",
	            url: "/turno/listar",
	            success: function(data) {            
	                $("#ListaTurno").empty().html(data);            
	            }
	        });
	    };
	    
	    var buscarTurno = function() {
	        var x = document.getElementById("buscarTurno");
	        x.value = x.value.toUpperCase();
	        if (x.value == '') {
	            listarTurno();
	        } else {
	            $.ajax({
	                type: "get",
	                url: "/turno/buscar/" + x.value,
	                success: function(data) {
	                    $("#ListaTurno").empty().html(data);
	                }
	            });
	        }
	    };
	
	    document.getElementById("buscarTurno").onkeyup = function() {
	        buscarTurno()
	    };
	     
	    $(document).ready(function(){
	        listarTurno();
	    });
	</script>
@endsection
