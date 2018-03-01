@extends('layouts.layout-site')

@section('content')
<!--SECTION-1 BANNER-->
<section class="login-banner">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h2>{{ getPhrase('Reset Password') }}</h2>
			</div>
		</div>
	</div>
</section>
<!--/SECTION BANNER-->
<!--SECTION LOGIN-->
<section class="login email-login">
	<div class="container">
		<h2>{{ getPhrase('GO TO MY ACCOUNT') }}</h2>
		<h6>{{ getPhrase('Please fill details to get password') }}</h6>
		
		@include('errors.errors')
		
		<form class="form-horizontal" role="form" method="POST" action="{{ URL_USERS_MYRESETPASSWORD }}" id="formName">
		{{ csrf_field() }}
		<input type="hidden" name="token" value="{{ $token }}">	
			
			<div class="form-group">
				<input id="password" type="password" class="form-control" name="password" placeholder="{{ getPhrase('Password') }}">
			</div>
			
			<div class="form-group">
				<input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="{{ getPhrase('Confirm Password') }}">
			</div>


			<div class="logbtn set-btn animated fadeInDown">
				<button type="submit" class="btn btn-default">{{ getPhrase('Reset Password') }}</button>
			</div>
		</form>

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
