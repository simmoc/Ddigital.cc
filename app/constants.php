<?php
// $base = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
// $base .= '://'.$_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
//  // $base = '';

// define('BASE_PATH', $base);
// define('PREFIX', $base);

 $base1 = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
 $base1 .= '://'.$_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);
 // $base1 = '/';
 // $base = '/';
  $base = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on' ? 'https' : 'http';
 $base .= '://'.$_SERVER['HTTP_HOST'] . str_replace(basename($_SERVER['SCRIPT_NAME']),"",$_SERVER['SCRIPT_NAME']);

define('PREFIX1', $base1.'public/');
define('BASE_PATH', $base.'/');
define('PREFIX', $base);



define('ASSETS',PREFIX1.'assets/');
define('CSS',ASSETS.'css/');
define('JS',ASSETS.'js/');
define('IMAGES',ASSETS.'images/');

define('AJAXLOADER', IMAGES.'ajax-loader.svg');
define('AJAXLOADER_FADEIN_TIME', 100);
define('AJAXLOADER_FADEOUT_TIME', 100);



// Import
define('URL_IMPORT', PREFIX.'import/index/');
define('URL_IMPORT_READEXCEL', PREFIX.'import/read-excel/');
// Front Images
define('IMAGES_FRONT',PREFIX1.'images/');

define('SITE_CSS',PREFIX1.'css/');
define('SITE_JS',PREFIX1.'js/');

define('UPLOADS', PREFIX1.'uploads/');
define('UPLOAD_PATH_USERS', 'public/uploads/users/');
define('UPLOAD_PATH_USERS_THUMBNAIL', 'public/uploads/users/thumbnail/');

define('UPLOAD_PATH_OFFERS', "uploads/offers/");
define('UPLOAD_PATH_OFFERS_THUMBNAIL', 'uploads/offers/thumbnail/');
define('UPLOAD_URL_OFFERS',UPLOADS. 'offers/');
define('UPLOAD_URL_OFFERS_THUMBNAIL',UPLOADS. 'offers/thumbnail/');


define('UPLOAD_PATH_CATEGORIES', "uploads/categories/");
define('UPLOAD_PATH_CATEGORIES_THUMBNAIL', 'uploads/categories/thumbnail/');

// Defaults
define('DEFAULT_USERS_IMAGE_THUMBNAIL', UPLOADS.'users/thumbnail/default.png');
define('DEFAULT_USERS_IMAGE', UPLOADS.'users/default.png');
define('IMAGE_PATH_CATEGORIES_THUMB', UPLOADS.'categories/thumbnail/default.png');
define('DEFAULT_PRODUCT_IMAGE', IMAGES_FRONT.'kingma.png');
define('DEFAULT_PRODUCT_IMAGE_THUMBNAIL', IMAGES_FRONT.'1.png');
define('DEFAULT_SITELOGO_IMAGE', IMAGES_FRONT.'logo.png');

// Default Templates
define('UPLOADS_EXCEL_TEMPLATES_CATEGORIES_TEMPLATE', UPLOADS.'excel-templates/categories_template.xlsx');
define('UPLOADS_EXCEL_TEMPLATES_PRODUCTS_TEMPLATE', UPLOADS.'excel-templates/products_template.xlsx');
define('UPLOADS_EXCEL_TEMPLATES_USERS_TEMPLATE', UPLOADS.'excel-templates/users_template.xlsx');

define('IMAGE_PATH_USERS', UPLOADS.'users/');
define('IMAGE_PATH_USERS_THUMBNAIL', UPLOADS.'users/thumbnail/');

define('IMAGE_PATH_SITE_LOGO', UPLOADS.'settings/');
define('IMAGE_PATH_SITE_FAVCASION', UPLOADS.'settings/');


define('IMAGE_URL_CATEGORIES', UPLOADS.'categories/');
define('IMAGE_URL_CATEGORIES_THUMBNAIL', UPLOADS.'categories/thumbnail/');

define('UPLOAD_PATH_PRODUCTS', 'public/uploads/products/');
define('UPLOAD_PATH_PRODUCTS_THUMBNAIL', 'public/uploads/products/thumbnail/');
define('UPLOAD_PATH_PRODUCTS_DOWNLOADS', 'public/uploads/products/downloads/');
define('UPLOAD_URL_PRODUCTS', UPLOADS . 'products/');
define('UPLOAD_URL_PRODUCTS_THUMBNAIL', UPLOADS . 'products/thumbnail/');
define('UPLOAD_URL_PRODUCTS_DOWNLOADS', UPLOADS . 'products/downloads/');

define('URL_INSTALL_SYSTEM', PREFIX.'install');
define('URL_UPDATE_INSTALLATATION_DETAILS', PREFIX.'update-details');
define('URL_FIRST_USER_REGISTER', PREFIX.'install/register');

define('DOWNLOAD_EMPTY_DATA_DATABASE', '/uploads/downloads/install.sql');
define('DOWNLOAD_SAMPLE_DATA_DATABASE', '/uploads/downloads/install_dummy_data.sql');



//URL CONTSTANTS STARTS HERE

define('SITE_TITLE',PREFIX.'Tours');
define('URL_LOGOUT',PREFIX.'logout');
define('URL_DASHBOARD',PREFIX.'home');
define('URL_FAQ_PAGE',PREFIX.'faq');
define('RECORDS_PER_PAGE', '8');


define('URL_USERS', PREFIX.'users/');
define('URL_USERS_ADD', PREFIX.'user/add');
define('URL_USERS_EDIT', PREFIX.'user/edit/');
define('URL_USERS_DELETE', PREFIX.'user/delete/');
define('URL_USERS_DATATABLE', PREFIX.'users/list/getList/');
define('URL_ADMIN_USERS_DASHBOARD', PREFIX.'users/list/dashboard');
define('URL_USERS_VENDOR_DETAILS', PREFIX.'users/vendors/details/');
define('URL_VENDOR_UPLOAD_PRODUCTS', PREFIX.'users/vendors/upload/products/');
define('URL_VENDOR_UPLOAD_PRODUCTS_LIST', PREFIX.'users/vendors/upload/products/list/');
define('URL_USERS_CUSTOMER_DETAILS', PREFIX.'users/customers/details/');
define('URL_CUSTOMER_PURCHASES_LIST', PREFIX.'users/customers/purchases/');
define('URL_CUSTOMERS_PURCHASES_PRODUCTS_LIST', PREFIX.'users/customers/purchases/list/');
define('URL_CUSTOMER_DOWLOADED_PRODUCTS', PREFIX.'users/customers/dowloaded/products/');
define('URL_CUSTOMERS_DOWNLOADED_PRODUCTS_LIST', PREFIX.'users/customers/dowloaded/products/list/');
// Categories
define('URL_CATEGORIES_DASHBOARD', PREFIX.'categories/dashboard');
define('URL_CATEGORIES', PREFIX.'categories/index');
define('URL_CATEGORIES_LIST', PREFIX.'categories/get-list');
define('URL_CATEGORIES_ADD', PREFIX.'categories/add');
define('URL_CATEGORIES_EDIT', PREFIX.'categories/edit/');
define('URL_CATEGORIES_DELETE', PREFIX.'categories/delete/');
define('URL_CATEGORIES_VIEW', PREFIX.'categories/view/');

// Templates (Email and SMS templates)
define('URL_TEMPLATES', PREFIX.'templates/index');
define('URL_TEMPLATES_EMAIL', PREFIX.'templates/index/email');
define('URL_TEMPLATES_SMS', PREFIX.'templates/index/sms');
define('URL_TEMPLATES_LIST', PREFIX.'templates/get-list');
define('URL_TEMPLATES_ADD', PREFIX.'templates/add');
define('URL_TEMPLATES_EDIT', PREFIX.'templates/edit/');
define('URL_TEMPLATES_DELETE', PREFIX.'templates/delete/');
define('URL_TEMPLATES_VIEW', PREFIX.'templates/view/');

// Pages
define('URL_PAGES_DASHBOARD', PREFIX.'pages/dashboard');
define('URL_PAGES', PREFIX.'pages/index');
define('URL_PAGES_LIST', PREFIX.'pages/get-list');
define('URL_PAGES_ADD', PREFIX.'pages/add');
define('URL_PAGES_EDIT', PREFIX.'pages/edit/');
define('URL_PAGES_DELETE', PREFIX.'pages/delete/');
define('URL_PAGES_VIEW', PREFIX.'pages/view/');

// MASTER SETTINGS MODULE
define('URL_SETTINGS_DASHBOARD', PREFIX.'settings/dashboard');
define('URL_MASTERSETTINGS_SETTINGS', PREFIX.'mastersettings/settings');
define('URL_SETTINGS_VIEW', PREFIX.'mastersettings/settings/view/');
define('URL_SETTINGS_ADD', PREFIX.'mastersettings/settings/add');
define('URL_SETTINGS_CERTIFICATES', PREFIX.'mastersettings/settings/certificates');
define('URL_SETTINGS_TIMETABLE', PREFIX.'mastersettings/settings/timetable');
define('URL_SETTINGS_EDIT', PREFIX.'mastersettings/settings/edit/');
define('URL_SETTINGS_DELETE', PREFIX.'mastersettings/settings/delete/');
define('URL_SETTINGS_GETLIST', PREFIX.'mastersettings/settings/getList/');

define('URL_SETTINGS_ADD_SUBSETTINGS', PREFIX.'mastersettings/settings/add-sub-settings/');
define('URL_SETTINGS_LIST', PREFIX.'mastersettings/settings');
define('IMAGE_PATH_SETTINGS', UPLOADS.'settings/');

// Coupons
define('URL_COUPONS_DASHBOARD', PREFIX.'coupons/dashboard');
define('URL_COUPONS', PREFIX.'coupons/index');
define('URL_COUPONS_LIST', PREFIX.'coupons/get-list');
define('URL_COUPONS_ADD', PREFIX.'coupons/add');
define('URL_COUPONS_EDIT', PREFIX.'coupons/edit/');
define('URL_COUPONS_DELETE', PREFIX.'coupons/delete/');
define('URL_COUPONS_VIEW', PREFIX.'coupons/view/');

// Licences
define('URL_LICENCES_DASHBOARD', PREFIX.'licence/dashboard');
define('URL_LICENCES', PREFIX.'licence/index');
define('URL_LICENCES_LIST', PREFIX.'licence/get-list');
define('URL_LICENCES_ADD', PREFIX.'licence/add');
define('URL_LICENCES_EDIT', PREFIX.'licence/edit/');
define('URL_LICENCES_DELETE', PREFIX.'licence/delete/');
define('URL_LICENCES_VIEW', PREFIX.'licence/view/');

// Products
define('URL_PRODUCTS_DASHBOARD', PREFIX.'products/dashboard');
define('URL_PRODUCTS', PREFIX.'products/index');
define('URL_PRODUCTS_LIST', PREFIX.'products/get-list');
define('URL_PRODUCTS_ADD', PREFIX.'products/add');
define('URL_PRODUCTS_EDIT', PREFIX.'products/edit/');
define('URL_PRODUCTS_DELETE', PREFIX.'products/delete/');
define('URL_PRODUCTS_VIEW', PREFIX.'products/view/');
define('URL_PRODUCTS_REMOTE_DATA', PREFIX.'products/get-Remote');
define('URL_PRODUCT_DETAILS', PREFIX.'products/details/view/');
define('URL_PRODUCT_CATEGORIES', PREFIX.'products/categories/view/');
define('URL_PRODUCTS_SALES', PREFIX.'products/sales/view/');
define('URL_PRODUCT_AMOUNT', PREFIX.'products/amount/view/');
define('URL_PRODUCT_SALES_DETAILS_LIST', PREFIX.'products/sales/details/list/');
define('URL_VENDOR_PRODUCTS_PURCHASES', PREFIX.'products/vendor/purchases/');
define('URL_VENDOR_PURCHASES_LIST', PREFIX.'products/vendor/purchases/list/');
define('URL_VENDOR_UPLOAD_PRODUCT_SALES', PREFIX.'products/vendor/uploads/sales/');
define('URL_VENDOR_UPLOAD_PRODUCTS_SALES_LIST', PREFIX.'products/vendor/uploads/sales/list/');
define('URL_PRODUCT_ADMIN_APPROVE', PREFIX.'products/approve');
define('URL_DELETE_PRODUCT_FILE', PREFIX.'products/delete/file');




define('OWNER_ROLE_ID', 1);
define('ADMIN_ROLE_ID', 2);
define('EXECUTIVE_ROLE_ID', 3);
define('VENDOR_ROLE_ID', 4);
define('USER_ROLE_ID', 5);

define('PRODUCTS_DISPLAY_SIZE', 9);

//LANGUAGES MODULE
define('URL_LANGUAGES_LIST', PREFIX.'languages/list');
define('URL_LANGUAGES_ADD', PREFIX.'languages/add');
define('URL_LANGUAGES_EDIT', PREFIX.'languages/edit');
define('URL_LANGUAGES_UPDATE_STRINGS', PREFIX.'languages/update-strings/');
define('URL_LANGUAGES_DELETE', PREFIX.'languages/delete/');
define('URL_LANGUAGES_GETLIST', PREFIX.'languages/getList/');
define('URL_LANGUAGES_MAKE_DEFAULT', PREFIX.'languages/make-default/');

define('URL_DISPLAY_PRODUCTS', PREFIX.'category');
define('URL_DISPLAY_PRODUCTS_LIST', PREFIX.'products-get/list');
define('URL_DISPLAY_PRODUCTS_DETAILS', PREFIX.'item/');
define('URL_DISPLAY_PRODUCTS_CART', PREFIX.'cart');
define('URL_FREEDOWNLOAD_PRODUCT_FORM', PREFIX.'product/free-bies');


define('URL_PAYNOW', PREFIX.'cart/paynow');
define('URL_PAYPAL_PAYMENT_SUCCESS', PREFIX.'cart/paypal/status-success');
define('URL_PAYPAL_PAYMENT_CANCEL', PREFIX.'cart/paypal/status-cancel');
define('URL_PAYU_PAYMENT_SUCCESS', PREFIX.'cart/payu/status-success');
define('URL_PAYU_PAYMENT_CANCEL', PREFIX.'cart/payu/status-cancel');

define('URL_UPDATE_OFFLINE_PAYMENT', PREFIX.'cart/offline-payment/update');

define('URL_CART', PREFIX.'cart');
define('URL_CHECKOUT', PREFIX.'cart/checkout');
define('URL_CART_PURCHASECONFIRM', PREFIX.'cart/purchase-confirm');
define('URL_CART_PAYMENTSUCCESS', PREFIX.'mycart/payment-success');

define('PAYMENT_STATUS_PENDING', 'pending');
define('PAYMENT_STATUS_SUCCESS', 'success');

define('URL_USERS_LOGIN', PREFIX.'login');
define('URL_USERS_REGISTER', PREFIX.'register-me');
define('URL_USERS_LOGOUT', PREFIX.'logout');
define('URL_USERS_CONFIRM', PREFIX.'confirm');
define('URL_USERS_FORGOTPASSWORD', PREFIX.'forgot-password');
define('URL_USERS_RESETPASSWORD', PREFIX.'reset-password');
define('URL_USERS_RESETPASSWORD_EMAIL', PREFIX.'reset-password-email');
define('URL_USERS_MYRESETPASSWORD', PREFIX.'reset-my-password');

define('URL_USERS_DASHBOARD', PREFIX.'user/my-dashboard');

define('URL_CART_DOWNLOAD', PREFIX.'download/');

define('URL_VENDOR_DASHBOARD', PREFIX.'vendor/my-dashboard');
define('URL_DISPLAYPRODUCTS_VENDORDETAILS', PREFIX.'vendor-details/');

// Messaging System
define('URL_MESSAGES', PREFIX.'messages');
define('URL_MESSAGES_SHOW', PREFIX.'messages/');
define('URL_MESSAGES_CREATE', PREFIX.'messages/create');

define('URL_CART_APPLYCOUPON', PREFIX.'coupon/apply');
define('URL_CART_REMOVECOUPON', PREFIX.'coupon/remove');
define('URL_INDEX_SEARCHPRODUCT', PREFIX.'home/search-product');

// Offers
define('URL_OFFERS', PREFIX.'offers/index');
define('URL_OFFERS_LIST', PREFIX.'offers/get-list');
define('URL_OFFERS_ADD', PREFIX.'offers/add');
define('URL_OFFERS_EDIT', PREFIX.'offers/edit/');
define('URL_OFFERS_DELETE', PREFIX.'offers/delete/');
define('URL_OFFERS_VIEW', PREFIX.'offers/view/');
define('URL_OFFERS_VIEW_ALL', PREFIX.'offers/view/all');
define('URL_VIEW_MORE_PRODUCTS', PREFIX.'view-more');

//Payment Reports
define('URL_ONLINE_PAYMENT_REPORTS', PREFIX.'payments-report/online');
define('URL_ONLINE_PAYMENT_REPORT_DETAILS', PREFIX.'payments-report/online/');
define('URL_ONLINE_PAYMENT_REPORT_DETAILS_AJAX', PREFIX.'payments-report/online/getList/');
define('URL_GET_PAYMENT_PRODUCT_DETAILS', PREFIX.'payment/product-details');
define('URL_FREEBIES_REPORTS', PREFIX.'free-bies/reports');
define('URL_FREEBIES_REPORT_LIST', PREFIX.'free-bies/reports/getList');



define('URL_GET_PAYMENT_RECORD', PREFIX.'payments-report/getRecord');
define('URL_TOTAL_SALES', PREFIX.'total/sales');
define('URL_TOTAL_SALES_GETLIST', PREFIX.'total/sales/getlist');

define('URL_PAYMENTS_DASHBOARD', PREFIX.'payments/dashborad');
define('URL_OFFLINE_PAYMENT_REPORTS', PREFIX.'payments-report/offline');
define('URL_OFFLINE_PAYMENT_REPORT_DETAILS', PREFIX.'payments-report/offline/');
define('URL_OFFLINE_PAYMENT_REPORT_DETAILS_AJAX', PREFIX.'payments-report/offline/getList/');
define('URL_PAYMENT_APPROVE_OFFLINE_PAYMENT', PREFIX.'payments/approve-reject-offline-request');

define('URL_PAYMENT_REPORT_EXPORT', PREFIX.'payments-report/export');
define('URL_PAYPAL_CANCEL_RETURN', PREFIX.'paypal/cancel');



define('PAYMENT_STATUS_CANCELLED', 'cancelled');

define('PAYMENT_STATUS_ABORTED', 'aborted');
define('PAYMENT_RECORD_MAXTIME', '30');

define('URL_INDEX_SUBSCRIBE', PREFIX.'home/subscribe');

// Menu
define('URL_MENU', PREFIX.'menu/index');
define('URL_MENU_LIST', PREFIX.'menu/get-list');
define('URL_MENU_ADD', PREFIX.'menu/add');
define('URL_MENU_EDIT', PREFIX.'menu/edit/');
define('URL_MENU_DELETE', PREFIX.'menu/delete/');
define('URL_MENU_VIEW', PREFIX.'menu/view/');

// Menu Items
define('URL_MENU_ITEMS', PREFIX.'menu-items/index/');
define('URL_MENU_ITEMS_LIST', PREFIX.'menu-items/get-list');
define('URL_MENU_ITEMS_ADD', PREFIX.'menu-items/add');
define('URL_MENU_ITEMS_EDIT', PREFIX.'menu-items/edit/');
define('URL_MENU_ITEMS_DELETE', PREFIX.'menu-items/delete/');
define('URL_MENU_ITEMS_VIEW', PREFIX.'menu-items/view/');

//Contact Us
define('URL_CONTACTUS_FORM', PREFIX.'menu/contactus');
define('URL_PRODUCT_OWNER_CONTACTUS_FORM', PREFIX.'menu/contactus/productowner');

// View Page
define('URL_VIEW_PAGE', PREFIX.'page/');

// FAQ
define('URL_FAQ_DASHBOARD', PREFIX.'faq/dashboard');
define('URL_FAQ', PREFIX.'faq/index');
define('URL_FAQ_LIST', PREFIX.'faq/get-list');
define('URL_FAQ_ADD', PREFIX.'faq/add');
define('URL_FAQ_EDIT', PREFIX.'faq/edit/');
define('URL_FAQ_DELETE', PREFIX.'faq/delete/');
define('URL_FAQ_VIEW', PREFIX.'faq/view/');

// MODULE HELPERS
define('URL_MODULEHELPERS_LIST', PREFIX.'mastersettings/module-helpers');
define('URL_MODULEHELPERS_VIEW', PREFIX.'mastersettings/module-helpers/view/');
define('URL_MODULEHELPERS_ADD', PREFIX.'mastersettings/module-helpers/add');
define('URL_MODULEHELPERS_EDIT', PREFIX.'mastersettings/module-helpers/edit/');
define('URL_MODULEHELPERS_DELETE', PREFIX.'mastersettings/module-helpers/delete/');
define('URL_MODULEHELPERS_GETLIST', PREFIX.'mastersettings/module-helpers/getList/');
define('URL_MODULEHELPERS_ADD_STEPS', PREFIX.'mastersettings/module-helpers/add-steps/');

define('URL_GET_THE_PRODUCTS', PREFIX.'get-products');
