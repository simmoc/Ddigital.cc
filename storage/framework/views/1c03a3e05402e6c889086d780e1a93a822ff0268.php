<style> .modal-backdrop {
    position: relative !important;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;
    z-index: 1040;
    background-color: #000;
}</style>

<?php if( $purchases->count() > 0 ): ?>

	<?php $__currentLoopData = $purchases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $data): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<tr>
		<td class="col1"><?php echo e($data->name); ?></td>
		<td class="col2"><?php echo e(currency($data->paid_amount)); ?></td>
		<td class="col3"><?php echo e($data->payment_gateway); ?></td>
		<td class="col4"><?php echo e($data->updated_at); ?></td>
		<?php if($data->payment_status=='success'): ?>
		<td class="col5"><span class="label label-success"><?php echo e(ucfirst($data->payment_status)); ?></span></td>
		<?php elseif($data->payment_status=='pending'): ?>
         <td class="col5"><span class="label label-info"><?php echo e(ucfirst($data->payment_status)); ?></span></td>
        <?php elseif($data->payment_status=='cancelled'): ?>
        <td class="col5"><span class="label label-danger"><?php echo e(ucfirst($data->payment_status)); ?></span></td>
        <?php endif; ?>
		<td class="col6"><button class="btn btn-info btn-sm" onclick="viewProductDetails(<?php echo e($data->id); ?>)"><?php echo e(getPhrase('view_details')); ?></button></td>
		
	</tr>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<?php else: ?>
		<tr> <td colspan="8" align="center"> <?php echo e(getPhrase('No Purchases Found')); ?> 
	<?php echo sprintf( getPhrase('Click %s to purchase'), '<a href="'.URL_DISPLAY_PRODUCTS.'">'.getPhrase('here').'</a>' );?> </td></tr>
<?php endif; ?>
	<?php echo e($purchases->links()); ?>



 <div id="myModal1" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo e(getPhrase('product_details')); ?></h4>
      </div>
      <div class="modal-body">
        <div class="row">
           <div class="col-md-8 col-md-offset-2" id="product_details">
              
           </div>
        </div>
      </div>
      <div class="modal-footer">
      
        <button type="button" class="btn btn-lg btn-default button" data-dismiss="modal"><?php echo e(getPhrase('ok')); ?></button>
      </div>
    </div>

  </div>
</div>



	<?php $__env->startSection('footer_scripts'); ?>

	<script>
  function viewProductDetails(record_id)
{    

  
    $.ajax({
        url : '<?php echo e(URL_GET_PAYMENT_PRODUCT_DETAILS); ?>',
        method:'post',
        data:{
            _token:'<?php echo e(Session::token()); ?>',
            record_id:record_id
        },
        dataType: 'html',
    }).done(function (data) {
        
    $('#product_details').html(data);
        $('#myModal1').modal('show');
    }).fail(function () {
        alert('Posts could not be loaded.');
    });
    
}
</script>
	<?php $__env->stopSection(); ?>
