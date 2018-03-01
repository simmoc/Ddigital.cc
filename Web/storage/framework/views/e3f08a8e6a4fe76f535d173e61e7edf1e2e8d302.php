<?php
$extra_class = '';
if( isset($type) && $type == 'related')
	$extra_class = 'product-lg';
?>
<?php if( $products->count() > 0 ): ?>
	<?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
     
<?php if(!Auth::guest()): ?>
	  <?php 
	  $user_id = Auth::user()->id;
	  ?>
<?php endif; ?>	  
	<div class="col-md-4 col-sm-12 col-xs-12">
		<!-- Product -->
		<div class="product <?php echo e($extra_class); ?>">
		
			<div class="portfolio-item">
			
				<?php
				$product_image = DEFAULT_PRODUCT_IMAGE_THUMBNAIL;
				if( $product->image!= '' && File::exists(UPLOAD_PATH_PRODUCTS_THUMBNAIL.$product->image ) ) {

					$product_image = UPLOAD_URL_PRODUCTS.$product->image;
				}
				// dd($product_image);
				?>
				<img src="<?php echo e($product_image); ?>"  alt="" >
				<!-- portfolio item hover -->
				<div class="portfolio-hover">
					<div class="portfolio-hover-content font-reg">
						<ul class="pair-btns">
							<?php if($product->price_type == 'default'): ?>
							<li>
							<form action="<?php echo e(URL_DISPLAY_PRODUCTS_CART); ?>" method="POST" class="side-by-side">
								<?php echo csrf_field(); ?>

								<?php if( $product->price_type == 'default' ): ?>
								<input type="hidden" name="id" value="<?php echo e($product->id); ?>">
								<input type="hidden" name="name" value="<?php echo e($product->name); ?>">
								<input type="hidden" name="price" value="<?php echo e($product->price); ?>">
								<?php endif; ?>
								<input type="hidden" name="price_type" value="<?php echo e($product->price_type); ?>">
								<?php if(Auth::guest()): ?>
								  <?php if($product->price!=0.00): ?>
								     <button type="submit" class="btn btn-buy"><?php echo e(getPhrase('buy_now')); ?></button>
								  <?php endif; ?>   
								<?php endif; ?>

								<?php if(!Auth::guest()): ?>
								<?php $product_owner_id  = $product->user_created;?>
								<?php if($user_id!= $product_owner_id): ?>
								  <?php if($product->price!=0.00): ?>
								     <button type="submit" class="btn btn-buy"><?php echo e(getPhrase('buy_now')); ?></button>
								  <?php endif; ?>   
								<?php endif; ?>
								<?php endif; ?>
							</form>
							</li>
							<?php endif; ?>
							<li><a href="<?php echo e(URL_DISPLAY_PRODUCTS_DETAILS.$product->slug.'/'.$product->id); ?>" class="btn btn-view"><?php echo e(getPhrase('details')); ?></a></li>
						</ul>
					</div>
				</div>
			</div>
			<?php
			$author = getUserRecord( $product->user_created);
			?>
			<div class="product-content">
			
				<span class="product-price">
				
               

			   	
				<?php if( $product->price_type == 'default' ): ?>
				<?php $display_with_tax = getSetting('display_tax_rate_on_prices','cart_settings');
				?>
				    <?php if($display_with_tax=='yes'): ?>
				      <?php echo e(currency( Cart::instance('default')->tax()+$product->price)); ?>

				    <?php else: ?>  
					<?php echo e(currency( $product->price )); ?>


					<?php endif; ?>
				<?php else: ?>
				<?php
					$price_variations = json_decode( $product->price_variations );
					$min_price = $max_price = $index = 0;
					if( ! empty( $price_variations ) ) {
						foreach( $price_variations as $key => $item ) {
							if( $index == 0)
								$min_price = $item->amount;
							if( $item->amount < $min_price )
								$min_price = $item->amount;
							if( $item->amount > $max_price )
								$max_price = $item->amount;
							$index++;
						}
					}
				?>
				<?php echo e(currency( $min_price )); ?> - <?php echo e(currency( $max_price )); ?>

				<?php endif; ?>
				</span>
				<a href="<?php echo e(URL_DISPLAY_PRODUCTS_DETAILS.$product->slug.'/'.$product->id); ?>" class="product-title" title="<?php echo e($product->name); ?>"> <?php echo e(getPhrase(strlen($product->name) < 20) ? getPhrase($product->name) : getPhrase(substr($product->name,0,15)).'...'); ?> </a>
				<a href="<?php echo e(URL_DISPLAYPRODUCTS_VENDORDETAILS . $author->slug); ?>">
					<div class="product-author ">
						<div class="media-left">
							<img src="<?php echo e(getProfilePath($author->image)); ?>" alt="user-avatar" class=" img-circle">
						</div>
						<div class="media-body">
							<p><?php echo e($author->name); ?></p>
						</div>
					</div>
				</a>
			</div>
            </div>
        </div>
        
		<!-- /Product -->
	
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	 <!-- <div class="products-button pull-right">						
						<a class="btn btn-primary" href="<?php echo e(URL_VIEW_MORE_PRODUCTS); ?>"><?php echo e(getPhrase('view_more', 'upper')); ?></a>
					</div> -->
	<?php if( ! isset($nopagelinks) ): ?>
		<?php echo e($products->appends(request()->input())->links('pagination/default')); ?>

	<?php endif; ?>
	<?php else: ?>
		<div class="col-md-4 col-sm-12 col-xs-12"> <?php echo e(getPhrase('no_products_found')); ?>

		</div>
	<?php endif; ?>
