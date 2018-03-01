<?php if( $purchases->count() > 0 ): ?>
<?php 
	$index = 1
 ?>	
<?php $__currentLoopData = $purchases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<tr>
		<td class="col1"><?php echo e($purchase->id); ?></td>
		<td class="col2"><?php echo e($purchase->item_name); ?></td>
		<td class="col3"><?php echo e($purchase->created_at); ?></td>
		<td class="col4"><?php echo e(currency( $purchase->paid_amount )); ?></td>
		<td class="col5">Standard</td>
		<?php if($purchase->payment_status=='success'): ?>
		<td class="col6">
		<a href="<?php echo e(URL_CART_DOWNLOAD.$purchase->slug); ?>">
		<span class="fa fa-download"></span>
            </a></td>
        <?php else: ?>
        <td class="col6">-</td>
        <?php endif; ?>    
		<td class="col7"><?php echo e($purchase->payment_gateway); ?></td>
		<td class="col8"><?php echo e($purchase->payment_status); ?></td>
		
	</tr>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	
	<?php echo e($purchases->links()); ?>

	
	<?php else: ?>
		<tr> <td colspan="8" align="center"> <?php echo e(getPhrase('No Purchases Found')); ?> 
	<?php echo sprintf( getPhrase('Click %s to purchase'), '<a href="'.URL_DISPLAY_PRODUCTS.'">'.getPhrase('here').'</a>' );?> </td></tr>
<?php endif; ?>