

<?php $__env->startSection('content'); ?>

<!--SECTION-1 BANNER-->
<section class="login-banner">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h2><?php echo e($record->title); ?></h2>
			</div>
		</div>
	</div>
</section>
<!--/SECTION BANNER-->
<!--section-4 Maintenance-->

<section class="maintenance">
	<div class="container">
		<h2 class="heading heading-center"> <?php echo e($record->title); ?></h2>

		<div class="row  animated fadeInDown">
			<?php echo $record->content; ?>

		</div>
	</div>
</section>

<!--/SECTION-4 Maintenance -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout-site', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>