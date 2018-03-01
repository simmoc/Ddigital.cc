<?php $__env->startSection('content'); ?>
<?php if(Auth::user()->role_id == VENDOR_ROLE_ID): ?>
<!--Inner Banner-->
<section class="login-banner">
	<div class="container">
		<div class="row">
			<div class="div col-sm-12">
				<h2><?php echo e(Auth::user()->name); ?></h2>
			</div>
		</div>
	</div>
</section>
<!--/Inner Banner-->

<!--SECTION cart DASHBOARD-2-->
<section class="dashboard2">
	<div class="container edd-edit">
	
		<h2><?php echo e(getPhrase('my_dashboard')); ?></h2>
		<?php echo $__env->make('productvendor.menu', array('sub_active' => $sub_active, 'tab' => 'products'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<?php echo $__env->make('errors.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 

		<?php $button_name = 'create'; ?>
		<?php if($record): ?>
		<?php $button_name = 'update'; ?>
		<?php echo e(Form::model($record, 
		array('url' => URL_PRODUCTS_EDIT.$record->slug, 
		'method'=>'patch','name'=>'formName', 'files'=>'true', 'novalidate' => '' ))); ?>

		<?php else: ?>
		<?php echo Form::open(array('url' => URL_PRODUCTS_ADD, 'method' => 'POST', 'name'=>'formName', 'files'=>'true', 'novalidate' => '','class' =>'clearfix dash-bg')); ?>

		<?php endif; ?>

		<?php echo $__env->make('products.form_elements', array('button_name'=> $button_name, 'record' => $record, 'categories' => $categories ), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

		<?php echo Form::close(); ?>

	
    </div>

    <div id="myModalFile" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align:center;"><?php echo e(getPhrase('edit_product')); ?></h4>
      </div>
	  
	   <?php echo Form::open(array('url'=> URL_DELETE_PRODUCT_FILE,'method'=>'POST','name'=>'productfile')); ?> 
	   
      <div class="modal-body">
      <span id="message"></span>
         
          <h4 style="color:#44a1ef;text-align: center;"><?php echo e(getPhrase('are_you_sure_to_make_clear_file')); ?></h4 >

        <input type="hidden" name="product_file" id="qfile" >
        <input type="hidden" name="product_id" id="qid" >

      </div>
	  
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-primary" >Yes</button>
      </div>
	  
      <?php echo Form::close(); ?>

    </div>

  </div>
</div>
</section>
<!-- ENd -->
<?php else: ?>
<!-- Content Header (Page header) -->
<section class="content-header">
<div class="row">
  <div class="col-lg-12">
    <ol class="breadcrumb">
      <li><a href="<?php echo e(URL_DASHBOARD); ?>"><i class="fa fa-home"></i> <?php echo e(getPhrase('Home')); ?></a> </li>
      <li><a  href="<?php echo e(URL_PRODUCTS_DASHBOARD); ?>"><?php echo e(getPhrase('products_dashboard')); ?></a></li>
       <li><a  href="<?php echo e(URL_PRODUCTS); ?>"><?php echo e(getPhrase('products_list')); ?></a></li>          
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
array('url' => URL_PRODUCTS_EDIT.$record->slug, 
'method'=>'patch','name'=>'formName', 'files'=>'true', 'novalidate' => '' ))); ?>

<?php else: ?>
<?php echo Form::open(array('url' => URL_PRODUCTS_ADD, 'method' => 'POST', 'name'=>'formName', 'files'=>'true', 'novalidate' => '')); ?>

<?php endif; ?>

<?php echo $__env->make('products.form_elements', array('button_name'=> $button_name, 'record' => $record, 'categories' => $categories ), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo Form::close(); ?>

          
           
          </div>
          <!-- /.box -->
 

        </div>
        <!--/.col (left) -->
      
      </div>

      <div id="myModalFile" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="text-align:center;"><?php echo e(getPhrase('edit_product')); ?></h4>
      </div>
	  
	   <?php echo Form::open(array('url'=> URL_DELETE_PRODUCT_FILE,'method'=>'POST','name'=>'productfile')); ?> 
	   
      <div class="modal-body">
      <span id="message"></span>
         
          <h4 style="color:#44a1ef;text-align: center;"><?php echo e(getPhrase('are_you_sure_to_make_clear_file')); ?></h4 >

        <input type="hidden" name="product_file" id="qfile" >
        <input type="hidden" name="product_id" id="qid" >

      </div>
	  
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
        <button type="submit" class="btn btn-primary" >Yes</button>
      </div>
	  
      <?php echo Form::close(); ?>

    </div>

  </div>
</div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>	
	<?php echo $__env->make('common.validations', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.editor', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<script src="<?php echo e(JS); ?>bootstrap-toggle.min.js"></script>
	<script src="<?php echo e(JS); ?>jquery-ui.js"></script>
	<script type="text/javascript">
		var edd_vars;
	</script>
	<script src="<?php echo e(JS); ?>custom.js"></script>
	<?php echo $__env->make('common.select2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
	<script type="text/javascript">
		jQuery(document).ready(function ($) {
			function toggle_price() {
				if( $('#price_type').val() == 'variable' ) {
					$('#variableprice_options_div').show();
					$('#price_display_type_div').show();
					$('#fixedprice_options_div').hide();
					$('.pricing').show();
				} else {
					$('#variableprice_options_div').hide();
					$('#price_display_type_div').hide();
					$('#fixedprice_options_div').show();
					$('.pricing').hide();
				}
			}
			$('#price_type').change(function(){
				toggle_price();
			});
			toggle_price();
			$('.upload_type').change(function(){
				var index = $(this).data('index');
				
				if( $(this).val() == 'file' ) {
					$('.digi_upload_file_button_index_'+index).attr('type', 'file');
				} else {
					$('.digi_upload_file_button_index_'+index).attr('type', 'text');
				}
			});
		});
	</script>
	<script>
		
          function deleteProductFile(file, product_id)
 		{    
 			
			var qf = file;
			var qi = product_id;
			
 			$('#qfile').val(qf);
 			$('#qid').val(qi);
 			$('#myModalFile').modal('show');
 		}
			
	</script>
	
<?php $__env->stopSection(); ?>
 
<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>