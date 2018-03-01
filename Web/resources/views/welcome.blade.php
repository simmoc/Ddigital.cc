@extends('layouts.layout-site')

@section('header_scripts')
<link rel="stylesheet" href="{{CSS}}select2.css">
@stop

@section('content')
<!--SECTION-1 Search goods-->
<section class="search-bg">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
			<?php $heading = getSetting('welcome_page_heading','site_settings');
			       $sub_heading = getSetting('welcome_page_sub_heading','site_settings');
			       $sub_heading2 = getSetting('welcome_page_another_heading','site_settings');?>
				<h1 class="hero-title"> {{ $heading }}</h1>
				<p class="search-para">{{ $sub_heading }}</p>
				<div class="sign">	
                    		
						{!! Form::open(array('url' => URL_INDEX_SEARCHPRODUCT, 'method' => 'POST', 'name'=>'fromSearch ',  )) !!}
						<div class="input-group">
							<div class="input-group-btn ">
								<span class=" fa-btn "><i class="fa fa-search hidden-xs"></i></span>
							</div>
							<?php
							$searchproducts = App\Product::where('status', '=', 'Active')->orderBy('created_at', 'desc');
							?>
							<div class="dropdown" ng-controller="searchController">
							<input type="text" name="title" id="title" class="form-control" placeholder="{{ getPhrase('search_by_product') }}" data-toggle="dropdown" ng-model = "changedtext" ng-change="textChanged(changedtext)">								
								<ul class="dropdown-menu search-dropmenu" id="products_dropdown" ng-if = "searchtestlenght==0">
									@if( $searchproducts->count() > 0 )
										@foreach( $searchproducts->paginate(20) as $product )
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
											  <a href="{{ URL_DISPLAY_PRODUCTS_DETAILS.$product->slug.'/'.$product->id }}">
											   <div class="media-left">
											   <?php
												$product_image = DEFAULT_PRODUCT_IMAGE_THUMBNAIL;
												if( $product->image != '' && File::exists(UPLOAD_PATH_PRODUCTS_THUMBNAIL . $product->image ) ) {
													$product_image = UPLOAD_URL_PRODUCTS_THUMBNAIL . $product->image;
												}
												?>
											   <img src="{{ $product_image }}"></div>
												<div class="media-body">
													<h4>{{ $product->name }}</h4>
													<p>
													@if( $product->price_type == 'default' )
														{{ currency( $price) }}
													@else
														{{ currency( $min_price ) }} - {{ currency( $max_price ) }}
													@endif
													</p>
												</div>
												</a>
										</li>
										@endforeach
									@endif		
									
								</ul>


								<ul class="dropdown-menu search-dropmenu" id="products_dropdown" ng-if = "searchtestlenght>0">
									
										<li ng-repeat="myproduct in products">
										<a href="{{ URL_DISPLAY_PRODUCTS_DETAILS}}@{{myproduct.slug}}">
											   <div class="media-left">
											   <?php
												$product_image = DEFAULT_PRODUCT_IMAGE_THUMBNAIL;
												if( $product->image != '' && File::exists(UPLOAD_PATH_PRODUCTS_THUMBNAIL . $product->image ) ) {
													$product_image = UPLOAD_URL_PRODUCTS_THUMBNAIL . $product->image;
												}
												?>
							<img ng-if="myproduct.image==''" src="{{ DEFAULT_PRODUCT_IMAGE_THUMBNAIL }}">
							<img ng-if="myproduct.image!=''" src="{{ UPLOAD_URL_PRODUCTS_THUMBNAIL }}@{{myproduct.image}}">
									 </div>
												<div class="media-body">
													<h4>@{{ myproduct.name }}</h4>
													<p ng-if="myproduct.price_type=='default'">
													<?php
													$currency = getSetting('currency_symbol', 'cart_settings');
													?>
													 {{$currency}} @{{myproduct.price}}
													</p>
												</div>
												</a>
										</li>
									
									
								</ul>
							
							</div>

							<?php
							$categories = App\Category::where('status', '=', 'Active');
							?>
							@if( $categories->count() > 0 )
							<div class="input-group-addon">
								<span class="select">
									<select class="btn btn-select select2" name="category">{{getPhrase('select')}}
										
										@foreach( $categories->get() as $category)
											@if( $category->parent_id == 0 )
												<?php
												$subcats = App\Category::where('status', '=', 'Active')->where('parent_id', '=', $category->id);
												?>
                                           <option value="">Category</option>
											<option value="{{ $category->slug}}">{{getPhrase($category->title)}}</option>
												@if( $subcats->count() > 0 )
													<optgroup>
													@foreach( $subcats->get() as $subcat)
											<option value="{{ $subcat->slug}}">{{ getPhrase($subcat->title)}}</option>
													@endforeach
													</optgroup>
												
												@endif
											@endif
										@endforeach
									</select>
								</span>
							</div>
							@endif
							<!-- /btn-group -->

							<div class="input-group-btn">
								<button class="btn btn-primary btn-search" type="submit"><span class="hidden-xs">{{ getPhrase('search') }}</span><span class="visible-xs fa fa-search"></span></button>
							</div>
						</div>
					{!! Form::close() !!}
				</div>
				<h3>{{$sub_heading2}}</h3>
			</div>
		</div>
	</div>
</section>
<!--/SECTION-1 Search goods-->

<!--section 2-OFFER-->
<?php $offer = App\Offers::select('offers.*', 'products.name', 'products.image as product_image', 'products.price', 'products.price_type', 'products.price_variations', 'products.description as product_description', 'products.id as product_id', 'products.slug as product_slug')->join('products', 'products.id', '=', 'offers.product_id')->where('offers.status', '=', 'active')->whereRaw('"'.date('Y-m-d H:i:s') . '" BETWEEN start_date_time and end_date_time')->orderBy('start_date_time', 'desc')->first();
?>
@if( $offer )
<section class="offer">
	<div class="container">
		<div class="row">
			<div class="div col-md-12">
				<h3 class="heading">{{$offer->title }}</h3>
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
				<img src="{{ $product_image }}" alt="" class="img-responsive">
			</div>
			<div class="col-md-8 col-sm-7 col-xs-12">
				<?php
				$product_title = $offer->title;
				$product_description = $offer->description;
				if( $offer->use_product_title == 'yes' ) {
					$product_title = getPhrase('Get ') . '<span>'.$offer->name . '</span>' . getPhrase(' for just ') .  '<span>'.currency( $offer->offer_price ).'</span>'. getPhrase(' actual_price ').'<span><del>'.currency($product->price). '</del></span>';
				}
				if( $offer->use_product_description == 'yes' ) {
					$product_description = $offer->product_description;
				}
				?>
				<h2>{!! $product_title !!}</h2>
					{!! $product_description !!}

				<!--for countdown timer-->
				<div class="row">
					<div class="ol-md-5 col-sm-5 col-xs-12">
						<div id="main">
							<div class="counter">
								<h6>{{ getPhrase('this_offer_expires_on') }}</h6>
								<div id="countdowner"></div>
								<input type="hidden" name="target_date" id="target_date" value="{{ $offer->end_date_time}}">
								<!-- /#Countdown Div -->
								<ul>
									<li>{{ getPhrase('days') }}</li>
									<li>{{ getPhrase('hours') }}</li>
									<li>{{ getPhrase('mins') }}</li>
									<li>{{ getPhrase('sec') }}</li>
								</ul>
							</div>
							<!-- /.Counter Div -->

						</div>
						<!-- /#Main Div -->
					</div>
					
                    <div class="col-md-7 col-sm-7 col-xs-12">
                        <!--for buttons-->
				<form action="{{ URL_DISPLAY_PRODUCTS_CART }}" method="POST" class="side-by-side">
				{!! csrf_field() !!}
					<div class="buttons clearfix">
					<div class="pull-left digi-top-padding">
						<a href="{{ URL_DISPLAY_PRODUCTS_DETAILS.$offer->product_slug }}" class="btn btn-primary">{{ getPhrase('view_details') }}</a> &nbsp;
						@if( $offer->price_type == 'default')
							<input type="hidden" name="id" value="{{ $offer->product_id }}">
							<input type="hidden" name="name" value="{{ $offer->name }}">
							<input type="hidden" name="offer_price" value="{{ $offer->offer_price }}">
                        </div>
                        <div class="pull-right digi-top-padding">
							<button type="submit" class="btn btn-default">{{ getPhrase('buy') . currency( $offer->offer_price )}}</button>
						@endif
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
      <a href="{{URL_OFFERS_VIEW_ALL}}" class="btn btn-primary">{{getPhrase('more_offers')}}</a>
    </div>
</section>
@endif
<!--/section 2-OFFER-->

<!--section 3-PRODUCTS-->
<div class="grey-bg">
	<div class="container">
		<div class="">
			<div class="row cs-row">
				<div class="col-md-12">
					<h2 class="heading heading-center">{{ getPhrase('products') }}</h2>
					<div class="products">
						<div class="tabs">
							<ul class="list-inline">
								<li><a href="javascript:void(0);" onclick="javascript:getProducts( 'popular')">{{ getPhrase('Popular') }}</a></li>
								<li><a href="javascript:void(0);" onclick="javascript:getProducts( 'featured')">{{ getPhrase('Featured') }}</a></li>
								<li><a href="javascript:void(0);" onclick="javascript:getProducts( 'latest')">{{ getPhrase('Latest') }}</a></li>
								<li><a href="javascript:void(0);" onclick="javascript:getProducts( 'free')">{{ getPhrase('Freebies') }}</a></li>
							</ul>
						</div>
					</div>
				</div>				
				<div class="row" id="products">
				@include('displayproducts.products', array('products' => $products, 'nopagelinks' => 1, 'type' => 'related'))
				</div>
				<div class="col-lg-12">
					<div class="products-button">						
						<a class="btn btn-primary" href="{{ URL_DISPLAY_PRODUCTS }}">{{ getPhrase('see_all_products') }}</a>
					</div>
				</div>

			</div>

		</div>
	</div>
</div>
<!--/section 3-PRODUCTS-->

<!--section-4 CATEGORIES-->
@include('displayproducts.home-view', array('products' => $category_products))
<!--/section-4 CATEGORIES-->

<!--SECTION-5 SIGN UP-->
@include('common.subscrption-form')
<!--/SECTION-5 SIGN UP-->
@endsection

@section('footer_scripts')
@include('common.search-products-script')
	@include('common.select2')
	<script type="text/javascript">
	$('#title').on( 'mousehover', function(){
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
	@include('common.subscribe')
@endsection