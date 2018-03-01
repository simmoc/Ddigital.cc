<?php $__env->startSection('header_scripts'); ?>
	<link rel="stylesheet" href="<?php echo e(CSS); ?>select2.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!--SECTION-1 BANNER-->
<section class="login-banner">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h2><?php echo e(getPhrase('check_out')); ?></h2>
			</div>
		</div>
	</div>
</section>
<!--/SECTION BANNER-->

<!--SECTION cart checkout-->
<section class="checkout">
<div class="container">
	<div class="row">
	<?php if(Auth::check()): ?>
		<?php
		$user = getUserRecord();
		?>
		<?php echo Form::model($user, array('url' => URL_PAYNOW, 'method' => 'POST', 'name'=>'formName', 'id' => 'formName')); ?>

	<?php else: ?>
		<?php echo Form::open(array('url' => URL_PAYNOW, 'method' => 'POST', 'name'=>'formName', 'id' => 'formName')); ?>

	<?php endif; ?>
	
	<?php echo $__env->make('errors.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
	
	<div class="col-md-8 col-sm-12">
	    <?php $licence_amount = session()->get('licence_price');
	     ?>
		<?php if( Cart::total() > 0 || $licence_amount>0): ?>
		<h2><?php echo e(getPhrase('select_payment_method')); ?></h2>		
		<div class="checkout-box">
			<div class="input-group ">
				<div class="radio">
				<?php $__currentLoopData = $payment_gateways; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $gateway): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
				<div>
					<label>
						<input type="radio" value="<?php echo e($gateway->slug); ?>" name="gateway">
						<span class="radio-content">
					<span class="item-content"><?php echo e($gateway->title); ?></span>
						<i aria-hidden="true" class="fa uncheck fa-circle-thin"></i>
						<i aria-hidden="true" class="fa check fa-dot-circle-o"></i>
						</span>
					</label>
				</div>
				<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</div>
			</div>
		</div>
		<?php else: ?>
		<input type="hidden" name="gateway" value="Free">
		<?php endif; ?>

		<div class="check-form  animated fadeInDown">
		
		<div class="form-group">
		<?php echo e(Form::label('email', getPhrase( 'Email address' ) )); ?> <?php echo required_field();; ?>

		<?php echo e(Form::text('email', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'email_address' ), 
				'title' => getPhrase('Email address' ), 
				'data-toggle' => 'tooltip',
				'data-validation' => "[NOTEMPTY]"
				))); ?>

	   </div>
	   <div class="form-group">
		<?php echo e(Form::label('first_name', getPhrase( 'First Name' ) )); ?> <?php echo required_field();; ?>

		<?php echo e(Form::text('first_name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'first_name' ), 
				'title' => getPhrase('First Name' ), 
				'data-toggle' => 'tooltip',
				))); ?>

	   </div>
		<div class="form-group">
		<?php echo e(Form::label('last_name', getPhrase( 'last_name' ) )); ?>

		<?php echo e(Form::text('last_name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'last_name' ), 
				'title' => getPhrase('Last Name' ), 
				'data-toggle' => 'tooltip',
				))); ?>

		</div>
		
		<h2><?php echo e(getPhrase('billing_address')); ?></h2>
		<div class="form-group">
		<?php echo e(Form::label('billing_address1', getPhrase( 'address_line1' ) )); ?>

			<?php echo e(Form::text('billing_address1', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'address_line1' ), 
			'title' => getPhrase('Address Line1' ),
			'ng-model'=>'billing_address1',
			'ng-class'=>'{"has-error": formName.billing_address1.$touched && formName.billing_address1.$invalid}',
			))); ?>									
		</div>
		
		<div class="form-group">
		<?php echo e(Form::label('billing_address2', getPhrase( 'address_line2' ) )); ?>

			<?php echo e(Form::text('billing_address2', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'address_line2' ), 
			'title' => getPhrase('Address Line2' ),
			'ng-model'=>'billing_address2',
			'ng-class'=>'{"has-error": formName.billing_address2.$touched && formName.billing_address2.$invalid}',
			))); ?>									
		</div>
		<div class="form-group">
		<?php echo e(Form::label('billing_city', getPhrase( 'city' ) )); ?>

			<?php echo e(Form::text('billing_city', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'city' ), 
			'title' => getPhrase('City' ),
			'ng-model'=>'billing_city',
			'ng-class'=>'{"has-error": formName.billing_city.$touched && formName.billing_city.$invalid}',
			))); ?>

		</div>
		<div class="form-group">
		<?php echo e(Form::label('billing_zip', getPhrase( 'zip_code' ) )); ?>

			<?php echo e(Form::text('billing_zip', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'zip_code' ), 
			'title' => getPhrase('Zip Code' ),
			'ng-model'=>'billing_zip',
			'ng-class'=>'{"has-error": formName.billing_zip.$touched && formName.billing_zip.$invalid}',
			))); ?>

		</div>
		<div class="form-group">
		<?php echo e(Form::label('billing_state', getPhrase( 'state_/_province' ) )); ?>

			<?php echo e(Form::text('billing_state', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'state_/_province' ), 
			'title' => getPhrase('State/Province' ),
			'ng-model'=>'billing_state',
			'ng-class'=>'{"has-error": formName.billing_state.$touched && formName.billing_state.$invalid}',
			))); ?>


		</div>
		<div class="form-group">
		<?php echo e(Form::label('billing_country', getPhrase( 'country' ) )); ?>

			<?php
			$countries = array_pluck( App\Countries::where('status', '=', 'Active')->get(), 'name', 'name' );
			?>
			<?php echo e(Form::select('billing_country', $countries, null, ['class'=>'form-control select2', "id"=>"billing_country",'placeholder'=>'select'])); ?>									
		</div>

		
		<button type="submit" class="btn btn-primary"><?php echo e(getPhrase('purchase')); ?></button>
		
		</div>

	</div>
	<?php echo Form::close(); ?>

	
	<div class="col-md-4 col-sm-12">
		  <h2><?php echo e(getPhrase('total_cart')); ?></h2>
		 <div class="total">
			<p class="fee"><?php echo e(getPhrase('products_price')); ?> <span><?php echo e(currency( Cart::instance('default')->subtotal() )); ?></span></p>
			<p class="fee"><?php echo e(getPhrase('tax')); ?> <span><?php echo e(currency( Cart::instance('default')->tax() )); ?></span></p>
			<?php
			$licence_price = 0;
			?>
			<?php if(session()->has('licence_price')): ?>
			<p class="fee"><?php echo e(getPhrase('support_fee')); ?> <span><?php echo e(currency( session()->get('licence_price') )); ?></span></p>
			<?php $licence_price = session()->get('licence_price');?>
			<?php endif; ?>
			
			<p id="amount_message" class="fee"></p>
			<?php
			$discount_amount = 0;
			?>
			<?php if(session()->has('discount_amount')): ?>
			<p class="fee"><?php echo e(getPhrase('coupon_code_off')); ?> <span><?php echo e(currency( session()->get('discount_amount') )); ?></span></p>
			<?php $discount_amount = session()->get('discount_amount');?>
			<?php endif; ?>
			
			<?php $cart_total = $parsed = floatval(preg_replace('/[^\d.]/', '', Cart::total()));?>
			<p class="fees"><?php echo e(getPhrase('total_price')); ?><span id="final_data"> <?php echo e(currency(($cart_total- $discount_amount )+$licence_price)); ?></span>
			
			</p>

			
		 </div>
		
		<div id="couponcode_message"></div>
		<?php if(!session()->has('discount_amount') ): ?>
		<form action="<?php echo e(URL_CART_APPLYCOUPON); ?>" method="post" id="frmApplycoupon">
		<?php $cart_total = $parsed = floatval(preg_replace('/[^\d.]/', '', Cart::total()));?>
		<?php $licence_price = 0;?>
			
			<?php if(session()->has('licence_price')): ?>
			
			<?php $licence_price = session()->get('licence_price');?>
			<?php endif; ?>
		<input type="hidden" name="total_price" value="<?php echo e($cart_total); ?>" id="total_price">			
		<input type="hidden" name="licence_price" value="<?php echo e($licence_price); ?>" id="licence_price">			
			<div class="form-group">
				 <p class="coupon"><?php echo e(getPhrase('have_coupon_code?')); ?></p>
				<input type="text" name="code" id="code" class="form-control" placeholder="<?php echo e(getPhrase('enter_code_here')); ?>">
			</div>		
			<div class="cart-button">
				<button type="submit" class="btn btn-primary"><?php echo e(getPhrase('apply')); ?></button>
			</div>
		</form>
		
		<?php endif; ?>
		
		<?php if( session()->has('discount_amount') ): ?>
		<?php
		$coupon_details = session()->get('discount_details', '');
		?>
		<?php if( $coupon_details != ''): ?>
		<?php 
			$code = $coupon_details->code;
		 ?>
		<div class="coupon-apply">
			<p class="coupon-data"><span class="fa fa-check"></span><?php echo e(getPhrase('coupon_code') . $code . ' ' . currency( session()->get('discount_amount') ) . getPhrase(' applied')); ?></p>
			<p class="coupon-data1"><?php echo e(currency( session()->get('discount_amount') ) . getPhrase('reduced_from_the_cart')); ?></p>
			<p><a href="<?php echo e(URL_CART_REMOVECOUPON); ?>"><span class="fa fa-times"></span></a></p>
		</div>
		<?php endif; ?>
		<?php endif; ?>
		</div>
	</div>
</div>
</section>
<!--/SECTION cart checkout-->
 <?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>

	<?php echo $__env->make('common.select2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<script>

	$(document).ready(function () {
		$('#formName').validate({
			rules: {
				email: {
					required:true,
					email:true
				},
				first_name:'required'
			},
			messages:{
				'email' : "<?php echo e(getPhrase('Please enter email address')); ?>",
				'first_name' : "<?php echo e(getPhrase('Please enter first name')); ?>",
			}
		});
	});
	function validateCheckout()
	{
		if( ! document.getElementById('gateway') ) {
			swal({
				title : "<?php echo e(getPhrase('info')); ?>",
				text : "<?php echo e(getPhrase('Please select payment gateway')); ?>",
				type: "info",
			});
		} else {
			$( "#formName" ).submit();
		}
	}
	
	$('#frmApplycoupon').submit(function(e){
		e.preventDefault();
		
		var code = $('#code').val();
		var currency = "<?php echo e(getSetting('currency_symbol', 'cart_settings')); ?>";
		
		if( code == '' ) {
			$('#couponcode_message').html('<div class="alert alert-danger"><?php echo e(getPhrase("please_enter_coupon_code")); ?></div>');
			return false;
		}
		
		$.ajax({
            url : '<?php echo e(URL_CART_APPLYCOUPON); ?>',
			data : {
				coupon:$('#code').val(),
				final_amount : $("#total_price").val(),
				support_fee : $("#licence_price").val(),
				_token:'<?php echo e(Session::token()); ?>'
			},
			method:'post',
            dataType: 'html',
        }).success(function (data) {
        	// console.log(result);
            var result = $.parseJSON(data);
            var message = '';
            if(result.discount_amount){
			var applied_message = '<p>COUPON CODE OFF<b><span style="padding-left:50px;">'+currency+result.discount_amount+'</span></b></p>';
		   }
			
			if(!result.status) {
				message = '<div class="alert alert-danger">'+result.message+'</div>';
			} 
			else {
				message = result.message;
				
				
				
				$('#frmApplycoupon').hide();
			}
			$('#final_data').html(result.final_price);
			$('#paid_amount').val(result.final_price);
			$('#couponcode_message').html( message );
			$('#amount_message').html( applied_message );
        }).fail(function () {
            alert('Posts could not be loaded.');
        });
	});
    </script>
	<?php if( Cart::total() == 0 && $licence_amount==0  ): ?>
		<script type="text/javascript">
			document.formName.submit();
		</script>
	<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout-site', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>