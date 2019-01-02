<div class="row">
    <div class="col-md-3 pull-right">
        <h4><b>Horas:</b></h4>
    </div>
</div>
<table class="table">
    <thead>
        <tr>
            <th>Fecha</th>
            <th>Hora Entrada</th>
            <th>Hora Salida</th>
            <th>Tardanza(min)</th>
            <th>Horas</th>
            <th>Observación</th>
        </tr>
    </thead>
    <tbody>
            <?php $__currentLoopData = $marcacions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $marcacion): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr> 
                <td>
                    <?php echo e(date('d-m-Y', strtotime( $marcacion->dia))); ?>

                </td>
                <td>
                    <?php if(!is_null( $marcacion->entrada)): ?>
                        <?php echo e(date('H:i:s', strtotime( $marcacion->entrada))); ?>

                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
                <td>
                    <?php if(!is_null($marcacion->salida)): ?>
                         <?php echo e(date('H:i:s', strtotime( $marcacion->salida))); ?>

                    <?php else: ?>
                        -
                    <?php endif; ?>
                </td>
                <td><?php echo e($marcacion->minutosTardanza); ?></td>
                <td><?php echo e($marcacion->horasEfectivas.'h '.$marcacion->minutosEfectivos.'m'); ?></td>
                <td><?php echo e($marcacion->observacion); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
