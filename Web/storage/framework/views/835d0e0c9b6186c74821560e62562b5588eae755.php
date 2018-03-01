<?php $__env->startSection('header_scripts'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div id="page-wrapper" ng-controller="angTopicsController">
			<div class="container-fluid">
				<!-- Page Heading -->
				<div class="row">
					<div class="col-lg-12">
						<ol class="breadcrumb">
							<li><a href="<?php echo e(URL_DASHBOARD); ?>"><i class="fa fa-home"></i><?php echo e(getPhrase('home')); ?></a> </li>
							
							<li><a href="<?php echo e(URL_SETTINGS_LIST); ?>"><?php echo e(getPhrase('settings')); ?></a> </li>
							<li><a href="<?php echo e(URL_SETTINGS_VIEW.$record->slug); ?>"><?php echo e($record->title); ?></a> </li>
							<li class="active"><?php echo e(isset($title) ? $title : ''); ?></li>
						</ol>
					</div>
				</div>
					<?php echo $__env->make('errors.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
				<!-- /.row -->
				<?php $field_types = array(
						    '' => 'Select Type',
						    'text' => 'Text',
						    'number' => 'Number',
						    'email' => 'Email',
                            'password' => 'Password',
                            'select' => 'Select',
                            'checkbox' => 'Checkbox',
                            'file' => 'Image(.png/.jpeg/.jpg)',
                            'textarea' => 'Textarea',
                            ); ?>

			 <div class="panel panel-custom col-lg-8 col-lg-offset-2">
					<div class="panel-heading">
						<div class="pull-right messages-buttons">
							<a href="<?php echo e(URL_SETTINGS_VIEW.$record->slug); ?>" class="btn  btn-primary button" ><?php echo e(getPhrase('list')); ?></a>
						</div>
					<h1><?php echo e($title); ?>  </h1>
					</div>
					<div class="panel-body" ng-controller="angTopicsController">
					<?php $button_name = getPhrase('create'); ?>
					<?php echo Form::open(array('url' => URL_SETTINGS_ADD_SUBSETTINGS.$record->slug, 'method' => 'POST', 
						'name'=>'formSettings ', 'files'=>'true')); ?>

				 		

					 <fieldset class="form-group">
						
						<?php echo e(Form::label('key', getphrase('key'))); ?>

						<span class="text-red">*</span>
						<?php echo e(Form::text('key', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('setting_key'),
					
						 ))); ?>

					
					</fieldset>


					 <fieldset class="form-group">
						
						<?php echo e(Form::label('tool_tip', getphrase('tool_tip'))); ?>

						<span class="text-red">*</span>
						<?php echo e(Form::text('tool_tip', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase('tool_tip'),
					
						 ))); ?>

					
					</fieldset>
					
					 <fieldset class="form-group">
						<?php echo e(Form::label('type', getphrase('type'))); ?>

						<span class="text-red">*</span>
						<?php echo e(Form::select('type',$field_types, null, ['class'=>'form-control', 
						'ng-model' => 'field_type' ])); ?>

					</fieldset>
				 
					 <fieldset 
					 ng-if="field_type=='text' || field_type=='password' || field_type=='number' || field_type=='email'||  field_type=='file' "
					 class="form-group" >
					 <?php echo e(Form::label('type', getphrase('default_value'))); ?>

					
					 <input 
					 		type="{{field_type}}" 
					 		class="form-control" 
					 		name="value" 
					 		required="true" 
					 		ng-model='value'
					 		
					 >
					</fieldset>
					 <fieldset 
					 ng-if="field_type=='checkbox' " class="form-group" >
					 <?php echo e(Form::label('type', getphrase('type'))); ?>

					
					 <input 
					 		type="checkbox" 
							data-toggle="toggle" 
							data-onstyle="primary" 
							data-offstyle="default"

					 		class="form-control" 
					 		name="value" 
					 		value="1" 
					 		required="true" 
					 		ng-model='value'
					 		style="display:block;"
					 		checked
					 >
					</fieldset>

					<fieldset 
					 ng-if="field_type=='select'"
					 class="form-group" >

					 <?php echo e(Form::label('total_options', getphrase('total_options'))); ?>

					
						 <input 
					 		type="number" 
					 		class="form-control" 
					 		name="total_options" 
					 		min="1"
					 		required="true" 
					 		ng-model='obj.total_options'
					 		ng-change="intilizeOptions(obj.total_options)"
					 >
					</fieldset>
					

					 <fieldset 
					 ng-if="field_type=='textarea'" class="form-group" >
					 <?php echo e(Form::label('description', getphrase('description'))); ?>

					
					<textarea name="value" class="form-control ckeditor" ng-model='value' rows="5" ></textarea>
					 
					</fieldset>

				



					 <div class="row" data-ng-repeat="option in options">
					 	<div class="col-md-12">
						
					<fieldset class="form-group col-md-4" >
						<?php echo e(Form::label('option_value', getphrase('option_value') )); ?> {{option}}
							<input 
					 		type="text" 
					 		class="form-control" 
					 		name="option_value[]" 
					 		required="true" >
					</fieldset>
					<fieldset class="form-group col-md-4" >
						<?php echo e(Form::label('option_text', getphrase('option_text') )); ?> {{option}}
							<input 
					 		type="text" 
					 		class="form-control" 
					 		name="option_text[]" 
					 		required="true" >
					</fieldset>
					<fieldset class="form-group col-md-4" >
					
                            <input type="radio" name="value" value="{{option-1}}" id="radio{{option}}" >
                            <label for="radio{{option}}"> <span class="fa-stack radio-button"> <i class="mdi mdi-check active"></i> </span> <?php echo e(getPhrase('make_default')); ?> </label>
                    
					</fieldset>


			

						</div>

					 </div>
					 


					
					 		<div class="buttons text-center">
							<button class="btn btn-lg btn-primary button" 
							><?php echo e($button_name); ?></button>
						</div>
					 
					<?php echo Form::close(); ?>

					 

					</div>
				</div>
			</div>
			<!-- /.container-fluid -->
		</div>
		<!-- /#page-wrapper -->
<?php $__env->stopSection(); ?>
<?php $__env->startSection('footer_scripts'); ?>
	
	<?php echo $__env->make('mastersettings.settings.scripts.js-scripts' , array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;
	<?php echo $__env->make('common.validations', array('isLoaded'=>true), array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>;
	 
	  <script src="<?php echo e(JS); ?>bootstrap-toggle.min.js"></script>
<?php $__env->stopSection(); ?>
 
<?php echo $__env->make($layout, array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>