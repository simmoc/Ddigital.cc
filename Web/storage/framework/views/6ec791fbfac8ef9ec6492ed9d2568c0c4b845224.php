<script src="<?php echo e(ASSETS); ?>plugins/daterangepicker/moment.js"></script>
<script src="<?php echo e(ASSETS); ?>plugins/daterangepicker/daterangepicker.js"></script>
<script>
$('.datetimerange').daterangepicker({
	singleDatePicker: true,
    showDropdowns: true,
	timePicker: true,
	autoApply: true,
	timePicker24Hour: true,
	locale: {
      format: 'YYYY-MM-DD H:mm'
    },
});
$('.daterange').daterangepicker({
	singleDatePicker: true,
    showDropdowns: true,
	autoApply: true,
	locale: {
      format: 'YYYY-MM-DD'
    },
});
</script>