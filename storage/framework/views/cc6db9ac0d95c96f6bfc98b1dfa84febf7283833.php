<?php $__env->startSection('content'); ?>
     <!-- 404 -->
    <div class="section cs-nopad">
        <div class="container">
            <!-- Tabs -->
            <div class="row cs-row center">
                <h1 class="not-found-heading">404</h1>
                <h2 class="not-found-title">The page you were looking for doesn’t exist</h2>
                <h3 class="not-found-subtitle">You may have mistyped address or the page may have moved.</h3>
                <p style="text-align: center"><a href="<?php echo e(PREFIX); ?>" class="btn btn-primary btn-link">Go to Home page</a></p>
            </div>
        </div>
    </div>
    <!-- 404 -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout-site', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>