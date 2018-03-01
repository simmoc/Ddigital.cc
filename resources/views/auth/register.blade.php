@extends('layouts.layout-site')

@section('content')
<!--Inner Banner-->
<section class="login-banner">
	<h2>{{ getPhrase('register') }}</h2>
</section>
<!--/Inner Banner-->

<!--SECTION LOGIN-->
<section class="register">
  <div class="container">
	<div class="row">
       <div class="col-md-6 col-sm-8 col-xs-12 col-md-offset-3 col-sm-offset-2 digi-download-register">
                @if($role=='user')
				<h2 class="heading heading-center">{{ getPhrase('customer_registration') }}</h2>
				@else
				<h2 class="heading heading-center">{{ getPhrase('vendor_registration') }}</h2>
				@endif
				@include('errors.errors')
				@if( isset($role) && $role == 'vendor' )
				{{ getPhrase('Click') }} <a href="{{ URL_USERS_REGISTER }}">{{ getPhrase('here') }}</a> {{ getPhrase('to_register_as_customer') }}
				@else
				{{ getPhrase('Click') }} <a href="{{ URL_USERS_REGISTER }}/vendor">{{ getPhrase('here') }}</a> {{ getPhrase('to_register_as_vendor') }}
				@endif
             
				<form class="form-horizontal" role="form" method="POST" action="{{ URL_USERS_REGISTER }}" id="formName">
                        {{ csrf_field() }}
					
					<input name="role" type="hidden" value="{{ $role }}">
					<div class="form-group">
                     <div class="input-group digi-download-border">
                        <span class="input-group-addon digi-download-icon" id="basic-addon1"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
                        <input type="email" name="email" id="email" class="form-control digi-download-margin" placeholder="{{ getPhrase('email_address') }}" value="{{ old('email') }}">
                     </div>
					</div>
					<div class="form-group">
                      <div class="input-group digi-download-border">
                        <span class="input-group-addon digi-download-icon" id="basic-addon1"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                        <input type="text" name="first_name" id="first_name" class="form-control digi-download-margin" placeholder="{{ getPhrase('first_name') }}" value="{{ old('first_name') }}">
                      </div>
					</div>
					<div class="form-group">
                     <div class="input-group digi-download-border">
                       <span class="input-group-addon digi-download-icon" id="basic-addon1"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                       <input type="text"  name="last_name" id="last_name" class="form-control digi-download-margin" placeholder="{{ getPhrase('last_name') }}" value="{{ old('last_name') }}">
                     </div>
					</div>				
					
					<div class="form-group">
                       <div class="input-group digi-download-border">
                       <span class="input-group-addon digi-download-icon" id="basic-addon1"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
                        <input type="password"  name="password" id="password" class="form-control digi-download-margin" placeholder="{{ getPhrase('password') }}">
                        </div>
					</div>
					<div class="form-group">
                      <div class="input-group digi-download-border">
                       <span class="input-group-addon digi-download-icon" id="basic-addon1"><i class="fa fa-key" aria-hidden="true"></i></span>
                        <input type="password"  name="password_confirmation" id="password_confirmation" class="form-control digi-download-margin" placeholder="{{ getPhrase('re-enter_password') }}">
                      </div>
					</div>
					
					<div class="checkbox">
                      <input id="checkbox-1" class="checkbox-custom" name="checkbox-1" type="checkbox">
                      <label for="checkbox-1" class="checkbox-custom-label digi-color"> {{ getPhrase('by_creating_an_account_you_agree_to_our ') }}</label>
                     </div>   
					
					<div class="terms">
						<?php
						$terms_and_conditions = getSetting('terms_and_conditions', 'site_settings');
						$privacy_policy = getSetting('privacy_policy', 'site_settings');
						if( $terms_and_conditions != '' || $privacy_policy != '' )
						{
						?>
						<br> 
						@if($terms_and_conditions != '')
							<a href="http://conquerorslabs.com/digi-downloads/public/page/terms-and-conditions" target="_blank">{{ getPhrase('terms_and_conditions') }} </a>	
						@endif
						@if($privacy_policy != '')
							{{ getPhrase('and our') }} <a href="http://conquerorslabs.com/digi-downloads/public/page/privacy-and-policy" target="_blank">{{ getPhrase('privacy_policy') }}</a>
						@endif
						<?php } else {
                           echo getPhrase('Terms and Conditions');
                        } ?>
					</div>
					<div class="reg-btn">
				      <button type="submit" class="btn btn-default">{{ getPhrase('register') }} </button>
						<p class="reg-data">{{ getPhrase('already_having_account?') }}
				          <a href="{{ URL_USERS_LOGIN }}">{{ getPhrase('login_here') }}</a>
				       </p>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>
<!--/SECTION LOGIN-->
@endsection

@section('footer_scripts')
<script type="text/javascript" src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.13.1/jquery.validate.min.js"></script>
<script type="text/javascript">
$(document).ready(function () {
	$('#formName').validate({
		rules:{
			first_name:{
				required: true
			},
			option:{
				required: true
			},
			email:{
				required: true,
				email: true
			},
			password: {
				required: true,
				minlength:6
			},
			password_confirmation: {
				required: true,
				minlength:6,
				equalTo: '#password'
			}
		},
		messages: {
			first_name:{
				required: "{{getPhrase('please_enter_first_name')}}"
			},
			option:{
				required: "{{getPhrase('please_accept_the_terms_and_conditions')}}"
			},
			email:{
				required: "{{getPhrase('Please enter email address')}}",
				email: "{{getPhrase('Please enter valid email address')}}"
			},
			password:{
				required: "{{getPhrase('Please enter password')}}",
				minlength: "{{ getPhrase('Password should be at least 6 characters') }}"
			},
			password_confirmation:{
				required: "{{getPhrase('Please enter password again to confirm')}}",
				minlength: "{{ getPhrase('Password should be at least 6 characters') }}",
				equalTo: "{{ getPhrase('Password and Re-enter Password not same') }}"
			}
		}
	});
});
</script>
@endsection
