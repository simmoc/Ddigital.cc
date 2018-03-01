@extends('layouts.layout-site')
@section('header_scripts')
	<link rel="stylesheet" href="{{CSS}}select2.css">
@endsection

@section('content')
<!--SECTION-1 BANNER-->
<section class="login-banner">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h2>{{ getPhrase('check_out') }}</h2>
			</div>
		</div>
	</div>
</section>
<!--/SECTION BANNER-->

<!--SECTION cart checkout-->
<section class="checkout">
<div class="container">
	<div class="row">
	@if(Auth::check())
		<?php
		$user = getUserRecord();
		?>
		{!! Form::model($user, array('url' => URL_PAYNOW, 'method' => 'POST', 'name'=>'formName', 'id' => 'formName')) !!}
	@else
		{!! Form::open(array('url' => URL_PAYNOW, 'method' => 'POST', 'name'=>'formName', 'id' => 'formName')) !!}
	@endif
	
	@include('errors.errors')
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
	
	<div class="col-md-8 col-sm-12">
	    <?php $licence_amount = session()->get('licence_price');
	     ?>
		@if( Cart::total() > 0 || $licence_amount>0)
		<h2>{{ getPhrase('select_payment_method') }}</h2>		
		<div class="checkout-box">
			<div class="input-group ">
				<div class="radio">
				@foreach( $payment_gateways as $gateway )
				<div>
					<label>
						<input type="radio" value="{{ $gateway->slug }}" name="gateway">
						<span class="radio-content">
					<span class="item-content">{{ $gateway->title }}</span>
						<i aria-hidden="true" class="fa uncheck fa-circle-thin"></i>
						<i aria-hidden="true" class="fa check fa-dot-circle-o"></i>
						</span>
					</label>
				</div>
				@endforeach
				</div>
			</div>
		</div>
		@else
		<input type="hidden" name="gateway" value="Free">
		@endif

		<div class="check-form  animated fadeInDown">
		
		<div class="form-group">
		{{ Form::label('email', getPhrase( 'Email address' ) ) }} {!! required_field(); !!}
		{{ Form::text('email', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'email_address' ), 
				'title' => getPhrase('Email address' ), 
				'data-toggle' => 'tooltip',
				'data-validation' => "[NOTEMPTY]"
				)) }}
	   </div>
	   <div class="form-group">
		{{ Form::label('first_name', getPhrase( 'First Name' ) ) }} {!! required_field(); !!}
		{{ Form::text('first_name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'first_name' ), 
				'title' => getPhrase('First Name' ), 
				'data-toggle' => 'tooltip',
				)) }}
	   </div>
		<div class="form-group">
		{{ Form::label('last_name', getPhrase( 'last_name' ) ) }}
		{{ Form::text('last_name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'last_name' ), 
				'title' => getPhrase('Last Name' ), 
				'data-toggle' => 'tooltip',
				)) }}
		</div>
		
		<h2>{{ getPhrase('billing_address') }}</h2>
		<div class="form-group">
		{{ Form::label('billing_address1', getPhrase( 'address_line1' ) ) }}
			{{ Form::text('billing_address1', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'address_line1' ), 
			'title' => getPhrase('Address Line1' ),
			'ng-model'=>'billing_address1',
			'ng-class'=>'{"has-error": formName.billing_address1.$touched && formName.billing_address1.$invalid}',
			)) }}									
		</div>
		
		<div class="form-group">
		{{ Form::label('billing_address2', getPhrase( 'address_line2' ) ) }}
			{{ Form::text('billing_address2', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'address_line2' ), 
			'title' => getPhrase('Address Line2' ),
			'ng-model'=>'billing_address2',
			'ng-class'=>'{"has-error": formName.billing_address2.$touched && formName.billing_address2.$invalid}',
			)) }}									
		</div>
		<div class="form-group">
		{{ Form::label('billing_city', getPhrase( 'city' ) ) }}
			{{ Form::text('billing_city', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'city' ), 
			'title' => getPhrase('City' ),
			'ng-model'=>'billing_city',
			'ng-class'=>'{"has-error": formName.billing_city.$touched && formName.billing_city.$invalid}',
			)) }}
		</div>
		<div class="form-group">
		{{ Form::label('billing_zip', getPhrase( 'zip_code' ) ) }}
			{{ Form::text('billing_zip', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'zip_code' ), 
			'title' => getPhrase('Zip Code' ),
			'ng-model'=>'billing_zip',
			'ng-class'=>'{"has-error": formName.billing_zip.$touched && formName.billing_zip.$invalid}',
			)) }}
		</div>
		<div class="form-group">
		{{ Form::label('billing_state', getPhrase( 'state_/_province' ) ) }}
			{{ Form::text('billing_state', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'state_/_province' ), 
			'title' => getPhrase('State/Province' ),
			'ng-model'=>'billing_state',
			'ng-class'=>'{"has-error": formName.billing_state.$touched && formName.billing_state.$invalid}',
			)) }}

		</div>
		<div class="form-group">
		{{ Form::label('billing_country', getPhrase( 'country' ) ) }}
			<?php
			$countries = array_pluck( App\Countries::where('status', '=', 'Active')->get(), 'name', 'name' );
			?>
			{{Form::select('billing_country', $countries, null, ['class'=>'form-control select2', "id"=>"billing_country",'placeholder'=>'select'])}}									
		</div>

		
		<button type="submit" class="btn btn-primary">{{getPhrase('purchase')}}</button>
		
		</div>

	</div>
	{!! Form::close() !!}
	
	<div class="col-md-4 col-sm-12">
		  <h2>{{ getPhrase('total_cart') }}</h2>
		 <div class="total">
			<p class="fee">{{ getPhrase('products_price') }} <span>{{ currency( Cart::instance('default')->subtotal() ) }}</span></p>
			<p class="fee">{{ getPhrase('tax') }} <span>{{ currency( Cart::instance('default')->tax() ) }}</span></p>
			<?php
			$licence_price = 0;
			?>
			@if(session()->has('licence_price'))
			<p class="fee">{{ getPhrase('support_fee') }} <span>{{ currency( session()->get('licence_price') ) }}</span></p>
			<?php $licence_price = session()->get('licence_price');?>
			@endif
			
			<p id="amount_message" class="fee"></p>
			<?php
			$discount_amount = 0;
			?>
			@if(session()->has('discount_amount'))
			<p class="fee">{{ getPhrase('coupon_code_off') }} <span>{{ currency( session()->get('discount_amount') ) }}</span></p>
			<?php $discount_amount = session()->get('discount_amount');?>
			@endif
			
			<?php $cart_total = $parsed = floatval(preg_replace('/[^\d.]/', '', Cart::total()));?>
			<p class="fees">{{ getPhrase('total_price') }}<span id="final_data"> {{ currency(($cart_total- $discount_amount )+$licence_price) }}</span>
			
			</p>

			
		 </div>
		
		<div id="couponcode_message"></div>
		@if(!session()->has('discount_amount') )
		<form action="{{ URL_CART_APPLYCOUPON }}" method="post" id="frmApplycoupon">
		<?php $cart_total = $parsed = floatval(preg_replace('/[^\d.]/', '', Cart::total()));?>
		<?php $licence_price = 0;?>
			
			@if(session()->has('licence_price'))
			
			<?php $licence_price = session()->get('licence_price');?>
			@endif
		<input type="hidden" name="total_price" value="{{$cart_total}}" id="total_price">			
		<input type="hidden" name="licence_price" value="{{$licence_price}}" id="licence_price">			
			<div class="form-group">
				 <p class="coupon">{{ getPhrase('have_coupon_code?') }}</p>
				<input type="text" name="code" id="code" class="form-control" placeholder="{{getPhrase('enter_code_here')}}">
			</div>		
			<div class="cart-button">
				<button type="submit" class="btn btn-primary">{{ getPhrase('apply') }}</button>
			</div>
		</form>
		
		@endif
		
		@if( session()->has('discount_amount') )
		<?php
		$coupon_details = session()->get('discount_details', '');
		?>
		@if( $coupon_details != '')
		@php
			$code = $coupon_details->code;
		@endphp
		<div class="coupon-apply">
			<p class="coupon-data"><span class="fa fa-check"></span>{{ getPhrase('coupon_code') . $code . ' ' . currency( session()->get('discount_amount') ) . getPhrase(' applied') }}</p>
			<p class="coupon-data1">{{ currency( session()->get('discount_amount') ) . getPhrase('reduced_from_the_cart') }}</p>
			<p><a href="{{ URL_CART_REMOVECOUPON }}"><span class="fa fa-times"></span></a></p>
		</div>
		@endif
		@endif
		</div>
	</div>
</div>
</section>
<!--/SECTION cart checkout-->
 @endsection

@section('footer_scripts')
    <script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>

	@include('common.select2')
	<script>

	$(document).ready(function () {
		$('#formName').validate({
			rules: {
				email: {
					required:true,
					email:true
				},
				first_name:'required'
			},
			messages:{
				'email' : "{{ getPhrase('Please enter email address') }}",
				'first_name' : "{{ getPhrase('Please enter first name') }}",
			}
		});
	});
	function validateCheckout()
	{
		if( ! document.getElementById('gateway') ) {
			swal({
				title : "{{getPhrase('info')}}",
				text : "{{getPhrase('Please select payment gateway')}}",
				type: "info",
			});
		} else {
			$( "#formName" ).submit();
		}
	}
	
	$('#frmApplycoupon').submit(function(e){
		e.preventDefault();
		
		var code = $('#code').val();
		var currency = "{{ getSetting('currency_symbol', 'cart_settings') }}";
		
		if( code == '' ) {
			$('#couponcode_message').html('<div class="alert alert-danger">{{getPhrase("please_enter_coupon_code")}}</div>');
			return false;
		}
		
		$.ajax({
            url : '{{URL_CART_APPLYCOUPON}}',
			data : {
				coupon:$('#code').val(),
				final_amount : $("#total_price").val(),
				support_fee : $("#licence_price").val(),
				_token:'{{ Session::token() }}'
			},
			method:'post',
            dataType: 'html',
        }).success(function (data) {
        	// console.log(result);
            var result = $.parseJSON(data);
            var message = '';
            if(result.discount_amount){
			var applied_message = '<p>COUPON CODE OFF<b><span style="padding-left:50px;">'+currency+result.discount_amount+'</span></b></p>';
		   }
			
			if(!result.status) {
				message = '<div class="alert alert-danger">'+result.message+'</div>';
			} 
			else {
				message = result.message;
				
				
				
				$('#frmApplycoupon').hide();
			}
			$('#final_data').html(result.final_price);
			$('#paid_amount').val(result.final_price);
			$('#couponcode_message').html( message );
			$('#amount_message').html( applied_message );
        }).fail(function () {
            alert('Posts could not be loaded.');
        });
	});
    </script>
	@if( Cart::total() == 0 && $licence_amount==0  )
		<script type="text/javascript">
			document.formName.submit();
		</script>
	@endif
@endsection