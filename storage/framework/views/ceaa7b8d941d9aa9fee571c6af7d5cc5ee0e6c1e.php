<?php $__env->startSection('header_scripts'); ?>
<link href="<?php echo e(CSS); ?>ajax-datatables.css" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

 <!-- Content Header (Page header) -->
    <section class="content-header">
    <div class="col-lg-12">
            <ol class="breadcrumb">
               <li><a href="<?php echo e(URL_DASHBOARD); ?>"><i class="fa fa-home"></i> <?php echo e(getPhrase('home')); ?></a> </li>
               <li><a href="<?php echo e(URL_PAYMENTS_DASHBOARD); ?>"> <?php echo e(getPhrase('payments_dashboard')); ?></a> </li>
              <li><?php echo e($title); ?></li>
            </ol>
          </div>

</section>
	<!-- Main content -->
    <section class="content">
     
      <div class="row">
          <div class="col-xs-12">
          <div class="box">
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover datatable">
                <thead>
                <tr>
          <th><?php echo e(getPhrase('s_no')); ?></th>
					<th><?php echo e(getPhrase('name')); ?></th>
					<th><?php echo e(getPhrase('email')); ?></th>
					<th><?php echo e(getPhrase('product_name')); ?></th>
					<th><?php echo e(getPhrase('product_owner')); ?></th>
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
<?php echo $__env->make('common.datatables',array('route'=>URL_FREEBIES_REPORT_LIST,'route_as_url'=>TRUE), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>