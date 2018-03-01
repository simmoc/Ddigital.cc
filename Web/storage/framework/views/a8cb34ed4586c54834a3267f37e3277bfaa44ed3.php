<?php $__env->startSection('content'); ?>
<!--Inner Banner-->
<section class="login-banner">
    <div class="container">
        <div class="row">
            <div class="div col-sm-12">
                <h2><?php echo e(getPhrase('LOGIN HERE')); ?></h2>
            </div>
        </div>
    </div>
</section>
<!--/Inner Banner-->

<!--SECTION LOGIN-->
<section class="login">
    <div class="container">
        <div class="row">
            <div class="col-sm-3"></div>
            <div class="col-sm-6">
                <h2 class="heading heading-center"><?php echo e(getPhrase('GO TO MY ACCOUNT')); ?></h2>
                <?php echo $__env->make('errors.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                <?php if(session()->has('success_message')): ?>
                <div class="alert alert-success">
                    <?php echo e(session()->get('success_message')); ?>

                </div>
                <?php endif; ?>

                <?php if(session()->has('error_message')): ?>
                <div class="alert alert-danger">
                    <?php echo e(session()->get('error_message')); ?>

                </div>
                <?php endif; ?>
                <form class="form-horizontal" role="form" method="POST" action="<?php echo e(url('/login')); ?>" id="myForm">
                    <?php echo e(csrf_field()); ?>

                    <div class="form-group">

                        <input type="email"  name="email" id="email" class="form-control" placeholder="Email Address">						

                    </div>
                    <div class="form-group">
                        <input type="password" name="password" id="password"  class="form-control" placeholder="Password">
                    </div>
                    
                    <div class="logbtn animated fadeInDown">
                        <button type="submit" class="btn btn-default"><?php echo e(getPhrase('Log In')); ?></button>
                    </div>
                       <ul class="you-login">
                           <li><a href="<?php echo e(URL_USERS_REGISTER); ?>"><?php echo e(getPhrase('Dont have account? Create Now')); ?></a></li>
                           <li>
                               <a class="forgot" href="<?php echo e(URL_USERS_FORGOTPASSWORD); ?>"><?php echo e(getPhrase('Forgot Password?')); ?></a></li>
                    </ul>
                   <!-- <div class="regbtn animated fadeInDown">
                       
                       
                    </div>-->
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
                    'required': "<?php echo e(getPhrase('Please enter email address')); ?>",
                    'email': "<?php echo e(getPhrase('Please enter valid email address')); ?>"
                },
                password:{
                    'required': "<?php echo e(getPhrase('Please enter password')); ?>"
                }
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout-site', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>