 					
 					 <fieldset class="form-group" >
						
						<?php echo e(Form::label('language', getphrase('language'))); ?>

						<span class="text-red">*</span>
						<?php echo e(Form::text('language', $value = null , $attributes = array('class'=>'form-control','name'=>'language', 
							'placeholder' => getPhrase('language_title'), 
							'ng-model'=>'language', 
							'required'=> 'true', 
							'id'=>'language',
							'ng-class'=>'{"has-error": formLanguage.language.$touched && formLanguage.language.$invalid}',
							'ng-minlength' => '4',
							'ng-maxlength' => '40',
							))); ?>

						<div class="validation-error" ng-messages="formLanguage.language.$error" >
	    					<?php echo getValidationMessage(); ?>

	    					<?php echo getValidationMessage('minlength'); ?>

	    					<?php echo getValidationMessage('maxlength'); ?>

						</div>
					</fieldset>


					<fieldset class="form-group" >
						<?php echo e(Form::label('code', getphrase('code'))); ?>

						<span class="text-red">*</span>
						<?php echo e(Form::text('code', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('language_code'),
							'name'=>'code',
							'ng-model'=>'code',
							'id'=>'code', 
							'required'=> 'true', 
							'ng-minlength' => '2',
							'ng-maxlength' => '4',
							'ng-class'=>'{"has-error": formLanguage.code.$touched && formLanguage.code.$invalid}',
						 		
						))); ?>

						
						<div class="validation-error" ng-messages="formLanguage.code.$error" >
	    					<?php echo getValidationMessage(); ?>

	    					<?php echo getValidationMessage('minlength'); ?>

	    					<?php echo getValidationMessage('maxlength'); ?>

						</div>


						<a class="pull-right btn btn-success helper_step2" style="margin-top:10px;" href="https://www.loc.gov/standards/iso639-2/php/code_list.php" target="_blank">
						<?php echo e(getPhrase('supported_language_codes')); ?>

						</a>
					</fieldset>
					  
					  <div class="row helper_step1">
					<fieldset class='form-group col-md-6'>
						<?php echo e(Form::label('is_rtl', getphrase('is_rtl'))); ?>

						<div class="form-group row">
							<div class="col-md-6">
							<?php echo e(Form::radio('is_rtl', 0, true, array('id'=>'free', 'name'=>'is_rtl'))); ?>

								
								<label for="free"> <span class="fa-stack radio-button"> <i class="mdi mdi-check active"></i> </span> <?php echo e(getPhrase('No')); ?></label> 
							</div>
							<div class="col-md-6">
							<?php echo e(Form::radio('is_rtl', 1, false, array('id'=>'paid', 'name'=>'is_rtl'))); ?>

								<label for="paid"> <span class="fa-stack radio-button"> <i class="mdi mdi-check active"></i> </span> <?php echo e(getPhrase('Yes')); ?> 
								</label>
							</div>
						</div>
					</fieldset>
 					
					</div>

					
						<div class="buttons text-center" >
							<button class="btn btn-lg btn-success button" 
							ng-disabled='!formLanguage.$valid'><?php echo e($button_name); ?></button>
						</div>
		 