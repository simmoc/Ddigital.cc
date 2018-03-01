<?php
$extra_class = '';
if( isset($type) && $type == 'related')
	$extra_class = 'product-lg';
?>
@if( $products->count() > 0 )
	@foreach( $products as $product )
     
@if(!Auth::guest())
	  <?php 
	  $user_id = Auth::user()->id;
	  ?>
@endif	  
	<div class="col-md-4 col-sm-6">
		<!-- Product -->
		<div class="product {{ $extra_class }}">
			<div class="portfolio-item">
			
				<?php
				$product_image = DEFAULT_PRODUCT_IMAGE_THUMBNAIL;
				if( $product->image != '' && File::exists(UPLOAD_PATH_PRODUCTS_THUMBNAIL.$product->image ) ) {
					$product_image = UPLOAD_URL_PRODUCTS.$product->image;
				}
				?>
				<img src="{{ $product_image }}"  alt="" >
				<!-- portfolio item hover -->
				<div class="portfolio-hover">
					<div class="portfolio-hover-content font-reg">
						<ul class="pair-btns">
							@if($product->price_type == 'default')
							<li>
							<form action="{{ URL_DISPLAY_PRODUCTS_CART }}" method="POST" class="side-by-side">
								{!! csrf_field() !!}
								@if( $product->price_type == 'default' )
								<input type="hidden" name="id" value="{{ $product->id }}">
								<input type="hidden" name="name" value="{{ $product->name }}">
								<input type="hidden" name="price" value="{{ $product->price }}">
								@endif
								<input type="hidden" name="price_type" value="{{ $product->price_type }}">
								@if(Auth::guest())
								  @if($product->price!=0.00)
								     <button type="submit" class="btn btn-buy">{{ getPhrase('buy_now') }}</button>
								  @endif   
								@endif

								@if(!Auth::guest())
								<?php $product_owner_id  = $product->user_created;?>
								@if($user_id!= $product_owner_id)
								  @if($product->price!=0.00)
								     <button type="submit" class="btn btn-buy">{{ getPhrase('buy_now') }}</button>
								  @endif   
								@endif
								@endif
							</form>
							</li>
							@endif
							<li><a href="{{ URL_DISPLAY_PRODUCTS_DETAILS . $product->slug .'/'. $product->id}}" class="btn btn-view">{{ getPhrase('details') }}</a></li>
						</ul>
					</div>
				</div>
			</div>
			<?php
			$author = getUserRecord( $product->user_created);
			?>
			<div class="product-content">
				<span class="product-price">
				
               

			   	
				@if( $product->price_type == 'default' )
				<?php $display_with_tax = getSetting('display_tax_rate_on_prices','cart_settings');
				?>
				    @if($display_with_tax=='yes')
				      {{currency( Cart::instance('default')->tax()+$product->price)}}
				    @else  
					{{ currency( $product->price ) }}

					@endif
				@else
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
				{{ currency( $min_price ) }} - {{ currency( $max_price ) }}
				@endif
				</span>
				<a href="{{URL_DISPLAY_PRODUCTS_DETAILS.$product->slug .'/'. $product->id }}" class="product-title" title="{{ $product->name }}"> {{ getPhrase(strlen($product->name) < 15) ? getPhrase($product->name) : getPhrase(substr($product->name,0,15)).'...' }} </a>
				<a href="{{ URL_DISPLAYPRODUCTS_VENDORDETAILS . $author->slug }}">
					<div class="product-author ">
						<div class="media-left">
							<img src="{{getProfilePath($author->image)}}" alt="user-avatar" class=" img-circle">
						</div>
						<div class="media-body">
							<p>{{ $author->name }}</p>
						</div>
					</div>
				</a>
			</div>
            </div>
        </div>
        
		<!-- /Product -->
	
	@endforeach
	 <div class="products-button">						
						<a class="btn btn-primary" href="{{ URL_DISPLAY_PRODUCTS }}">{{ getPhrase('view_more') }}</a>
					</div>
	<!-- @if( ! isset($nopagelinks) )
		{{ $products->links() }}
	@endif -->
	@else
		<div class="col-md-4 col-sm-6"> {{ getPhrase('no_products_found') }}
		</div>
	@endif
