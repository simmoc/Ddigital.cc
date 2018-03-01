<!--FOOTER-->

<div class="footer">
	<div class="container">
		<div class="row">
			<?php
			$digimenu = App\Menu::select(['menu_items.*'])->join('menu_items', 'menus.id', '=', 'menu_items.menu_id')->where('menus.id', '=', 6);
			?>
			@if($digimenu->count() > 0)
			<?php
			$digimenu = $digimenu->first();
			?>
			<div class="col-lg-3 col-md-4  col-sm-6 col-xs-12 edd-footer">
				<h4 class="footer-head"> {{ getPhrase($digimenu->title) }}</h4>
					{!! $digimenu->description !!}
			</div>
			@endif
			
			<?php
			$menu2 = App\Menu::select(['menus.name','menu_items.*'])->join('menu_items', 'menus.id', '=', 'menu_items.menu_id')->where('menus.slug', '=', 'useful-links')->where('menus.status', '=', 'active')->where('menu_items.status', '=', 'active');
			$menuname = App\Menu::select(['menus.name','menu_items.*'])->join('menu_items', 'menus.id', '=', 'menu_items.menu_id')->where('menus.slug', '=', 'useful-links')->where('menus.status', '=', 'active')->where('menu_items.status', '=', 'active');			
			?>
			@if( $menu2->count() > 0)
			<?php
			$menu_name = $menuname->first()->name;
			?>
			<div class="col-lg-3 col-md-4  col-sm-6 col-xs-12 edd-footer">				
				<h4 class="footer-head">{{ getPhrase($menu_name) }}</h4>
				<ul>
					@foreach( $menu2->get() as $menu_item )
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
					<li><a href="{{ $url }}" {{ $target }}>{{ getPhrase($menu_item->title) }}</a></li>
					@endforeach
				</ul>
			</div>
			@endif
			
			<?php
			$menu3 = App\Menu::select(['menus.name','menu_items.*'])->join('menu_items', 'menus.id', '=', 'menu_items.menu_id')->where('menus.slug', '=', 'our-services')->where('menus.status', '=', 'active')->where('menu_items.status', '=', 'active');
			$menuname = App\Menu::select(['menus.name','menu_items.*'])->join('menu_items', 'menus.id', '=', 'menu_items.menu_id')->where('menus.slug', '=', 'our-services')->where('menus.status', '=', 'active')->where('menu_items.status', '=', 'active');			
			?>
			@if( $menu3->count() > 0)
			<div class="col-lg-3 col-md-4  col-sm-6 col-xs-12 edd-footer">
				<?php
			$menu_name = $menuname->first()->name;
			?>
				<h4 class="footer-head">{{ getPhrase($menu_name) }}</h4>
				<ul>
					@foreach( $menu3->get() as $menu_item )
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
					<li><a href="{{ $url }}" {{ $target }}><span class="fa fa-caret-right"></span>{{ getPhrase($menu_item->title) }}</a></li>
					@endforeach
				</ul>
			</div>
			@endif
			
			<?php
			$menu4 = App\Menu::select(['menus.name','menu_items.*'])->join('menu_items', 'menus.id', '=', 'menu_items.menu_id')->where('menus.slug', '=', 'contact')->where('menus.status', '=', 'active')->where('menu_items.status', '=', 'active')->first();
			?>
			@if( $menu4 )
			<div class="col-lg-3 col-md-4  col-sm-6 col-xs-12 edd-footer">				
				<h4 class="footer-head">{{ getPhrase($menu4->name) }}</h4>
				{!! $menu4->description !!}
			</div>
			@endif
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
			@if( $copy_rights != '')
			<div class="col-lg-4 col-md-10 col-sm-12 col-xs-12 col-lg-offset-1 col-md-offset-1 edd-footer">
                <p>{!! $copy_rights !!}</p></div>
			@endif
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
               @if($facebook!="")
				<li><a href="{{$facebook}}" target="_blank"><span class="fa fa-facebook"></span></a></li>
				@endif
				@if($twitter!="")
			    <li><a href="{{$twitter}}" target="_blank"><span class="fa fa-twitter"></span></a></li>
			    @endif
			    @if($googleplus!="")
				<li><a href="{{$googleplus}}" target="_blank"><span class="fa fa-google-plus"></span></a></li>
				@endif
				@if($linkedin!="")
				<li><a href="{{$linkedin}}" target="_blank"><span class="fa fa-linkedin"></span></a></li>
				@endif
				@if($dribble!="")
				<li><a href="{{$dribble}}" target="_blank"><span class="fa fa-dribbble"></span></a></li>
				@endif
				@if($pinterest!="")
				<li><a href="{{$pinterest}}" target="_blank"><span class="fa fa-pinterest"></span></a></li>
				@endif
				</ul>
			</div>
			
		</div>
	</div>
</div>

<!--/FOOTER-->