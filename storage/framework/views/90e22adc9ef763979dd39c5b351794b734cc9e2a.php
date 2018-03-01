     <div class="box-body">
       <div class="col-md-6">
                
				<div class="form-group">
                 <?php echo e(Form::label('title', getPhrase( 'Title' ) )); ?> <?php echo required_field();; ?>

                 <?php echo e(Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'category_name' ),
						))); ?>


                </div>
                
				<div class="form-group">
              	<?php echo e(Form::label('description', getPhrase( 'Description' ) )); ?>               
				<?php echo e(Form::textarea('description', $value = null, $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Enter purpose of the category' ), 'rows'=>'4'))); ?>

                </div>

                  <div class="form-group">
                 <?php echo e(Form::label('meta_tag_title', getPhrase( 'Meta tag title' ) )); ?>

                 <?php echo e(Form::text('meta_tag_title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Meta tag title' ) ) )); ?>


                </div>

                  
               <div class="form-group">
                 <?php echo e(Form::label('meta_tag_keywords', getPhrase( 'Meta Keywords' ) )); ?>

                 <?php echo e(Form::text('meta_tag_keywords', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Meta Keywords' ),
            ))); ?>


                </div>
               
            </div>

            <div class="col-md-6">
           
		   <div class="form-group">
                 <?php echo e(Form::label('meta_tag_description', getPhrase( 'Meta Description' ) )); ?>

                 <?php echo e(Form::textarea('meta_tag_description', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Meta Description' ),'rows'=>'4'
            ))); ?>


                </div> 
               
                <div class="form-group">
                <?php echo e(Form::label('parent_id', getPhrase( 'Select Parent' ) )); ?>

               <?php
			   $selected = 0;
			   if($record)
				   $selected = $record->parent_id;
			   ?>
				<?php echo e(Form::select('parent_id', $parent_categories, $selected, ['class'=>'form-control', "id"=>"parent_id"])); ?>

                </div>
				
				<div class="form-group">
					<?php echo e(Form::label('icon', getPhrase( 'Icon' ) )); ?>

					<?php echo e(Form::text('icon', $value = null , $attributes = array('class'=>'form-control icp icp-auto', 'placeholder' => getPhrase( 'Icon' ),'data-input-search' => true, ))); ?>				
				</div>
  

				<?php 
				$status = array(
				'Active' => getPhrase('Active'),
				'Inactive' => getPhrase('Inactive'),
				);

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