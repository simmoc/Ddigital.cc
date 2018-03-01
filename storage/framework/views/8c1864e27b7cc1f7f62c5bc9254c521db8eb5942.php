<script src="<?php echo e(JS); ?>ckeditor/ckeditor.js"></script>
<script>
CKEDITOR.editorConfig = function( config ) {
	config.language = 'es';
	config.uiColor = '#F7B42C';
	config.height = 100;
	config.toolbarCanCollapse = true;
};
CKEDITOR.replace( 'editor1' );
</script>