<?php $__env->startSection('content'); ?>
<?php 
//dd($record); 
?>
<div id="page-wrapper">
			<div class="container-fluid" >
				<!-- Page Heading -->
				<section class="content-header">
				<div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
							<li><a href="<?php echo e(URL_DASHBOARD); ?>"><i class="fa fa-home"></i> <?php echo e(getPhrase('home')); ?></a> </li>
							<li><a href="<?php echo e(URL_LANGUAGES_LIST); ?>"><?php echo e(getPhrase('languages')); ?></a> </li>
							<li class="active"><?php echo e(isset($title) ? $title : ''); ?></li>
						</ol>
					</div>
				</div>
				</section>
				<?php echo $__env->make('errors.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>	
				<div class="panel panel-custom col-lg-6 col-lg-offset-3" >
					<div class="panel-heading">
						<div class="pull-right messages-buttons">
							<a href="<?php echo e(URL_LANGUAGES_LIST); ?>" class="btn  btn-primary button" ><?php echo e(getPhrase('list')); ?></a>
						</div>
					<h1><?php echo e($title); ?>  </h1>
					</div>
					<div class="panel-body form-auth-style" >
					<?php $button_name = getPhrase('create'); ?>
					<?php if($record): ?>

					 <?php $button_name = getPhrase('update'); ?>
						<?php echo e(Form::model($record, 
						array('url' => URL_LANGUAGES_EDIT.'/'. $record->slug, 
						'method'=>'patch','novalidate'=>'','name'=>'formLanguage'))); ?>

					<?php else: ?>
						<?php echo Form::open(array('url' => URL_LANGUAGES_ADD, 'method' => 'POST', 'name'=>'formLanguage ', 'novalidate'=>'')); ?>

					<?php endif; ?>

					 <?php echo $__env->make('languages.form_elements', 
					 array('button_name'=> $button_name),
					 array('record' => $record), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
					<?php echo Form::close(); ?>

					</div>

				</div>
			</div>
			<!-- /.container-fluid -->
		</div>
		<!-- /#page-wrapper -->
		

<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
 <?php echo $__env->make('common.validations', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;
<?php $__env->stopSection(); ?>
 
<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>