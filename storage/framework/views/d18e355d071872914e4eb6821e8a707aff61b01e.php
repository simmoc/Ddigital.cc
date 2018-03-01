<?php $__env->startSection('content'); ?>
<!--SECTION-1 BANNER-->
<section class="login-banner">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h2><?php echo e($title); ?></h2>
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
		<div class="row">
			<div class="col-md-8 col-sm-12">
			<?php echo $__env->make('errors.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			<div class="alert alert-info">
			<strong><?php echo e(getPhrase('warning')); ?>!</strong>  &nbsp;<?php echo e(getPhrase('do_not_refresh_this_page')); ?>

			</div>
			
			<?php $button_name = getPhrase('submit'); 

			?>
			<?php $status = getSetting('status', 'offline_payment'); ?>
			<?php if($status=='active'): ?>
			 <div class="jumbotron">
			  <h3><?php echo e(getPhrase('offline_payment_instructions')); ?></h3>
			  <?php $instructions = $paypal = getSetting('offline_payment_information', 'offline_payment');
			  
			   ?>
			  <?php echo $instructions; ?>

			</div>
			<?php endif; ?>
			<?php echo Form::open(array('url' => URL_UPDATE_OFFLINE_PAYMENT, 'method' => 'POST', 'name'=>'formQuiz ',  )); ?>

			<input type="hidden" name="token" value="<?php echo e($token); ?>">	 
			<div class="row">
			 <fieldset class="form-group col-md-12">
			 <?php echo e(Form::label('payment_details', getphrase('payment_details'))); ?>

				<span class="text-red">*</span>
					 <textarea name="payment_details" ng-model="payment_details"
					 required="true" class='form-control ckeditor'  rows="5"></textarea>
				<div class="validation-error"    >
					<?php echo getValidationMessage(); ?>

				</div>
			</fieldset>
			</div>
			
				<div class="buttons text-center">
					<button class="btn btn-lg btn-success button"
					 ><?php echo e(getPhrase($button_name)); ?></button>
				</div>
			<?php echo Form::close(); ?>	
			
			</div>
			<?php $payment_data = App\Payment::where('slug','=',$token)->first();
			 
			?>
			<?php if(sizeof(Cart::content()) > 0): ?>
			<div class="col-md-4 col-sm-12">
				  <h2>TOTAL CART</h2>
				 <div class="total">
					  <p class="fee"><?php echo e(getPhrase('products_price')); ?> : <span><?php echo e(currency( Cart::instance('default')->subtotal() )); ?></span></p>
					  <p class="fee"><?php echo e(getPhrase('tax')); ?> : <span><?php echo e(currency( Cart::instance('default')->tax() )); ?></span></p>
					  <p class="fee"><?php echo e(getPhrase('support_fee')); ?> : <span><?php echo e(currency($payment_data->licence_price)); ?></span></p>
					  <p class="fee"><?php echo e(getPhrase('coupon_code_off')); ?> : <span>- <?php echo e(currency($payment_data->discount_amount)); ?></span></p>
					  <?php $cart_total = $parsed = floatval(preg_replace('/[^\d.]/', '', Cart::total()));?>
					  <p class="fees"><?php echo e(getPhrase('total_price')); ?> : <span><?php echo e(currency( $cart_total+ $payment_data->licence_price - $payment_data->discount_amount )); ?></span></p>

				 </div>
			</div>
			<?php endif; ?>
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