@extends('layouts.layout-site')

@section('content')
<!--SECTION-1 BANNER-->
<section class="login-banner">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h2>{{ $title }}</h2>
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
			<div class="col-md-8 col-sm-12">
			@include('errors.errors')
			<div class="alert alert-info">
			<strong>{{getPhrase('warning')}}!</strong>  &nbsp;{{getPhrase('do_not_refresh_this_page')}}
			</div>
			
			<?php $button_name = getPhrase('submit'); 

			?>
			<?php $status = getSetting('status', 'offline_payment'); ?>
			@if($status=='active')
			 <div class="jumbotron">
			  <h3>{{getPhrase('offline_payment_instructions')}}</h3>
			  <?php $instructions = $paypal = getSetting('offline_payment_information', 'offline_payment');
			  
			   ?>
			  {!!$instructions!!}
			</div>
			@endif
			{!! Form::open(array('url' => URL_UPDATE_OFFLINE_PAYMENT, 'method' => 'POST', 'name'=>'formQuiz ',  )) !!}
			<input type="hidden" name="token" value="{{ $token }}">	 
			<div class="row">
			 <fieldset class="form-group col-md-12">
			 {{ Form::label('payment_details', getphrase('payment_details')) }}
				<span class="text-red">*</span>
					 <textarea name="payment_details" ng-model="payment_details"
					 required="true" class='form-control ckeditor'  rows="5"></textarea>
				<div class="validation-error"    >
					{!! getValidationMessage()!!}
				</div>
			</fieldset>
			</div>
			
				<div class="buttons text-center">
					<button class="btn btn-lg btn-success button"
					 >{{ getPhrase($button_name) }}</button>
				</div>
			{!! Form::close() !!}	
			
			</div>
			<?php $payment_data = App\Payment::where('slug','=',$token)->first();
			 
			?>
			@if (sizeof(Cart::content()) > 0)
			<div class="col-md-4 col-sm-12">
				  <h2>TOTAL CART</h2>
				 <div class="total">
					  <p class="fee">{{getPhrase('products_price')}} : <span>{{ currency( Cart::instance('default')->subtotal() ) }}</span></p>
					  <p class="fee">{{getPhrase('tax')}} : <span>{{ currency( Cart::instance('default')->tax() ) }}</span></p>
					  <p class="fee">{{getPhrase('support_fee')}} : <span>{{currency($payment_data->licence_price)}}</span></p>
					  <p class="fee">{{getPhrase('coupon_code_off')}} : <span>- {{currency($payment_data->discount_amount)}}</span></p>
					  <?php $cart_total = $parsed = floatval(preg_replace('/[^\d.]/', '', Cart::total()));?>
					  <p class="fees">{{getPhrase('total_price')}} : <span>{{ currency( $cart_total+ $payment_data->licence_price - $payment_data->discount_amount ) }}</span></p>

				 </div>
			</div>
			@endif
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