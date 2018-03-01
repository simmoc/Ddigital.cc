<!--section-4 CATEGORIES-->
<div class="categories ">
	<div class="container">
		<div class="row cs-row">
			<div class="col-sm-12">
				<div class="tabs1">
					<ul class="list-inline">
						<!--
						<li><a href="javascript:void(0);" onclick="javascript:getProducts(1, 'popular')">{{ getPhrase('Most Popular') }}</a></li>
						<li><a href="javascript:void(0);" onclick="javascript:getProducts(1, 'reatured')">{{ getPhrase('Featured') }}</a></li>
						<li><a href="javascript:void(0);" onclick="javascript:getProducts(1, 'latest')">{{ getPhrase('Latest') }}</a></li>
						<li><a href="javascript:void(0);" onclick="javascript:getProducts(1, 'free')">{{ getPhrase('Freebies') }}</a></li>
						-->
						<?php
						$url = $popular = $featured = $latest = $free = url()->current();
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
						<li @if( strpos($url, 'popular=true') !== false ) class="active" @endif><a href="{{ $popular }}">{{ getPhrase('Most Popular') }}</a></li>
						<li @if( strpos($url, 'featured=true') !== false ) class="active" @endif><a href="{{ $featured }}">{{ getPhrase('Featured') }}</a></li>
						<li @if( strpos($url, 'latest=true') !== false ) class="active" @endif><a href="{{ $latest }}">{{ getPhrase('Latest') }}</a></li>
						<li @if( strpos($url, 'free=true') !== false ) class="active" @endif><a href="{{ $free }}">{{ getPhrase('Freebies') }}</a></li>
					</ul>
				</div>
			</div>
			<div class="col-md-3 col-sm-12">
				<!--for left side columns-->
				<div class="panel panel-default">
					<div class="panel-heading">{{ getPhrase('categories') }}</div>
					<div class="panel-body">
						<?php
						$categories = App\Category::where('status', '=', 'Active')->get();
						?>

						@if( count($categories) > 0 )
						<ul class="nav nav-pills nav-stacked">
							@foreach( $categories as $category)
							     <?php $total_products  =App\Products_Categories::where('category_id','=',$category->id)->get()->count(); ?>
								<li class="{{ isActive($selected_category, $category->slug) }}">
								@if( $category->parent_id == 0 )
								<a href="{{  URL_DISPLAY_PRODUCTS .'/'. $category->slug}}">{{ getPhrase($category->title)}}<span class="number"></span></a>
								<!-- <?php
								$subcats = App\Category::where('status', '=', 'Active')->where('parent_id', '=', $category->id);
								?>
								@if( $subcats->count() > 0 )
									<ul class="dropdown-menu">
									@foreach( $subcats->get() as $subcat)
										<li><a href="{{ URL_DISPLAY_PRODUCTS .'?category=' . $category->slug . '&sub-category=' . $subcat->slug}}"> {{ $subcat->title }}<span class="number">({{ App\Products_Categories::where('category_id', '=', $subcat->id)->count() }})</span></a> </li>
									@endforeach
									</ul>
								@endif -->
								@endif
								</li>
							@endforeach                                
						</ul>
						@endif

					</div>
				</div>
			</div>
			<div class="col-md-9 col-sm-12">
				<!--for right side columns-->
			   
				<div class="row" id="products">
					@include('displayproducts.products', array('products' => $products))
				</div>				
				
			</div>
		</div>
	</div>
</div>
<!--/section-4 CATEGORIES-->