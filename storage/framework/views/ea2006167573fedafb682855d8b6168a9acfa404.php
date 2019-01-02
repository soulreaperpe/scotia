
<table class="table no-margin">
  <thead>
  <tr>
    <th>Nombre</th>
    <th>Descripcion</th>
    <th>Inicio</th>
    <th>Fin</th>
    <th></th>
  </tr>
  </thead>
  <tbody>
<?php if(!empty($proyectos)): ?>
  <?php $__currentLoopData = $proyectos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proyecto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <tr>
    <td><a href="#" onclick="infoProyecto(<?php echo e($proyecto->id); ?>)"><?php echo e($proyecto->nombre); ?></a></td>
    <td><?php echo e($proyecto->descripcion); ?></td>
    <td><?php echo e(date("d-m-Y",strtotime($proyecto->inicio))); ?></td>
    <td><?php echo e(date("d-m-Y",strtotime($proyecto->fin))); ?></td>
    <td>
      <a href="#" onclick="editarProyecto(<?php echo e($proyecto->id); ?>)">
         <i class="fa fa-fw fa-pencil"></i>
      </a>
    </td>
  </tr>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </tbody>
</table>
<div align="center" id="pg-proyectos">
    <?php echo e($proyectos->links()); ?>

</div>
<?php else: ?>
    </tbody>
  </table>
  <div align="center">
      <h5>No hay resultados</h5>
  </div>
<?php endif; ?>
