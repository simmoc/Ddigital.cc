<?php $__env->startSection('content'); ?>
<div id="page-wrapper" ng-controller="payments_report" ng-init="initAngData()">
			<div class="container-fluid">
				<!-- Page Heading -->
				<section class="content-header">
				<div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
							<li><a href="<?php echo e(URL_DASHBOARD); ?>"><i class="fa fa-home"></i> <?php echo e(getPhrase('home')); ?></a> </li>
							<li><a href="<?php echo e(URL_PAYMENTS_DASHBOARD); ?>"> <?php echo e(getPhrase('payments_dashboard')); ?></a> </li>
						 
							<li class="active"><?php echo e(getPhrase('export_payment_records')); ?></li>
						</ol>
					</div>
				</div>
				</section>
					<?php echo $__env->make('errors.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				<!-- /.row -->
				
 <div class="panel panel-custom col-lg-8 col-lg-offset-2">
 <div class="panel-heading">
 <h1><?php echo e($title); ?> </h1>
					</div>
					<div class="panel-body" >
					<?php $button_name = getPhrase('download_excel'); 

					?>
			 
					<?php echo Form::open(array('url' => URL_PAYMENT_REPORT_EXPORT, 'method' => 'POST', 'name'=>'formQuiz ',  )); ?>

					
					<div class="row">
					<fieldset class='form-group'>
						<?php echo e(Form::label('all_records', getphrase('all_records'))); ?>

						<div class="form-group row">
						<div class="col-md-3">
							<?php echo e(Form::radio('all_records', 1, true, array('id'=>'paid', 'name'=>'all_records', 'ng-model'=>'all_records'))); ?>

								<label for="paid"> <!--<span class="fa-stack radio-button"> <i class="mdi mdi-check active"></i> </span> --><?php echo e(getPhrase('Yes')); ?> </label>
							</div>
							
							
						</div>
					</fieldset>

					
 					
					</div>

					<div class="row">
					 <fieldset class='form-group'>
						<?php echo e(Form::label('payment_type', getphrase('payment_type'))); ?>

						<div class="form-group row">
							<div class="col-md-2">
							<?php echo e(Form::radio('payment_type', 'all', true, array('id'=>'free1', 'name'=>'payment_type'))); ?>

								
								<label for="free1"> <!--<span class="fa-stack radio-button"> <i class="mdi mdi-check active"></i> </span>--> <?php echo e(getPhrase('all')); ?></label> 
							</div>
							<div class="col-md-2">
							<?php echo e(Form::radio('payment_type', 'online', false, array('id'=>'paid1', 'name'=>'payment_type'))); ?>

								<label for="paid1"> <!--<span class="fa-stack radio-button"> <i class="mdi mdi-check active"></i> </span>--> <?php echo e(getPhrase('online')); ?> </label>
							</div>
							<div class="col-md-2">
							<?php echo e(Form::radio('payment_type', 'offline', false, array('id'=>'offline', 'name'=>'payment_type'))); ?>

								<label for="offline"><!-- <span class="fa-stack radio-button"> <i class="mdi mdi-check active"></i> </span>--> <?php echo e(getPhrase('offline')); ?> </label>
							</div>
						</div>
					</fieldset>
					</div>

					<div class="row">
					 <fieldset class='form-group'>
						<?php echo e(Form::label('payment_status', getphrase('payment_status'))); ?>

						<div class="form-group row">
							<div class="col-md-2">
							<?php echo e(Form::radio('payment_status', 'all', true, array('id'=>'payment_status_all', 'name'=>'payment_status'))); ?>

								
								<label for="payment_status_all"> <!--<span class="fa-stack radio-button"> <i class="mdi mdi-check active"></i> </span> --><?php echo e(getPhrase('all')); ?></label> 
							</div>
							<div class="col-md-2">
							<?php echo e(Form::radio('payment_status', 'success', false, array('id'=>'payment_status_success', 'name'=>'payment_status'))); ?>

								<label for="payment_status_success"> <!--<span class="fa-stack radio-button"> <i class="mdi mdi-check active"></i> </span>--> <?php echo e(getPhrase('success')); ?> </label>
							</div>
							<div class="col-md-2">
							<?php echo e(Form::radio('payment_status', 'pending', false, array('id'=>'payment_status_pending', 'name'=>'payment_status'))); ?>

								<label for="payment_status_pending"> <!--<span class="fa-stack radio-button"> <i class="mdi mdi-check active"></i> </span> --><?php echo e(getPhrase('pending')); ?> </label>
							</div>
							<div class="col-md-2">
							<?php echo e(Form::radio('payment_status', 'cancelled', false, array('id'=>'payment_status_cancelled', 'name'=>'payment_status'))); ?>

								<label for="payment_status_cancelled"><!-- <span class="fa-stack radio-button"> <i class="mdi mdi-check active"></i> </span> --><?php echo e(getPhrase('cancelled')); ?> </label>
							</div>
						</div>
					</fieldset>
					</div>
					
						<div class="buttons text-center">
							<button class="btn btn-lg btn-success button"
							 ><?php echo e($button_name); ?></button>
						</div>
					<?php echo Form::close(); ?>

					</div>

				</div>
			</div>
			<!-- /.container-fluid -->
		</div>
		<!-- /#page-wrapper -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
 <?php echo $__env->make('payments.scripts.js-scripts', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

  <script src="<?php echo e(JS); ?>bootstrap-datepicker.min.js"></script>
 <script src="<?php echo e(JS); ?>bootstrap-toggle.min.js"></script>   
    
<?php $__env->stopSection(); ?>
 
 
<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>