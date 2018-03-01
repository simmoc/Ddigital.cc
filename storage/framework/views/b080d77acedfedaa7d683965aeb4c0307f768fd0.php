<!DOCTYPE html>
<html lang="en" >

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Business Tips" content="BUSINESS STARTUP">

    

   

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo e(SITE_CSS); ?>main.css">
    <link href="<?php echo e(CSS); ?>sweetalert.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo e(CSS); ?>select2.css">

    <?php echo $__env->yieldContent('header_scripts'); ?>
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

<?php echo $__env->yieldContent('content'); ?>
	
       <!-- /#wrapper -->
		<!-- jQuery -->
    <script type="text/javascript" src="<?php echo e(SITE_JS); ?>jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo e(SITE_JS); ?>bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo e(SITE_JS); ?>custom.js"></script>

    <script src="<?php echo e(JS); ?>sweetalert-dev.js"></script>
		<?php echo $__env->make('errors.formMessages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		<?php echo $__env->yieldContent('footer_scripts'); ?>
</body>

</html>