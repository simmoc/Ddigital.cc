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
<?php if(Auth::user()->role_id == USER_ROLE_ID || Auth::user()->role_id == VENDOR_ROLE_ID): ?>
     <section class="login-banner">
        <div class="container">
            <div class="row">
                <div class="div col-sm-12">
                    <h2><?php echo e(Auth::user()->name); ?></h2>
                </div>
            </div>
        </div>
    </section>
    
    
    <!--SECTION cart DASHBOARD-2-->
    <section class="dashboard2">
        <div class="container">
            <h2><?php echo e(getPhrase('my_dashboard')); ?></h2>
            <?php if(Auth::user()->role_id == USER_ROLE_ID): ?>
            <?php echo $__env->make('customer.menu', array('sub_active' => $sub_active, 'tab' => 'dashboard'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php elseif(Auth::user()->role_id == VENDOR_ROLE_ID): ?>
            <?php echo $__env->make('productvendor.menu', array('sub_active' => $sub_active, 'tab' => 'dashboard'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endif; ?>
            <div class="alert alert-success"><?php echo e(getPhrase('admin_commission : ')); ?> <?php echo e(getSetting('admin_commission_for_a_vendor_product', 'site_settings')); ?> %</div>
            
           
            <div id="history" class="tab-pane fade in active">
                
                <table id="example2" class="table table-bordered table-hover datatable digi-table">
                    <thead>
                    <th><?php echo e(getPhrase('Title')); ?></th>
                    <th><?php echo e(getPhrase('code')); ?></th>
                    <th><?php echo e(getPhrase('discount_type')); ?></th>
                    <th><?php echo e(getPhrase('value')); ?></th>
                    <th><?php echo e(getPhrase('start_date')); ?></th>
                    <th><?php echo e(getPhrase('end_date')); ?></th>
                    <th><?php echo e(getPhrase('Status')); ?></th>
                    </thead>
                    <tbody>
                    
                    </tbody>
                    
                  </table>
            </div>
        </div>
    </section>
<!-- Main content -->
<?php else: ?>
<section class="content">
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                     
                        
                     <div class="panel-heading">
                    
                        <div class="pull-right messages-buttons">
                            <a href="<?php echo e(URL_COUPONS_ADD); ?>" class="btn btn-primary pull-right"><?php echo e(getPhrase('Add')); ?></a>
                             
                        </div>
                        <h2><?php echo e($title); ?></h2>
                    </div>
                    
              
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="example2" class="table table-bordered table-hover datatable">
                        <thead>
                            <tr>
                                <th><?php echo e(getPhrase('Title')); ?></th>
                                <th><?php echo e(getPhrase('code')); ?></th>
                                <th><?php echo e(getPhrase('discount_type')); ?></th>
                                <th><?php echo e(getPhrase('value')); ?></th>
                                <th><?php echo e(getPhrase('start_date')); ?></th>
                                <th><?php echo e(getPhrase('end_date')); ?></th>
                                <th><?php echo e(getPhrase('Status')); ?></th>
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
        <!-- /.col -->
    </div>
    <!-- /.row -->
</section>
<?php endif; ?>
<!-- /.content -->

<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
<?php echo $__env->make('common.datatables',array('route' => URL_COUPONS_LIST,'route_as_url'=>TRUE), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<?php echo $__env->make('common.deletescript', array('route'=>URL_COUPONS_DELETE), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>