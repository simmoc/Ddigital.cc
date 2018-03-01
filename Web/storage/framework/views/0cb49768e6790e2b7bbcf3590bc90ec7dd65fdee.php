<?php $__env->startSection('content'); ?>
<!--SECTION-1 BANNER-->
<section class="login-banner">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
			  <?php if($paymentdetails->payment_status=='success'): ?>
				<h2><?php echo e(getPhrase('payment_status : success')); ?></h2>
		      <?php else: ?>
		        <h2><?php echo e(getPhrase('payment_status : pending')); ?></h2>
		      <?php endif; ?>  		
			</div>
		</div>
	</div>
</section>
<!--/SECTION BANNER-->

<!--SECTION cart-->
<section class="cart  animated fadeInDown">
	<div class="container">
		<?php if(session()->has('success_message')): ?>
            <div class="alert alert-success">
                <?php echo e(session()->get('success_message')); ?>

            </div>
        <?php endif; ?>

        <?php if(session()->has('error_message')): ?>
            <div class="alert alert-danger">
                <?php echo e(session()->get('error_message')); ?>

            </div>
        <?php endif; ?>
		<div class="">
			<div class="">
			<?php echo $__env->make('errors.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php if(isset($payment_details)): ?>			
			<?php if( $paymentmethod == 'offline-payment'): ?>
			 <div class="jumbotron">
			  <h3><?php echo e(getPhrase('offline_payment_instructions')); ?></h3>
			  <?php $instructions = $paypal = getSetting('offline_payment_information', 'payment_gateways'); ?>
			  <?php echo $instructions; ?>

			</div>
			<?php endif; ?>
		<?php endif; ?>	
			<div class="jumbotron">
				<h3><?php echo e(getPhrase('payment_details')); ?></h3>
					<fieldset class="form-group col-md-12">
					
					<?php echo e(Form::label('actual_cost', getphrase('actual_cost : '))); ?>

					<?php echo e(currency( $paymentdetails->actual_cost )); ?>

					</fieldset>
					<?php if($paymentdetails->tax): ?>
					<fieldset class="form-group col-md-12">
					<?php echo e(Form::label('tax', getphrase('tax : '))); ?>

					<?php echo e(currency( $paymentdetails->tax )); ?>

					</fieldset>
					<?php endif; ?>
					<?php if($paymentdetails->discount_amount): ?>
					<fieldset class="form-group col-md-12">
					<?php echo e(Form::label('discount', getphrase('discount : '))); ?>

					<?php echo e(currency( $paymentdetails->discount_amount )); ?>

					</fieldset>
					<?php endif; ?>
					
					<fieldset class="form-group col-md-12">
					<?php echo e(Form::label('amount_paid', getphrase('amount_paid : '))); ?>

					<?php echo e(currency( $paymentdetails->paid_amount )); ?>

					</fieldset>
					
					<fieldset class="form-group col-md-12">
					<?php echo e(Form::label('payment_status', getphrase('payment_status : '))); ?>

					<?php echo e(ucfirst( $paymentdetails->payment_status )); ?>

					</fieldset>
					<?php if($paymentdetails->payment_details): ?>
					<fieldset class="form-group col-md-12">
					<?php echo e(Form::label('payment_details', getphrase('payment_details : '))); ?>

					<?php echo e($paymentdetails->payment_details); ?>

					</fieldset>
					<?php endif; ?>
					<?php if($paymentdetails->payment_status == 'success'): ?>
					<fieldset class="form-group col-md-12">
					<?php echo e(Form::label('download', getphrase('download : '))); ?>

					<a href="<?php echo e(URL_CART_DOWNLOAD.$paymentdetails->slug); ?>">
					<span class="fa fa-download"></span>
					</a>
					</fieldset>
					<?php endif; ?>
					
			</div>
			
			<div class="jumbotron">
				<h3><?php echo e(getPhrase('purchase_details')); ?></h3>
					
				<table class="table">
				<thead>
					<tr>
						<th><?php echo e(getPhrase('Image')); ?></th>
						<th><?php echo e(getPhrase('Product Name')); ?></th>
						<th><?php echo e(getPhrase('Product Price')); ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $__currentLoopData = $cart_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<tr>
						<td class="table-image">
						<?php
						$product_image = DEFAULT_PRODUCT_IMAGE_THUMBNAIL;
						if( $item->model->image != '' && File::exists(UPLOAD_PATH_PRODUCTS_THUMBNAIL . $item->model->image ) ) {
							$product_image = UPLOAD_URL_PRODUCTS_THUMBNAIL.$item->model->image;
						}
						?>
						<a href="<?php echo e(URL_DISPLAY_PRODUCTS_DETAILS.$item->model->slug); ?>"><img src="<?php echo e($product_image); ?>" alt="product" class="img-responsive cart-image"></a></td>
						
						<td><a href="<?php echo e(URL_DISPLAY_PRODUCTS_DETAILS.$item->model->slug); ?>"><?php echo e($item->name); ?></a></td>
						
						<td class="colu2"><?php echo e(currency($item->subtotal)); ?></td>
						
					</tr>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					
				</tbody>
			</table>
			</div>			
			
			</div>
			
		</div>
	</div>
</section>

<!--/SECTION cart-->
 <?php $__env->stopSection(); ?>
 
 <?php $__env->startSection('footer_scripts'); ?>
<script >
	history.pushState(null, null, location.href);
window.onpopstate = function(event) {
    history.go(1);
};
</script>
 <?php echo $__env->make('common.validations', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout-site', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>