<!--FOOTER-->

<div class="footer">
	<div class="container">
		<div class="row">
			<?php
			$digimenu = App\Menu::select(['menu_items.*'])->join('menu_items', 'menus.id', '=', 'menu_items.menu_id')->where('menus.id', '=', 6);
			?>
			<?php if($digimenu->count() > 0): ?>
			<?php
			$digimenu = $digimenu->first();
			?>
			<div class="col-lg-3 col-md-4  col-sm-6 col-xs-12 edd-footer">
				<h4 class="footer-head"> <?php echo e(getPhrase($digimenu->title)); ?></h4>
					<?php echo $digimenu->description; ?>

			</div>
			<?php endif; ?>
			
			<?php
			$menu2 = App\Menu::select(['menus.name','menu_items.*'])->join('menu_items', 'menus.id', '=', 'menu_items.menu_id')->where('menus.slug', '=', 'useful-links')->where('menus.status', '=', 'active')->where('menu_items.status', '=', 'active');
			$menuname = App\Menu::select(['menus.name','menu_items.*'])->join('menu_items', 'menus.id', '=', 'menu_items.menu_id')->where('menus.slug', '=', 'useful-links')->where('menus.status', '=', 'active')->where('menu_items.status', '=', 'active');			
			?>
			<?php if( $menu2->count() > 0): ?>
			<?php
			$menu_name = $menuname->first()->name;
			?>
			<div class="col-lg-3 col-md-4  col-sm-6 col-xs-12 edd-footer">				
				<h4 class="footer-head"><?php echo e(getPhrase($menu_name)); ?></h4>
				<ul>
					<?php $__currentLoopData = $menu2->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php
					$url = PREFIX . $menu_item->url;
					if( $menu_item->page_id > 0 ) {
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
					<li><a href="<?php echo e($url); ?>" <?php echo e($target); ?>><?php echo e(getPhrase($menu_item->title)); ?></a></li>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</ul>
			</div>
			<?php endif; ?>
			
			<?php
			$menu3 = App\Menu::select(['menus.name','menu_items.*'])->join('menu_items', 'menus.id', '=', 'menu_items.menu_id')->where('menus.slug', '=', 'our-services')->where('menus.status', '=', 'active')->where('menu_items.status', '=', 'active');
			$menuname = App\Menu::select(['menus.name','menu_items.*'])->join('menu_items', 'menus.id', '=', 'menu_items.menu_id')->where('menus.slug', '=', 'our-services')->where('menus.status', '=', 'active')->where('menu_items.status', '=', 'active');			
			?>
			<?php if( $menu3->count() > 0): ?>
			<div class="col-lg-3 col-md-4  col-sm-6 col-xs-12 edd-footer">
				<?php
			$menu_name = $menuname->first()->name;
			?>
				<h4 class="footer-head"><?php echo e(getPhrase($menu_name)); ?></h4>
				<ul>
					<?php $__currentLoopData = $menu3->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $menu_item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
					<?php
					$url = PREFIX . $menu_item->url;
					if( $menu_item->page_id > 0 ) {
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
					<li><a href="<?php echo e($url); ?>" <?php echo e($target); ?>><span class="fa fa-caret-right"></span><?php echo e(getPhrase($menu_item->title)); ?></a></li>
					<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
				</ul>
			</div>
			<?php endif; ?>
			
			<?php
			$menu4 = App\Menu::select(['menus.name','menu_items.*'])->join('menu_items', 'menus.id', '=', 'menu_items.menu_id')->where('menus.slug', '=', 'contact')->where('menus.status', '=', 'active')->where('menu_items.status', '=', 'active')->first();
			?>
			<?php if( $menu4 ): ?>
			<div class="col-lg-3 col-md-4  col-sm-6 col-xs-12 edd-footer">				
				<h4 class="footer-head"><?php echo e(getPhrase($menu4->name)); ?></h4>
				<?php echo $menu4->description; ?>

			</div>
			<?php endif; ?>
		</div>
	</div>
</div>

<!--for copy rights-->

<div class="copyrights">
	<div class="social-icons ">
		<div class="row">
			<?php
			$copy_rights = getSetting('copy_rights', 'site_settings');
			?>
			<?php if( $copy_rights != ''): ?>
			<div class="col-lg-4 col-md-10 col-sm-12 col-xs-12 col-lg-offset-1 col-md-offset-1 edd-footer">
                <p><?php echo $copy_rights; ?></p></div>
			<?php endif; ?>
			<?php
			$facebook = getSetting('facebook', 'site_settings');

			$twitter = getSetting('twitter', 'site_settings');
			$googleplus = getSetting('googleplus', 'site_settings');
			$linkedin = getSetting('linkedin', 'site_settings');
			$dribble = getSetting('dribble', 'site_settings');
			$pinterest = getSetting('pinterest', 'site_settings');
			?>
			
			<div class="col-lg-4 col-md-10 col-sm-12 col-xs-12 col-lg-offset-1 col-md-offset-1 edd-footer pull-right">
				<ul class="edd-links">
               <?php if($facebook!=""): ?>
				<li><a href="<?php echo e($facebook); ?>" target="_blank"><span class="fa fa-facebook"></span></a></li>
				<?php endif; ?>
				<?php if($twitter!=""): ?>
			    <li><a href="<?php echo e($twitter); ?>" target="_blank"><span class="fa fa-twitter"></span></a></li>
			    <?php endif; ?>
			    <?php if($googleplus!=""): ?>
				<li><a href="<?php echo e($googleplus); ?>" target="_blank"><span class="fa fa-google-plus"></span></a></li>
				<?php endif; ?>
				<?php if($linkedin!=""): ?>
				<li><a href="<?php echo e($linkedin); ?>" target="_blank"><span class="fa fa-linkedin"></span></a></li>
				<?php endif; ?>
				<?php if($dribble!=""): ?>
				<li><a href="<?php echo e($dribble); ?>" target="_blank"><span class="fa fa-dribbble"></span></a></li>
				<?php endif; ?>
				<?php if($pinterest!=""): ?>
				<li><a href="<?php echo e($pinterest); ?>" target="_blank"><span class="fa fa-pinterest"></span></a></li>
				<?php endif; ?>
				</ul>
			</div>
			
		</div>
	</div>
</div>

<!--/FOOTER-->