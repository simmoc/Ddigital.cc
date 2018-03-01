<?php $__env->startSection('content'); ?>
<!--Inner Banner-->
<section class="login-banner">
	<h2><?php echo e(getPhrase('register')); ?></h2>
</section>
<!--/Inner Banner-->

<!--SECTION LOGIN-->
<section class="register">
	<div class="container">
		<div class="row">
		<div class="col-sm-3"></div>
			<div class="col-sm-6">
			
				<h2 class="heading heading-center"><?php echo e(getPhrase('greate_join_with_us')); ?></h2>
			
				<?php echo $__env->make('errors.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				<?php if( isset($role) && $role == 'vendor' ): ?>
				<?php echo e(getPhrase('Click')); ?> <a href="<?php echo e(URL_USERS_REGISTER); ?>"><?php echo e(getPhrase('here')); ?></a> <?php echo e(getPhrase('to_register_as_customer')); ?>

				<?php else: ?>
				<?php echo e(getPhrase('Click')); ?> <a href="<?php echo e(URL_USERS_REGISTER); ?>/vendor"><?php echo e(getPhrase('here')); ?></a> <?php echo e(getPhrase('to_register_as_vendor')); ?>

				<?php endif; ?>
             
				<form class="form-horizontal" role="form" method="POST" action="<?php echo e(URL_USERS_REGISTER); ?>" id="formName">
                        <?php echo e(csrf_field()); ?>

				
					<?php
					$role = isset($role) ? 'vendor' : 'customer';					
					?>
					<input name="role" type="hidden" value="<?php echo e($role); ?>">
					<div class="form-group">
                        <input type="email" name="email"  id="email" class="form-control" placeholder="<?php echo e(getPhrase('email_address')); ?>" value="<?php echo e(old('email')); ?>">
					</div>
					<div class="form-group">
                        <input type="text" name="first_name" id="first_name" class="form-control" placeholder="<?php echo e(getPhrase('first_name')); ?>" value="<?php echo e(old('first_name')); ?>">
					</div>
					<div class="form-group">
                        <input type="text"  name="last_name" id="last_name" class="form-control" placeholder="<?php echo e(getPhrase('last_name')); ?>" value="<?php echo e(old('last_name')); ?>">
					</div>				
					
					<div class="form-group">
                        <input type="password"  name="password" id="password" class="form-control" placeholder="<?php echo e(getPhrase('password')); ?>">
					</div>
					<div class="form-group">
                        <input type="password"  name="password_confirmation" id="password_confirmation" class="form-control" placeholder="<?php echo e(getPhrase('re-enter_password')); ?>">
					</div>
					<p class="terms"><span><input type="checkbox" name="option" id="free"></span> <?php echo e(getPhrase('by_creating_an_account_you_agree_to_our ')); ?>

						<?php
						$terms_and_conditions = getSetting('terms_and_conditions', 'site_settings');
						$privacy_policy = getSetting('privacy_policy', 'site_settings');
						if( $terms_and_conditions != '' || $privacy_policy != '' )
						{
						?>
						<br> 
						<?php if($terms_and_conditions != ''): ?>
							<a href="http://conquerorslabs.com/digi-downloads/public/page/terms-and-conditions" target="_blank"><?php echo e(getPhrase('terms_and_conditions')); ?> </a>						
						<?php endif; ?>
						<?php if($privacy_policy != ''): ?>
							<?php echo e(getPhrase('and our')); ?> <a href="http://conquerorslabs.com/digi-downloads/public/page/privacy-and-policy" target="_blank"><?php echo e(getPhrase('privacy_policy')); ?></a>
						<?php endif; ?>
						<?php } else {
                           echo getPhrase('Terms and Conditions');
                        } ?>
						</p>
					<div class="reg-btn">
						<button type="submit" class="btn btn-default"><?php echo e(getPhrase('register')); ?> </button>
						<p class="reg-data"><?php echo e(getPhrase('already_having_account?')); ?>

							<a href="<?php echo e(URL_USERS_LOGIN); ?>"><?php echo e(getPhrase('login_here')); ?></a>
						</p>
					</div>
				</form>
			</div>
            <div class="col-sm-3"></div>
		</div>
	</div>
</section>
<!--/SECTION LOGIN-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>
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
				required: "<?php echo e(getPhrase('please_enter_first_name')); ?>"
			},
			option:{
				required: "<?php echo e(getPhrase('please_accept_the_terms_and_conditions')); ?>"
			},
			email:{
				required: "<?php echo e(getPhrase('Please enter email address')); ?>",
				email: "<?php echo e(getPhrase('Please enter valid email address')); ?>"
			},
			password:{
				required: "<?php echo e(getPhrase('Please enter password')); ?>",
				minlength: "<?php echo e(getPhrase('Password should be at least 6 characters')); ?>"
			},
			password_confirmation:{
				required: "<?php echo e(getPhrase('Please enter password again to confirm')); ?>",
				minlength: "<?php echo e(getPhrase('Password should be at least 6 characters')); ?>",
				equalTo: "<?php echo e(getPhrase('Password and Re-enter Password not same')); ?>"
			}
		}
	});
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.layout-site', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>