<?php
if( ! isset($main_active) )
	$main_active = 'login';
?>
<!--HEADER-->
<nav class="navbar navbar-default navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<a class="navbar-brand pw-navbar-brand" href="<?php echo e(PREFIX); ?>">
			<?php
			$site_logo = getSetting('site_logo', 'site_settings');

			if( $site_logo != '' && File::exists(IMAGE_PATH_SITE_LOGO.$site_logo ) ) {
				$site_logo = IMAGE_PATH_SITE_LOGO.$site_logo;
			} else {
				$site_logo =  DEFAULT_SITELOGO_IMAGE;
			}
			?>
           <img src="<?php echo e(IMAGE_PATH_SITE_LOGO.getSetting('site_logo', 'site_settings')); ?>" alt="" height="46" width="auto"></a>
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar1">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<!--<ul class="nav navbar-nav">
				<li><img src="images/logo.png" alt="image missing" class="img-responsive"></li>
			</ul>-->

		<div class="collapse navbar-collapse" id="myNavbar1">
			<?php
			$menu = App\Menu::select(['menus.name','menu_items.*'])->join('menu_items', 'menus.id', '=', 'menu_items.menu_id')->where('menus.slug', '=', 'main-menu')->where('menus.status', '=', 'active')->where('menu_items.status', '=', 'active')->orderBy('menu_order', 'asc');
			?>
			<?php if( $menu->count() > 0): ?>
				<ul class="nav navbar-nav navbar-right">
					<?php $__currentLoopData = $menu->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<?php if( $menu_item->url == 'login' || $menu_item->url == 'register' ): ?>
							<?php if(Auth::check()): ?>
							<?php
								$user = getUserRecord();
								$url = URL_USERS_DASHBOARD;
								if( in_array($user->role_id, array( OWNER_ROLE_ID, ADMIN_ROLE_ID, EXECUTIVE_ROLE_ID )) ) {
									$url = URL_DASHBOARD;
								} elseif( $user->role_id == USER_ROLE_ID ) {
									$url = URL_USERS_DASHBOARD;
								} elseif( $user->role_id == VENDOR_ROLE_ID ) {
									$url = URL_VENDOR_DASHBOARD;
								}
							?>
							<?php if( $menu_item->url == 'login' ): ?>
								<li <?php echo e(isActive($main_active, 'login')); ?>><a href="<?php echo e($url); ?>"><?php echo e(getPhrase('my_dashboard')); ?></a></li>							
								<li>	
								<a href="<?php echo e(URL_MESSAGES); ?>">
								<i class="fa fa-envelope-o"></i>
								<span class="badge badge-success"></span><sup><?php echo e($count = Auth::user()->newThreadsCount()); ?></sup>
								</a></li>
							<?php endif; ?>
							<?php else: ?>
								<?php if( $menu_item->url == 'login' ): ?>	
								<li <?php echo e(isActive($main_active, 'login')); ?>><a href="<?php echo e(URL_USERS_LOGIN); ?>">Login</a></li>
								
								<?php endif; ?>
								
							<?php endif; ?>	
						<?php elseif( $menu_item->url == 'products-display' ): ?>
							<?php
							$categories = App\Category::where('status', '=', 'Active');
							?>
							<?php if( $categories->count() > 0 ): ?>
							<li class="dropdown <?php echo e(isActive($main_active, 'products')); ?>">
								<a href="<?php echo e(URL_DISPLAY_PRODUCTS); ?>">Products</a>
								<ul class="dropdown-menu multi-level" role="menu">
									<?php $__currentLoopData = $categories->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<li class="dropdown-submenu">
										<?php if( $category->parent_id == 0 ): ?>
										  
										<a href="<?php echo e(URL_DISPLAY_PRODUCTS . '/' . $category->slug); ?>"><span class="fa <?php echo e($category->icon); ?>"></span><?php echo e($category->title); ?></a>							
										<?php
										$subcats = App\Category::where('status', '=', 'Active')->where('parent_id', '=', $category->id);
										?>
										<?php if( $subcats->count() > 0 ): ?>
										<ul class="dropdown-menu">
											<?php $__currentLoopData = $subcats->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
												<li><a href="<?php echo e(URL_DISPLAY_PRODUCTS.'/'.$category->slug.'/'.$subcat->slug); ?>"> <?php echo e($subcat->title); ?></a> </li>
											<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
										</ul>
										<?php endif; ?>
										<?php endif; ?>
									</li>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
								</ul>
							</li>
							<?php endif; ?>
						<?php elseif( $menu_item->page_id == 'pages'): ?>
							<?php
							$pages = App\Pages::where('status', '=', 'Active')->whereIn('id', (array) json_decode($menu_item->pages) );
							?>
							<?php if( $pages->count() > 0 ): ?>
								<li class="dropdown <?php echo e(isActive($main_active, 'pages')); ?>">
									<a href="javascript:void(0);">Pages</a>
									<ul class="dropdown-menu multi-level" role="menu">
										<?php $__currentLoopData = $pages->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<li class="dropdown-submenu">
											<a href="<?php echo e(URL_VIEW_PAGE . $page->slug); ?>"><span class="fa <?php echo e($page->icon); ?>"></span><?php echo e($page->title); ?></a>
										</li>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
									</ul>
								</li>
							<?php endif; ?>
						<?php elseif( $menu_item->url == 'faq' ): ?>
						<li <?php echo e(isActive($main_active, 'faq')); ?>><a href="<?php echo e(URL_FAQ_PAGE); ?>">FAQ</a></li>						
						<?php else: ?>
						<?php						
						$url = PREFIX . $menu_item->url;
						if( $menu_item->page_id > '0' ) {
							$page = App\Pages::where('id', '=', $menu_item->page_id)->first();
							if( $page ) {
								$url = PREFIX . 'page/' .$page->slug;
							}
						}
						$target = '';
						if( $menu_item->target == '_blank' ) {
							$target = ' target="_blank"';
						}
						?>
						<li <?php echo e(isActive($main_active, $menu_item->menu_active_title)); ?>><a href="<?php echo e($url); ?>" <?php echo e($target); ?>><?php echo e($menu_item->title); ?></a></li>
						<?php endif; ?>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
					<!--for cart-->
					<li>
						<a href="<?php echo e(URL_CART); ?>"><span class="fa fa-shopping-cart"></span> <sup><?php echo e(sizeof(Cart::content())); ?></sup></a>

					</li>

					<?php if(Auth::check()): ?>
					<li><a href="<?php echo e(URL_LOGOUT); ?>" onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">Logout</a>
				   <form id="logout-form" action="<?php echo e(URL_LOGOUT); ?>" method="POST" style="display: none;">
                                            <?php echo e(csrf_field()); ?>

                                        </form>
				   </li>
					<?php endif; ?>
				</ul>
				
			<?php else: ?>
			<ul class="nav navbar-nav navbar-right">
				
				<!--for home-->
				<li class="<?php echo e(isActive($main_active, 'home')); ?>"><a href="<?php echo e(PREFIX); ?>">Home</a></li>
				<!--for products-->
				<?php
				$categories = App\Category::where('status', '=', 'Active');
				?>
				<?php if( $categories->count() > 0 ): ?>
				<li class="dropdown <?php echo e(isActive($main_active, 'products')); ?>">
					<a href="<?php echo e(URL_DISPLAY_PRODUCTS); ?>">Products</a>
					<ul class="dropdown-menu multi-level" role="menu">
						<?php $__currentLoopData = $categories->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
						<li class="dropdown-submenu">
							<?php if( $category->parent_id == 0 ): ?>
							<a href="<?php echo e(URL_DISPLAY_PRODUCTS . '/' . $category->slug); ?>"><span class="fa fa-product-hunt"></span><?php echo e($category->title); ?><span class="fa <?php echo e($category->icon); ?>"></span></a>							
							<?php
							$subcats = App\Category::where('status', '=', 'Active')->where('parent_id', '=', $category->id);
							?>
							<?php if( $subcats->count() > 0 ): ?>
							<ul class="dropdown-menu">
								<?php $__currentLoopData = $subcats->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<li><a href="<?php echo e(URL_DISPLAY_PRODUCTS . '/' . $category->slug . '/' . $subcat->slug); ?>"> <?php echo e(getPhrase($subcat->title)); ?></a> </li>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</ul>
							<?php endif; ?>
							<?php endif; ?>
						</li>
						<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>	
					</ul>
				</li>
				<?php endif; ?>

				<li class="<?php echo e(isActive($main_active, 'about')); ?>"><a href="about.html">About</a></li>
				<li class="<?php echo e(isActive($main_active, 'faq')); ?>"><a href="faq.html">FAQ</a></li>
				<li class="<?php echo e(isActive($main_active, 'support')); ?>"><a href="support.html">Support</a></li>
				<?php if(Auth::check()): ?>
				<?php
					$user = getUserRecord();
					$url = URL_USERS_DASHBOARD;
					if( in_array($user->role_id, array( OWNER_ROLE_ID, ADMIN_ROLE_ID, EXECUTIVE_ROLE_ID )) ) {
						$url = URL_DASHBOARD;
					} elseif( $user->role_id == USER_ROLE_ID ) {
						$url = URL_USERS_DASHBOARD;
					} elseif( $user->role_id == VENDOR_ROLE_ID ) {
						$url = URL_VENDOR_DASHBOARD;
					}
				?>
				
				<li class="<?php echo e(isActive($main_active, 'login')); ?>"><a href="<?php echo e($url); ?>"><?php echo e(getPhrase('my_dashboard')); ?></a></li>
                
                <li>	
				<a href="<?php echo e(URL_MESSAGES); ?>">
              <i class="fa fa-envelope-o"></i>
              <span class="badge badge-success"></span><sup><?php echo e($count = Auth::user()->newThreadsCount()); ?></sup>
            </a></li>

				<?php else: ?>
					<li class="<?php echo e(isActive($main_active, 'login')); ?>"><a href="<?php echo e(URL_USERS_LOGIN); ?>"><?php echo e(getPhrase('login')); ?></a></li>
				<?php endif; ?>
				
				<li>
            
            
          </li>

				<!--for cart-->
				<li>
					<a href="<?php echo e(URL_CART); ?>"><span class="fa fa-shopping-cart"></span> <sup><?php echo e(sizeof(Cart::content())); ?></sup></a>

				</li>
			</ul>
			<?php endif; ?>

		</div>
	</div>
</nav>
<!--/HEADER-->