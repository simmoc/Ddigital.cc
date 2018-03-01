<ul class="nav nav-tabs">
	<li class="<?php if($tab == 'dashboard') echo 'active';?>"><a href="{{ URL_USERS_DASHBOARD }}">{{getPhrase('dashboard')}}</a></li>
	<li class="<?php if($tab == 'purchases') echo 'active';?>"><a href="{{ URL_USERS_DASHBOARD . '/purchases' }}">{{getPhrase('purchase_history')}}</a></li>
	<li class="<?php if($tab == 'setting') echo 'active';?>"><a href="{{ URL_USERS_DASHBOARD . '/setting' }}">{{getPhrase('profile')}}</a></li>
	
	<!-- <li><a href="{{URL_LOGOUT}}" onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">Logout</a>
				   <form id="logout-form" action="{{ URL_LOGOUT }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
				   </li> -->
</ul>