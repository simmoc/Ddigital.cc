<ul class="nav nav-tabs">
	<li class="<?php if($tab == 'dashboard') echo 'active';?>"><a href="<?php echo e(URL_USERS_DASHBOARD); ?>">Dashboard</a></li>
	<li class="<?php if($tab == 'purchases') echo 'active';?>"><a href="<?php echo e(URL_USERS_DASHBOARD . '/purchases'); ?>">Purchase History</a></li>
	<li class="<?php if($tab == 'setting') echo 'active';?>"><a href="<?php echo e(URL_USERS_DASHBOARD . '/setting'); ?>">Profile</a></li>
	
	<!-- <li><a href="<?php echo e(URL_LOGOUT); ?>" onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">Logout</a>
				   <form id="logout-form" action="<?php echo e(URL_LOGOUT); ?>" method="POST" style="display: none;">
                                            <?php echo e(csrf_field()); ?>

                                        </form>
				   </li> -->
</ul>