<td>
		<span class="digi_draghandle"></span>
		<input type="hidden" name="digi_variable_prices[<?php echo $key; ?>][index]" class="digi_repeatable_index" value="<?php echo $key; ?>"/>
	</td>
	<td>
		<input type="text" name="digi_variable_prices[<?php echo $key; ?>][name]" class="digi_variable_prices_name" value="<?php echo e($name); ?>" placeholder="<?php echo e(getPhrase('option_name')); ?>"/>
	</td>

	<td>
		<input type="text" name="digi_variable_prices[<?php echo $key; ?>][amount]" value="<?php echo e($amount); ?>" placeholder="2.3"/>
	</td>
	<td class="digi_repeatable_default_wrapper">
		<label class="digi-default-price">
			<?php if($isdefault): ?>
			<input type="radio" class="digi_repeatable_default_input" name="digi_variable_prices[<?php echo $key; ?>][isdefault]" checked />
			<?php else: ?>
			<input type="radio" class="digi_repeatable_default_input" name="digi_variable_prices[<?php echo $key; ?>][isdefault]"/>
			<?php endif; ?>
		</label>
	</td>
	<td>
		<span class="digi_price_id"><?php echo $key; ?></span>
	</td>
	<td>
		<button class="digi_remove_repeatable" data-type="price" style="background: url(<?php echo IMAGES . 'xit.gif'; ?>) no-repeat;"><span class="screen-reader-text"><?php printf( getPhrase( 'Remove price option %s'), $key ); ?></span><span aria-hidden="true">&times;</span></button>
	</td>