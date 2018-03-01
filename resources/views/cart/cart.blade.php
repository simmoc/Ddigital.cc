@extends('layouts.layout-site')

@section('content')
<!--SECTION-1 BANNER-->
<section class="login-banner">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h2>{{ getPhrase('cart') }}</h2>
			</div>
		</div>
	</div>
</section>
<!--/SECTION BANNER-->

<!--SECTION cart-->
<section class="cart  animated fadeInDown">
	<div class="container">
		@if (session()->has('success_message'))
            <div class="alert alert-success">
                {{ session()->get('success_message') }}
            </div>
        @endif

        @if (session()->has('error_message'))
            <div class="alert alert-danger">
                {{ session()->get('error_message') }}
            </div>
        @endif
		<div class="row">
			@if (sizeof(Cart::content()) > 0)
			<div class="col-md-8 col-sm-12">
				<h2>{{ getPhrase('YOUR CART') }}</h2>
				
				<table class="table">
					<thead>
						<tr>
							<th>{{ getPhrase('image') }}</th>
							<th>{{ getPhrase('product_name') }}</th>
							<th>{{ getPhrase('product_price') }}</th>
							<th>{{ getPhrase('options') }}</th>
						</tr>
					</thead>
					<tbody>
						@foreach (Cart::content() as $item)
						<tr>
							<td class="table-image">
							<?php
							$product_image = DEFAULT_PRODUCT_IMAGE_THUMBNAIL;
							if( $item->model->image != '' && File::exists(UPLOAD_PATH_PRODUCTS_THUMBNAIL.$item->model->image ) ) {
								$product_image = UPLOAD_URL_PRODUCTS_THUMBNAIL.$item->model->image;
							}
							?>
							<a href="{{ URL_DISPLAY_PRODUCTS_DETAILS.$item->model->slug }}"><img src="{{ $product_image }}" alt="product" class="cart-image" height="45" width="45"></a></td>
							
							<td><a href="{{ URL_DISPLAY_PRODUCTS_DETAILS.$item->model->slug }}">{{ getPhrase($item->name) }}</a></td>
							
							<td class="colu2">{{ currency( $item->subtotal ) }}</td>
							<td class="colu3">
						      <form action="{{ url('cart', [$item->rowId]) }}" method="POST" class="side-by-side">
                                {!! csrf_field() !!}
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-sm">
								<span class="fa fa-times"></span>
								</button>
                            </form>
							</td>

						</tr>
						@endforeach
						
					</tbody>
				</table>
               <div class="cart-button btn-left">
                <a href="{{ URL_DISPLAY_PRODUCTS }}" class="btn btn-primary">{{ getPhrase('continue_shopping') }}</a>	
                </div>		
			</div>
			<div class="col-md-4 col-sm-12">
				<h2>{{ getPhrase('total_cart') }}</h2>
				<div class="total">
					<p class="fee">{{ getPhrase('products_price') }} <span>{{ currency( Cart::instance('default')->subtotal() ) }}</span></p>


                    <?php $dispaly_incheckout = getSetting('display_during_checkout','cart_settings');
                    ?>
                    @if($dispaly_incheckout=='yes')
					<p class="fee">{{ getPhrase('tax') }} <span>{{ currency( Cart::instance('default')->tax() ) }}</span></p>
					@endif

					<?php
					$licence_price = 0;
					?>
					@if(session()->has('licence_price'))
					<p class="fee">{{ getPhrase('support_fee') }} <span>{{ currency( session()->get('licence_price') ) }}</span></p>
					<?php $licence_price = session()->get('licence_price');?>
					@endif
					
					<?php
					$discount_amount = 0;
					?>
					@if(session()->has('discount_amount'))
					<p class="fee">{{ getPhrase('coupon_code_off') }} <span>{{ currency( session()->get('discount_amount') ) }}</span></p>
					<?php $discount_amount = session()->get('discount_amount');?>
					@endif

					
                     
                     <?php $prices_and_tax = getSetting('prices_entered_with_tax','cart_settings');
                     ?>
                     
                    @if($prices_and_tax=='yes')

                    <p class="fees">{{ getPhrase('total_price') }} <span>

                     <?php
					$cart_total = $parsed = floatval(preg_replace('/[^\d.]/', '', Cart::instance('default')->subtotal()));
					?>
					{{ currency( $cart_total + $licence_price - $discount_amount ) }}</span></p>

                    @else

                    <p class="fees">{{ getPhrase('total_price') }} <span>

					<?php
					$cart_total = $parsed = floatval(preg_replace('/[^\d.]/', '', Cart::total()));
					?>
					{{ currency( $cart_total + $licence_price - $discount_amount ) }}</span></p>

					@endif

				</div>
                @if (sizeof(Cart::content()) > 0)
				<div class="cart-button">
                    <a href="{{ URL_CHECKOUT }}" type="submit" class="btn btn-primary">{{ getPhrase('check_out') }}</a>
				</div>
                @endif
			</div>
			
			@else
			<div class="btn-center">
				<div class="alert alert-danger">
				{{ getPhrase('your_cart_is_empty') }}
				</div>
            </div>
			@endif
          
           
			
		</div>
	</div>
</section>
<!--/SECTION cart-->
@endsection