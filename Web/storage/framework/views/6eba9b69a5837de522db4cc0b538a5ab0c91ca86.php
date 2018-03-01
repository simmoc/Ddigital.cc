<script src="<?php echo e(JS); ?>select2.js"></script>
<script>
$('.select2').select2({
	placeholder: "<?php echo e(getPhrase('Click here to select')); ?>",
	allowClear: true
});

$('.select2ajax').select2({
	placeholder: "<?php echo e(getPhrase('Click here to select')); ?>",
	allowClear: true,
	ajax : {
		url: "<?php echo e(URL_PRODUCTS_REMOTE_DATA); ?>",
		dataType: 'json',
		delay: 250,
		data: function (params) {
			return {
				q: $.trim(params.term)
			};
		},
		processResults: function (data) {
			return {
				results: data
			};
		},
	}
});
</script>