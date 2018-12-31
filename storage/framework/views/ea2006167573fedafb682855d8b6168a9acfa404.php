
<table class="table no-margin">
  <thead>
  <tr>
    <th>Nombre</th>
    <th>Descripcion</th>
    <th>Inicio</th>
    <th>Fin</th>
  </tr>
  </thead>
  <tbody>
<?php if(!empty($proyectos)): ?>
  <?php $__currentLoopData = $proyectos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proyecto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <tr>
    <td><a href="#" onclick="infoProyecto(<?php echo e($proyecto->id); ?>)"><?php echo e($proyecto->nombre); ?></a></td>
    <td><?php echo e($proyecto->descripcion); ?></td>
    <td><?php echo e(date("d-m-y",strtotime($proyecto->inicio))); ?></td>
    <td><?php echo e(date("d-m-y",strtotime($proyecto->fin))); ?></td>
  </tr>
  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
  </tbody>
</table>
<div align="center" id="pg-proyecto">
    <?php echo e($proyectos->links()); ?>

</div>
<?php else: ?>
    </tbody>
  </table>
  <div align="center">
      <h5>No hay resultados</h5>
  </div>
<?php endif; ?>
