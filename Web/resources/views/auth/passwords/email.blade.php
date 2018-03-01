@extends('layouts.layout-site')

<!-- Main Content -->
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
	<div class="row">
	<div class="col-md-8 col-sm-8 col-md-offset-2 col-sm-offset-2 digi-download-register">
		<h2>{{ getPhrase('GO TO MY ACCOUNT') }}</h2>
		<h6>{{ getPhrase('Please fill details to get password') }}</h6>
		<div class="form-group">
			@include('errors.errors')
		</div>
		<form class="form-horizontal" role="form" method="POST" action="{{ URL_USERS_RESETPASSWORD_EMAIL }}">
		{{ csrf_field() }}
			<div class="form-group">
			 <div class="input-group digi-download-border">
               <span class="input-group-addon digi-download-icon" id="basic-addon1"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
				<input id="email" type="email" class="form-control digi-download-margin" name="email" placeholder="{{ getPhrase('Email address') }}" value="{{ old('email') }}" required>
              </div>
             </div>

             
			<div class="logbtn set-btn animated fadeInDown">
				<button type="submit" class="btn btn-default2">{{ getPhrase('Send Password Reset Link') }}</button>
			</div>
        </form>
		<div class="row">
		<div class="col-md-6">
		<div class="regbtn set-btn animated fadeInDown">
			<p> <i class="fa fa-sign-in" aria-hidden="true"></i> {{ getPhrase('have account?') }}</p>
			<a href="{{ URL_USERS_LOGIN }}" class="btn btn-default2">{{ getPhrase('Login') }}</a>
		</div>
            </div>
            <div class="col-md-6">
		<div class="regbtn set-btn animated fadeInDown">
			<p> <i class="fa fa-question-circle-o" aria-hidden="true"></i> {{ getPhrase('Dont have account? Create Now') }}</p>
			<a href="{{ URL_USERS_REGISTER }}" class="btn btn-default2">{{ getPhrase('REGISTER') }}</a>
		</div>
        </div>
        </div>
        </div>
        </div>

	</div>
</section>
<!--/SECTION LOGIN-->
@endsection
