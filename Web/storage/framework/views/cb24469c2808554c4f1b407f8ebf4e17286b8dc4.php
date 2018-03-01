<?php $__env->startSection('header_scripts'); ?>
<link href="<?php echo e(CSS); ?>ajax-datatables.css" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

 <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="row">
          <div class="col-lg-12">
            <ol class="breadcrumb">
          <li><a href="<?php echo e(URL_DASHBOARD); ?>"><i class="fa fa-home"> <?php echo e(getPhrase('home')); ?></i></a> </li>
              <li><a href="<?php echo e(URL_PRODUCTS_DASHBOARD); ?>"> <?php echo e(getPhrase('products_dashboard')); ?></a> </li>
              <li><a href="<?php echo e(URL_PRODUCTS); ?>"><?php echo e(getPhrase('products')); ?></a> </li>
              <li><a href="<?php echo e(URL_PRODUCT_DETAILS.$product_details->id); ?>"><?php echo e($product_details->name); ?> <?php echo e(getPhrase('dashboard')); ?></a> </li>
              <li><?php echo e($product_details->name); ?> <?php echo e(getPhrase('sales')); ?></li>
                         
            </ol>
          </div>
        </div>
    </section>
      <!-- Main content -->

      <?php if(Auth::user()->role_id == VENDOR_ROLE_ID): ?>
  
  
  <!--SECTION cart DASHBOARD-2-->
    <section class="dashboard2">
        <div class="container">
            <h2><?php echo e(getPhrase('my_dashboard')); ?></h2>
      <?php echo $__env->make('productvendor.menu', array('sub_active' => $sub_active, 'tab' => 'products'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
      <div class="box-header">
      <a href="<?php echo e(URL_PRODUCTS_ADD); ?>" class="btn btn-primary pull-right"><?php echo e(getPhrase('Add')); ?></a>
            </div>
      <div id="history" class="tab-pane fade in active">
        
        <table id="example2" class="table table-bordered table-hover datatable">
          <thead>
                <tr>
          <th><?php echo e(getPhrase('product')); ?></th>         
          <th><?php echo e(getPhrase('product_owner')); ?></th>         
          <th><?php echo e(getPhrase('price')); ?></th>         
          <th><?php echo e(getPhrase('coupon_code')); ?></th>
          <th><?php echo e(getPhrase('discount')); ?></th>
          <th><?php echo e(getPhrase('payment_gateway')); ?></th>
          <th><?php echo e(getPhrase('date')); ?></th>
          <th><?php echo e(getPhrase('customer_name')); ?></th>
          <th><?php echo e(getPhrase('customer_email')); ?></th>
                </tr>
          
                </tr>
                </thead>
                <tbody>
                
                </tbody>
          
          </table>
      </div>
    </div>
  </section>
  <?php else: ?>
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
      
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover datatable">
                <thead>
                <tr>
           <th><?php echo e(getPhrase('product')); ?></th>         
					 <th><?php echo e(getPhrase('product_owner')); ?></th>         
          <th><?php echo e(getPhrase('price')); ?></th>         
          <th><?php echo e(getPhrase('coupon_code')); ?></th>
          <th><?php echo e(getPhrase('discount')); ?></th>
          <th><?php echo e(getPhrase('paid_amount')); ?></th>
          <th><?php echo e(getPhrase('payment_gateway')); ?></th>
          <th><?php echo e(getPhrase('date')); ?></th>
          <th><?php echo e(getPhrase('customer_name')); ?></th>
          <th><?php echo e(getPhrase('customer_email')); ?></th>
                </tr>
					
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

    <?php endif; ?>
    <!-- /.content -->

 <?php $__env->stopSection(); ?>
 
<?php $__env->startSection('footer_scripts'); ?>
<?php echo $__env->make('common.datatables',array('route'=>URL_PRODUCT_SALES_DETAILS_LIST.$product_id,'route_as_url'=>TRUE), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.deletescript', array('route' => URL_PRODUCTS_DELETE), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>