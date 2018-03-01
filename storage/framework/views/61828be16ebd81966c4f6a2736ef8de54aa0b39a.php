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
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover datatable">
                <thead>
                <tr>
          <th><?php echo e(getPhrase('product')); ?></th>         
          <th><?php echo e(getPhrase('price')); ?></th>         
          <th><?php echo e(getPhrase('owner_name')); ?></th>         
          <th><?php echo e(getPhrase('coupon_code')); ?></th>
          <th><?php echo e(getPhrase('discount')); ?></th>
          <th><?php echo e(getPhrase('licence_name')); ?></th>
          <th><?php echo e(getPhrase('licence_amount')); ?></th>         
          <th><?php echo e(getPhrase('paid_amount')); ?></th>
          <th><?php echo e(getPhrase('payment_gateway')); ?></th>
          <th><?php echo e(getPhrase('date')); ?></th>
					<th><?php echo e(getPhrase('customer_email')); ?></th>
					
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
<?php echo $__env->make('common.datatables',array('route'=>URL_TOTAL_SALES_GETLIST,'route_as_url'=>TRUE), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>