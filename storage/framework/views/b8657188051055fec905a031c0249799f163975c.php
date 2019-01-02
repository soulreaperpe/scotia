<?php $__env->startSection('htmlheader_title'); ?>
	Proyectos
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>
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
                    	<div class="col-md-4 col-sm-6 alert alert-success print-success-msg" style="display: none;">
                    	</div>
                        <div class="col-md-4 col-sm-6 pull-right">
                            <div class="input-group">
                                <input class="form-control" id="buscarProyecto" type="text" onkeyup="buscarProyecto()">
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
                </div>
                <!-- ./box-body -->
            </div>
        </div>
    </div>

	<script>  	     
	    $(document).ready(function(){
	        listarProyecto();
	    });	
	</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('adminlte::layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>