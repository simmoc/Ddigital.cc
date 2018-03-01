     <div class="box-body">
       <div class="col-md-6">
                
				<div class="form-group">
                 <?php echo e(Form::label('title', getPhrase( 'Title' ) )); ?> <?php echo required_field();; ?>

                 <?php echo e(Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Eg: Wordpress Templates' ),))); ?>

                </div>
				
				<?php 
				$status['header'] = getPhrase( 'Header' );
				$status['footer'] = getPhrase('Footer');
				$status['content'] = getPhrase('Content');
				?>
				<div class="form-group">
				<?php echo e(Form::label('type', getPhrase( 'Select' ) )); ?>

				<?php echo e(Form::select('type', $status, null, ['class'=>'form-control', "id"=>"status"])); ?>

				</div>
				
				<div class="form-group">
                 <?php echo e(Form::label('subject', getPhrase( 'Subject' ) )); ?> <?php echo required_field();; ?>

                 <?php echo e(Form::text('subject', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Eg: Wordpress Templates' ),))); ?>

                </div>
				
				
				
				               
            </div>

            <div class="col-md-6">
              <div class="form-group">
                 <?php echo e(Form::label('from_email', getPhrase( 'from_email' ) )); ?> <?php echo required_field();; ?>

                 <?php echo e(Form::text('from_email', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Eg: admin@admin.com' ),))); ?>

                </div>
				
				<div class="form-group">
                 <?php echo e(Form::label('from_name', getPhrase( 'from_name' ) )); ?> <?php echo required_field();; ?>

                 <?php echo e(Form::text('from_name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'From Name' ),))); ?>

                </div>
				
				<?php 
				$template_types = array();
				$template_types['email'] = getPhrase( 'email' );
				$template_types['sms'] = getPhrase('SMS');
				?>
				<div class="form-group">
				<?php echo e(Form::label('template_type', getPhrase( 'Select' ) )); ?>

				<?php echo e(Form::select('template_type', $template_types, null, ['class'=>'form-control', "id"=>"status"])); ?>

				</div>      
           
			</div>
			
			<div class="col-md-12">
				<div class="form-group">
					<?php echo e(Form::label('content', getPhrase( 'content' ) )); ?>               
					<?php echo e(Form::textarea('content', $value = null, $attributes = array('class'=>'form-control ckeditor', 'placeholder' => getPhrase( 'Content for the template' ), 'rows'=>'4'))); ?>

					</div>
			</div>
              </div>   
              <!-- /.box-body -->

              <div class="box-footer">
               <div class="btn-center">
                <button type="submit" class="btn btn-primary"><?php echo e($button_name); ?></button>
                  </div>
              </div>