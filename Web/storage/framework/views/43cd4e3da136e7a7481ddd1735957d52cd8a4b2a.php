<?php $__env->startSection('header_scripts'); ?>
<link rel="stylesheet" href="<?php echo e(CSS); ?>select2.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<!--SECTION-1 Search goods-->
<section class="search-bg">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h1 class="hero-title"> <?php echo e(getPhrase('welcome_to_digi_downloads')); ?></h1>
				<p class="search-para"><?php echo e(getPhrase('home_page_banner_sub_heading')); ?></p>
				<div class="sign">	
                    <form>				
						<?php echo Form::open(array('url' => URL_INDEX_SEARCHPRODUCT, 'method' => 'POST', 'name'=>'fromSearch ',  )); ?>

						<div class="input-group">
							<div class="input-group-btn ">
								<span class=" fa-btn "><i class="fa fa-search hidden-xs"></i></span>
							</div>
							<?php
							$searchproducts = App\Product::where('status', '=', 'Active')->orderBy('created_at', 'desc');
							?>
							<div class="dropdown">
							<input type="text" name="title" id="title" class="form-control" placeholder="<?php echo e(getPhrase('search_by_product')); ?>" data-toggle="dropdown">								
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

							<?php
							$categories = App\Category::where('status', '=', 'Active');
							?>
							<?php if( $categories->count() > 0 ): ?>
							<div class="input-group-addon">
								<span class="select">
									<select class="btn btn-select select2" name="category"><?php echo e(getPhrase('select')); ?>

										
										<?php $__currentLoopData = $categories->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<?php if( $category->parent_id == 0 ): ?>
												<?php
												$subcats = App\Category::where('status', '=', 'Active')->where('parent_id', '=', $category->id);
												?>
                                           <option value="">Category</option>
											<option value="<?php echo e($category->slug); ?>"><?php echo e(getPhrase($category->title)); ?></option>
												<?php if( $subcats->count() > 0 ): ?>
													<optgroup>
													<?php $__currentLoopData = $subcats->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
											<option value="<?php echo e($subcat->slug); ?>"><?php echo e(getPhrase($subcat->title)); ?></option>
													<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
													</optgroup>
												
												<?php endif; ?>
											<?php endif; ?>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
								</span>
							</div>
							<?php endif; ?>
							<!-- /btn-group -->

							<div class="input-group-btn">
								<button class="btn btn-primary btn-search" type="submit"><span class="hidden-xs"><?php echo e(getPhrase('search')); ?></span><span class="visible-xs fa fa-search"></span></button>
							</div>
						</div>
					</form>
				</div>
				<h3>UI Kits, Themes, HTML Templates Strarting From $5</h3>
			</div>
		</div>
	</div>
</section>
<!--/SECTION-1 Search goods-->

<!--section 2-OFFER-->
<?php $offer = App\Offers::select('offers.*', 'products.name', 'products.image as product_image', 'products.price', 'products.price_type', 'products.price_variations', 'products.description as product_description', 'products.id as product_id', 'products.slug as product_slug')->join('products', 'products.id', '=', 'offers.product_id')->where('offers.status', '=', 'active')->whereRaw('"'.date('Y-m-d H:i:s') . '" BETWEEN start_date_time and end_date_time')->orderBy('start_date_time', 'desc')->first();
?>
<?php if( $offer ): ?>
<section class="offer">
	<div class="container">
		<div class="row">
			<div class="div col-md-12">
				<h3 class="heading"><?php echo e($offer->title); ?></h3>
			</div>
		</div>

		<div class="row">
			<div class="col-md-4  col-sm-5 col-xs-12">
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
			<div class="col-md-8 col-sm-7 col-xs-12">
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
					<div class="ol-md-5 col-sm-5 col-xs-12">
						<div id="main">
							<div class="counter">
								<h6><?php echo e(getPhrase('this_offer_expires_on')); ?></h6>
								<div id="countdowner"></div>
								<input type="hidden" name="target_date" id="target_date" value="<?php echo e($offer->end_date_time); ?>">
								<!-- /#Countdown Div -->
								<ul>
									<li><?php echo e(getPhrase('days')); ?></li>
									<li><?php echo e(getPhrase('hours')); ?></li>
									<li><?php echo e(getPhrase('mins')); ?></li>
									<li><?php echo e(getPhrase('sec')); ?></li>
								</ul>
							</div>
							<!-- /.Counter Div -->

						</div>
						<!-- /#Main Div -->
					</div>
					
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <!--for buttons-->
				<form action="<?php echo e(URL_DISPLAY_PRODUCTS_CART); ?>" method="POST" class="side-by-side">
				<?php echo csrf_field(); ?>

					<div class="buttons clearfix">
					<div class="pull-left digi-top-padding">
						<a href="<?php echo e(URL_DISPLAY_PRODUCTS_DETAILS . $offer->product_slug); ?>" class="btn btn-primary"><?php echo e(getPhrase('view_details')); ?></a> &nbsp;
						<?php if( $offer->price_type == 'default'): ?>
							<input type="hidden" name="id" value="<?php echo e($offer->product_id); ?>">
							<input type="hidden" name="name" value="<?php echo e($offer->name); ?>">
							<input type="hidden" name="price" value="<?php echo e($offer->price); ?>">
                        </div>
                        <div class="pull-right digi-top-padding">
							<button type="submit" class="btn btn-default"><?php echo e(getPhrase('buy') . currency( $offer->price )); ?></button>
						<?php endif; ?>
                       </div>
					</div>
				</form>
                    </div>
					<!-- /.Columns Div -->
				</div>
				<!-- /.Row Div -->		
			</div>
		</div>
	</div>
	<div class="text-center">
      <a href="<?php echo e(URL_OFFERS_VIEW_ALL); ?>" class="btn btn-primary"><?php echo e(getPhrase('more_offers')); ?></a>
    </div>
</section>
<?php endif; ?>
<!--/section 2-OFFER-->

<!--section 3-PRODUCTS-->
<div class="grey-bg">
	<div class="container">
		<div class="">
			<div class="row cs-row">
				<div class="col-md-12">
					<h2 class="heading heading-center"><?php echo e(getPhrase('products')); ?></h2>
					<div class="products">
						<div class="tabs">
							<ul class="list-inline">
								<li><a href="javascript:void(0);" onclick="javascript:getProducts( 'popular')"><?php echo e(getPhrase('Popular')); ?></a></li>
								<li><a href="javascript:void(0);" onclick="javascript:getProducts( 'featured')"><?php echo e(getPhrase('Featured')); ?></a></li>
								<li><a href="javascript:void(0);" onclick="javascript:getProducts( 'latest')"><?php echo e(getPhrase('Latest')); ?></a></li>
								<li><a href="javascript:void(0);" onclick="javascript:getProducts( 'free')"><?php echo e(getPhrase('Freebies')); ?></a></li>
							</ul>
						</div>
					</div>
				</div>				
				<div class="row" id="products">
				<?php echo $__env->make('displayproducts.products', array('products' => $products, 'nopagelinks' => 1, 'type' => 'related'), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>
				<div class="col-lg-12">
					<div class="products-button">						
						<a class="btn btn-primary" href="<?php echo e(URL_DISPLAY_PRODUCTS); ?>"><?php echo e(getPhrase('see_all_products')); ?></a>
					</div>
				</div>

			</div>

		</div>
	</div>
</div>
<!--/section 3-PRODUCTS-->

<!--section-4 CATEGORIES-->
<?php echo $__env->make('displayproducts.home-view', array('products' => $category_products), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!--/section-4 CATEGORIES-->

<!--SECTION-5 SIGN UP-->
<?php echo $__env->make('common.subscrption-form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<!--/SECTION-5 SIGN UP-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
	<?php echo $__env->make('common.select2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<script type="text/javascript">
	$('#title').on( 'keydown', function(){
			$('#products_dropdown').hide();
	});
	
	function getProducts(param) {
        $.ajax({
            url : '?param=' + param,
            dataType: 'html',
        }).done(function (data) {
            $('#products').html(data);			
			//window.location.hash = '?page=' + page + '&param=' + param;
			//location.hash = page;
        }).fail(function () {
            alert('Posts could not be loaded.');
        });
    }
	</script>
	<?php echo $__env->make('common.subscribe', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout-site', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>