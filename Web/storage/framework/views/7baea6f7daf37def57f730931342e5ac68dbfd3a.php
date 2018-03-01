 <?php $__env->startSection('header_scripts'); ?>
<link rel="stylesheet" href="<?php echo e(CSS); ?>select2.css"> <?php $__env->stopSection(); ?> <?php $__env->startSection('content'); ?>
<!--Inner Banner-->
<section class="login-banner">
    <div class="container">
        <div class="row">
            <div class="div col-sm-12">
                <h2><?php echo e(Auth::user()->name); ?></h2> </div>
        </div>
    </div>
</section>
<!--/Inner Banner-->
<!--SECTION cart DASHBOARD-2-->
<section class="dashboard2">
    <div class="container">
        <h2><?php echo e(getPhrase('my_dashboard')); ?></h2> <?php echo $__env->make('productvendor.menu', array('sub_active' => $sub_active, 'tab' => $tab), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <div class="tab-content  animated fadeInDown">
            <div id="dashboard" class="tab-pane fade <?php if( $tab == 'dashboard' ) echo 'in active';?>">
               <div class="dashboard-layout">
                <div class="row">
                    <div class="col-md-3">
                        <div class="card card-green">
                        <?php $coupons = App\Coupon::where('status','=',1);?>
                            <div class="card-title"><?php echo e($coupons->count()); ?></div>
                            <p class="card-text"><i class="fa fa-hashtag"></i> <?php echo e(getPhrase('coupons')); ?> </p>
                            
                            <div class="card-button">
                                <div><a href="<?php echo e(URL_COUPONS); ?>" class="btn btn-primary"><?php echo e(getPhrase('view_details')); ?></a></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card card-red">
                        <?php $total_uploads = App\Product::where('user_created',Auth::user()->id)->get();
                            $vendor_uploads = $total_uploads->count();
                            if(!count($vendor_uploads)){
                              $vendor_uploads = 0;
                            }
                     ?>
                            <div class="card-title"><?php echo e($vendor_uploads); ?></div>
                            <p class="card-text"><i class="fa fa-upload"></i> <?php echo e(getPhrase('uploads')); ?> </p>
                            
                            <div class="card-button">
                                <div><a href="<?php echo e(URL_PRODUCTS); ?>" class="btn btn-primary"><?php echo e(getPhrase('view_details')); ?></a></div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card card-yellow">
                       <?php if(count($total_uploads)): ?>

                            <?php
                               $count = 0; 
                               
                              foreach ($total_uploads as $items) {
                            $total_available = [];      
                            $total_available = App\Payment_Items::where('item_id',$items->id)->get();
                            $count += count($total_available);
                            }
                             

                            ?>
                                <div class="card-title"><?php echo e($count); ?></div>

                                <?php else: ?>
                                <div class="card-title">0</div>
                             <?php endif; ?>
                            <p class="card-text"><i class="fa fa-shopping-cart"></i> <?php echo e(getPhrase('upload_purchases')); ?> </p>
                            
                            <div class="card-button">
                                <div><a href="<?php echo e(URL_VENDOR_UPLOAD_PRODUCT_SALES.$record->slug); ?>" class="btn btn-primary"><?php echo e(getPhrase('view_details')); ?></a></div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3">
                        <div class="card card-blue">
                        <?php $vendor_got_amount = App\Payment_Items::join('payments','payments.id','=','payments_items.payment_id')
                                          ->join('products','products.id','=','payments_items.item_id')
                                          ->where('products.user_created','=',Auth::user()->id)
                                          ->select('payments_items.final_amount')->get();

                             $count = 0;

                                    foreach ($vendor_got_amount as $amount) {
                                        
                                        $count +=$amount->final_amount; 
                                    }
                                          
                     ?>
                            <div class="card-title"><?php echo e(currency($count)); ?></div>
                            <p class="card-text"><i class="fa fa-money"></i> <?php echo e(getPhrase('amount')); ?> </p>
                            
                            <div class="card-button">
                                <div><a href="#" class="btn btn-primary"><?php echo e(getPhrase('view_details')); ?></a></div>
                            </div>
                        </div>
                    </div>

                </div>
                </div>
            </div>
            <div id="history" class="tab-pane fade <?php if( $tab == 'purchases' ) echo 'in active';?>">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th><?php echo e(getPhrase('user_name')); ?></th>
                            <th><?php echo e(getPhrase('paid_amount')); ?></th>
                            <th><?php echo e(getPhrase('payment_gateway')); ?></th>
                            <th><?php echo e(getPhrase('updated_at')); ?></th>
                            <th><?php echo e(getPhrase('payment_status')); ?></th>
                            <th><?php echo e(getPhrase('product_details')); ?></th>
                        </tr>
                    </thead>
                    <tbody> <?php echo $__env->make('productvendor.purchases', array('purchases' => $purchases, 'tab' => $tab), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> </tbody>
                </table>
            </div>
            <div id="setting" class="tab-pane fade tab-setting <?php if( $tab == 'setting' ) echo 'in active';?>">
                <?php
					$user = getUserRecord();
					?> <?php echo $__env->make('errors.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> <?php echo e(Form::model($user, array('url' => URL_VENDOR_DASHBOARD.'/'.$tab, 'method'=>'post','name'=>'formName', 'files'=>TRUE))); ?>

                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <h4><?php echo e(getPhrase('Edit Account Information')); ?></h4>
                            <div class="form-group"> <?php echo e(Form::label('first_name', getPhrase( 'First Name' ) )); ?><?php echo required_field(); ?> <?php echo e(Form::text('first_name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'First Name' ), 'title' => getPhrase('First Name' ), 'ng-model'=>'first_name', 'required'=> 'true', 'ng-class'=>'{"has-error": formName.first_name.$touched && formName.first_name.$invalid}', ))); ?>

                                <div class="validation-error" ng-messages="formName.first_name.$error"> <?php echo getValidationMessage(); ?> </div>
                            </div>
                            <div class="form-group"> 
                            <?php echo e(Form::label('last_name', getPhrase( 'Last Name' ) )); ?>

                             <?php echo e(Form::text('last_name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Last Name' ), 'title' => getPhrase('Last Name' ) ))); ?>

                                
                            </div>
                            <?php
								$facebook = $twitter = $pinterest = $dribbble = '';
								$social_links = json_decode( $user->social_links );
								if( $social_links ) {
									$facebook = isset($social_links->facebook) ? $social_links->facebook : '';
									$twitter = isset($social_links->twitter) ? $social_links->twitter : '';
									$pinterest = isset($social_links->pinterest) ? $social_links->pinterest : '';
									$dribbble = isset($social_links->dribbble) ? $social_links->dribbble : '';
								}
								?>
                                <div class="form-group"> <?php echo e(Form::label('Facebook', getPhrase( 'Facebook' ) )); ?> <?php echo e(Form::text('social_links[facebook]', $value = $facebook , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Facebook' ), 'title' => getPhrase('Facebook' ), ))); ?> </div>
                                <div class="form-group"> <?php echo e(Form::label('Twitter', getPhrase( 'Twitter' ) )); ?> <?php echo e(Form::text('social_links[twitter]', $value = $twitter , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Twitter' ), 'title' => getPhrase('Twitter' ), ))); ?> </div>
                                <div class="form-group"> <?php echo e(Form::label('Pinterest', getPhrase( 'Pinterest' ) )); ?> <?php echo e(Form::text('social_links[pinterest]', $value = $pinterest , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Pinterest' ), 'title' => getPhrase('Pinterest' ), ))); ?> </div>
                                <div class="form-group"> <?php echo e(Form::label('Dribbble', getPhrase( 'Dribbble' ) )); ?> <?php echo e(Form::text('social_links[dribbble]', $value = $dribbble , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Dribbble' ), 'title' => getPhrase('Dribbble' ), ))); ?> </div>
                                <div class="form-group"> <?php echo e(Form::label('about_me', getPhrase( 'about_me' ) )); ?> <?php echo e(Form::textarea('about_me', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'about_me_few_words' ), 'title' => getPhrase('about_me_few_words' ), ))); ?> </div>
                                <div class="form-group"> <?php echo e(Form::label('image', getPhrase( 'Profile Image' ) )); ?> <?php echo Form::file('image',array('id'=>'image_input', 'accept'=>'.png,.jpg,.jpeg')); ?>

                                    <?php if(isset($user) && $user) {
										 
										  	echo '<img src="'.getProfilePath($user->image).'" heigth="45" width="40" />';
										  										?>
                                        <?php  } ?>
                                </div>
                                <div class="form-group"> <?php echo e(Form::label('email', getPhrase( 'Email address' ) )); ?> <?php echo e(Form::text('email', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Email address' ), 'title' => getPhrase('Email address' ), 'ng-model'=>'email', 'required'=> 'true', 'disabled' => true, 'ng-class'=>'{"has-error": formName.email.$touched && formName.email.$invalid}', ))); ?> </div>
                                <div class="form-group"> <?php echo e(Form::label('password', getPhrase( 'Password' ) )); ?>

                                    <input type="password" class="form-control" name="password" id="password" placeholder="<?php echo e(getPhrase( 'Password' )); ?>"> </div>
                                <div class="form-group"> <?php echo e(Form::label('confirm_password', getPhrase( 'Re-enter Password' ) )); ?>

                                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="<?php echo e(getPhrase( 'Re-enter Password' )); ?>"> </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <h4><?php echo e(getPhrase('Edit Billing Address')); ?></h4>
                            <div class="form-group"> 
                            <?php echo e(Form::label('billing_address1', getPhrase( 'Address Line1' ) )); ?> 
                            <?php echo e(Form::text('billing_address1', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Address Line1' ), 'title' => getPhrase('Address Line1' ), 'ng-model'=>'billing_address1', 'ng-class'=>'{"has-error": formName.billing_address1.$touched && formName.billing_address1.$invalid}', ))); ?> 
                            </div>

                            <div class="form-group"> 
                            <?php echo e(Form::label('billing_address2', getPhrase( 'Address Line2' ) )); ?> 
                            <?php echo e(Form::text('billing_address2', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Address Line2' ), 'title' => getPhrase('Address Line2' ), 'ng-model'=>'billing_address2', 'ng-class'=>'{"has-error": formName.billing_address2.$touched && formName.billing_address2.$invalid}', ))); ?> 
                            </div>

                            <div class="form-group"> <?php echo e(Form::label('billing_city', getPhrase( 'City' ) )); ?>

                             <?php echo e(Form::text('billing_city', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'City' ), 'title' => getPhrase('City' ), 'ng-model'=>'billing_city', 'ng-class'=>'{"has-error": formName.billing_city.$touched && formName.billing_city.$invalid}', ))); ?> 
                             </div>

                            <div class="form-group"> <?php echo e(Form::label('billing_zip', getPhrase( 'Zip Code' ) )); ?> <?php echo e(Form::text('billing_zip', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Zip Code' ), 'title' => getPhrase('Zip Code' ), 'ng-model'=>'billing_zip', 'ng-class'=>'{"has-error": formName.billing_zip.$touched && formName.billing_zip.$invalid}', ))); ?> 
                            </div>

                            <div class="form-group"> <?php echo e(Form::label('billing_state', getPhrase( 'State/Province' ) )); ?> <?php echo e(Form::text('billing_state', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'State/Province' ), 'title' => getPhrase('State/Province' ), 'ng-model'=>'billing_state', 'ng-class'=>'{"has-error": formName.billing_state.$touched && formName.billing_state.$invalid}', ))); ?> 
                            </div>
                            <div class="form-group"> <?php echo e(Form::label('billing_country', getPhrase( 'Country' ) )); ?>

                                <?php
									$countries = array_pluck( App\Countries::where('status', '=', 'Active')->get(), 'name', 'name' );
									?> <?php echo e(Form::select('billing_country', $countries, null, ['class'=>'form-control select2', "id"=>"billing_country",'placeholder'=>'Select'])); ?> </div>
                        </div>
                        <div class="col-md-12 col-sm-12 save">
                            <button type="submit" class="btn btn-primary digi-save"><?php echo e(getPhrase('save_changes')); ?></button>
                        </div>
                    </div> <?php echo Form::close(); ?> </div>
            <div id="key" class="tab-pane fade">
                <h4></h4> </div>
            <div id="logout" class="tab-pane fade">
                <h4></h4> </div>
        </div>
    </div>
</section>
<!--/SECTION cart checkout--><?php $__env->stopSection(); ?> <?php $__env->startSection('footer_scripts'); ?> <?php echo $__env->make('common.validations', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> <?php echo $__env->make('common.alertify', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> <?php echo $__env->make('common.select2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<script>
    var file = document.getElementById('image_input');
    file.onchange = function (e) {
        var ext = this.value.match(/\.([^\.]+)$/)[1];
        switch (ext) {
        case 'jpg':
        case 'jpeg':
        case 'png':
            break;
        default:
            alertify.error("<?php echo e(getPhrase('file_type_not_allowed')); ?>");
            this.value = '';
        }
    };
</script> <?php $__env->stopSection(); ?>
<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>