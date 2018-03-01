<?php $__env->startSection('header_scripts'); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>


<div id="page-wrapper">
			<div class="container-fluid">
				<!-- Page Heading -->
				<section class="content-header">
				<div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
							<li><a href="<?php echo e(URL_DASHBOARD); ?>"><i class="fa fa-home"></i> <?php echo e(getPhrase('home')); ?></a> </li>
							<li><a href="<?php echo e(URL_LANGUAGES_LIST); ?>"><?php echo e(getPhrase('languages')); ?></a> </li>
							<li><?php echo e($title); ?></li>
						</ol>
					</div>
				</div>
				</section>
					<?php $language_data = json_decode($record->phrases);?>			
				<!-- /.row -->
				<div class="panel panel-custom">
					<div class="panel-heading">
						
						<h1><?php echo e($title); ?></h1>
					</div>
					<div class="panel-body packages">
					<?php echo Form::open(array('url' => URL_LANGUAGES_UPDATE_STRINGS.$record->slug, 'method' => 'PATCH', 
						'novalidate'=>'','name'=>'formSettings ', 'files'=>'true')); ?>

						<div class="table-responsive"> 
						<ul class="list-group">
						<?php if(count($language_data)): ?>
						<?php $__currentLoopData = $language_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						 
					 <div class="col-md-6">
						<fieldset class="form-group">
						   <?php echo e(Form::label($key, getPhrase($key))); ?>

						  
						   <input type="text" class="form-control" name="<?php echo e($key); ?>" 
					 		required="true" value = "<?php echo e($value); ?>" >
					 		 

							</fieldset>
							</div>

						  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

						  <?php else: ?>
							  <li class="list-group-item"><?php echo e(getPhrase('no_strings_available')); ?></li>
						  <?php endif; ?>
						</ul>

						</div>

						<?php if(count($language_data)): ?>
						<div class="buttons text-center">
							<button class="btn btn-lg btn-success button" ng-disabled='!formTopics.$valid'
							><?php echo e(getPhrase('update')); ?></button>
						</div>
						<?php endif; ?>
							<?php echo Form::close(); ?>

					</div>
				</div>
			</div>
			<!-- /.container-fluid -->
		</div>
<?php $__env->stopSection(); ?>
 

<?php $__env->startSection('footer_scripts'); ?>
  
 
 

<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>