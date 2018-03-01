<?php $__env->startSection('content'); ?>

<div id="page-wrapper">
			<div class="container-fluid">
			<section class="content-header">
			<div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
							 <li><a href="<?php echo e(URL_DASHBOARD); ?>"><i class="fa fa-home"></i> <?php echo e(getPhrase('home')); ?></a> </li>
							 <li><a href="<?php echo e(URL_PAYMENTS_DASHBOARD); ?>"> <?php echo e(getPhrase('payments_dashboard')); ?></a> </li>
							<li><?php echo e($title); ?></li>
						</ol>
					</div>
				</div>
           </section>
				 <div class="row">
					<div class="col-md-3">
						<div class="card card-blue text-xs-center">
							<div class="card-block">
								<h4 class="card-title"><?php echo e($payments->all); ?></h4>
								<p class="card-text"><?php echo e(getPhrase('Payments')); ?></p>
							</div>
							<a class="card-footer text-muted" 
							href="<?php if($payment_mode=='online'): ?>
							<?php echo e(URL_ONLINE_PAYMENT_REPORT_DETAILS); ?>

							<?php else: ?> <?php echo e(URL_OFFLINE_PAYMENT_REPORT_DETAILS); ?>

							<?php endif; ?>
							all"
							>
								<?php echo e(getPhrase('view_all')); ?>

							</a>
						</div>
					</div>
					<div class="col-md-3">
						<div class="card card-green text-xs-center">
							<div class="card-block">
								<h4 class="card-title"><?php echo e($payments->success); ?></h4>
								<p class="card-text"><?php echo e(getPhrase('success')); ?></p>
							</div>
							<a class="card-footer text-muted" 
							href="<?php if($payment_mode=='online'): ?>
							<?php echo e(URL_ONLINE_PAYMENT_REPORT_DETAILS); ?>

							<?php else: ?> <?php echo e(URL_OFFLINE_PAYMENT_REPORT_DETAILS); ?>

							<?php endif; ?>
							success"
							>
								<?php echo e(getPhrase('view_all')); ?>

							</a>
						</div>
					</div>

					<div class="col-md-3">
						<div class="card card-black text-xs-center">
							<div class="card-block">
								<h4 class="card-title"><?php echo e($payments->pending); ?></h4>
								<p class="card-text"><?php echo e(getPhrase('pending')); ?></p>
							</div>
							<a class="card-footer text-muted" 
							href="<?php if($payment_mode=='online'): ?>
							<?php echo e(URL_ONLINE_PAYMENT_REPORT_DETAILS); ?>

							<?php else: ?> <?php echo e(URL_OFFLINE_PAYMENT_REPORT_DETAILS); ?>

							<?php endif; ?>
							pending"
							>
								<?php echo e(getPhrase('view_all')); ?>

							</a>
						</div>
					</div>

					<div class="col-md-3">
						<div class="card card-red text-xs-center">
							<div class="card-block">
								<h4 class="card-title"><?php echo e($payments->cancelled); ?></h4>
								<p class="card-text"><?php echo e(getPhrase('cancelled')); ?></p>
							</div>
							<a class="card-footer text-muted" 
							href="<?php if($payment_mode=='online'): ?>
							<?php echo e(URL_ONLINE_PAYMENT_REPORT_DETAILS); ?>

							<?php else: ?> <?php echo e(URL_OFFLINE_PAYMENT_REPORT_DETAILS); ?>

							<?php endif; ?>
							cancelled"
							>
								<?php echo e(getPhrase('view_all')); ?>

							</a>
						</div>
					</div>
					 
			</div>
			<!-- /.container-fluid -->
			
</div>
		<!-- /#page-wrapper -->
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
 
 
 
 

<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>