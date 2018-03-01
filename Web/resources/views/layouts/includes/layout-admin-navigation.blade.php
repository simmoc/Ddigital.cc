<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
       <?php $login_user_image = Auth::user()->image;
        ?>
        <div class="pull-left image"> <img src="{{getProfilePath($login_user_image)}}" class="img-circle" alt="User Image"> </div>
        <div class="pull-left info">
            <p>{{ucfirst($current_user->name)}}</p> <a href="#"><i class="fa fa-circle text-success"></i> {{ getPhrase('Online') }}</a> </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
        <!--<li class="{{ isActive($main_active, 'dashboard') }}"><a href="{{URL_DASHBOARD}}"><i class="fa fa-home"></i> {{ getPhrase('Dashboard') }}</a></li>-->
        <li class="{{ isActive($main_active, 'dashboard') }} treeview">
            <a href="{{URL_DASHBOARD}}"> <i class="fa fa-home"></i> <span>{{ getPhrase('home') }}</span> </a>
        </li> @if(isModuleEligible('Users'))
        <li class="{{ isActive($main_active, 'users') }} treeview">
            <a href="{{URL_ADMIN_USERS_DASHBOARD}}"> <i class="fa fa-users"></i> <span>{{ getPhrase('users') }}</span> <span class="pull-right-container">
		  <i class="fa fa-angle-left pull-right"></i>
		</span> </a>
            <ul class="treeview-menu"> @if(isModuleEligible('Users'))
                <li class="{{ isActive($sub_active, 'list') }}"><a href="{{URL_USERS."all"}}"><i class="fa fa-users"></i> {{ getPhrase('all') }}</a></li> @endif @if(isModuleEligible('Users_Owners'))
                <li class="{{ isActive($sub_active, 'ownerlist') }}"><a href="{{URL_USERS."owner"}}"><i class="fa fa-user-times"></i> {{ getPhrase('owners') }}</a></li> @endif @if(isModuleEligible('Users_Admins'))
                <li class="{{ isActive($sub_active, 'adminlist') }}"><a href="{{URL_USERS."admin"}}"><i class="fa fa-user-secret"></i> {{ getPhrase('admins') }}</a></li> @endif @if(isModuleEligible('Users_Executives'))
                <li class="{{ isActive($sub_active, 'executivelist') }}"><a href="{{URL_USERS."executive"}}"><i class="fa fa-male"></i> {{ getPhrase('executives') }}</a></li> @endif @if(isModuleEligible('Users_Vendors'))
                <li class="{{ isActive($sub_active, 'vendorlist') }}"><a href="{{URL_USERS."vendor"}}"><i class="fa fa-user-md"></i> {{ getPhrase('vendors') }}</a></li> @endif @if(isModuleEligible('Users_Customers'))
                <li class="{{ isActive($sub_active, 'userlist') }}"><a href="{{URL_USERS."user"}}"><i class="fa fa-female"></i> {{ getPhrase('customers') }}</a></li> @endif @if(isModuleEligible('Users', array('Add')))
                <li class="{{ isActive($sub_active, 'add') }}"><a href="{{URL_USERS_ADD}}"><i class="fa fa-user-plus"></i> {{ getPhrase('add') }}</a></li> @endif @if(isModuleEligible('Users', array( 'Import' )))
                <li class="{{ isActive($sub_active, 'import') }}"><a href="{{URL_IMPORT."user"}}"><i class="fa fa-user"></i> {{ getPhrase('import') }}</a></li> @endif </ul>
        </li> @endif @if(isModuleEligible('Categories'))
        <li class="{{ isActive($main_active, 'categories') }} treeview">
            <a href="#"> <i class="fa fa-random"></i> <span>Categories</span> <span class="pull-right-container">
		  <i class="fa fa-angle-left pull-right"></i>
		</span> </a>
            <ul class="treeview-menu">
                <li class="{{ isActive($sub_active, 'list') }}"><a href="{{URL_CATEGORIES}}"><i class="fa fa-list"></i> {{ getPhrase('list') }}</a></li> @if(isModuleEligible('Categories', array('Add')))
                <li class="{{ isActive($sub_active, 'add') }}"><a href="{{URL_CATEGORIES_ADD}}"><i class="fa fa-plus"></i> {{ getPhrase('add') }}</a></li> @endif @if(isModuleEligible('Categories', array('Import')))
                <li class="{{ isActive($sub_active, 'import') }}"><a href="{{URL_IMPORT.'category'}}"><i class="fa fa-download"></i> {{ getPhrase('import') }}</a></li> @endif </ul>
        </li> @endif @if(isModuleEligible('Coupons'))
        <li class="{{ isActive($main_active, 'coupons') }} treeview">
            <a href="#"> <i class="fa fa-hashtag"></i> <span>{{ getPhrase('coupons') }}</span> <span class="pull-right-container">
		  <i class="fa fa-angle-left pull-right"></i>
		</span> </a>
            <ul class="treeview-menu">
                <li class="{{ isActive($sub_active, 'list') }}"><a href="{{ URL_COUPONS }}"><i class="fa fa-list"></i> {{ getPhrase('list') }}</a></li> @if(isModuleEligible('Coupons', array('Add')))
                <li class="{{ isActive($sub_active, 'add') }}"><a href="{{ URL_COUPONS_ADD }}"><i class="fa fa-plus"></i> {{ getPhrase('add') }}</a></li> @endif </ul>
        </li> @endif @if(isModuleEligible('Licences'))
        <li class="{{ isActive($main_active, 'licences') }} treeview">
            <a href="#"> <i class="fa fa-key"></i> <span>{{ getPhrase('licences') }}</span> <span class="pull-right-container">
		  <i class="fa fa-angle-left pull-right"></i>
		</span> </a>
            <ul class="treeview-menu">
                <li class="{{ isActive($sub_active, 'list') }}"><a href="{{ URL_LICENCES }}"><i class="fa fa-list"></i> {{ getPhrase('list') }}</a></li> @if(isModuleEligible('Licences', array('Add')))
                <li class="{{ isActive($sub_active, 'add') }}"><a href="{{ URL_LICENCES_ADD }}"><i class="fa fa-plus"></i> {{ getPhrase('add') }}</a></li> @endif </ul>
        </li> @endif @if(isModuleEligible('Products'))
        <li class="{{ isActive($main_active, 'products') }} treeview">
            <a href="#"> <i class="fa fa-shopping-bag" aria-hidden="true"></i> <span>Products</span> <span class="pull-right-container">
		  <i class="fa fa-angle-left pull-right"></i>
		</span> </a>
            <ul class="treeview-menu">
                <li class="{{ isActive($sub_active, 'list') }}"><a href="{{ URL_PRODUCTS }}"><i class="fa fa-list"></i> {{ getPhrase('list') }}</a></li> @if(isModuleEligible('Products', array('Add')))
                <li class="{{ isActive($sub_active, 'add') }}"><a href="{{ URL_PRODUCTS_ADD }}"><i class="fa fa-plus"></i> {{ getPhrase('add') }}</a></li> @endif @if(isModuleEligible('Products', 'Import'))
                <li class="{{ isActive($sub_active, 'import') }}"><a href="{{ URL_IMPORT . 'product' }}"><i class="fa fa-download"></i> {{ getPhrase('Import') }}</a></li> @endif </ul>
        </li> @endif 
        @if(isModuleEligible('Email_Templates'))
        <li class="{{ isActive($main_active, 'templates') }} treeview">
            <a href="#"> <i class="fa fa-commenting-o" aria-hidden="true"></i><span>{{ getPhrase('Templates') }}</span> <span class="pull-right-container">
		  <i class="fa fa-angle-left pull-right"></i>
		</span> </a>
            <ul class="treeview-menu">
                <li class="{{ isActive($sub_active, 'list_email') }}"><a href="{{ URL_TEMPLATES_EMAIL }}"><i class="fa fa-list"></i> {{getPhrase('list')}}</a></li> @if(isModuleEligible('Email_Templates', array('Add')))
                <li class="{{ isActive($sub_active, 'add') }}"><a href="{{ URL_TEMPLATES_ADD }}"><i class="fa fa-plus"></i> {{getPhrase('add')}}</a></li> @endif </ul>
        </li> @endif @if(isModuleEligible('Offers'))
        <li class="{{ isActive($main_active, 'offers') }} treeview">
            <a href="#"> <i class="fa fa-tags" aria-hidden="true"></i>
 <span>{{ getPhrase('offers') }}</span> <span class="pull-right-container">
		  <i class="fa fa-angle-left pull-right"></i>
		</span> </a>
            <ul class="treeview-menu">
                <li class="{{ isActive($sub_active, 'list') }}"><a href="{{ URL_OFFERS }}"><i class="fa fa-list"></i> {{ getPhrase('list') }}</a></li> @if(isModuleEligible('Offers', array('Add')))
                <li class="{{ isActive($sub_active, 'add') }}"><a href="{{ URL_OFFERS_ADD }}"><i class="fa fa-plus"></i> {{ getPhrase('add') }}</a></li> @endif </ul>
        </li> @endif @if(isModuleEligible('Pages'))
        <li class="{{ isActive($main_active, 'pages') }} treeview">
            <a href="#"> <i class="fa fa-file-text-o" aria-hidden="true"></i> <span>{{ getPhrase('pages') }}</span> <span class="pull-right-container">
		  <i class="fa fa-angle-left pull-right"></i>
		</span> </a>
            <ul class="treeview-menu">
                <li class="{{ isActive($sub_active, 'list') }}"><a href="{{ URL_PAGES }}"><i class="fa fa-list"></i> {{ getPhrase('list') }}</a></li> @if(isModuleEligible('Pages', array('Add')))
                <li class="{{ isActive($sub_active, 'add') }}"><a href="{{ URL_PAGES_ADD }}"><i class="fa fa-plus"></i> {{ getPhrase('add') }}</a></li> @endif </ul>
        </li> @endif @if(isModuleEligible('Faq'))
        <li class="{{ isActive($main_active, 'faq') }} treeview">
            <a href="#"> <i class="fa fa-question"></i> <span>FAQs</span> <span class="pull-right-container">
		  <i class="fa fa-angle-left pull-right"></i>
		</span> </a>
            <ul class="treeview-menu">
                <li class="{{ isActive($sub_active, 'list') }}"><a href="{{ URL_FAQ }}"><i class="fa fa-list"></i> {{ getPhrase('list') }}</a></li> @if(isModuleEligible('Faq', array('Add')))
                <li class="{{ isActive($sub_active, 'add') }}"><a href="{{ URL_FAQ_ADD }}"><i class="fa fa-plus"></i> {{ getPhrase('add') }}</a></li> @endif </ul>
        </li> @endif @if(isModuleEligible('Payments_Report'))
        <li class="{{ isActive($main_active, 'reports') }} treeview">
            <a href="#"> <i class="fa fa-file-o" aria-hidden="true"></i> <span>{{ getPhrase('payment_reports') }}</span> <span class="pull-right-container">
		  <i class="fa fa-angle-left pull-right"></i>
		</span> </a>
            <ul class="treeview-menu">
                <li class="{{ isActive($sub_active, 'online_reports') }}"><a href="{{ URL_ONLINE_PAYMENT_REPORTS }}"><i class="fa fa-file"></i> {{ getPhrase('online_reports') }}</a></li>
                <li class="{{ isActive($sub_active, 'offline_reports') }}">
                    <a href="{{URL_OFFLINE_PAYMENT_REPORTS}}"> <i class="fa fa-files-o" aria-hidden="true"></i> {{ getPhrase('offline_reports') }} </a>
                </li> @if(isModuleEligible('Payments_Report', array('Export')))
                <li class="{{ isActive($sub_active, 'export') }}">
                    <a href="{{URL_PAYMENT_REPORT_EXPORT}}"> <i class="fa fa-file-text-o" aria-hidden="true"></i> {{ getPhrase('export') }} </a>
                </li>
                <li class="{{ isActive($sub_active, 'free_bies') }}">
                    <a href="{{URL_FREEBIES_REPORTS}}"> 

                                    <i class="fa fa-list-alt" aria-hidden="true"></i>
                                {{ getPhrase('free_bies') }} </a>
                </li> @endif </ul>
        </li> @endif @if(isModuleEligible('Menus'))
        <li class="{{ isActive($main_active, 'menu') }} treeview">
            <a href="#"> <i class="fa fa-bars" aria-hidden="true"></i> <span>{{ getPhrase('Menus') }}</span> <span class="pull-right-container">
		  <i class="fa fa-angle-left pull-right"></i>
		</span> </a>
            <ul class="treeview-menu">
                <li class="{{ isActive($sub_active, 'list') }}"><a href="{{ URL_MENU }}"><i class="fa fa-list"></i> {{ getPhrase('list') }}</a></li> @if(isModuleEligible('Menus', array('Add')))
                <li class="{{ isActive($sub_active, 'add') }}"><a href="{{ URL_MENU_ADD }}"><i class="fa fa-plus"></i> {{ getPhrase('add') }}</a></li> @endif </ul>
        </li> @endif @if(isModuleEligible('Settings') || isModuleEligible('Languages'))
        <li class="{{ isActive($main_active, 'settings') }} treeview">
            <a href="#"> <i class="fa fa-cog" aria-hidden="true"></i> <span>{{ getPhrase('settings') }}</span> <span class="pull-right-container">
		  <i class="fa fa-angle-left pull-right"></i>
		</span> </a>
            <ul class="treeview-menu"> @if(isModuleEligible('Settings'))
                <li class="{{ isActive($sub_active, 'list') }}"><a href="{{ URL_MASTERSETTINGS_SETTINGS }}"><i class="fa fa-list"></i> {{ getPhrase('list') }}</a></li> @endif @if(isModuleEligible('Languages'))
                <li class="{{ isActive($sub_active, 'languages') }}">
                    <a href="{{URL_LANGUAGES_LIST}}"> <i class="fa fa-language" aria-hidden="true"></i> {{ getPhrase('languages') }} </a>
                </li> @endif </ul>
        </li> @endif </ul>
</section>