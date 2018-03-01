<!-- Main Content -->
<?php $__env->startSection('content'); ?>
<!--SECTION-1 BANNER-->
<section class="login-banner">
	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<h2><?php echo e(getPhrase('Reset Password')); ?></h2>
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
		<h2><?php echo e(getPhrase('GO TO MY ACCOUNT')); ?></h2>
		<h6><?php echo e(getPhrase('Please fill details to get password')); ?></h6>
		<div class="form-group">
			<?php echo $__env->make('errors.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
		</div>
		<form class="form-horizontal" role="form" method="POST" action="<?php echo e(URL_USERS_RESETPASSWORD_EMAIL); ?>">
		<?php echo e(csrf_field()); ?>

			<div class="form-group">
			 <div class="input-group digi-download-border">
               <span class="input-group-addon digi-download-icon" id="basic-addon1"><i class="fa fa-envelope-o" aria-hidden="true"></i></span>
				<input id="email" type="email" class="form-control digi-download-margin" name="email" placeholder="<?php echo e(getPhrase('Email address')); ?>" value="<?php echo e(old('email')); ?>" required>
              </div>
             </div>

             
			<div class="logbtn set-btn animated fadeInDown">
				<button type="submit" class="btn btn-default2"><?php echo e(getPhrase('Send Password Reset Link')); ?></button>
			</div>
        </form>
		<div class="row">
		<div class="col-md-6">
		<div class="regbtn set-btn animated fadeInDown">
			<p> <i class="fa fa-sign-in" aria-hidden="true"></i> <?php echo e(getPhrase('have account?')); ?></p>
			<a href="<?php echo e(URL_USERS_LOGIN); ?>" class="btn btn-default2"><?php echo e(getPhrase('Login')); ?></a>
		</div>
            </div>
            <div class="col-md-6">
		<div class="regbtn set-btn animated fadeInDown">
			<p> <i class="fa fa-question-circle-o" aria-hidden="true"></i> <?php echo e(getPhrase('Dont have account? Create Now')); ?></p>
			<a href="<?php echo e(URL_USERS_REGISTER); ?>" class="btn btn-default2"><?php echo e(getPhrase('REGISTER')); ?></a>
		</div>
        </div>
        </div>
        </div>
        </div>

	</div>
</section>
<!--/SECTION LOGIN-->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout-site', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>