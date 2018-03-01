<?php if( $purchases->count() > 0 ): ?>
	<?php $__currentLoopData = $purchases; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $purchase): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
	<tr>
		<td class="col1"><?php echo e($purchase->id); ?></td>
		<td class="col2"><?php echo e($purchase->item_name); ?></td>
		<td class="col3"><?php echo e($purchase->created_at); ?></td>
		<td class="col4"><?php echo e(currency( $purchase->paid_amount )); ?></td>
		<?php if($purchase->licence_id!=0): ?>
		<?php $licence_name = App\Licence::where('id','=',$purchase->licence_id)->first()->title; ?>
		<td class="col5"><?php echo e($licence_name); ?></td>
		<?php else: ?>
		<td class="col5">Standard</td>
		<?php endif; ?>
		<?php if($purchase->payment_status=='success'): ?>
		<td class="col6">
		<a href="<?php echo e(URL_CART_DOWNLOAD.$purchase->slug); ?>">
		<span class="fa fa-download"></span>
		</a>
		</td>
		<?php else: ?>
         <td class="col6">-</td>
        <?php endif; ?> 
		<td class="col7"><?php echo e($purchase->payment_gateway); ?></td>
		<td class="col8"><?php echo e($purchase->payment_status); ?></td>
	</tr>
	<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
	<?php else: ?>
		<tr> <td colspan="8" align="center"> <?php echo e(getPhrase('No Purchases Found')); ?> 
	<?php echo sprintf( getPhrase('Click %s to purchase'), '<a href="'.URL_DISPLAY_PRODUCTS.'">'.getPhrase('here').'</a>' );?> </td></tr>
<?php endif; ?>
	<?php echo e($purchases->links()); ?>

