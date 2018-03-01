@extends('layouts.layout-site')

@section('content')
<!--Inner Banner-->
<section class="login-banner">
    <div class="container">
        <div class="row">
            <div class="div col-sm-12">
                <h2>{{ getPhrase('login_here') }}</h2>
            </div>
        </div>
    </div>
</section>
<!--/Inner Banner-->

<!--SECTION LOGIN-->
<section class="login">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-sm-8 col-xs-12 col-md-offset-3 col-sm-offset-2 digi-download-hilight">
                <h2 class="heading heading-center">{{ getPhrase('go_to_my_account') }}</h2>
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
                <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}" id="myForm">
                    {{ csrf_field() }}
                    
                    <div class="form-group">
                      <div class="input-group digi-download-border">
                        <span class="input-group-addon digi-download-icon" id="basic-addon1"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                        <input type="email"  name="email" id="email" class="form-control digi-download-margin" placeholder="{{getPhrase('email_address')}}">                        
                      </div>
                    </div>
                                        
                    <div class="form-group">
                      <div class="input-group digi-download-border">
                        <span class="input-group-addon digi-download-icon" id="basic-addon1"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
                        <input type="password" name="password" id="password"  class="form-control digi-download-margin" placeholder="{{getPhrase('password')}}">
                      </div>
                     </div>
                     
                    {{-- <div class="checkbox">
                        <div class="checkbox">
                            <h4 class="ap-stage-title"><label>
                               
                                <input type="checkbox" value="p0" name="group2" >
                                <span class="checkbox-content">

                                    <i aria-hidden="true" class="fa fa-check "></i>
                                    <i class="check-square"></i>
                                    <span class="create">{{ getPhrase('remember_me?') }}</span>
                                </span>
                                </label>
                            </h4> </div>
                    </div> --}}
                    <div class="logbtn animated fadeInDown">
                        <button type="submit" class="btn btn-default digi-btn">{{ getPhrase('log_in') }}</button>
                    </div>
                       <ul class="you-login">
                         <li>
                         <a href="{{ URL_USERS_REGISTER }}"><i class="fa fa-question-circle-o" aria-hidden="true"></i> {{ getPhrase('Dont_have_account ?_create_it_now') }}</a></li>
                         <li class="digi-right">
                         <a class="forgot" href="{{ URL_USERS_FORGOTPASSWORD }}"><i class="fa fa-user-plus" aria-hidden="true"></i> {{ getPhrase('forgot_password?') }}</a></li>
                       </ul>
                       
                   <!-- <div class="regbtn animated fadeInDown">
                      
                    </div>-->
                  
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
        $('#myForm').validate({
            rules:{
                email:{
                    required: true,
                    email: true
                },
                password: {
                    required: true
                }
            },
            messages: {
                email:{
                    'required': "{{getPhrase('please_enter_email_address')}}",
                    'email': "{{ getPhrase('please_enter_valid_email_address')}}"
                },
                password:{
                    'required': "{{ getPhrase('please_enter_password') }}"
                }
            }
        });
    });
</script>
@endsection