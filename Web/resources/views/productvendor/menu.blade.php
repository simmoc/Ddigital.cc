<ul class="nav nav-tabs">
	<li class="<?php if($tab == 'dashboard') echo 'active';?>"><a href="{{ URL_VENDOR_DASHBOARD }}">{{ getPhrase('dashboard') }}</a></li>
	<li class="<?php if($tab == 'purchases') echo 'active';?>"><a href="{{ URL_VENDOR_DASHBOARD . '/purchases' }}">{{ getPhrase('purchase_history') }}</a></li>
	<li class="<?php if($tab == 'products') echo 'active';?>"><a href="{{ URL_PRODUCTS }}">{{ getPhrase('products') }}</a></li>
	<li class="<?php if($tab == 'setting') echo 'active';?>"><a href="{{ URL_VENDOR_DASHBOARD . '/setting' }}">{{ getPhrase('profile') }}</a></li>
	
	{{-- <li><a href="{{URL_LOGOUT}}" onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">{{ getPhrase('logout') }}</a>
				   <form id="logout-form" action="{{ URL_LOGOUT }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
				   </li> --}}


</ul>