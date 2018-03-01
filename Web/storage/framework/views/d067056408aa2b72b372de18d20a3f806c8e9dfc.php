<?php $__env->startSection('header_scripts'); ?>
<link rel="stylesheet" href="<?php echo e(CSS); ?>select2.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!--Inner Banner-->
    <section class="login-banner">
        <div class="container">
            <div class="row">
                <div class="div col-sm-12">
                    <h2><?php echo e(Auth::user()->name); ?></h2>
                </div>
            </div>
        </div>
    </section>
    <!--/Inner Banner-->
	
	<!--SECTION cart DASHBOARD-2-->
    <section class="dashboard2">
        <div class="container">
            <h2><?php echo e(getPhrase('my_dashboard')); ?></h2>
           
            <?php echo $__env->make('customer.menu', array('sub_active' => $sub_active, 'tab' => $tab), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

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
                        <div class="card card-yellow">
                        <?php $purchase_items = App\Payment::where('user_id',Auth::user()->id)->get()->count();
                                    if(!count($purchase_items)){
                                      $purchase_items = 0;
                                    }
                     ?>
                            <div class="card-title"><?php echo e($purchase_items); ?></div>
                            <p class="card-text"><i class="fa fa-shopping-cart"></i> <?php echo e(getPhrase('purchases')); ?> </p>
                            
                            <div class="card-button">
                                <div><a href="<?php echo e(URL_USERS_DASHBOARD.'/purchases'); ?>" class="btn btn-primary"><?php echo e(getPhrase('view_details')); ?></a></div>
                            </div>
                        </div>
                    </div>
                     <div class="col-md-3">
                        <div class="card card-blue">
                        <?php $total_amount = App\Payment::join('payments_items','payments_items.payment_id','=','payments.id')
                          ->where('payments.user_id','=',Auth::user()->id)
                          ->select('payments_items.final_amount')->get();

                           $final_amount =0;
                             foreach ($total_amount as $amount) {
                                $final_amount += $amount->final_amount;
                             }

                               
                     ?>
                            <div class="card-title"><?php echo e(currency($final_amount)); ?></div>
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
                        <tbody>
                            <?php echo $__env->make('customer.purchases', array('purchases' => $purchases, 'tab' => $tab), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>							
                        </tbody>
                    </table>
                </div>

                <div id="setting" class="tab-pane fade tab-setting <?php if( $tab == 'setting' ) echo 'in active';?>">
                    <?php
					$user = getUserRecord();
					?>
					<?php echo $__env->make('errors.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>				
					<?php echo e(Form::model($user, array('url' => URL_USERS_DASHBOARD.'/'.$tab, 		'method'=>'post','name'=>'formName', 'files'=>'true' ))); ?>

					<div class="row">
                        <div class="col-md-6 col-sm-12">
                            <h4><?php echo e(getPhrase('Edit Account Information')); ?></h4>                          
                                <div class="form-group">
                                    <?php echo e(Form::label('first_name', getPhrase( 'First Name' ) )); ?>

									<span class="text-red">*</span>
									<?php echo e(Form::text('first_name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'First Name' ), 
									'title' => getPhrase('First Name' ),
									'ng-model'=>'first_name',
									'required'=> 'true',
									'ng-class'=>'{"has-error": formName.first_name.$touched && formName.first_name.$invalid}',
									))); ?>

									<div class="validation-error" ng-messages="formName.first_name.$error" >
										<?php echo getValidationMessage(); ?>

									</div>
                                </div>
                                <div class="form-group">
									<?php echo e(Form::label('last_name', getPhrase( 'last_name' ) )); ?>

                               
									<?php echo e(Form::text('last_name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'last_name' ), 
									'title' => getPhrase('Last Name' )
									
									))); ?>                                
									
                                </div>
								
								<div class="form-group">
            <?php echo e(Form::label('image', getphrase('image'))); ?>

            <div class="form-group row">
              <div class="col-md-6">        

          <?php echo Form::file('image', array('id'=>'image_input', 'accept'=>'.png,.jpg,.jpeg')); ?>

              </div>

              <?php if(isset($record) && $record) { 
                  if($record->image!='') {
                ?>
              <div class="col-md-6">
                <img src="<?php echo e(getProfilePath($record->image)); ?>" width="30%" height="30%" />
              </div>
              <?php } 
              } ?>

            </div>

          </div>
								
								
								
								
								
                                <div class="form-group">
                               <?php echo e(Form::label('email', getPhrase( 'email_address' ) )); ?>

                                    <span class="text-red">*</span>
                                    <?php echo e(Form::text('email', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'email_address' ), 
									'title' => getPhrase('Email address' ),
									'ng-model'=>'email',
									'required'=> 'true',
									'disabled' => true,
									'ng-class'=>'{"has-error": formName.email.$touched && formName.email.$invalid}',
									))); ?>

                                </div>
                                
                                <div class="form-group">
<?php echo e(Form::label('password', getPhrase( 'password' ) )); ?>

                                    <input type="password" class="form-control" name="password" id="password" placeholder="<?php echo e(getPhrase( 'password' )); ?>">

                                </div>
                                <div class="form-group">
<?php echo e(Form::label('confirm_password', getPhrase( 're-enter_password' ) )); ?>

                                    <input type="password" class="form-control" name="confirm_password" id="confirm_password" placeholder="<?php echo e(getPhrase( 're-enter_password' )); ?>">

                                </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <h4><?php echo e(getPhrase('Edit Billing Address')); ?></h4>                           

                                <div class="form-group">
<?php echo e(Form::label('billing_address1', getPhrase( 'address_line1' ) )); ?>

                                    <?php echo e(Form::text('billing_address1', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'address_line1' ), 
									'title' => getPhrase('Address Line1' ),
									'ng-model'=>'billing_address1',
									'ng-class'=>'{"has-error": formName.billing_address1.$touched && formName.billing_address1.$invalid}',
									))); ?>									
                                </div>
                                <div class="form-group">
<?php echo e(Form::label('billing_address2', getPhrase( 'address_line2' ) )); ?>

                                    <?php echo e(Form::text('billing_address2', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'address_line2' ), 
									'title' => getPhrase('Address Line2' ),
									'ng-model'=>'billing_address2',
									'ng-class'=>'{"has-error": formName.billing_address2.$touched && formName.billing_address2.$invalid}',
									))); ?>									
                                </div>
                                <div class="form-group">
<?php echo e(Form::label('first_name', getPhrase( 'city' ) )); ?>

                                    <?php echo e(Form::text('billing_city', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'city' ), 
									'title' => getPhrase('City' ),
									'ng-model'=>'billing_city',
									'ng-class'=>'{"has-error": formName.billing_city.$touched && formName.billing_city.$invalid}',
									))); ?>

                                </div>
                                <div class="form-group">
<?php echo e(Form::label('first_name', getPhrase( 'zip_code' ) )); ?>

                                    <?php echo e(Form::text('billing_zip', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'zip_code' ), 
									'title' => getPhrase('Zip Code' ),
									'ng-model'=>'billing_zip',
									'ng-class'=>'{"has-error": formName.billing_zip.$touched && formName.billing_zip.$invalid}',
									))); ?>

                                </div>
                                <div class="form-group">
<?php echo e(Form::label('first_name', getPhrase( 'state_/_province' ) )); ?>

									<?php echo e(Form::text('billing_state', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'State/Province' ), 
									'title' => getPhrase('State/Province' ),
									'ng-model'=>'billing_state',
									'ng-class'=>'{"has-error": formName.billing_state.$touched && formName.billing_state.$invalid}',
									))); ?>


                                </div>
                                <div class="form-group">
<?php echo e(Form::label('first_name', getPhrase( 'country' ) )); ?>

                                    <?php
									$countries = array_pluck( App\Countries::where('status', '=', 'Active')->get(), 'name', 'name' );
									?>
									<?php echo e(Form::select('billing_country', $countries, null, ['class'=>'form-control select2', "id"=>"billing_country"])); ?>									
                                </div>

                        </div>
                     
                     <div class="col-md-12 col-sm-12 col-xs-12 save">
                            <button type="submit" class="btn btn-primary digi-save"><?php echo e(getPhrase("save_changes")); ?></button>
                        </div>   
                    
                    </div>
					
                </div>

                <div id="key" class="tab-pane fade">
                    <h4></h4>
                </div>
                <div id="logout" class="tab-pane fade">
                    <h4></h4>

                </div>
            </div>
        </div>
    </section>
    <!--/SECTION cart checkout-->
<?php $__env->stopSection(); ?>

<?php $__env->startSection('footer_scripts'); ?>	
	<?php echo $__env->make('common.validations', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo $__env->make('common.alertify', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<?php echo $__env->make('common.select2', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<script>
	var file = document.getElementById('image_input');
	file.onchange = function(e){
	var ext = this.value.match(/\.([^\.]+)$/)[1];
	switch(ext)
	{
	case 'jpg':
	case 'jpeg':
	case 'png':
	break;
	default:
	alertify.error("<?php echo e(getPhrase('file_type_not_allowed')); ?>");
	this.value='';
	}
	};
	</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>