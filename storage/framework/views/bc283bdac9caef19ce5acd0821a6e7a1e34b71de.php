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
							<li><a href="<?php echo e(URL_SETTINGS_LIST); ?>"> <?php echo e(getPhrase('settings')); ?></a>  </li>
							<?php if($record->slug=='payu'||$record->slug=='paypal'||$record->slug=='offline-payment'): ?>
							<li><a href="<?php echo e(URL_SETTINGS_VIEW."payment-gateways"); ?>"> <?php echo e(getPhrase('payment_gateways')); ?></a> </li>
							<?php endif; ?>
							<li><?php echo e($title); ?></li>
						</ol>
					</div>
				</div>
				</section>
								
				<!-- /.row -->
				<div class="panel panel-custom col-lg-10 col-lg-offset-1">
					<div class="panel-heading">
						
						<div class="pull-right messages-buttons">
							
							 
						</div>
						<h1><?php echo e($title); ?>


						</h1>

					</div>
					<div class="panel-body packages">
					<div class="row">
						<?php if($record->image): ?>
						<img src="<?php echo e(IMAGE_PATH_SETTINGS.$record->image); ?>" width="100" height="100">
						<?php endif; ?>
					</div>
					
					<?php if( $sub_list->count() > 0 ): ?>
					<div > 
					<table class="table table-striped table-bordered datatable" cellspacing="0" width="100%">
						<thead>
							<tr>
								<th><?php echo e(getPhrase('module')); ?></th>
								<th><?php echo e(getPhrase('key')); ?></th>
								<th><?php echo e(getPhrase('description')); ?></th>
								<th><?php echo e(getPhrase('action')); ?></th>
							</tr>
							<?php $__currentLoopData = $sub_list->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $records): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<tr role="row" class="odd">
								<td class="sorting_1">
								<a href="<?php echo e(URL_SETTINGS_VIEW . $records->slug); ?>"><?php echo e(ucwords($records->title)); ?></a></td>
								<td><?php echo e($records->key); ?></td>
								<td></td>
								<td><a href="<?php echo e(URL_SETTINGS_EDIT . $records->slug); ?>" class="btn btn-warning"><i class="fa fa-edit"></i></a>&nbsp; &nbsp;<a href="<?php echo e(URL_SETTINGS_VIEW.$records->slug); ?>" class="btn btn-primary"><i class="fa fa-eye"></i></a></td>
							</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</thead>
						 
					</table>
					</div>
					<?php else: ?>
					<?php echo Form::open(array('url' => URL_SETTINGS_ADD_SUBSETTINGS.$record->slug, 'method' => 'PATCH', 
						'novalidate'=>'','name'=>'formSettings ', 'files'=>'true')); ?>

						<div class="row"> 
						<ul class="list-group">
						<?php if(count($settings_data)): ?>

						<?php $__currentLoopData = $settings_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php 
							$type_name = 'text';

							if($value->type == 'number' || $value->type == 'email' || $value->type=='password')
								$type_name = 'text';
							else
								$type_name = $value->type;
						?>
						<?php echo $__env->make(
									'mastersettings.settings.sub-list-views.'.$type_name.'-type', 
									array('key'=>$key, 'value'=>$value)
								, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
						  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

						  <?php else: ?>
							  <li class="list-group-item"><?php echo e(getPhrase('no_settings_available')); ?></li>
						  <?php endif; ?>
						</ul>

						</div>

						 

						<?php if(count($settings_data)): ?>
						<div class="buttons text-center clearfix">
							<button class="btn btn-lg btn-primary button" ng-disabled='!formTopics.$valid'
							><?php echo e(getPhrase('update')); ?></button>
						</div>
						<?php endif; ?>
							<?php echo Form::close(); ?>

							
						<?php endif; ?>

					</div>
				</div>
			</div>
			<!-- /.container-fluid -->
		</div>
<?php $__env->stopSection(); ?>
 

<?php $__env->startSection('footer_scripts'); ?>
  <script src="<?php echo e(JS); ?>bootstrap-toggle.min.js"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>