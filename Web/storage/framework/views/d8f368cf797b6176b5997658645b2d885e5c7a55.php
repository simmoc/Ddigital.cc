<section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
       <?php $login_user_image = Auth::user()->image;
        ?>
        <div class="pull-left image"> <img src="<?php echo e(getProfilePath($login_user_image)); ?>" class="img-circle" alt="User Image"> </div>
        <div class="pull-left info">
            <p><?php echo e(ucfirst($current_user->name)); ?></p> <a href="#"><i class="fa fa-circle text-success"></i> <?php echo e(getPhrase('Online')); ?></a> </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
        <!--<li class="<?php echo e(isActive($main_active, 'dashboard')); ?>"><a href="<?php echo e(URL_DASHBOARD); ?>"><i class="fa fa-home"></i> <?php echo e(getPhrase('Dashboard')); ?></a></li>-->
        <li class="<?php echo e(isActive($main_active, 'dashboard')); ?> treeview">
            <a href="<?php echo e(URL_DASHBOARD); ?>"> <i class="fa fa-home"></i> <span><?php echo e(getPhrase('home')); ?></span> </a>
        </li> <?php if(isModuleEligible('Users')): ?>
        <li class="<?php echo e(isActive($main_active, 'users')); ?> treeview">
            <a href="<?php echo e(URL_ADMIN_USERS_DASHBOARD); ?>"> <i class="fa fa-users"></i> <span><?php echo e(getPhrase('users')); ?></span> <span class="pull-right-container">
		  <i class="fa fa-angle-left pull-right"></i>
		</span> </a>
            <ul class="treeview-menu"> <?php if(isModuleEligible('Users')): ?>
                <li class="<?php echo e(isActive($sub_active, 'list')); ?>"><a href="<?php echo e(URL_USERS."all"); ?>"><i class="fa fa-users"></i> <?php echo e(getPhrase('all')); ?></a></li> <?php endif; ?> <?php if(isModuleEligible('Users_Owners')): ?>
                <li class="<?php echo e(isActive($sub_active, 'ownerlist')); ?>"><a href="<?php echo e(URL_USERS."owner"); ?>"><i class="fa fa-user-times"></i> <?php echo e(getPhrase('owners')); ?></a></li> <?php endif; ?> <?php if(isModuleEligible('Users_Admins')): ?>
                <li class="<?php echo e(isActive($sub_active, 'adminlist')); ?>"><a href="<?php echo e(URL_USERS."admin"); ?>"><i class="fa fa-user-secret"></i> <?php echo e(getPhrase('admins')); ?></a></li> <?php endif; ?> <?php if(isModuleEligible('Users_Executives')): ?>
                <li class="<?php echo e(isActive($sub_active, 'executivelist')); ?>"><a href="<?php echo e(URL_USERS."executive"); ?>"><i class="fa fa-male"></i> <?php echo e(getPhrase('executives')); ?></a></li> <?php endif; ?> <?php if(isModuleEligible('Users_Vendors')): ?>
                <li class="<?php echo e(isActive($sub_active, 'vendorlist')); ?>"><a href="<?php echo e(URL_USERS."vendor"); ?>"><i class="fa fa-user-md"></i> <?php echo e(getPhrase('vendors')); ?></a></li> <?php endif; ?> <?php if(isModuleEligible('Users_Customers')): ?>
                <li class="<?php echo e(isActive($sub_active, 'userlist')); ?>"><a href="<?php echo e(URL_USERS."user"); ?>"><i class="fa fa-female"></i> <?php echo e(getPhrase('customers')); ?></a></li> <?php endif; ?> <?php if(isModuleEligible('Users', array('Add'))): ?>
                <li class="<?php echo e(isActive($sub_active, 'add')); ?>"><a href="<?php echo e(URL_USERS_ADD); ?>"><i class="fa fa-user-plus"></i> <?php echo e(getPhrase('add')); ?></a></li> <?php endif; ?> <?php if(isModuleEligible('Users', array( 'Import' ))): ?>
                <li class="<?php echo e(isActive($sub_active, 'import')); ?>"><a href="<?php echo e(URL_IMPORT."user"); ?>"><i class="fa fa-user"></i> <?php echo e(getPhrase('import')); ?></a></li> <?php endif; ?> </ul>
        </li> <?php endif; ?> <?php if(isModuleEligible('Categories')): ?>
        <li class="<?php echo e(isActive($main_active, 'categories')); ?> treeview">
            <a href="#"> <i class="fa fa-random"></i> <span>Categories</span> <span class="pull-right-container">
		  <i class="fa fa-angle-left pull-right"></i>
		</span> </a>
            <ul class="treeview-menu">
                <li class="<?php echo e(isActive($sub_active, 'list')); ?>"><a href="<?php echo e(URL_CATEGORIES); ?>"><i class="fa fa-list"></i> <?php echo e(getPhrase('list')); ?></a></li> <?php if(isModuleEligible('Categories', array('Add'))): ?>
                <li class="<?php echo e(isActive($sub_active, 'add')); ?>"><a href="<?php echo e(URL_CATEGORIES_ADD); ?>"><i class="fa fa-plus"></i> <?php echo e(getPhrase('add')); ?></a></li> <?php endif; ?> <?php if(isModuleEligible('Categories', array('Import'))): ?>
                <li class="<?php echo e(isActive($sub_active, 'import')); ?>"><a href="<?php echo e(URL_IMPORT.'category'); ?>"><i class="fa fa-download"></i> <?php echo e(getPhrase('import')); ?></a></li> <?php endif; ?> </ul>
        </li> <?php endif; ?> <?php if(isModuleEligible('Coupons')): ?>
        <li class="<?php echo e(isActive($main_active, 'coupons')); ?> treeview">
            <a href="#"> <i class="fa fa-hashtag"></i> <span><?php echo e(getPhrase('coupons')); ?></span> <span class="pull-right-container">
		  <i class="fa fa-angle-left pull-right"></i>
		</span> </a>
            <ul class="treeview-menu">
                <li class="<?php echo e(isActive($sub_active, 'list')); ?>"><a href="<?php echo e(URL_COUPONS); ?>"><i class="fa fa-list"></i> <?php echo e(getPhrase('list')); ?></a></li> <?php if(isModuleEligible('Coupons', array('Add'))): ?>
                <li class="<?php echo e(isActive($sub_active, 'add')); ?>"><a href="<?php echo e(URL_COUPONS_ADD); ?>"><i class="fa fa-plus"></i> <?php echo e(getPhrase('add')); ?></a></li> <?php endif; ?> </ul>
        </li> <?php endif; ?> <?php if(isModuleEligible('Licences')): ?>
        <li class="<?php echo e(isActive($main_active, 'licences')); ?> treeview">
            <a href="#"> <i class="fa fa-key"></i> <span><?php echo e(getPhrase('licences')); ?></span> <span class="pull-right-container">
		  <i class="fa fa-angle-left pull-right"></i>
		</span> </a>
            <ul class="treeview-menu">
                <li class="<?php echo e(isActive($sub_active, 'list')); ?>"><a href="<?php echo e(URL_LICENCES); ?>"><i class="fa fa-list"></i> <?php echo e(getPhrase('list')); ?></a></li> <?php if(isModuleEligible('Licences', array('Add'))): ?>
                <li class="<?php echo e(isActive($sub_active, 'add')); ?>"><a href="<?php echo e(URL_LICENCES_ADD); ?>"><i class="fa fa-plus"></i> <?php echo e(getPhrase('add')); ?></a></li> <?php endif; ?> </ul>
        </li> <?php endif; ?> <?php if(isModuleEligible('Products')): ?>
        <li class="<?php echo e(isActive($main_active, 'products')); ?> treeview">
            <a href="#"> <i class="fa fa-shopping-bag" aria-hidden="true"></i> <span>Products</span> <span class="pull-right-container">
		  <i class="fa fa-angle-left pull-right"></i>
		</span> </a>
            <ul class="treeview-menu">
                <li class="<?php echo e(isActive($sub_active, 'list')); ?>"><a href="<?php echo e(URL_PRODUCTS); ?>"><i class="fa fa-list"></i> <?php echo e(getPhrase('list')); ?></a></li> <?php if(isModuleEligible('Products', array('Add'))): ?>
                <li class="<?php echo e(isActive($sub_active, 'add')); ?>"><a href="<?php echo e(URL_PRODUCTS_ADD); ?>"><i class="fa fa-plus"></i> <?php echo e(getPhrase('add')); ?></a></li> <?php endif; ?> <?php if(isModuleEligible('Products', 'Import')): ?>
                <li class="<?php echo e(isActive($sub_active, 'import')); ?>"><a href="<?php echo e(URL_IMPORT . 'product'); ?>"><i class="fa fa-download"></i> <?php echo e(getPhrase('Import')); ?></a></li> <?php endif; ?> </ul>
        </li> <?php endif; ?> 
        <?php if(isModuleEligible('Email_Templates')): ?>
        <li class="<?php echo e(isActive($main_active, 'templates')); ?> treeview">
            <a href="#"> <i class="fa fa-commenting-o" aria-hidden="true"></i><span><?php echo e(getPhrase('Templates')); ?></span> <span class="pull-right-container">
		  <i class="fa fa-angle-left pull-right"></i>
		</span> </a>
            <ul class="treeview-menu">
                <li class="<?php echo e(isActive($sub_active, 'list_email')); ?>"><a href="<?php echo e(URL_TEMPLATES_EMAIL); ?>"><i class="fa fa-list"></i> <?php echo e(getPhrase('list')); ?></a></li> <?php if(isModuleEligible('Email_Templates', array('Add'))): ?>
                <li class="<?php echo e(isActive($sub_active, 'add')); ?>"><a href="<?php echo e(URL_TEMPLATES_ADD); ?>"><i class="fa fa-plus"></i> <?php echo e(getPhrase('add')); ?></a></li> <?php endif; ?> </ul>
        </li> <?php endif; ?> <?php if(isModuleEligible('Offers')): ?>
        <li class="<?php echo e(isActive($main_active, 'offers')); ?> treeview">
            <a href="#"> <i class="fa fa-tags" aria-hidden="true"></i>
 <span><?php echo e(getPhrase('offers')); ?></span> <span class="pull-right-container">
		  <i class="fa fa-angle-left pull-right"></i>
		</span> </a>
            <ul class="treeview-menu">
                <li class="<?php echo e(isActive($sub_active, 'list')); ?>"><a href="<?php echo e(URL_OFFERS); ?>"><i class="fa fa-list"></i> <?php echo e(getPhrase('list')); ?></a></li> <?php if(isModuleEligible('Offers', array('Add'))): ?>
                <li class="<?php echo e(isActive($sub_active, 'add')); ?>"><a href="<?php echo e(URL_OFFERS_ADD); ?>"><i class="fa fa-plus"></i> <?php echo e(getPhrase('add')); ?></a></li> <?php endif; ?> </ul>
        </li> <?php endif; ?> <?php if(isModuleEligible('Pages')): ?>
        <li class="<?php echo e(isActive($main_active, 'pages')); ?> treeview">
            <a href="#"> <i class="fa fa-file-text-o" aria-hidden="true"></i> <span><?php echo e(getPhrase('pages')); ?></span> <span class="pull-right-container">
		  <i class="fa fa-angle-left pull-right"></i>
		</span> </a>
            <ul class="treeview-menu">
                <li class="<?php echo e(isActive($sub_active, 'list')); ?>"><a href="<?php echo e(URL_PAGES); ?>"><i class="fa fa-list"></i> <?php echo e(getPhrase('list')); ?></a></li> <?php if(isModuleEligible('Pages', array('Add'))): ?>
                <li class="<?php echo e(isActive($sub_active, 'add')); ?>"><a href="<?php echo e(URL_PAGES_ADD); ?>"><i class="fa fa-plus"></i> <?php echo e(getPhrase('add')); ?></a></li> <?php endif; ?> </ul>
        </li> <?php endif; ?> <?php if(isModuleEligible('Faq')): ?>
        <li class="<?php echo e(isActive($main_active, 'faq')); ?> treeview">
            <a href="#"> <i class="fa fa-question"></i> <span>FAQs</span> <span class="pull-right-container">
		  <i class="fa fa-angle-left pull-right"></i>
		</span> </a>
            <ul class="treeview-menu">
                <li class="<?php echo e(isActive($sub_active, 'list')); ?>"><a href="<?php echo e(URL_FAQ); ?>"><i class="fa fa-list"></i> <?php echo e(getPhrase('list')); ?></a></li> <?php if(isModuleEligible('Faq', array('Add'))): ?>
                <li class="<?php echo e(isActive($sub_active, 'add')); ?>"><a href="<?php echo e(URL_FAQ_ADD); ?>"><i class="fa fa-plus"></i> <?php echo e(getPhrase('add')); ?></a></li> <?php endif; ?> </ul>
        </li> <?php endif; ?> <?php if(isModuleEligible('Payments_Report')): ?>
        <li class="<?php echo e(isActive($main_active, 'reports')); ?> treeview">
            <a href="#"> <i class="fa fa-file-o" aria-hidden="true"></i> <span><?php echo e(getPhrase('payment_reports')); ?></span> <span class="pull-right-container">
		  <i class="fa fa-angle-left pull-right"></i>
		</span> </a>
            <ul class="treeview-menu">
                <li class="<?php echo e(isActive($sub_active, 'online_reports')); ?>"><a href="<?php echo e(URL_ONLINE_PAYMENT_REPORTS); ?>"><i class="fa fa-file"></i> <?php echo e(getPhrase('online_reports')); ?></a></li>
                <li class="<?php echo e(isActive($sub_active, 'offline_reports')); ?>">
                    <a href="<?php echo e(URL_OFFLINE_PAYMENT_REPORTS); ?>"> <i class="fa fa-files-o" aria-hidden="true"></i> <?php echo e(getPhrase('offline_reports')); ?> </a>
                </li> <?php if(isModuleEligible('Payments_Report', array('Export'))): ?>
                <li class="<?php echo e(isActive($sub_active, 'export')); ?>">
                    <a href="<?php echo e(URL_PAYMENT_REPORT_EXPORT); ?>"> <i class="fa fa-file-text-o" aria-hidden="true"></i> <?php echo e(getPhrase('export')); ?> </a>
                </li>
                <li class="<?php echo e(isActive($sub_active, 'free_bies')); ?>">
                    <a href="<?php echo e(URL_FREEBIES_REPORTS); ?>"> 

                                    <i class="fa fa-list-alt" aria-hidden="true"></i>
                                <?php echo e(getPhrase('free_bies')); ?> </a>
                </li> <?php endif; ?> </ul>
        </li> <?php endif; ?> <?php if(isModuleEligible('Menus')): ?>
        <li class="<?php echo e(isActive($main_active, 'menu')); ?> treeview">
            <a href="#"> <i class="fa fa-bars" aria-hidden="true"></i> <span><?php echo e(getPhrase('Menus')); ?></span> <span class="pull-right-container">
		  <i class="fa fa-angle-left pull-right"></i>
		</span> </a>
            <ul class="treeview-menu">
                <li class="<?php echo e(isActive($sub_active, 'list')); ?>"><a href="<?php echo e(URL_MENU); ?>"><i class="fa fa-list"></i> <?php echo e(getPhrase('list')); ?></a></li> <?php if(isModuleEligible('Menus', array('Add'))): ?>
                <li class="<?php echo e(isActive($sub_active, 'add')); ?>"><a href="<?php echo e(URL_MENU_ADD); ?>"><i class="fa fa-plus"></i> <?php echo e(getPhrase('add')); ?></a></li> <?php endif; ?> </ul>
        </li> <?php endif; ?> <?php if(isModuleEligible('Settings') || isModuleEligible('Languages')): ?>
        <li class="<?php echo e(isActive($main_active, 'settings')); ?> treeview">
            <a href="#"> <i class="fa fa-cog" aria-hidden="true"></i> <span><?php echo e(getPhrase('settings')); ?></span> <span class="pull-right-container">
		  <i class="fa fa-angle-left pull-right"></i>
		</span> </a>
            <ul class="treeview-menu"> <?php if(isModuleEligible('Settings')): ?>
                <li class="<?php echo e(isActive($sub_active, 'list')); ?>"><a href="<?php echo e(URL_MASTERSETTINGS_SETTINGS); ?>"><i class="fa fa-list"></i> <?php echo e(getPhrase('list')); ?></a></li> <?php endif; ?> <?php if(isModuleEligible('Languages')): ?>
                <li class="<?php echo e(isActive($sub_active, 'languages')); ?>">
                    <a href="<?php echo e(URL_LANGUAGES_LIST); ?>"> <i class="fa fa-language" aria-hidden="true"></i> <?php echo e(getPhrase('languages')); ?> </a>
                </li> <?php endif; ?> </ul>
        </li> <?php endif; ?> </ul>
</section>