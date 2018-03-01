 					

 				 

					 <fieldset class="form-group">

						<?php echo e(Form::label('title', getphrase('title'))); ?>


						<span class="text-red">*</span>

						<?php echo e(Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('title')

							))); ?>


						

					</fieldset>



 				 

					 <fieldset class="form-group">
						<?php echo e(Form::label('key', getphrase('key'))); ?>

						<span class="text-red">*</span>
						<?php echo e(Form::text('key', $value = null , $attributes = array('class'=>'form-control', 'placeholder' =>  getPhrase('Introduction')							
						 ))); ?>

					</fieldset>
					
					<fieldset class="form-group">
						<?php echo e(Form::label('Parent of', getphrase('parent_id'))); ?>

						<span class="text-red">*</span>
						<?php echo e(Form::select('parent_id', ['0' => getPhrase('Parent')] + $parents, null ,array('class'=>'form-control'							
						 ))); ?>

					</fieldset>
					
					<fieldset class="form-group">
						<?php echo e(Form::label('Status', getphrase('status'))); ?>

						<span class="text-red">*</span>
						<?php echo e(Form::select('status', array('active' => getPhrase('Active'), 'inactive' => getPhrase('In-Active')), null ,array('class'=>'form-control'							
						 ))); ?>

					</fieldset>



					


					<fieldset class="form-group">

						<?php echo e(Form::label('description', getphrase('description'))); ?>


						<?php echo e(Form::textarea('description', $value = null , $attributes = array('class'=>'form-control', 'rows'=>'5', 'placeholder' => getphrase('description_of_the_topic')))); ?>


					</fieldset>
                 

						<div class="buttons text-center">

							<button class="btn btn-lg btn-primary button"

							><?php echo e($button_name); ?></button>

						</div>
