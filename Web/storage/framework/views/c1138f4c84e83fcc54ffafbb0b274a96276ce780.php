<?php 
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
 ?>
<!DOCTYPE html>
<html lang="en" dir="<?php echo e((App\Language::isDefaultLanuageRtl()) ? 'rtl' : 'ltr'); ?>">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title><?php echo e($site_title); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Business Tips" content="BUSINESS STARTUP">
    
    <meta name="keywords" content="<?php echo e($meta_keywords); ?>"/>
    <meta name="description" content="<?php echo e($meta_description); ?>"/>


     <link rel="icon" href="<?php echo e(IMAGE_PATH_SITE_FAVCASION.getSetting('site_favicon', 'site_settings')); ?>" type="image/x-icon" />
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo e(SITE_CSS); ?>main.css">
    <link href="<?php echo e(CSS); ?>sweetalert.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?php echo e(CSS); ?>select2.css">

    <?php echo $__env->yieldContent('header_scripts'); ?>
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
        <button type="button" class="btn btn-default contact-btn" id="side"><?php echo e(getPhrase('contact_us')); ?></button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">

                <div class="modal-body">
        <?php echo Form::open(array('url'=> URL_CONTACTUS_FORM,'method'=>'POST','name'=>'contactus')); ?> 
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4> <?php echo e(getPhrase('contact_us')); ?></h4>
                    
                       <fieldset class="form-group">
                    

                        <?php echo e(Form::label('name', getPhrase('name'))); ?>


                        <span class="text-red">*</span>

                        <?php echo e(Form::text('name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('jack'),'required'=>'true'

                          ))); ?>


                    </fieldset>

                     <fieldset class="form-group">
                    

                        <?php echo e(Form::label('phone_number', getPhrase('phone_number'))); ?>


                        <span class="text-red">*</span>

                        <?php echo e(Form::number('phone_number', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => '1234567890','min'=>1,'required'=>'true'

                          ))); ?>


                    </fieldset>


                         <fieldset class="form-group">

                        <?php echo e(Form::label('email', getPhrase('email'))); ?>


                        <span class="text-red">*</span>

                        <?php echo e(Form::email('email', $value = null, $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('jack@jarvis.com'),'required'=>'true'

                           ))); ?>


                    </fieldset>
                      
                      <fieldset class="form-group">

                        

                        <?php echo e(Form::label('user_message', getPhrase('message'))); ?>

 
                         <span class="text-red">*</span>
                       <?php echo e(Form::textarea('user_message', $value = null , $attributes = array('class'=>'form-control','rows'=>3, 'cols'=>'15', 'placeholder' => getPhrase('please_enter_your_message'),'required'=>'true'

                       ))); ?>


                    </fieldset>
                        <button type="submit" class="btn btn-success"><?php echo e(getPhrase('send')); ?></button>
             </div>
                 <?php echo Form::close(); ?>

            </div>

        </div>
    </div>
    
    <?php echo $__env->make('layouts.includes.layout-site-navigation', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
    <?php echo $__env->yieldContent('content'); ?>

    <?php echo $__env->make('layouts.includes.layout-site-footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

    <!--for back to top button-->
    <a id="back-to-top" href="#" class="back-to-top"> <i class="fa fa-angle-up"></i> </a>
    <!-- Script files-->

    <script type="text/javascript" src="<?php echo e(SITE_JS); ?>jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo e(SITE_JS); ?>bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo e(SITE_JS); ?>custom.js"></script>
    
    <script src="<?php echo e(JS); ?>sweetalert-dev.js"></script>

    <?php echo $__env->make('errors.formMessages', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
<?php echo $__env->yieldContent('footer_scripts'); ?>

</body>

</html>