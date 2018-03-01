     <div class="box-body">
     <div class="row">
		<div class="col-md-6">                
			<div class="form-group">
				<?php echo e(Form::label('title', getPhrase( 'Title' ) )); ?> <?php echo required_field();; ?>

				<?php echo e(Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Eg: Introduction Offer' ), 
				'title' => getPhrase('Coupon Title' ), 
				'data-toggle' => 'tooltip',
				'ng-model'=>'title',
				'required'=> 'true',
				'ng-class'=>'{"has-error": formName.name.$touched && formName.name.$invalid}',
				))); ?>

				<div class="validation-error" ng-messages="formName.title.$error" >
					<?php echo getValidationMessage(); ?>

				</div>
			</div>
		</div>
		
		<div class="col-md-6">                
			<div class="form-group">
				<?php echo e(Form::label('code', getPhrase( 'code' ) )); ?> <?php echo required_field();; ?>

				<?php echo e(Form::text('code', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Eg: 326F6' ), 'title' => getPhrase('Code'), 'data-toggle' => 'tooltip'))); ?>

			</div>
		</div>
         </div>
         <div class="row">
		<div class="col-md-6">                
			<div class="form-group">
				<?php echo e(Form::label('type', getPhrase( 'type' ) )); ?> <?php echo required_field();; ?>

				<?php echo e(Form::select('type', array('percent' => getPhrase('Percent'), 'value' => getPhrase('Value')), null, ['class'=>'form-control','ng-model'=>'type'])); ?>

			</div>
		</div>
		
		<div class="col-md-6">                
			<div class="form-group">
				<?php echo e(Form::label('value', getPhrase( 'value' ) )); ?> <?php echo required_field();; ?>

				<?php echo e(Form::text('value', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Eg: 23' ),))); ?>

			</div>
		</div>
         </div>
          <div class="row" ng-if="type=='percent'"> 
           <div class="col-md-12">                
			<div class="form-group">
				<?php echo e(Form::label('max_discount_amount', getPhrase( 'max_discount_amount' ) )); ?> <?php echo required_field();; ?>

				<?php echo e(Form::text('max_discount_amount', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Eg: 50' ),))); ?>

			</div>
		</div>
		</div>

         <div class="row">
             		<div class="col-md-6">                
			<div class="form-group">
				<?php echo e(Form::label('start_date', getPhrase( 'start_date' ) )); ?> <?php echo required_field();; ?>

				<?php echo e(Form::text('start_date', $value = null , $attributes = array('class'=>'form-control datetimerange', 'placeholder' => getPhrase( 'start_date' ),))); ?>

			</div>
		</div>
		
		<div class="col-md-6">                
			<div class="form-group">
				<?php echo e(Form::label('end_date', getPhrase( 'end_date' ) )); ?> <?php echo required_field();; ?>

				<?php echo e(Form::text('end_date', $value = null , $attributes = array('class'=>'form-control datetimerange', 'placeholder' => getPhrase( 'end_date' ),))); ?>

			</div>
		</div>
         </div>
         <div class="row">
		<div class="col-md-6">                
			<div class="form-group">
				<?php echo e(Form::label('minimum_amount', getPhrase( 'minimum_amount' ) )); ?> 
				<?php echo e(Form::text('minimum_amount', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'minimum_amount. Leave 0 for No minimum amount limitation.' ),))); ?>

			</div>
		</div>
		
		<div class="col-md-6">                
			<div class="form-group">
				<?php
				$selected = array();
				if( $record && $record->categories != '') {
					$selected = (array)json_decode( $record->categories );
				}				
				?>
				<?php echo e(Form::label('categories', getPhrase( 'categories' ) )); ?>

				<?php echo e(Form::select('categories', $categories, $selected, array('name' => 'categories[]', 'multiple' => 'multiple', 'class'=>'form-control select2'))); ?>

			</div>
		</div>
         </div>
         <div class="row">
		<div class="col-md-6">                
			<div class="form-group">
				<?php
				$selected = array();
				if( $record && $products != '') {
					$selected = (array)json_decode($record->exclude_products);
				}				
				?>
				<?php echo e(Form::label('exclude_products', getPhrase( 'exclude_products' ) )); ?>

				<?php echo e(Form::select('exclude_products', $products, $selected, array('name' => 'exclude_products[]', 'multiple' => 'multiple', 'class'=>'form-control select2'))); ?>

			</div>
		</div>
		
		<div class="col-md-6">                
			<div class="form-group">
				<?php echo e(Form::label('max_users', getPhrase( 'max_users' ) )); ?>

				<?php echo e(Form::text('max_users', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Max Users. Leave 0 for unlimited users' ),))); ?>

			</div>
		</div>
         </div>
         <div class="row">
		<div class="col-md-6">
			<?php 
			$status[1] = 'Yes';
			$status[0] = 'No';
			if($record){
				$selected = $record->user_once_per_customer; 
			}
			?>
			<div class="form-group">
				<?php echo e(Form::label('user_once_per_customer', getPhrase( 'use_once_per_customer' ) )); ?>

				<?php echo e(Form::select('user_once_per_customer', $status, $selected, ['class'=>'form-control', "id"=>"status"])); ?>

			</div>
		</div>

		<div class="col-md-6">
			<?php 
			$status[1] = 'Active';
			$status[0] = 'Inactive';
			?>
			<div class="form-group">
				<?php echo e(Form::label('status', getPhrase( 'Select' ) )); ?>

				<?php echo e(Form::select('status', $status, null, ['class'=>'form-control', "id"=>"status"])); ?>

			</div>
		</div>
         </div>
        
		<div class="col-md-12">                
			<div class="form-group">
				<?php echo e(Form::label('description', getPhrase( 'description' ) )); ?>

				<?php echo e(Form::textarea('description', $value = null , $attributes = array('class'=>'form-control ckeditor', 'placeholder' => getPhrase( 'description' ),))); ?>

			</div>
		</div>
              </div>   
              <!-- /.box-body -->

              <div class="box-footer">
               <div class="btn-center">
                <button type="submit" class="btn btn-primary"><?php echo e($button_name); ?></button>
                  </div>
              </div>