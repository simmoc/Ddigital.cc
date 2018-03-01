@extends('layouts.layout-site')

@section('content')
<!--SECTION-1 BANNER-->
<section class="login-banner">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
			  @if($paymentdetails->payment_status=='success')
				<h2>{{ getPhrase('payment_status : success') }}</h2>
		      @else
		        <h2>{{ getPhrase('payment_status : pending') }}</h2>
		      @endif  		
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
		<div class="">
			<div class="">
			@include('errors.errors')
		@if(isset($payment_details))			
			@if( $paymentmethod == 'offline-payment')
			 <div class="jumbotron">
			  <h3>{{getPhrase('offline_payment_instructions')}}</h3>
			  <?php $instructions = $paypal = getSetting('offline_payment_information', 'payment_gateways'); ?>
			  {!!$instructions!!}
			</div>
			@endif
		@endif	
			<div class="jumbotron">
				<h3>{{getPhrase('payment_details')}}</h3>
					<fieldset class="form-group col-md-12">
					
					{{ Form::label('actual_cost', getphrase('actual_cost : ')) }}
					{{ currency( $paymentdetails->actual_cost ) }}
					</fieldset>
					@if($paymentdetails->tax)
					<fieldset class="form-group col-md-12">
					{{ Form::label('tax', getphrase('tax : ')) }}
					{{ currency( $paymentdetails->tax ) }}
					</fieldset>
					@endif
					@if($paymentdetails->discount_amount)
					<fieldset class="form-group col-md-12">
					{{ Form::label('discount', getphrase('discount : ')) }}
					{{ currency( $paymentdetails->discount_amount ) }}
					</fieldset>
					@endif
					
					<fieldset class="form-group col-md-12">
					{{ Form::label('amount_paid', getphrase('amount_paid : ')) }}
					{{ currency( $paymentdetails->paid_amount ) }}
					</fieldset>
					
					<fieldset class="form-group col-md-12">
					{{ Form::label('payment_status', getphrase('payment_status : ')) }}
					{{ ucfirst( $paymentdetails->payment_status ) }}
					</fieldset>
					@if($paymentdetails->payment_details)
					<fieldset class="form-group col-md-12">
					{{ Form::label('payment_details', getphrase('payment_details : ')) }}
					{{ $paymentdetails->payment_details }}
					</fieldset>
					@endif
					@if($paymentdetails->payment_status == 'success')
					<fieldset class="form-group col-md-12">
					{{ Form::label('download', getphrase('download : ')) }}
					<a href="{{ URL_CART_DOWNLOAD.$paymentdetails->slug}}">
					<span class="fa fa-download"></span>
					</a>
					</fieldset>
					@endif
					
			</div>
			
			<div class="jumbotron">
				<h3>{{getPhrase('purchase_details')}}</h3>
					
				<table class="table">
				<thead>
					<tr>
						<th>{{ getPhrase('Image') }}</th>
						<th>{{ getPhrase('Product Name') }}</th>
						<th>{{ getPhrase('Product Price') }}</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($cart_details as $item)
					<tr>
						<td class="table-image">
						<?php
						$product_image = DEFAULT_PRODUCT_IMAGE_THUMBNAIL;
						if( $item->model->image != '' && File::exists(UPLOAD_PATH_PRODUCTS_THUMBNAIL . $item->model->image ) ) {
							$product_image = UPLOAD_URL_PRODUCTS_THUMBNAIL.$item->model->image;
						}
						?>
						<a href="{{ URL_DISPLAY_PRODUCTS_DETAILS.$item->model->slug }}"><img src="{{ $product_image }}" alt="product" class="img-responsive cart-image"></a></td>
						
						<td><a href="{{ URL_DISPLAY_PRODUCTS_DETAILS.$item->model->slug }}">{{ $item->name }}</a></td>
						
						<td class="colu2">{{ currency($item->subtotal) }}</td>
						
					</tr>
					@endforeach
					
				</tbody>
			</table>
			</div>			
			
			</div>
			
		</div>
	</div>
</section>

<!--/SECTION cart-->
 @endsection
 
 @section('footer_scripts')
<script >
	history.pushState(null, null, location.href);
window.onpopstate = function(event) {
    history.go(1);
};
</script>
 @include('common.validations');    
@stop