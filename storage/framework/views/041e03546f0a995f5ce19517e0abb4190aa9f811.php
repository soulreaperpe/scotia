
<table class="table no-margin">
  <thead>
  <tr>
    <th>Codigo</th>
    <th>Descripcion</th>
    <th>Registrado</th>
  </tr>
  </thead>
  <tbody>
<?php if(count($turnos)>0): ?>
  <?php $__currentLoopData = $turnos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $turno): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
  <tr>
    <td><a href="#" onclick="infoLead(<?php echo e($turno->id); ?>)"><?php echo e($turno->codigo); ?></a></td>
    <td><?php echo e($turno->descripcion); ?></td>
    <td><?php echo e(date("d-m-y",strtotime($turno->created_at))); ?></td>
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
<div align="center" id="pg-turno">
    <?php echo e($turnos->links()); ?>

</div>