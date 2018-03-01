<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
          <meta name="csrf_token" content="<?php echo e(csrf_token()); ?>">

  <title><?php if(isset($title)) echo $title;else echo 'Ecomm'; ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
    <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <link rel="icon" href="<?php echo e(IMAGE_PATH_SITE_FAVCASION.getSetting('site_favicon', 'site_settings')); ?>" type="image/x-icon" />
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="<?php echo e(ASSETS); ?>bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo e(ASSETS); ?>dist/css/AdminLTE.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo e(ASSETS); ?>dist/css/skins/_all-skins.min.css">
<?php echo $__env->yieldContent('header_scripts'); ?>
<link href="<?php echo e(CSS); ?>sweetalert.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="<?php echo e(CSS); ?>select2.css">
  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition skin-blue sidebar-mini" ng-app="vehicle_booking">
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo e(URL_DASHBOARD); ?>" class="logo">
	<?php 
		$site_title = getSetting('site_title', 'site_settings');
		if( $site_title == '' )
			$site_title = getPhrase('Digi Downloads');
	 ?>
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><img src="<?php echo e(IMAGE_PATH_SITE_LOGO.getSetting('site_logo', 'site_settings')); ?>" alt="<?php echo e(getSetting('site_title','site_settings')); ?>" height="40" width="40"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><img src="<?php echo e(IMAGE_PATH_SITE_LOGO.getSetting('site_logo', 'site_settings')); ?>" alt="<?php echo e(getSetting('site_title','site_settings')); ?>" height="45" width="45"></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#"  class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only"><?php echo e(getPhrase('Toggle navigation')); ?></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="<?php echo e(URL_MESSAGES); ?>">
              <i class="fa fa-envelope-o"></i>
              <span class="label label-success"><?php echo e($count = Auth::user()->newThreadsCount()); ?></span>
            </a>
            
          </li>
          <!-- Notifications: style can be found in dropdown.less -->
          
          <!-- Tasks: style can be found in dropdown.less -->
          
          <?php $current_user = Auth::user();
                $login_user_image = Auth::user()->image; ?>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
             
			  <img src="<?php echo e(getProfilePath($login_user_image)); ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo e(ucfirst($current_user->name)); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo e(getProfilePath($login_user_image)); ?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo e(ucfirst($current_user->name)); ?> - <?php echo e(ucfirst(getRoleData($current_user->role_id))); ?>

                  <!--<small>Member since Nov. 2012</small>-->
                </p>
              </li>
              <!-- Menu Body -->
             
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="<?php echo e(URL_USERS_EDIT . Auth::User()->slug); ?>" class="btn btn-default btn-flat"><?php echo e(getPhrase('Profile')); ?></a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo e(URL_LOGOUT); ?>" class="btn btn-default btn-flat"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">

				   <?php echo e(getPhrase('Sign out')); ?></a>

                  <form id="logout-form" action="<?php echo e(URL_LOGOUT); ?>" method="POST" style="display: none;">
                                            <?php echo e(csrf_field()); ?>

                                        </form>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
		  
        </ul>
      </div>
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <?php echo $__env->make('layouts.includes.layout-admin-navigation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
   <?php echo $__env->yieldContent('content'); ?>
  </div>
  <!-- /.content-wrapper -->
	

  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
    <?php 
    $copy_rights = getSetting('copy_rights', 'site_settings');
     ?>
    <?php if( $copy_rights != ''): ?>
    <footer class="main-footer"><?php echo $copy_rights; ?>



    </footer>
    <?php endif; ?>
</div>
   
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<script src="<?php echo e(ASSETS); ?>plugins/jQuery/jquery-2.2.3.min.js"></script>
<!-- Bootstrap 3.3.6 -->
<script src="<?php echo e(ASSETS); ?>bootstrap/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo e(ASSETS); ?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo e(ASSETS); ?>plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(ASSETS); ?>dist/js/app.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo e(ASSETS); ?>dist/js/demo.js"></script>
<script src="<?php echo e(JS); ?>sweetalert-dev.js"></script>

<?php echo $__env->make('errors.formMessages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<?php echo $__env->yieldContent('footer_scripts'); ?>
<script type="text/javascript">
            var csrfToken = $('[name="csrf_token"]').attr('content');

            setInterval(refreshToken, 3600000); // 1 hour 

            function refreshToken(){
                $.get('refresh-csrf').done(function(data){
                    csrfToken = data; // the new token
                });
            }

            setInterval(refreshToken, 3600000); // 1 hour 

        </script>
</body>
</html>
