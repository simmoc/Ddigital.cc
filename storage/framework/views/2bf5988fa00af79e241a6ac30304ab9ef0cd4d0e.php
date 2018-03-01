<?php $__env->startSection('content'); ?>
 <!-- Content Header (Page header) -->
<section class="content-header">
<div class="row">
  <div class="col-lg-12">
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL_DASHBOARD); ?>"><i class="fa fa-home"></i> <?php echo e(getPhrase('Home')); ?></a> </li>
      <li><a  href="<?php echo e(URL_USERS.'all'); ?>"><?php echo e(getPhrase('users')); ?></a></li> 
      <?php if($record): ?>        
      <li><a  href="<?php echo e(URL_USERS.$role_name); ?>"><?php echo e(ucfirst($role_name)); ?> <?php echo e(getPhrase('dashboard')); ?></a></li> 
      <?php endif; ?>        
      <li class="active"><?php echo e(isset($title) ? $title : ''); ?></li>
    </ol>
  </div>
</div>
</section>



 <!-- Main content -->
    <section class="content">
      <div class="row">
        <!-- left column -->
        <div class="col-md-10 col-md-offset-1">
          <!-- general form elements -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo e($title); ?></h3>
            </div>

            <?php echo $__env->make('errors.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <!-- /.box-header -->

            <?php $button_name = 'Create'; ?>
<?php if($record): ?>
<?php $button_name = 'Update'; ?>
<?php echo e(Form::model($record, 
array('url' => URL_USERS_EDIT.$record->slug, 
'method'=>'patch','novalidate'=>'','name'=>'formUsers ', 'files'=>'true' ))); ?>

<?php else: ?>
<?php echo Form::open(array('url' => URL_USERS_ADD, 'method' => 'POST', 'novalidate'=>'','name'=>'formUsers ', 'files'=>'true')); ?>

<?php endif; ?>

<?php echo $__env->make('users.form_elements', array('button_name'=> $button_name, 'record' => $record, 'roles'=>$roles), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo Form::close(); ?>

          
           
          </div>
          <!-- /.box -->
 

        </div>
        <!--/.col (left) -->
      
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<?php echo $__env->make('common.validations', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>