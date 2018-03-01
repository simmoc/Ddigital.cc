<?php $__env->startSection('content'); ?>

<!--SECTION-1 BANNER-->
<section class="login-banner">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h2>FAQs</h2>
			</div>
		</div>
	</div>
</section>
<!--/SECTION BANNER-->

<!--section-FAQ-->
<section class="faq">
	<div class="container">

		<div class="row  animated fadeInDown">
			<?php if($faqs->count() > 0): ?>
			<div class="col-md-6">
				<div class="panel-group" id="accordation">
					<?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<div class="panel panel-default">
						<div class="panel-heading">
							<h5 class="panel-title">
					  <a data-toggle="collapse" data-parent="#accordation" href="#collapse<?php echo e($faq->id); ?>"><span class="fa <?php echo e($faq->icon); ?>"></span><?php echo e($faq->title); ?></a>
					  </h5>
						</div>
						<div id="collapse<?php echo e($faq->id); ?>" class="panel-collapse collapse ">
							<div class="panel-body">
								<h6> <?php echo e($faq->description); ?></h6>
							</div>
						</div>
					</div>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</div>
			<?php endif; ?>

		</div>
	</div>
</section>
<!--/section-FAQ-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout-site', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>