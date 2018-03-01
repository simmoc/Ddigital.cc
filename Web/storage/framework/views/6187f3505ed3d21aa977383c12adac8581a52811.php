<section class="signup">
	<div class="container">
<?php $heading = getSetting('subscribe_heading','site_settings'); ?>
<h3><?php echo e(getPhrase($heading)); ?></h3>
		<div class="row">
		<div class="col-md-6 col-sm-12 col-xs-12 col-md-offset-3 sign">
			<div id="subscription_info"></div>
			<?php echo Form::open(array('url' => URL_INDEX_SUBSCRIBE, 'method' => 'POST', 'name'=>'formSubscription', 'id' => 'formSubscription')); ?>

			<div class="input-group">
				<?php echo e(Form::email('subscription_email', $value = null , $attributes = array('class'=>'form-control', 'placeholder' => getPhrase( 'Email Address' ), 
				'title' => getPhrase('Email Address' ), 
				'id' => 'subscription_email',
				'data-toggle' => 'tooltip',
				'ng-model'=>'subscription_email',
				'required'=>'true',
				'ng-class'=>'{"has-error": formSubscription.subscription_email.$touched && formSubscription.subscription_email.$invalid}',
				))); ?>

				
				<div class="input-group-btn">
					<button type="submit" class="btn btn-primary" id="subscription_button"><?php echo e(getPhrase('Send')); ?></button>
				</div>
			</div>
			<?php echo Form::close(); ?>

		</div>
	  </div>
	</div>
</section>