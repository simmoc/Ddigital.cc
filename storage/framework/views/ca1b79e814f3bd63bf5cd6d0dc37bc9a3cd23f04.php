<?php if(count($errors) > 0 ): ?>
 <div class="alert alert-danger alert-dismissible">
 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<ul class="list-unstyled">
		<?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
		<li><?php echo e($error); ?></li>
		<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	</ul>
</div>
<?php endif; ?>

<?php if(Session::has('flash_message')): ?>
<?php
$type = 'danger';
if(Session::get('flash_message.type') == 'success')
	$type = 'success';
?> 
<div class="alert alert-<?php echo $type;?> alert-dismissible">
 <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
	<ul class="list-unstyled">		
		<li><?php echo e(Session::get('flash_message.text')); ?></li>
	</ul>
</div>
<?php endif; ?>
 
 