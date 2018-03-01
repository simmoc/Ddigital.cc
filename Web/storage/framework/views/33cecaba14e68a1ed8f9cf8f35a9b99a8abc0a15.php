<?php $__env->startSection('content'); ?>

    <!--Inner banner-->
    <section class="login-banner">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3><?php echo e($user->name); ?></h3>
                    <p class="loginbanner-data"><?php echo $user->about_me; ?></p>
                </div>
            </div>
        </div>
    </section>
    <!--/Inner banner-->

    <!--section-4 CATEGORIES-->
    <div class="categories ">
        <div class="container">
            <div class="row cs-row">
                <div class="col-md-9 col-sm-12">
                    <!--for right side columns-->
                    <div class="row">
						<?php echo $__env->make('displayproducts.products', array('products' => $products), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
                    </div>

                    
                </div>
                <div class="col-md-3 col-sm-12  animated fadeInDown">
                    <!--for right side-->
                    <div class="author-details">
                       
						<img src="<?php echo e(getProfilePath($user->image)); ?>" alt="" class="img-circle" width="45" height="45">
                        <h3><?php echo e($user->name); ?></h3>
                        <h6><?php echo e($user->email); ?></h6>
                        <?php
						$social_logins = json_decode($user->social_links);

                         ?>
					   
                       <?php if($social_logins!=null): ?>	
						<div class="author-icons">
                            <ul>
                               <li><a href="#"><?php echo e(getPhrase('Share:')); ?></a></li>
                        <?php if($social_logins->facebook!=""): ?>
                        <li><a href="<?php echo e($social_logins->facebook); ?>" target="_blank"><span class="fa fa-facebook"></span></a></li>
                        <?php endif; ?>
                        <?php if($social_logins->twitter!=""): ?>
                        <li><a href="<?php echo e($social_logins->twitter); ?>" target="_blank"><span class="fa fa-twitter"></span></a></li>
                        <?php endif; ?>
                        <?php if($social_logins->pinterest!=""): ?>
                        <li><a href="<?php echo e($social_logins->pinterest); ?>" target="_blank"><span class="fa fa-pinterest"></span></a></li>
                        <?php endif; ?>
                        <?php if($social_logins->dribbble!=""): ?>
                        <li><a href="<?php echo e($social_logins->dribbble); ?>" target="_blank"><span class="fa fa-dribbble"></span></a></li>
                        <?php endif; ?>
                            </ul>
                        </div>
                        <?php else: ?>
                        <h3><?php echo e(getPhrase('please_update_social_login_details')); ?></h3>
                        <?php endif; ?>
						
                        <h6><?php echo $user->about_me; ?></h6>
                    </div>
                    <div class="author-form">
                        <h2>FILL DETAILS HERE</h2>
                         <?php echo Form::open(array('url'=> URL_PRODUCT_OWNER_CONTACTUS_FORM,'method'=>'POST','name'=>'contactus')); ?> 
                         <input type="hidden" name="owneremail" value=<?php echo e($user->email); ?>>
                     <fieldset class="form-group">
                    

                        <?php echo e(Form::label('customername', getphrase('name'))); ?>


                        <span class="text-red">*</span>

                        <?php echo e(Form::text('customername', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => 'Jack','required'=>true

                          ))); ?>


                    </fieldset>

                     <fieldset class="form-group">
                    

                        <?php echo e(Form::label('phone_number', getphrase('phone_number'))); ?>


                        <span class="text-red">*</span>

                        <?php echo e(Form::number('phone_number', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => '1234567890','min'=>1,'required'=>true

                          ))); ?>


                    </fieldset>


                         <fieldset class="form-group">

                        <?php echo e(Form::label('customeremail', getphrase('email'))); ?>


                        <span class="text-red">*</span>

                        <?php echo e(Form::email('customeremail', $value = null, $attributes = array('class'=>'form-control', 'placeholder' => 'jack@jarvis.com','required'=>true


                           ))); ?>


                    </fieldset>
                      
                      <fieldset class="form-group">

                        

                        <?php echo e(Form::label('customer_message', getphrase('message'))); ?>


                      <span class="text-red">*</span>

                        <?php echo e(Form::textarea('customer_message', $value = null , $attributes = array('class'=>'form-control','rows'=>3, 'cols'=>'15', 'placeholder' => getPhrase('please_enter_your_message'),'required'=>true

                       ))); ?>


                    </fieldset>

                        <button type="submit" class="btn btn-success">SEND</button>
             </div>
                 <?php echo Form::close(); ?>

                    </div>
                </div>
            </div>
        
    </div>
    <!--/section-4 CATEGORIES-->

    <!--SECTION-5 SIGN UP-->
    <?php echo $__env->make('common.subscrption-form', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    <!--/SECTION-5 SIGN UP-->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.layout-site', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>