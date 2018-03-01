@php
    if( isset($title) && $title != '' ) {
        $site_title = $title;
    } else {
        $site_title = getSetting('site_title', 'site_settings');
    }

    if( isset($meta_description) && $meta_description != '' ) {
        $meta_description = $meta_description;
    } else {
        $meta_description = getSetting('meta_description', 'seo_settings');
    }
    if( isset($meta_keywords) && $meta_keywords != '' ) {
        $meta_keywords = $meta_keywords;
    } else {
        $meta_keywords = getSetting('meta_keywords', 'seo_settings');
    }
@endphp
<!DOCTYPE html>
<html lang="en" dir="{{ (App\Language::isDefaultLanuageRtl()) ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ $site_title }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Business Tips" content="BUSINESS STARTUP">
    
    <meta name="keywords" content="{{ $meta_keywords }}"/>
    <meta name="description" content="{{ $meta_description }}"/>


     <link rel="icon" href="{{IMAGE_PATH_SITE_FAVCASION.getSetting('site_favicon', 'site_settings')}}" type="image/x-icon" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ SITE_CSS }}main.css">
    <link href="{{CSS}}sweetalert.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{CSS}}select2.css">

    @yield('header_scripts')
</head>

<body ng-app="vehicle_booking">

    <!-- PRELOADER -->
    <div id="preloader">
        <div id="status">
            <div class="mul8circ1"></div>
            <div class="mul8circ2"></div>
        </div>
    </div>
    <!-- /PRELOADER -->

    <!-- Trigger the modal with a button -->
    <!--for side button contact-us-->
    <div class="button-side">
        <button type="button" class="btn btn-default contact-btn" id="side">{{getPhrase('contact_us')}}</button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">

                <div class="modal-body">
        {!!Form::open(array('url'=> URL_CONTACTUS_FORM,'method'=>'POST','name'=>'contactus'))!!} 
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4> {{getPhrase('contact_us')}}</h4>
                    
                       <fieldset class="form-group">
                    

                        {{ Form::label('name', getPhrase('name')) }}

                        <span class="text-red">*</span>

                        {{ Form::text('name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('jack'),'required'=>'true'

                          )) }}

                    </fieldset>

                     <fieldset class="form-group">
                    

                        {{ Form::label('phone_number', getPhrase('phone_number')) }}

                        <span class="text-red">*</span>

                        {{ Form::number('phone_number', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => '1234567890','min'=>1,'required'=>'true'

                          )) }}

                    </fieldset>


                         <fieldset class="form-group">

                        {{ Form::label('email', getPhrase('email')) }}

                        <span class="text-red">*</span>

                        {{ Form::email('email', $value = null, $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('jack@jarvis.com'),'required'=>'true'

                           )) }}

                    </fieldset>
                      
                      <fieldset class="form-group">

                        

                        {{ Form::label('user_message', getPhrase('message')) }}
 
                         <span class="text-red">*</span>
                       {{ Form::textarea('user_message', $value = null , $attributes = array('class'=>'form-control','rows'=>3, 'cols'=>'15', 'placeholder' => getPhrase('please_enter_your_message'),'required'=>'true'

                       )) }}

                    </fieldset>
                        <button type="submit" class="btn btn-success">{{getPhrase('send')}}</button>
             </div>
                 {!!Form::close()!!}
            </div>

        </div>
    </div>
    
    @include('layouts.includes.layout-site-navigation')
    
    @yield('content')

    @include('layouts.includes.layout-site-footer')

    <!--for back to top button-->
    <a id="back-to-top" href="#" class="back-to-top"> <i class="fa fa-angle-up"></i> </a>
    <!-- Script files-->

    <script type="text/javascript" src="{{ SITE_JS }}jquery.min.js"></script>
    <script type="text/javascript" src="{{ SITE_JS }}bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ SITE_JS }}custom.js"></script>
    
    <script src="{{JS}}sweetalert-dev.js"></script>

    @include('errors.formMessages')
    
@yield('footer_scripts')

</body>

</html>