<?php $__env->startSection('header_scripts'); ?>
<link href="<?php echo e(CSS); ?>ajax-datatables.css" rel="stylesheet">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>

 <!-- Content Header (Page header) -->
 <?php if(checkRole(getUserGrade(2))): ?>
    <section class="content-header">
    <div class="row">
  <div class="col-lg-12">
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL_DASHBOARD); ?>"><i class="fa fa-home"></i> <?php echo e(getPhrase('Home')); ?></a> </li>
      <li><a  href="<?php echo e(URL_PRODUCTS_DASHBOARD); ?>"><?php echo e(getPhrase('products_dashboard')); ?></a></li>         
      <li class="active"><?php echo e(isset($title) ? $title : ''); ?></li>
    </ol>
  </div>
</div>

</section>
<?php endif; ?>
    <?php if(Auth::user()->role_id == VENDOR_ROLE_ID): ?>
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
			<?php echo $__env->make('productvendor.menu', array('sub_active' => '$sub_active', 'tab' => 'products'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			
			<div class="alert alert-success"><?php echo e(getPhrase('admin_commission : ')); ?> <?php echo e(getSetting('admin_commission_for_a_vendor_product', 'site_settings')); ?> %</div>
			
			<div class="box-header pull-right">
      <a href="<?php echo e(URL_PRODUCTS_ADD); ?>" class="btn btn-primary "><?php echo e(getPhrase('Add')); ?></a>
      
			<a href="<?php echo e(URL_IMPORT.'product'); ?>" class="btn btn-primary"><?php echo e(getPhrase('import')); ?></a>
      </div>
           
			<div id="history" class="tab-pane fade in active">
				
				<table id="example2" class="table table-bordered table-hover datatable">
					<thead>
					<tr>
            <th><?php echo e(getPhrase('Title')); ?></th>
						<th><?php echo e(getPhrase('product_owner')); ?></th>
            <th><?php echo e(getPhrase('Price')); ?></th>
						<th><?php echo e(getPhrase('Image')); ?></th>
						<th><?php echo e(getPhrase('Status')); ?></th>
            <th><?php echo e(getPhrase('approve_status')); ?></th>
						<th><?php echo e(getPhrase('Action')); ?></th>
					</tr>
					</thead>
					<tbody>
					
					</tbody>
					
				  </table>
			</div>
      
            </div>
		
	</section>
	<?php else: ?>
	<!-- Main content -->
    <section class="content">
     
      <div class="row">
          <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
			<a href="<?php echo e(URL_PRODUCTS_ADD); ?>" class="btn btn-primary pull-right"><?php echo e(getPhrase('Add')); ?></a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example2" class="table table-bordered table-hover datatable">
                <thead>
                <tr>
          <th><?php echo e(getPhrase('Title')); ?></th>
					<th><?php echo e(getPhrase('product_owner')); ?></th>
					<th><?php echo e(getPhrase('Price')); ?></th>
					<th><?php echo e(getPhrase('Image')); ?></th>
          <th><?php echo e(getPhrase('Status')); ?></th>
					<th><?php echo e(getPhrase('approve_status')); ?></th>
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

 <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align: center;"><?php echo e(getPhrase('product_approve_status')); ?></h4>
      </div>
      <div class="modal-body">
      <?php echo Form::open(array('url'=> URL_PRODUCT_ADMIN_APPROVE,'method'=>'POST','name'=>'userstatus')); ?> 

      <span><h4 id="message" style="text-align: center; color: #3c8dbc;"></h4></span>

        <input type="hidden" name="product_id" id="product_id" >
      
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-primary" >Yes</button>
      </div>
      <?php echo Form::close(); ?>

    </div>

  </div>
</div>


    <!-- /.content -->
	<?php endif; ?>

 <?php $__env->stopSection(); ?>
 
<?php $__env->startSection('footer_scripts'); ?>
<?php echo $__env->make('common.datatables',array('route'=>URL_PRODUCTS_LIST,'route_as_url'=>TRUE), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 
<script >
   
    function approveProduct(productid)
    {
      $('#product_id').val(productid);
      
      message = '<?php echo e(getPhrase('are_you_sure_to_make_approve_this_product')); ?>?'; 
      
      $('#message').html(message);

      $('#myModal').modal('show');
    }

   
  
 </script>
<?php echo $__env->make('common.deletescript', array('route' => URL_PRODUCTS_DELETE), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>