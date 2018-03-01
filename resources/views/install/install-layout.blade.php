<!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Business Tips" content="BUSINESS STARTUP">

    

   

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ SITE_CSS }}main.css">
    <link href="{{CSS}}sweetalert.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{CSS}}select2.css">

    @yield('header_scripts')
</head>

<body class="login-screen" ng-app="vehicle_booking" >
    <!-- PRELOADER -->
   <!-- <div id="preloader">
        <div id="status">
            <div class="mul8circ1"></div>
            <div class="mul8circ2"></div>
        </div>
    </div>-->
    <!-- /PRELOADER -->

@yield('content')
	
       <!-- /#wrapper -->
		<!-- jQuery -->
    <script type="text/javascript" src="{{ SITE_JS }}jquery.min.js"></script>
    <script type="text/javascript" src="{{ SITE_JS }}bootstrap.min.js"></script>
    <script type="text/javascript" src="{{ SITE_JS }}custom.js"></script>

    <script src="{{JS}}sweetalert-dev.js"></script>
		@include('errors.formMessages')
		@yield('footer_scripts')
</body>

</html>