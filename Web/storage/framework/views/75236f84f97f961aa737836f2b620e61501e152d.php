<?php $__env->startSection('header_scripts'); ?>
<link rel="stylesheet" href="<?php echo e(ASSETS); ?>plugins/datepicker/datepicker3.css">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<?php if($record): ?>
<?php 
$menu_id = $record->menu_id;
$menu_slug = $record->menu_slug;
$menu_item_slug = $menu_item_slug;
 ?>
<?php endif; ?>
<!-- Content Header (Page header) -->
<section class="content-header">
<div class="row">
  <div class="col-lg-12">
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL_DASHBOARD); ?>"><i class="fa fa-home"></i> <?php echo e(getPhrase('Home')); ?></a> </li>
       <li><a  href="<?php echo e(URL_MENU_ITEMS.$menu_slug); ?>"><?php echo e(getPhrase('menu_list')); ?></a></li>          
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
array('url' => URL_MENU_ITEMS_EDIT.$record->slug, 
'method'=>'patch','name'=>'formName ', 'files'=>'true' ))); ?>

<?php else: ?>
<?php echo Form::open(array('url' => URL_MENU_ITEMS_ADD . '/' . $menu_slug, 'method' => 'POST', 'name'=>'formName ', 'files'=>'true')); ?>

<?php endif; ?>

<?php echo $__env->make('menu-items.form_elements', array('button_name'=> $button_name, 'record' => $record, 'menu_id' => $menu_id, 'menu_slug' => $menu_slug), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

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
	<?php echo $__env->make('common.editor', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
 
<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>