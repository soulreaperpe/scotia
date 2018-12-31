<?php $__env->startSection('htmlheader_title'); ?>
    Marcacion
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <body class="hold-transition login-page">
    <div id="app" v-cloak>
        <div class="login-box">
            <div class="login-logo">
                <a href="/home">
                <img src="<?php echo e(asset('/img/logoAlfaGl-2.png')); ?>" alt="dnp-logo"/>
                </a>    
            </div> 
            <div class="login-box-body">
                        
<!--
                <a href="#">Marcación<b> | </b>AlfaGl</a>
                <img src="<?php echo e(asset('/img/logoAlfaGl.png')); ?>" alt="dnp-logo"/>
/.login-logo -->
                
                 <p class="login-box-msg"> Marcación</p>

                <div class="alert alert-danger print-error-msg" style="display:none">
                    <ul></ul>
                </div>
                <div class="alert alert-success print-success-msg" style="display:none">
                    <ul></ul>
                </div>

                <form id="formMarcacion" action="#" method="post">
                    <input id="tipo_marcacion" name="tipo_marcacion" value="tipoMarcacion" type="hidden" />
                    <div class="form-group proyectos">
                        <label>Proyecto</label>
                        <select class="form-control" name="Proyecto">                            
                        </select>
                    </div>
                    <div class="form-group empleados">
                        <label>Empleado</label>
                        <select class="form-control" name="Empleado" disabled="true">
                        </select>
                    </div>
                    <div class="form-group turnos">
                        <label>Turno</label>
                        <select class="form-control" name="Turno" disabled="true">
                        </select>
                    </div>
                    <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>">
                    <div class="row">
                        <div class="col-xs-4 marcacion">
                            <input class="btn btn-primary btn-block btn-flat marcar invisible" type="button" value="Entrada">
                        </div><!-- /.col -->
                        <div class="col-xs-4 col-xs-offset-4 reporte">
                            <input class="btn btn-primary btn-block btn-flat getReporte invisible" type="button" value="Reporte">
                        </div><!-- /.col -->
                    </div>
                </form>


            </div><!-- /.login-box-body -->

        </div><!-- /.login-box -->
    </div>

    <script>
        
        $(document).ready(function() {            
            selectProyectos();
        });

        var  selectProyectos= function() {
            $(".proyectos select").empty(); 
            $.getJSON('/asistencia/marcacion/proyectos',function(data){ 
                $(".proyectos select").append('<option selected="true" disabled="disabled">Elegir Proyecto</option>');         
                $.each(data, function(key,value){
                    $(".proyectos select").append('<option value="'+value['id']+'">'+value['nombre']+'</option>');  
                });
            });            
        };


        var  selectEmpleados= function() {
            $(".empleados select").empty();                  
            $.getJSON('asistencia/marcacion/proyecto/'+$(".proyectos select").val()+'/empleados',function(data){   
                $(".empleados select").append('<option selected="true" disabled="disabled">Elegir Empleado</option>');             
                $.each(data, function(key,value){
                    $(".empleados select").append('<option value="'+value['idEmpleado']+'">'+value['apellidos']+', '+value['nombres']+'</option>');
                });
            });       
        };


        var  selectTurnos= function() {            
            $(".turnos select").empty();
            $.getJSON('asistencia/marcacion/proyecto/'+$(".proyectos select").val()+'/turnos',function(data){
                $(".turnos select").append('<option selected="true" disabled="disabled">Elegir Turno</option>');
                $.each(data, function(key,value){
                    $(".turnos select").append('<option value="'+value['id']+'">'+value['codigo']+'</option>');
                });
            });      
        };


        $(".proyectos select").change(function() {  
            
            if ($(".proyectos select").val() > 0) {
                selectEmpleados();
                $('.empleados select').prop("disabled", false); 
                $('.turnos select').prop("disabled", true);
                $(".turnos select").empty();
            } else {
                $('.empleados select').prop("disabled", true);
                $('.turnos select').prop("disabled", true);
                $(".empleados select").empty();
                $(".turnos select").empty();
                $('.marcar').addClass('invisible');
            }
            
        });


        $(".empleados select").change(function() {
            $('.marcar').addClass('invisible');                        

            if ($(".proyectos select").val() > 0 && $(".empleados select").val() > 0) {

                selectTurnos();

                var idEmpleado = $(".empleados select").val();
                $.ajax({                    
                    type: 'get',
                    url: '/asistencia/marcacion/tipoMarcacion/' + idEmpleado,
                    success: function(data) {
                        $('#tipo_marcacion').val(data.tipoMarcacion);
                        $('.marcar').val(data.tipoMarcacion);
                    }
                });


                $('.turnos select').prop("disabled", false);
                $('.getReporte').removeClass('invisible');

            } else {

                $('.turnos select').prop("disabled", true);
                $('.marcar').addClass('invisible');

            }

        });


        $(".turnos select").change(function() { 
            if ($(".proyectos select").val() > 0 && $(".empleados select").val() > 0 && $(".turnos select").val() > 0) {                
                $('.marcar').removeClass('invisible');               

            } else {

                $('.marcar').addClass('invisible');

            }

             
        });

        $('.marcacion').on('click', '.marcar', function(event){        
            event.preventDefault();    
            var data = $( "#formMarcacion" ).serialize();
            $.post( "asistencia/marcacion/marcar", data, function(data){
                


            if ($.isEmptyObject(data.error)) {

                selectProyectos();
                $('.empleados select').prop("disabled", true);
                $('.turnos select').prop("disabled", true);
                $(".empleados select").empty();
                $(".turnos select").empty();
                $('.marcar').addClass('invisible');
                $('.getReporte').addClass('invisible');    

                //printSuccesMsg(data.success);    
                $(".print-success-msg").find("ul").html('');
                $(".print-success-msg").css('display','block');
                
                $(".print-success-msg").find("ul").append('<li>'+data.success+'</li>');
               
                setTimeout(function() {
                    $(".print-success-msg").fadeOut(1500);
                },1500);        

            } else {
                //printErrorMsg(data.error);
                $(".print-error-msg").find("ul").html('');
                $(".print-error-msg").css('display','block');
                
                $(".print-error-msg").find("ul").append('<li>'+data.error+'</li>');
               
                setTimeout(function() {
                    $(".print-error-msg").fadeOut(1500);
                },3000);
            }


            });         
        });

        $('.reporte').on('click', '.getReporte', function(event){        
            event.preventDefault();    
            var data = $( "#formMarcacion" ).serialize();
            $.post( "asistencia/reporte/empleado", data, function(data){
                $('#tituloModalLg').empty().html('<i class="fa fa-calendar"></i> Reporte');
                $('#contentModalLg').empty().html(data);
                
                $("#myModalLg").modal({backdrop: "static"});
            });         
        }); 

    </script>
    </body>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::layouts.auth', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>