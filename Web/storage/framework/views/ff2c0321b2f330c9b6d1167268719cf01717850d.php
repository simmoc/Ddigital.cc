<div class="box-body">
	<div class="col-md-12">                
		<div class="form-group">
			<?php echo e(Form::label('name', getPhrase( 'name' ) )); ?> <?php echo required_field();; ?>

			<?php echo e(Form::text('name', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Eg: Main Menu' ),
			'ng-model' => 'name',
			'required' => true,
			'ng-class'=>'{"has-error": formName.name.$touched && formName.name.$invalid}',
			))); ?>

			<div class="validation-error" ng-messages="formName.name.$error" >
			<?php echo getValidationMessage(); ?>

			</div>
		</div>
		<div class="form-group">
		<?php echo e(Form::label('description', getPhrase( 'Description' ) )); ?>               
		<?php echo e(Form::textarea('description', $value = null, $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Enter decription' ), 'rows'=>'4'))); ?>

		</div>
		<!-- <?php 
		$status = array();
		$status['no'] = getPhrase( 'No' );
		$status['yes'] = getPhrase( 'Yes' );
         
         $selected  = 'no';
         if($record){

         	$selected =$record->display_dynamic_pages;
         }

		?>
		<div class="form-group">
		<?php echo e(Form::label('display_dynamic_pages', getPhrase( 'Display Dynamic Pages' ) )); ?>

		<?php echo e(Form::select('display_dynamic_pages', $status, $selected, ['class'=>'form-control', "id"=>"display_dynamic_pages"])); ?>

		</div> -->
		<?php $status = array('active'=>getphrase('active'),'inactive'=>getphrase('inactive'));
		$selected = 'active';
		if($record){
			$selected = $record->status;
			}?>
		<div class="form-group">
		<?php echo e(Form::label('status', getPhrase( 'status' ) )); ?>

		<?php echo e(Form::select('status', $status,$selected,['class'=>'form-control', 'id'=>'status'])); ?>

		</div>		
	</div>
</div>   
<!-- /.box-body -->

<div class="box-footer">
<div class="btn-center">
	<button type="submit" class="btn btn-primary"><?php echo e($button_name); ?></button>
    </div>
</div>