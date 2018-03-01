<section class="signup">
	<div class="container">
		<h3>Nullam quis ante.Etiam sit amet orci eget eros faucibus tincidunt</h3>
		<div class="sign">
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
</section>