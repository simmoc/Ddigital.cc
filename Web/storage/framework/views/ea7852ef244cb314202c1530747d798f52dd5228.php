<div class="box-body">
	<div class="col-md-6">                
		<div class="form-group">
			<?php echo e(Form::label('title', getPhrase( 'Title of the Menu Item' ) )); ?> <?php echo required_field();; ?>

			<?php echo e(Form::text('title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Title of the Menu Item' ),
			'ng-model' => 'title',
			'required' => true,
			'ng-class'=>'{"has-error": formName.title.$touched && formName.title.$invalid}',
			))); ?>

			<div class="validation-error" ng-messages="formName.title.$error" >
			<?php echo getValidationMessage(); ?>

			</div>
		</div>		
	</div>
	
	<div class="col-md-6">                
		<div class="form-group">
			<?php echo e(Form::label('url', getPhrase( 'url', 'upper' ) )); ?> <?php echo required_field();; ?>

			<?php echo e(Form::text('url', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'url', 'upper' ),
			'ng-model' => 'url',
			'required' => true,
			'ng-class'=>'{"has-error": formName.url.$touched && formName.url.$invalid}',
			))); ?>

			<div class="validation-error" ng-messages="formName.url.$error" >
			<?php echo getValidationMessage(); ?>

			</div>
		</div>		
	</div>
	
	<div class="col-md-6">                
		<?php 
		$target['_self'] = getPhrase('Same Page');
		$target['_blank'] = getPhrase( 'Other Page' );
		$target['sameplace'] = getPhrase('Print in Same Place');
		?>
		<div class="form-group">
		<?php echo e(Form::label('target', getPhrase( 'Open in' ) )); ?>

		<?php echo e(Form::select('target', $target, null, ['class'=>'form-control', "id"=>"target"])); ?>

		</div>
	</div>
	<div class="col-md-6">                
		<div class="form-group">
			<?php echo e(Form::label('menu_order', getPhrase( 'order' ) )); ?> <?php echo required_field();; ?>

			<?php echo e(Form::number('menu_order', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'order' ),
			'ng-model' => 'menu_order',
			'required' => true,
			'ng-class'=>'{"has-error": formName.menu_order.$touched && formName.menu_order.$invalid}',
			))); ?>

			<div class="validation-error" ng-messages="formName.menu_order.$error" >
			<?php echo getValidationMessage(); ?>

			</div>
		</div>		
	</div>

	<div class="col-md-6">                
		<div class="form-group">
			<?php echo e(Form::label('menu_active_title', getPhrase( 'menu_active_title', 'upper' ) )); ?> <?php echo required_field();; ?>

			<?php echo e(Form::text('menu_active_title', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'menu_active_title', 'upper' ),
			'ng-model' => 'menu_active_title',
			'required' => true,
			'ng-class'=>'{"has-error": formName.menu_active_title.$touched && formName.menu_active_title.$invalid}',
			))); ?>

			<div class="validation-error" ng-messages="formName.menu_active_title.$error" >
			<?php echo getValidationMessage(); ?>

			</div>
		</div>			
	</div>
	<?php if($record && $record->slug=='pages-18'): ?>
	<div class="col-md-6">                
		<?php 
		$pages = array( 'Options' => array( '0' => getPhrase('URL Content'), 'description' => getPhrase('Use Description'), 'pages' => getPhrase('Display Pages') ) )+array('Pages' => array_pluck(App\Pages::where('status', '=', 'Active')->get(), 'title', 'id'));
		?>
		<div class="form-group">
		<?php echo e(Form::label('page_id', getPhrase( 'Display' ) )); ?>

		<?php echo e(Form::select('page_id', $pages, null, ['class'=>'form-control', "id"=>"page_id"])); ?>

		</div>		
	</div>
	
	<div class="col-md-6">                
		<?php 
		$pages = array_pluck(App\Pages::where('status', '=', 'Active')->get(), 'title', 'id');
		?>
		<div class="form-group">
		<?php echo e(Form::label('pages[]', getPhrase( 'Display_items' ) )); ?>

		<?php echo e(Form::select('pages[]', $pages, null, ['class'=>'form-control select2', "id"=>"pages", 'multiple' => 'multiple'])); ?>

		</div>		
	</div>

<?php endif; ?>


	
	<div class="col-md-6">                
		<?php 
		$status['active'] = 'Active';
		$status['inactive'] = 'Inactive';
		?>
		<div class="form-group">
		<?php echo e(Form::label('status', getPhrase( 'status' ) )); ?>

		<?php echo e(Form::select('status', $status, null, ['class'=>'form-control', "id"=>"status"])); ?>

		</div>		
	</div>

	
	<div class="col-md-12">                
		<div class="form-group">
		<?php echo e(Form::label('description', getPhrase( 'Description' ) )); ?>               
		<?php echo e(Form::textarea('description', $value = null, $attributes = array('class'=>'form-control ckeditor', 'placeholder' => getPhrase( 'Enter decription' ), 'rows'=>'4'))); ?>

		</div>
	</div>
</div>   
<!-- /.box-body -->

<div class="box-footer">
    <div class="btn-center">
	<button type="submit" class="btn btn-primary"><?php echo e($button_name); ?></button>
	</div>
	<input type="hidden" name="menu_id" id="menu_id" value="<?php echo e($menu_id); ?>">
	<input type="hidden" name="menu_slug" id="menu_slug" value="<?php echo e($menu_slug); ?>">
</div>