     <div class="box-body">                
								
				<div class="form-group">
					<?php echo e(Form::label('first_name', getPhrase( 'First Name' ) )); ?> <?php echo required_field();; ?>

					
					<?php echo e(Form::text('first_name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'First Name' ), 
					'title' => getPhrase('First Name' ),
					'ng-model'=>'first_name',
					'required'=> 'true',
					'ng-class'=>'{"has-error": formUsers.first_name.$touched && formUsers.first_name.$invalid}',
					))); ?>

					<div class="validation-error" ng-messages="formUsers.first_name.$error" >
						<?php echo getValidationMessage(); ?>

					</div>
				</div>
				<div class="form-group">
					<?php echo e(Form::label('last_name', getPhrase( 'Last Name' ) )); ?>

					<?php echo e(Form::text('last_name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Last Name' ), 
					'title' => getPhrase('Last Name' ),
					'ng-model'=>'last_name',
					'required'=> 'true',
					'ng-class'=>'{"has-error": formUsers.last_name.$touched && formUsers.last_name.$invalid}',
					))); ?>                                
					<div class="validation-error" ng-messages="formUsers.last_name.$error" >
						<?php echo getValidationMessage(); ?>

					</div>
				</div>

                <div class="form-group">
              	<?php echo e(Form::label('email', 'Email')); ?> <?php echo required_field();; ?>

               
						<?php echo e(Form::email('email', $value = null, $attributes = array('class'=>'form-control', 'placeholder' => 'jack@jarvis.com',
              'required'=> 'true', 
              'ng-model'=> 'email', 
              'ng-class'=>'{"has-error": formUsers.email.$touched && formUsers.email.$invalid}',
							))); ?>


              <div class="validation-error" ng-messages="formUsers.email.$error" >

                <?php echo getValidationMessage(); ?>


                <?php echo getValidationMessage('email'); ?>


            </div>

                </div>

                <div class="form-group">
              	<?php echo e(Form::label('password', 'Password')); ?> <?php echo required_field();; ?>

               
						<?php echo e(Form::password('password', $attributes = array('class'=>'form-control', 'placeholder' => 'password'
               ))); ?>


 

            </div>
            
            <?php if( $record && $record->role_id == Auth::User()->role_id): ?>
				<input type="hidden" name="role_id" id="role_id" value="<?php echo e($record->role_id); ?>">
			<?php else: ?>
			<div class="form-group">
			<?php echo e(Form::label('role_id', 'User Type')); ?> <?php echo required_field();; ?>


			<?php echo e(Form::select('role_id', $roles, null, array('class'=>'form-control', "id"=>"role_id",
			'ng-model'=>'role_id',
			'required'=> 'true', 
			'ng-class'=>'{"has-error": formUsers.role_id.$touched && formUsers.role_id.$invalid}'
			))); ?>

			<div class="validation-error" ng-messages="formUsers.role_id.$error" >
			<?php echo getValidationMessage(); ?>

			</div>
			</div>
			
			<div class="form-group">
			<?php echo e(Form::label('status', getPhrase('User Status'))); ?> <?php echo required_field();; ?>


			<?php echo e(Form::select('status', array('Registered' => getPhrase('Registered'), 'Active' => getPhrase('Active'), 'Suspended' => getPhrase('Suspended')), null, array('class'=>'form-control',
			'ng-model'=>'status',
			'required'=> 'true', 
			'ng-class'=>'{"has-error": formUsers.status.$touched && formUsers.status.$invalid}'
			))); ?>

			<div class="validation-error" ng-messages="formUsers.status.$error" >
			<?php echo getValidationMessage(); ?>

			</div>
			</div>
			<?php endif; ?>

           
			<?php
			$facebook = $twitter = $pinterest = $dribbble = '';
			if( $record ) {
			$social_links = json_decode( $record->social_links );
			if( $social_links ) {
				$facebook = isset($social_links->facebook) ? $social_links->facebook : '';
				$twitter = isset($social_links->twitter) ? $social_links->twitter : '';
				$pinterest = isset($social_links->pinterest) ? $social_links->pinterest : '';
				$dribbble = isset($social_links->dribbble) ? $social_links->dribbble : '';
			}
			}
			?>
			<div class="form-group">
				<?php echo e(Form::label('Facebook', getPhrase( 'Facebook' ) )); ?>

				<?php echo e(Form::text('social_links[facebook]', $value = $facebook , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Facebook' ), 
				'title' => getPhrase('Facebook' ),
				))); ?>

			</div>
			<div class="form-group">
				<?php echo e(Form::label('Twitter', getPhrase( 'Twitter' ) )); ?>

				<?php echo e(Form::text('social_links[twitter]', $value = $twitter , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Twitter' ), 
				'title' => getPhrase('Twitter' ),
				))); ?>

			</div>
			<div class="form-group">
				<?php echo e(Form::label('Pinterest', getPhrase( 'Pinterest' ) )); ?>

				<?php echo e(Form::text('social_links[pinterest]', $value = $pinterest , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Pinterest' ), 
				'title' => getPhrase('Pinterest' ),
				))); ?>

			</div>
			<div class="form-group">
				<?php echo e(Form::label('Dribbble', getPhrase( 'Dribbble' ) )); ?>

				<?php echo e(Form::text('social_links[dribbble]', $value = $dribbble , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Dribbble' ), 
				'title' => getPhrase('Dribbble' ),
				))); ?>

			</div>
           <div class="form-group">
            <?php echo e(Form::label('about_me', getphrase('about_me'))); ?>

            <?php echo e(Form::textarea('about_me', $value = null , $attributes = array('class'=>'form-control ckeditor','rows'=>3, 'cols'=>'15', 'placeholder' => getPhrase('please_enter_about_user'),
              'ng-model'=>'about_me',
              ))); ?>

          </div>
		  

	<h4><?php echo e(getPhrase('Edit Billing Address')); ?></h4>                           

		<div class="form-group">
<?php echo e(Form::label('billing_address1', getPhrase( 'Address Line1' ) )); ?>

			<?php echo e(Form::text('billing_address1', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Address Line1' ), 
			'title' => getPhrase('Address Line1' ),
			'ng-model'=>'billing_address1',
			'ng-class'=>'{"has-error": formName.billing_address1.$touched && formName.billing_address1.$invalid}',
			))); ?>									
		</div>
		<div class="form-group">
<?php echo e(Form::label('billing_address2', getPhrase( 'Address Line2' ) )); ?>

			<?php echo e(Form::text('billing_address2', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Address Line2' ), 
			'title' => getPhrase('Address Line2' ),
			'ng-model'=>'billing_address2',
			'ng-class'=>'{"has-error": formName.billing_address2.$touched && formName.billing_address2.$invalid}',
			))); ?>									
		</div>
		<div class="form-group">
<?php echo e(Form::label('first_name', getPhrase( 'City' ) )); ?>

			<?php echo e(Form::text('billing_city', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'City' ), 
			'title' => getPhrase('City' ),
			'ng-model'=>'billing_city',
			'ng-class'=>'{"has-error": formName.billing_city.$touched && formName.billing_city.$invalid}',
			))); ?>

		</div>
		<div class="form-group">
<?php echo e(Form::label('first_name', getPhrase( 'Zip Code' ) )); ?>

			<?php echo e(Form::text('billing_zip', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Zip Code' ), 
			'title' => getPhrase('Zip Code' ),
			'ng-model'=>'billing_zip',
			'ng-class'=>'{"has-error": formName.billing_zip.$touched && formName.billing_zip.$invalid}',
			))); ?>

		</div>
		<div class="form-group">
<?php echo e(Form::label('first_name', getPhrase( 'State/Province' ) )); ?>

			<?php echo e(Form::text('billing_state', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'State/Province' ), 
			'title' => getPhrase('State/Province' ),
			'ng-model'=>'billing_state',
			'ng-class'=>'{"has-error": formName.billing_state.$touched && formName.billing_state.$invalid}',
			))); ?>


		</div>
		<div class="form-group">
<?php echo e(Form::label('billing_country', getPhrase( 'Country' ) )); ?>

			<?php
			$countries = array_pluck( App\Countries::where('status', '=', 'Active')->get(), 'name', 'name' );
			?>
			<?php echo e(Form::select('billing_country', $countries, null, ['class'=>'form-control select2', "id"=>"billing_country",'placeholder'=>'select'])); ?>									
		</div>
		
		
	<?php if($record && $record->role_id!=1): ?>
		<?php			
		//if( $user_type == 'moderator' ) 
		{
			echo '<div class="form-group">';
			$modules = App\Modules::where('status', '=', 'active')->get();
			$user_modules_permissions = array();
			if( $record ) {
			if(isset($record->user_modules_permissions)) {
				$user_modules_permissions = (array)json_decode($record->user_modules_permissions);
			  }
			}			
         $id_cnt=0;
			if( ! empty( $modules ) ) {
				echo '<div class="col-lg-12 table-class-head">';
                
					foreach( $modules as $module ) {
						echo '<div class="table-class row">';
							echo '<div class="col-lg-3">';
							echo $module->module_name;
							echo '</div>';
							echo '<div class="col-lg-9">';
							$permissions = explode(',', $module->permissions);
                            
							if( ! empty( $permissions ) ) {
								foreach( $permissions as $permission ) {
									if( isset($user_modules_permissions[$module->module_name]) ) {
										$selected = (array) $user_modules_permissions[$module->module_name];
										
										if( in_array($permission, array_keys( $selected ) ) ) {

											echo '
											<input id="'.$id_cnt.'" class="checkbox-custom" type="checkbox" name="user_modules_permissions['.$module->module_name.']['.$permission.']" checked>&nbsp
											<label for="'.$id_cnt++.'" class="checkbox-custom-label digi-color">
											
											 ' . $permission.'</label>';
										} else {
											echo '
											<input id="'.$id_cnt.'" class="checkbox-custom checkbox_class" type="checkbox" name="user_modules_permissions['.$module->module_name.']['.$permission.']">&nbsp
											<label for="'.$id_cnt++.'" class="checkbox-custom-label digi-color">
											' . $permission.'</label>';
										}
									} else {
									echo '
									<input id="'.$id_cnt.'" class="checkbox-custom checkbox_class" type="checkbox" name="user_modules_permissions['.$module->module_name.']['.$permission.']" >&nbsp
									<label for="'.$id_cnt++.'" class="checkbox-custom-label digi-color">
									' . $permission.'</label>';
									}
								}
							}
							echo '</div>';
						echo '</div>';
					}
				echo '</div>';
				
			}
			echo '</div>';
		}
		?>
	

	<?php endif; ?>

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
                <img src="<?php echo e(getProfilePath($record->image)); ?>" height="100" width="100">
              </div>
              <?php } } ?>

            </div>

          </div>

           
              <!-- /.box-body -->

              <div class="box-footer">
               <div class="btn-center">
                <button type="submit" class="btn btn-primary "
                ><?php echo e(getPhrase('Submit')); ?></button>
                  </div>
              </div>

	<?php echo $__env->make('common.editor', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>				  
