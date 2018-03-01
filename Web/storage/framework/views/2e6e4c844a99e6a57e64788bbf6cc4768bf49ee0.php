<script type="text/javascript">
$('#formSubscription').submit(function(e){
	e.preventDefault();
	var email = $('#subscription_email').val();
	if(email == '' ) {
		$('#subscription_info').html('<div class="alert alert-danger"><?php echo e(getPhrase("Please enter email address")); ?></div>');
		return false;
	}
	var pattern = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	if( ! pattern.test(email) ) {
		$('#subscription_info').html('<div class="alert alert-danger"><?php echo e(getPhrase("Please enter valid email address")); ?></div>');
		return false;
	}
	$.ajax({
		url : '<?php echo e(URL_INDEX_SUBSCRIBE); ?>',
		method:'post',
		data: {
			email:email,
			_token:'<?php echo e(Session::token()); ?>'
		},
		dataType: 'html'
	}).done(function (data) {
		console.log(data);
		$('#subscription_info').html(data);
		$('#subscription_email').val('');
	}).fail(function (data) {
		//alert('<?php echo e(getPhrase("Subscription failed. Please try after some time")); ?>');
		console.log(data);
		alert(data);
	});
});
</script>