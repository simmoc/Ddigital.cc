<?php $__env->startSection('header_scripts'); ?>
<link rel="stylesheet" href="<?php echo e(CSS); ?>select2.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!--SECTION-1 Search goods-->
<section class="search-bg">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
			<?php $heading = getSetting('welcome_page_heading','site_settings');
			       $sub_heading = getSetting('welcome_page_sub_heading','site_settings');
			       $sub_heading2 = getSetting('welcome_page_another_heading','site_settings');?>
				<h1 class="hero-title"> <?php echo e(getPhrase($heading)); ?></h1>
				<p class="search-para"><?php echo e(getPhrase($sub_heading)); ?></p>
				<div class="sign">					
						<?php echo Form::open(array('url' => URL_INDEX_SEARCHPRODUCT, 'method' => 'POST', 'name'=>'fromSearch ',  )); ?>

						<div class="input-group">
							<div class="input-group-btn ">
								<span class=" fa-btn "><i class="fa fa-search hidden-xs"></i></span>
							</div>
							<?php
							$searchproducts = App\Product::where('status', '=', 'Active')->orderBy('created_at', 'desc');
							?>
							<div class="dropdown">
							<input type="text" name="title" id="title" class="form-control" placeholder="<?php echo e(getPhrase('Search')); ?>" data-toggle="dropdown">								
								<ul class="dropdown-menu search-dropmenu" id="products_dropdown">
									<?php if( $searchproducts->count() > 0 ): ?>
										<?php $__currentLoopData = $searchproducts->paginate(10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<?php
										$price = $product->price;
										if($product->price_type == 'variable') {
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
										}
										?>
										<li>
											   <a href="<?php echo e(URL_DISPLAY_PRODUCTS_DETAILS . $product->slug); ?>">
											   <div class="media-left">
											   <?php
												$product_image = DEFAULT_PRODUCT_IMAGE_THUMBNAIL;
												if( $product->image != '' && File::exists(UPLOAD_PATH_PRODUCTS_THUMBNAIL . $product->image ) ) {
													$product_image = UPLOAD_URL_PRODUCTS_THUMBNAIL . $product->image;
												}
												?>
											   <img src="<?php echo e($product_image); ?>"></div>
												<div class="media-body">
													<h4><?php echo e($product->name); ?></h4>
													<p>
													<?php if( $product->price_type == 'default' ): ?>
														<?php echo e(currency( $price)); ?>

													<?php else: ?>
														<?php echo e(currency( $min_price )); ?> - <?php echo e(currency( $max_price )); ?>

													<?php endif; ?>
													</p>
												</div>
												</a>
										</li>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									<?php endif; ?>		
									
								</ul>
							
							</div>

							
							<!-- /btn-group -->

							<div class="input-group-btn">
								<button class="btn btn-primary btn-search" type="submit"><span class="hidden-xs"><?php echo e(getPhrase('SEARCH')); ?></span><span class="visible-xs fa fa-search"></span></button>
							</div>
						</div>
					</form>
				</div>
				<h3><?php echo e(getPhrase($sub_heading2)); ?></h3>
			</div>
		</div>
	</div>
</section>
<!--/SECTION-1 Search goods-->

<!--section 2-OFFER-->
<?php $offers = App\Offers::select('offers.*', 'products.name', 'products.image as product_image', 'products.price', 'products.price_type', 'products.price_variations', 'products.description as product_description', 'products.id as product_id', 'products.slug as product_slug')->join('products', 'products.id', '=', 'offers.product_id')->where('offers.status', '=', 'active')->whereRaw('"'.date('Y-m-d H:i:s') . '" BETWEEN start_date_time and end_date_time')->orderBy('start_date_time', 'desc')->get();
// dd($offers);
?>
<?php if( $offers ): ?>
<?php $__currentLoopData = $offers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $offer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
<section class="offer">
	<div class="container">
		<div class="row">
			<div class="div col-md-12">
				<h3 class="heading"><?php echo e($offer->title); ?></h3>
			</div>
		</div>

		<div class="row">
			<div class="col-md-5  col-sm-6 ">
				<?php
				if( $offer->use_product_image == 'yes' ) {
					$product_image = DEFAULT_PRODUCT_IMAGE;
				if($offer->product_image != '' && file_exists(UPLOAD_PATH_PRODUCTS.$offer->product_image) ) {
						$product_image = UPLOAD_URL_PRODUCTS.$offer->product_image;
					}
				}
				else{
					$product_image = DEFAULT_PRODUCT_IMAGE;
					if($offer->image != '' && file_exists(UPLOAD_PATH_OFFERS.$offer->image))
					$product_image = UPLOAD_URL_OFFERS.$offer->image;
				}
				?>
				<img src="<?php echo e($product_image); ?>" alt="" class="img-responsive">
			</div>
			<div class="col-md-7 col-sm-6">
				<?php
				$product_title = $offer->title;
				$product_description = $offer->description;
				if( $offer->use_product_title == 'yes' ) {
					$product_title = getPhrase('Get ') . '<span>'.$offer->name . '</span>' . getPhrase(' for just ') .  '<span>'.currency( $offer->price ) . '</span>';
				}
				if( $offer->use_product_description == 'yes' ) {
					$product_description = $offer->product_description;
				}
				?>
				<h2><?php echo $product_title; ?></h2>
					<?php echo $product_description; ?>


				<!--for countdown timer-->
				<div class="row">
					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<div class="main">
							<div class="counter">
								<h5><?php echo e(getPhrase('This offer expires on:')); ?> <span> <strong> <?php echo e($offer->end_date_time); ?></strong></span></h5>
								
								<input type="hidden" name="target_date" id="target_date" value="<?php echo e($offer->end_date_time); ?>">
								<!-- /#Countdown Div -->
								
							</div>
							<!-- /.Counter Div -->

						</div>
						<!-- /#Main Div -->
					</div>
					<!-- /.Columns Div -->
				</div>
				<!-- /.Row Div -->



				<!--for buttons-->
				<form action="<?php echo e(URL_DISPLAY_PRODUCTS_CART); ?>" method="POST" class="side-by-side">
				<?php echo csrf_field(); ?>

					<div class="buttons">
						<a href="<?php echo e(URL_DISPLAY_PRODUCTS_DETAILS . $offer->product_slug); ?>" class="btn btn-primary"><?php echo e(getPhrase('VIEW DETAILS', 'upper')); ?></a> &nbsp;
						<?php if( $offer->price_type == 'default'): ?>
							<input type="hidden" name="id" value="<?php echo e($offer->product_id); ?>">
							<input type="hidden" name="name" value="<?php echo e($offer->name); ?>">
							<input type="hidden" name="offer_price" value="<?php echo e($offer->offer_price); ?>">
							<button type="submit" class="btn btn-default"><?php echo e(getPhrase('BUY ') . currency( $offer->offer_price )); ?></button>
						<?php endif; ?>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div>
</div>

</section>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php else: ?>
<div>No Offers Available</div>
<?php endif; ?>
<!--/section 2-OFFER-->

<!--section 3-PRODUCTS-->


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout-site', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>