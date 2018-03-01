<!--section-4 CATEGORIES-->
<div class="categories ">
	<div class="container">
		<div class="row cs-row">
			<div class="col-sm-12">
				<div class="tabs1">
					<ul class="list-inline">
						<!--
						<li><a href="javascript:void(0);" onclick="javascript:getProducts(1, 'popular')"><?php echo e(getPhrase('Most Popular')); ?></a></li>
						<li><a href="javascript:void(0);" onclick="javascript:getProducts(1, 'reatured')"><?php echo e(getPhrase('Featured')); ?></a></li>
						<li><a href="javascript:void(0);" onclick="javascript:getProducts(1, 'latest')"><?php echo e(getPhrase('Latest')); ?></a></li>
						<li><a href="javascript:void(0);" onclick="javascript:getProducts(1, 'free')"><?php echo e(getPhrase('Freebies')); ?></a></li>
						-->
						<?php
						$url = $popular = $featured = $latest = $free = Request::capture()->fullUrl();
						if( strpos($url,'?') !== false ) { // If question mark found
							if( strpos($url,'popular=true') === false ) {
								$popular = $url . '&popular=true';
							}
							if( strpos($url,'featured=true') === false ) {
								$featured = $url . '&featured=true';
							}
							if( strpos($url,'latest=true') === false ) {
								$latest = $url . '&latest=true';
							}
							if( strpos($url,'free=true') === false ) {
								$free = $url . '&free=true';
							}
						} else {
							if( strpos($url,'popular=true') === false ) {
								$popular = $url . '?popular=true';
							}
							if( strpos($url,'featured=true') === false ) {
								$featured = $url . '?featured=true';
							}
							if( strpos($url,'latest=true') === false ) {
								$latest = $url . '?latest=true';
							}
							if( strpos($url,'free=true') === false ) {
								$free = $url . '?free=true';
							}
						}							
						?>
						<!-- <li <?php if( strpos($url, 'popular=true') !== false ): ?> class="active" <?php endif; ?>><a href="<?php echo e($popular); ?>"><?php echo e(getPhrase('Most Popular')); ?></a></li>
						<li <?php if( strpos($url, 'featured=true') !== false ): ?> class="active" <?php endif; ?>><a href="<?php echo e($featured); ?>"><?php echo e(getPhrase('Featured')); ?></a></li>
						<li <?php if( strpos($url, 'latest=true') !== false ): ?> class="active" <?php endif; ?>><a href="<?php echo e($latest); ?>"><?php echo e(getPhrase('Latest')); ?></a></li>
						<li <?php if( strpos($url, 'free=true') !== false ): ?> class="active" <?php endif; ?>><a href="<?php echo e($free); ?>"><?php echo e(getPhrase('Freebies')); ?></a></li> -->
					</ul>
				</div>
			</div>
			<div class="col-md-3 col-sm-12">
				<!--for left side columns-->
				<div class="panel panel-default">
					<div class="panel-heading"><?php echo e(getPhrase('categories')); ?></div>
					<div class="panel-body">
						<?php
						$categories = App\Category::where('status', '=', 'Active')->get();
						?>

						<?php if( count($categories) > 0 ): ?>
						<ul class="nav nav-pills nav-stacked">
							<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							     <?php $total_products  =App\Products_Categories::where('category_id','=',$category->id)->get()->count(); ?>
								<li class="<?php echo e(isActive($selected_category, $category->slug)); ?>">
								<?php if( $category->parent_id == 0 ): ?>
								<a href="<?php echo e(URL_DISPLAY_PRODUCTS.'/'.$category->slug); ?>"><?php echo e(getPhrase($category->title)); ?><span class="number"></span></a>
								<!-- <?php
								$subcats = App\Category::where('status', '=', 'Active')->where('parent_id', '=', $category->id);
								?>
								<?php if( $subcats->count() > 0 ): ?>
									<ul class="dropdown-menu">
									<?php $__currentLoopData = $subcats->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<li><a href="<?php echo e(URL_DISPLAY_PRODUCTS .'?category=' . $category->slug . '&sub-category=' . $subcat->slug); ?>"> <?php echo e($subcat->title); ?><span class="number">(<?php echo e(App\Products_Categories::where('category_id', '=', $subcat->id)->count()); ?>)</span></a> </li>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</ul>
								<?php endif; ?> -->
								<?php endif; ?>
								</li>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>                                
						</ul>
						<?php endif; ?>

					</div>
				</div>
			</div>
			<div class="col-md-9 col-sm-12">
				<!--for right side columns-->
			   
				<div class="row" id="products">
					<?php echo $__env->make('displayproducts.view-more', array('products' => $products), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				</div>				
				
			</div>
		</div>
	</div>
</div>
<!--/section-4 CATEGORIES-->