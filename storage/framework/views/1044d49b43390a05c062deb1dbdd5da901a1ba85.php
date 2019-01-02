<div class="alert alert-danger print-error-msg" style="display:none">
  <ul></ul>
</div>
<div class="row">
    <form  class="form box-body" id="formNuevoEmpleado"> 
        <?php echo csrf_field(); ?>
        <input id="idEmpleado" name="idEmpleado" value="<?php echo e($empleado->id); ?>" hidden="" type="number" />
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Código</label>
                    <input type="text" placeholder="Codigo" name="Codigo" value="<?php echo e($empleado->codigo); ?>" class="form-control" autocomplete="off">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label>Nombres</label>
                    <input type="text" placeholder="Nombres" name="Nombres" value="<?php echo e($empleado->nombres); ?>" autofocus="autofocus" class="form-control" autocomplete="off">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label>Apellidos</label>
                    <input type="text" placeholder="Apellidos" name="Apellidos" value="<?php echo e($empleado->apellidos); ?>" class="form-control" autocomplete="off">
                </div>
            </div>
        </div>  
        <div class="row">
            <div class="col-md-6">
                <div class="form-group proyectos">
                    <label>Proyecto</label>
                    <select class="form-control" name="Proyecto">     
                        <option value="0"></option>
                    <?php $__currentLoopData = $proyectos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proyecto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?> 
                        <option value="<?php echo e($proyecto->id); ?>" <?php if(!empty($empleadosproyecto)>0): ?> <?php if($empleadosproyecto->idProyecto == $proyecto->id): ?> selected="selected" <?php endif; ?> <?php endif; ?>> 
                            <?php echo e($proyecto->nombre); ?> 
                        </option> 
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                       
                    </select>
                </div>
            </div>
        </div>        
        <div class="row">
            <div class="col-md-12">
                <div class="form-group pull-right">
                    <button class="btn btn-primary actionBtn" id="footer_action_button" type="submit">
                        Grabar
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>