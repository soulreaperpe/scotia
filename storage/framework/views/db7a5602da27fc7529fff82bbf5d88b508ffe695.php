<?php $__env->startSection('htmlheader_title'); ?>
    Página no encontrada
<?php $__env->stopSection(); ?>

<?php $__env->startSection('main-content'); ?>

    <div class="error-page">
        <h2 class="headline text-yellow"> 404</h2>
        <div class="error-content">
            <h3><i class="fa fa-warning text-yellow"></i> Oops! Página no encontrada.</h3>
            <p>
                No pudimos encontrar la página que estas buscando.
                Puedes regresar a la <a href='<?php echo e(url( '/')); ?>'>Marcación</a>.
            </p>
        </div><!-- /.error-content -->
    </div><!-- /.error-page -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('adminlte::layouts.errors', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>