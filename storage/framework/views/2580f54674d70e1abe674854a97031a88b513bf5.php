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
      <li><a  href="<?php echo e(URL_ADMIN_USERS_DASHBOARD); ?>"><?php echo e(getPhrase('users_dashboard')); ?></a></li>         
      <li><a  href="<?php echo e(URL_USERS_CUSTOMER_DETAILS.$record->slug); ?>"><?php echo e($record->name); ?> <?php echo e(getPhrase('details')); ?></a></li>         
      <li class="active"><?php echo e(isset($title) ? $title : ''); ?></li>
    </ol>
  </div>
</div>
    </section>

<?php if(Auth::user()->role_id == USER_ROLE_ID): ?>
  
   <section class="login-banner">
        <div class="container">
            <div class="row">
                <div class="div col-sm-12">
                    <h2><?php echo e(Auth::user()->name); ?></h2>
                    <ol class="breadcrumb">
                        <li><a href="<?php echo e(URL_VENDOR_DASHBOARD); ?>"><?php echo e(getPhrase('dashboard')); ?></a></li>
                        <li><a href="<?php echo e(URL_USERS_CUSTOMER_DETAILS.Auth::user()->slug); ?>"><?php echo e(getPhrase('profile')); ?></a></li>
                        <li><a href="#" ><?php echo e(getPhrase('sales_list')); ?></a></li>
                  </ol>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>

<div class="container pad">
  <div class="col-lg-12">
  <h3><?php echo e($record->name); ?> <?php echo e(getPhrase('downloads')); ?></h3>
</div>
      <!-- Main content -->
<section class="content">
    
      <div class="row">
        <div class="col-xs-12">
          <div class="box">
      
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover datatable">
                <thead>
                <tr>
          <th><?php echo e(getPhrase('s.no')); ?></th>
					<th><?php echo e(getPhrase('product_name')); ?></th>
					
				  <th><?php echo e(getPhrase('date')); ?></th>
										
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
</div>
    <!-- /.content -->

 <?php $__env->stopSection(); ?>
 
<?php $__env->startSection('footer_scripts'); ?>
<?php echo $__env->make('common.datatables',array('route'=>URL_CUSTOMERS_DOWNLOADED_PRODUCTS_LIST.$user_slug,'route_as_url'=>TRUE), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 

<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>