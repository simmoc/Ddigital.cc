     <div class="box-body">
       <div class="col-md-6">
                
				<div class="form-group">
                 <?php echo e(Form::label('title', getPhrase( 'Title' ) )); ?> <?php echo required_field();; ?>

                 <?php echo e(Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Eg: Contact Us' ),))); ?>

                </div>
				
				<?php 
				$status = array();
				$status['yes'] = getPhrase( 'Yes' );
				$status['no'] = getPhrase('No');
				?>
				<div class="form-group">
				<?php echo e(Form::label('show_in_menu', getPhrase( 'Show in menu?' ) )); ?>

				<?php echo e(Form::select('show_in_menu', $status, null, ['class'=>'form-control', "id"=>"show_in_menu"])); ?>

				</div>
				
            </div>			
			
			<div class="col-md-6">
				<?php echo e(Form::label('icon', getPhrase( 'Icon' ) )); ?>

				<?php echo e(Form::text('icon', $value = null , $attributes = array('class'=>'form-control icp icp-auto', 'placeholder' => getPhrase( 'Icon' ),'data-input-search' => true, ))); ?>				
			</div>

            <div class="col-md-6">
								
				<?php 
				$status = array();
				$status['Active'] = getPhrase( 'Active' );
				$status['Inactive'] = getPhrase('Inactive');
				?>
				<div class="form-group">
				<?php echo e(Form::label('status', getPhrase( 'Status' ) )); ?>

				<?php echo e(Form::select('status', $status, null, ['class'=>'form-control', "id"=>"status"])); ?>

				</div>
           
			</div>
			
			<div class="col-md-12">
				<div class="form-group">
					<?php echo e(Form::label('content', getPhrase( 'content' ) )); ?>               
					<?php echo e(Form::textarea('content', $value = null, $attributes = array('class'=>'form-control ckeditor', 'placeholder' => getPhrase( 'Content for the template' ), 'rows'=>'4'))); ?>

				</div>
				<h2>SEO Settings</h2>
				<div class="form-group">
                 <?php echo e(Form::label('meta_tag_title', getPhrase( 'Title Meta Tag' ) )); ?>

                 <?php echo e(Form::text('meta_tag_title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Title Meta Tag' ),))); ?>

                </div>
			</div>
			
			<div class="col-md-6">
				<div class="form-group">
				<?php echo e(Form::label('meta_tag_description', getPhrase( 'Description Meta Tag' ) )); ?>               
				<?php echo e(Form::textarea('meta_tag_description', $value = null, $attributes = array('class'=>'form-control ckeditor', 'placeholder' => getPhrase( 'Description Meta Tag' ), 'rows'=>'4'))); ?>

				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
				<?php echo e(Form::label('meta_tag_keywords', getPhrase( 'Kewords Meta Tag' ) )); ?>               
				<?php echo e(Form::textarea('meta_tag_keywords', $value = null, $attributes = array('class'=>'form-control ckeditor', 'placeholder' => getPhrase( 'Kewords Meta Tag' ), 'rows'=>'4'))); ?>

				</div>
			</div>
              </div>   
              <!-- /.box-body -->

              <div class="box-footer">
               <div class="btn-center">
                <button type="submit" class="btn btn-primary" ng-disabled='!formUsers.$valid'><?php echo e($button_name); ?></button>
                  </div>
              </div>