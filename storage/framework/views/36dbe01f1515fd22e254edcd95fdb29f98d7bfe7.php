<?php $__env->startSection('content'); ?>
<!--Inner Banner-->
<section class="login-banner">
    <div class="container">
        <div class="row">
            <div class="div col-sm-12">
                <h2><?php echo e(getPhrase('login_here')); ?></h2>
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
                <h2 class="heading heading-center"><?php echo e(getPhrase('go_to_my_account')); ?></h2>
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
                      <div class="input-group digi-download-border">
                        <span class="input-group-addon digi-download-icon" id="basic-addon1"><i class="fa fa-user-o" aria-hidden="true"></i></span>
                        <input type="email"  name="email" id="email" class="form-control digi-download-margin" placeholder="<?php echo e(getPhrase('email_address')); ?>">                        
                      </div>
                    </div>
                                        
                    <div class="form-group">
                      <div class="input-group digi-download-border">
                        <span class="input-group-addon digi-download-icon" id="basic-addon1"><i class="fa fa-unlock-alt" aria-hidden="true"></i></span>
                        <input type="password" name="password" id="password"  class="form-control digi-download-margin" placeholder="<?php echo e(getPhrase('password')); ?>">
                      </div>
                     </div>
                     
                    
                    <div class="logbtn animated fadeInDown">
                        <button type="submit" class="btn btn-default digi-btn"><?php echo e(getPhrase('log_in')); ?></button>
                    </div>
                       <ul class="you-login">
                         <li>
                         <a href="<?php echo e(URL_USERS_REGISTER); ?>"><i class="fa fa-question-circle-o" aria-hidden="true"></i> <?php echo e(getPhrase('Dont_have_account ?_create_it_now')); ?></a></li>
                         <li class="digi-right">
                         <a class="forgot" href="<?php echo e(URL_USERS_FORGOTPASSWORD); ?>"><i class="fa fa-user-plus" aria-hidden="true"></i> <?php echo e(getPhrase('forgot_password?')); ?></a></li>
                       </ul>
                       
                   <!-- <div class="regbtn animated fadeInDown">
                      
                    </div>-->
                  
                </form>
            </div>
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
                    'required': "<?php echo e(getPhrase('please_enter_email_address')); ?>",
                    'email': "<?php echo e(getPhrase('please_enter_valid_email_address')); ?>"
                },
                password:{
                    'required': "<?php echo e(getPhrase('please_enter_password')); ?>"
                }
            }
        });
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout-site', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>