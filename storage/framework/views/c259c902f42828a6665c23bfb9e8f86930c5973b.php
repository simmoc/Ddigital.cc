     <div class="box-body">
       <div class="col-md-6">                
			<div class="form-group">
			 <?php echo e(Form::label('title', getPhrase( 'Title' ) )); ?> <?php echo required_field();; ?>

			 <?php echo e(Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'enter_title' ),
			 'ng-model' => 'title',
			 'required' => true,
			 'ng-class'=>'{"has-error": formName.title.$touched && formName.title.$invalid}',
					))); ?>

			<div class="validation-error" ng-messages="formName.title.$error" >
				<?php echo getValidationMessage(); ?>

			</div>
			</div>
			
			
			
			<div class="form-group">
			<?php echo e(Form::label('description', getPhrase( 'Description' ) )); ?>               
			<?php echo e(Form::textarea('description', $value = null, $attributes = array('class'=>'form-control ckeditor', 'placeholder' => getPhrase( 'Enter decription' ), 'rows'=>'4'))); ?>

			</div> 
			
			<?php 
				$icons = getIcons();
				?>
                <div class="form-group">
                <?php echo e(Form::label('icon', getPhrase( 'Icon' ) )); ?>

               
        <?php echo e(Form::select('icon', $icons, null, ['class'=>'form-control'])); ?>

                </div>	

<?php 
				$status['Active'] = 'Active';
				$status['Inactive'] = 'Inactive';
				?>
                <div class="form-group">
                <?php echo e(Form::label('status', getPhrase( 'Select' ) )); ?>

               
        <?php echo e(Form::select('status', $status, null, ['class'=>'form-control', "id"=>"status"])); ?>

                </div>			
         </div>

            
              </div>   
              <!-- /.box-body -->

              <div class="box-footer">
               <div class="btn-center">
                <button type="submit" class="btn btn-primary"><?php echo e($button_name); ?></button>
                  </div>
              </div>