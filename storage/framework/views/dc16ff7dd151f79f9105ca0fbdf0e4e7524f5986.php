<?php $__env->startSection('header_scripts'); ?>
<link rel="stylesheet" href="<?php echo e(CSS); ?>select2.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!--SECTION-1 Search goods-->
  <!--  <section class="container">
    <div style="text-align: center; color: #45b289;"><h2><b><?php echo e(getPhrase('all_offers')); ?></b></h2></div>
   	
   </section> -->
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
					$product_title = getPhrase('Get ') . '<span>'.$offer->name . '</span>' . getPhrase(' for just ') .  '<span>'.currency( $offer->offer_price ) . '</span>'. getPhrase(' actual_price ').'<span><del>'.currency($offer->price). '</del></span>';
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

					<div class="buttons clearfix">
					<div class="pull-left digi-top-padding">
						<a href="<?php echo e(URL_DISPLAY_PRODUCTS_DETAILS.$offer->product_slug.'/'.$offer->product_id); ?>" class="btn btn-primary"><?php echo e(getPhrase('view_details')); ?></a> &nbsp;
						<?php if( $offer->price_type == 'default'): ?>
							<input type="hidden" name="id" value="<?php echo e($offer->product_id); ?>">
							<input type="hidden" name="name" value="<?php echo e($offer->name); ?>">
							<input type="hidden" name="offer_price" value="<?php echo e($offer->offer_price); ?>">
                        </div>
                        <div class="pull-right digi-top-padding">
							<button type="submit" class="btn btn-default"><?php echo e(getPhrase('buy') . currency( $offer->offer_price )); ?></button>
						<?php endif; ?>
                       </div>
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