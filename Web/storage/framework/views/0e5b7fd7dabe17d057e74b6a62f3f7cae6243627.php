<?php $__env->startSection('header_scripts'); ?>
<link href="<?php echo e(CSS); ?>ajax-datatables.css" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

 <!-- Content Header (Page header) -->
<section class="content-header">
	<div class="row">
	<div class="col-lg-12">
	<ol class="breadcrumb">
    <li><a href="<?php echo e(URL_DASHBOARD); ?>"><i class="fa fa-home"></i> <?php echo e(getPhrase('Home')); ?></a> </li>
		<li><a href="<?php echo e(URL_ADMIN_USERS_DASHBOARD); ?>"><?php echo e(getPhrase('users_dashboard')); ?></a> </li>
		<li class="active"><?php echo e(isset($title) ? $title : ''); ?></li>
	</ol>
	</div>
	</div>
</section>
      <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
               <div class="panel-heading">
                    
                        <div class="pull-right messages-buttons">
                              <a href="<?php echo e(URL_IMPORT . 'user'); ?>" class="btn btn-primary pull-right"><?php echo e(getPhrase('Import')); ?></a>
        <a href="<?php echo e(URL_USERS_ADD); ?>" class="btn btn-primary pull-right"><?php echo e(getPhrase('Add')); ?></a>
                             
                        </div>
                        <h2><?php echo e($title); ?></h2>
                    </div>
           
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover datatable">
                <thead>
                <tr>
					<th><?php echo e(getPhrase('Name')); ?></th>
					<th><?php echo e(getPhrase('Email')); ?></th>
					<th><?php echo e(getPhrase('Role')); ?></th>
					<th><?php echo e(getPhrase('Image')); ?></th>
					<th><?php echo e(getPhrase('Action')); ?></th>
                </tr>
                </thead>
                <tbody>
                
                </tbody>
                
              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
 
           
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->

      <!-- /.row -->
    </section>
    <!-- /.content -->

 <?php $__env->stopSection(); ?>
 
<?php $__env->startSection('footer_scripts'); ?>
 <?php echo $__env->make('common.datatables', array('route' => URL_USERS_DATATABLE . $type, 'route_as_url' => TRUE), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
 <?php echo $__env->make('common.deletescript', array('route'=>URL_USERS_DELETE), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>