@extends('adminlte::layouts.app')

@section('htmlheader_title')
    Empleados
@endsection

@section('main-content')
    <div class="row">
        <div class="col-md-12">            
            <div class="box box-primary">
                <div class="box-header with-border">
                  <i class="fa fa-users"></i><h3 class="box-title"> Asistencia</h3>
                  <div class="box-tools pull-right">
                    <a href="#" onclick="nuevaMarcacion()">
                        <i class="fa fa-plus">
                        </i>
                        <span>
                            Marcar
                        </span>
                    </a>
                  </div>
                </div>
                <div class="box-body">  
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive" id="ListaAsistencia">                    
                        </div>
                    </div>


                </div>
            <!-- /.box -->
            </div>
        </div>
        <!-- /.col -->
    </div>

    <script>  
    
        var listarAsistencia = function() {
            $.ajax({
                type: "get",
                url: "/asistencia/listar",
                success: function(data) {            
                    $("#ListaAsistencia").empty().html(data);            
                }
            });
        };        
    
         
        $(document).ready(function(){
            listarAsistencia();
        });
    </script>
@endsection
