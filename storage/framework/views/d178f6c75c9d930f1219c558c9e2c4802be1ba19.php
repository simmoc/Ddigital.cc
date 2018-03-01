<ul class="nav nav-tabs">
	<li class="<?php if($tab == 'dashboard') echo 'active';?>"><a href="<?php echo e(URL_VENDOR_DASHBOARD); ?>"><?php echo e(getPhrase('dashboard')); ?></a></li>
	<li class="<?php if($tab == 'purchases') echo 'active';?>"><a href="<?php echo e(URL_VENDOR_DASHBOARD . '/purchases'); ?>"><?php echo e(getPhrase('purchase_history')); ?></a></li>
	<li class="<?php if($tab == 'products') echo 'active';?>"><a href="<?php echo e(URL_PRODUCTS); ?>"><?php echo e(getPhrase('products')); ?></a></li>
	<li class="<?php if($tab == 'setting') echo 'active';?>"><a href="<?php echo e(URL_VENDOR_DASHBOARD . '/setting'); ?>"><?php echo e(getPhrase('profile')); ?></a></li>
	
	


</ul>