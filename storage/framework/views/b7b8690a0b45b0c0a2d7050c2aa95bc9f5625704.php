<?php $__env->startSection('content'); ?>
<!--SECTION-1 BANNER-->
<section class="login-banner">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h2><?php echo e(getPhrase('cart')); ?></h2>
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
			<?php if(sizeof(Cart::content()) > 0): ?>
			<div class="col-md-8 col-sm-12">
				<h2><?php echo e(getPhrase('YOUR CART')); ?></h2>
				
				<table class="table">
					<thead>
						<tr>
							<th><?php echo e(getPhrase('image')); ?></th>
							<th><?php echo e(getPhrase('product_name')); ?></th>
							<th><?php echo e(getPhrase('product_price')); ?></th>
							<th><?php echo e(getPhrase('options')); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $__currentLoopData = Cart::content(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<tr>
							<td class="table-image">
							<?php
							$product_image = DEFAULT_PRODUCT_IMAGE_THUMBNAIL;
							if( $item->model->image != '' && File::exists(UPLOAD_PATH_PRODUCTS_THUMBNAIL.$item->model->image ) ) {
								$product_image = UPLOAD_URL_PRODUCTS_THUMBNAIL.$item->model->image;
							}
							?>
							<a href="<?php echo e(URL_DISPLAY_PRODUCTS_DETAILS.$item->model->slug); ?>"><img src="<?php echo e($product_image); ?>" alt="product" class="cart-image" height="45" width="45"></a></td>
							
							<td><a href="<?php echo e(URL_DISPLAY_PRODUCTS_DETAILS.$item->model->slug); ?>"><?php echo e(getPhrase($item->name)); ?></a></td>
							
							<td class="colu2"><?php echo e(currency( $item->subtotal )); ?></td>
							<td class="colu3">
						      <form action="<?php echo e(url('cart', [$item->rowId])); ?>" method="POST" class="side-by-side">
                                <?php echo csrf_field(); ?>

                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-sm">
								<span class="fa fa-times"></span>
								</button>
                            </form>
							</td>

						</tr>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						
					</tbody>
				</table>
               <div class="cart-button btn-left">
                <a href="<?php echo e(URL_DISPLAY_PRODUCTS); ?>" class="btn btn-primary"><?php echo e(getPhrase('continue_shopping')); ?></a>	
                </div>		
			</div>
			<div class="col-md-4 col-sm-12">
				<h2><?php echo e(getPhrase('total_cart')); ?></h2>
				<div class="total">
					<p class="fee"><?php echo e(getPhrase('products_price')); ?> <span><?php echo e(currency( Cart::instance('default')->subtotal() )); ?></span></p>


                    <?php $dispaly_incheckout = getSetting('display_during_checkout','cart_settings');
                    ?>
                    <?php if($dispaly_incheckout=='yes'): ?>
					<p class="fee"><?php echo e(getPhrase('tax')); ?> <span><?php echo e(currency( Cart::instance('default')->tax() )); ?></span></p>
					<?php endif; ?>

					<?php
					$licence_price = 0;
					?>
					<?php if(session()->has('licence_price')): ?>
					<p class="fee"><?php echo e(getPhrase('support_fee')); ?> <span><?php echo e(currency( session()->get('licence_price') )); ?></span></p>
					<?php $licence_price = session()->get('licence_price');?>
					<?php endif; ?>
					
					<?php
					$discount_amount = 0;
					?>
					<?php if(session()->has('discount_amount')): ?>
					<p class="fee"><?php echo e(getPhrase('coupon_code_off')); ?> <span><?php echo e(currency( session()->get('discount_amount') )); ?></span></p>
					<?php $discount_amount = session()->get('discount_amount');?>
					<?php endif; ?>

					
                     
                     <?php $prices_and_tax = getSetting('prices_entered_with_tax','cart_settings');
                     ?>
                     
                    <?php if($prices_and_tax=='yes'): ?>

                    <p class="fees"><?php echo e(getPhrase('total_price')); ?> <span>

                     <?php
					$cart_total = $parsed = floatval(preg_replace('/[^\d.]/', '', Cart::instance('default')->subtotal()));
					?>
					<?php echo e(currency( $cart_total + $licence_price - $discount_amount )); ?></span></p>

                    <?php else: ?>

                    <p class="fees"><?php echo e(getPhrase('total_price')); ?> <span>

					<?php
					$cart_total = $parsed = floatval(preg_replace('/[^\d.]/', '', Cart::total()));
					?>
					<?php echo e(currency( $cart_total + $licence_price - $discount_amount )); ?></span></p>

					<?php endif; ?>

				</div>
                <?php if(sizeof(Cart::content()) > 0): ?>
				<div class="cart-button">
                    <a href="<?php echo e(URL_CHECKOUT); ?>" type="submit" class="btn btn-primary"><?php echo e(getPhrase('check_out')); ?></a>
				</div>
                <?php endif; ?>
			</div>
			
			<?php else: ?>
			<div class="btn-center">
				<div class="alert alert-danger">
				<?php echo e(getPhrase('your_cart_is_empty')); ?>

				</div>
            </div>
			<?php endif; ?>
          
           
			
		</div>
	</div>
</section>
<!--/SECTION cart-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout-site', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>