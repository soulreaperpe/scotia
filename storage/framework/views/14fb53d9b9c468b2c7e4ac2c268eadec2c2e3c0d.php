
<table class="table no-margin">
  <thead>
  <tr>
    <th>Activo</th>
    <th>Codigo</th>
    <th>Nombre</th>
    <th>Proyecto</th>    
    <th>Registrado</th>
    <th></th>
  </tr>
  </thead>
  <tbody>
<?php if(count($empleados)>0): ?>
  <?php $__currentLoopData = $empleados; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $empleado): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <tr>   
    <td><?php echo e($empleado->activo); ?></td>
    <td><?php echo e($empleado->codigo); ?></td>
    <td><a href="#" onclick="infoEmpleado(<?php echo e($empleado->id); ?>)"><?php echo e($empleado->apellidos); ?>, <?php echo e($empleado->nombres); ?></a></td>
    <td><a href="#" onclick="infoProyecto(<?php echo e($empleado->idProyecto); ?>)"><?php echo e($empleado->proyecto); ?></a></td>
    <td><?php echo e(date("d-m-Y",strtotime($empleado->created_at))); ?></td> 
    <td>
      <a href="#" onclick="editarEmpleado(<?php echo e($empleado->id); ?>)">
         <i class="fa fa-fw fa-pencil"></i>
      </a>
    </td>
  </tr>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </tbody>
</table>
<?php else: ?>
    </tbody>
  </table>
  <div align="center">
      <h5>No hay resultados</h5>
  </div>
<?php endif; ?>
<div align="center" id="pg-empleados">
    <?php echo e($empleados->links()); ?>

</div>