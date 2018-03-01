<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
});
*/

Route::get('/', 'IndexController@index');


if(env('DB_DATABASE')=='')
{

   Route::get('/', 'InstallatationController@index');
   Route::get('/install', 'InstallatationController@index');
   Route::post('/update-details', 'InstallatationController@updateDetails');
   Route::post('/install', 'InstallatationController@installProject');
}

Route::post('install/register', 'InstallatationController@registerUser');


//Users

Auth::routes();
Route::post('/login', 'Auth\LoginController@performLogin');
Route::get('confirm/{confirmation_code}', 'Auth\LoginController@confirm');
Route::get('register-me/{role?}', 'Auth\RegisterController@getRegister');
Route::post('register-me/{role?}', 'Auth\RegisterController@register');
Route::get('forgot-password', 'Auth\LoginController@forgotpassword');
Route::get('reset-password/{token}', 'Auth\LoginController@resetpassword');
Route::post('reset-password-email', 'Auth\LoginController@forgotpasswordEmail');

Route::post('reset-my-password', 'Auth\LoginController@resetmypassword');

Route::get('/home', 'HomeController@index');
Route::post('/home', 'HomeController@index');
Route::get('faq', 'IndexController@faqs');

Route::get('users/{role_name}', 'UsersController@index');
Route::get('users/list/getList/{role_name?}', [ 'as'   => 'users.dataTable',
    'uses' => 'UsersController@getDatatable']);
Route::get('users/list/getList/{role_name?}', 'UsersController@getDatatable');
Route::get('user/add', 'UsersController@create');
Route::post('user/add', 'UsersController@store');
Route::get('user/edit/{slug}', 'UsersController@edit');
Route::patch('user/edit/{slug}', 'UsersController@update');
Route::delete('user/delete/{slug}', 'UsersController@delete');
Route::get('users/list/dashboard', 'UsersController@adminDashBoard');
Route::get('users/vendors/details/{slug}', 'UsersController@vendorDetails');
Route::get('users/vendors/upload/products/{userslug}', 'UsersController@vendorUploadProducts');
Route::get('users/vendors/upload/products/list/{userslug}', 'UsersController@vendorUploadProductsList');
Route::get('products/vendor/purchases/{userid}', 'UsersController@vendorPurchases');
Route::get('products/vendor/purchases/list/{userslug}', 'UsersController@vendorPurchasesLists');
Route::get('products/vendor/uploads/sales/{userslug}', 'UsersController@vendorProductsSales');
Route::get('products/vendor/uploads/sales/list/{userslug}', 'UsersController@vendorProductsSalesList');
Route::get('users/customers/details/{userslug}', 'UsersController@customersProfile');
Route::get('users/customers/purchases/{userslug}', 'UsersController@customersPurchases');
Route::get('users/customers/purchases/list/{userslug}', 'UsersController@customersPurchasesList');
Route::get('users/customers/dowloaded/products/{userslug}', 'UsersController@customersDownloads');
Route::get('users/customers/dowloaded/products/list/{userslug}', 'UsersController@customersDownloadsList');


//Categories
Route::get('categories/dashboard', 'CategoriesController@categoriesDashborad');
Route::get('categories/index', 'CategoriesController@index');
Route::get('categories/index/{slug}', 'CategoriesController@index');
Route::get('categories/add', 'CategoriesController@create');
Route::post('categories/add', 'CategoriesController@store');
Route::get('categories/edit/{slug}', 'CategoriesController@edit');
Route::patch('categories/edit/{slug}', 'CategoriesController@update');
Route::get('categories/view/{slug}', 'CategoriesController@show');
Route::get('categories/get-list', 'CategoriesController@getDatatable');
Route::get('categories/get-list/{slug}', 'CategoriesController@getDatatable');
Route::delete('categories/delete/{slug}', 'CategoriesController@delete');

// Templates (Email templates and SMS templates)
Route::get('templates/index', 'TemplatesController@index');
Route::get('templates/index/{slug}', 'TemplatesController@index');
Route::get('templates/add', 'TemplatesController@create');
Route::post('templates/add', 'TemplatesController@store');
Route::get('templates/edit/{slug}', 'TemplatesController@edit');
Route::patch('templates/edit/{slug}', 'TemplatesController@update');
Route::get('templates/view/{slug}', 'TemplatesController@show');
Route::get('templates/get-list', 'TemplatesController@getDatatable');
Route::get('templates/get-list/{slug}', 'TemplatesController@getDatatable');
Route::delete('templates/delete/{slug}', 'TemplatesController@delete');

// Pages
Route::get('pages/dashboard', 'PagesController@pagesDashboard');
Route::get('pages/index', 'PagesController@index');
Route::get('pages/add', 'PagesController@create');
Route::post('pages/add', 'PagesController@store');
Route::get('pages/edit/{slug}', 'PagesController@edit');
Route::patch('pages/edit/{slug}', 'PagesController@update');
Route::get('pages/view/{slug}', 'PagesController@show');
Route::get('pages/get-list', 'PagesController@getDatatable');
Route::delete('pages/delete/{slug}', 'PagesController@delete');

//Settings ---dashboard
Route::get('settings/dashboard', 'SettingsController@settingsDashboard');
Route::get('mastersettings/settings', 'SettingsController@index');
Route::get('mastersettings/settings/index', 'SettingsController@index');
Route::get('mastersettings/settings/certificates', 'SettingsController@certificatesdashboard');
Route::get('mastersettings/settings/timetable', 'SettingsController@timetabledashboard');
Route::get('mastersettings/settings/add', 'SettingsController@create');
Route::post('mastersettings/settings/add', 'SettingsController@store');
Route::get('mastersettings/settings/edit/{slug}', 'SettingsController@edit');
Route::patch('mastersettings/settings/edit/{slug}', 'SettingsController@update');
Route::get('mastersettings/settings/view/{slug}', 'SettingsController@viewSettings');
Route::get('mastersettings/settings/add-sub-settings/{slug}', 'SettingsController@addSubSettings');
Route::post('mastersettings/settings/add-sub-settings/{slug}', 'SettingsController@storeSubSettings');
Route::patch('mastersettings/settings/add-sub-settings/{slug}', 'SettingsController@updateSubSettings');
 
Route::get('mastersettings/settings/getList', [ 'as'   => 'mastersettings.dataTable',
     'uses' => 'SettingsController@getDatatable']);
	 
// Products
Route::get('products/dashboard', 'ProductsController@productsDashboard');
Route::get('products/index', 'ProductsController@index');
Route::get('products/add', 'ProductsController@create');
Route::post('products/add', 'ProductsController@store');
Route::get('products/edit/{slug}', 'ProductsController@edit');
Route::patch('products/edit/{slug}', 'ProductsController@update');
Route::get('products/view/{slug}', 'ProductsController@show');
Route::get('products/get-list', 'ProductsController@getDatatable');
Route::delete('products/delete/{slug}', 'ProductsController@delete');
Route::get('products/get-Remote', 'ProductsController@getRemote');
Route::get('products/details/view/{productid}', 'ProductsController@detailsViewDashboard');
Route::get('products/categories/view/{productid}', 'ProductsController@detailsCategories');
Route::get('products/sales/view/{productid}/', 'ProductsController@detailsSales');
Route::get('products/amount/view/{productid}', 'ProductsController@detailsAmount');
Route::get('products/sales/details/list/{productid}', 'ProductsController@getSalesDetailsList');
Route::post('products/approve', 'ProductsController@approveProductByAdmin');
Route::post('products/delete/file', 'ProductsController@deleteProductFile');



// Coupons
Route::get('coupons/dashboard', 'CouponsController@couponsDashboard');
Route::get('coupons/index', 'CouponsController@index');
Route::get('coupons/add', 'CouponsController@create');
Route::post('coupons/add', 'CouponsController@store');
Route::get('coupons/edit/{slug}', 'CouponsController@edit');
Route::patch('coupons/edit/{slug}', 'CouponsController@update');
Route::get('coupons/view/{slug}', 'CouponsController@show');
Route::get('coupons/get-list', 'CouponsController@getDatatable');
Route::delete('coupons/delete/{slug}', 'CouponsController@delete');

// Import
Route::get('import/index/{model}', 'ImportController@index');
Route::post('import/read-excel/{model}','ImportController@readExcel');

Route::get('languages/list', 'NativeController@index');
Route::get('languages/getList', [ 'as'   => 'languages.dataTable',
     'uses' => 'NativeController@getDatatable']);

// Language
Route::get('languages/add', 'NativeController@create');
Route::post('languages/add', 'NativeController@store');
Route::get('languages/edit/{slug}', 'NativeController@edit');
Route::patch('languages/edit/{slug}', 'NativeController@update');
Route::delete('languages/delete/{slug}', 'NativeController@delete');
 
Route::get('languages/make-default/{slug}', 'NativeController@changeDefaultLanguage');
Route::get('languages/update-strings/{slug}', 'NativeController@updateLanguageStrings');
Route::patch('languages/update-strings/{slug}', 'NativeController@saveLanguageStrings');

// Products
Route::get('category/{category?}/{sub_category?}', 'DisplayProductsController@index');
Route::get('products-get/list', 'DisplayProductsController@getDatatable');
Route::get('item/{slug}/{id?}', 'DisplayProductsController@showDetails');
Route::get('vendor-details/{slug}', 'DisplayProductsController@showVendor');
Route::get('offers/view/all', 'DisplayProductsController@viewAllOffers');
Route::get('view-more', 'DisplayProductsController@viewMoreProducts');
Route::resource('cart', 'CartController');
Route::get('paypal/cancel', 'CartController@index');

Route::post('cart/paynow', 'CartController@paynow');
Route::post('cart/paypal/status-success','CartController@paypal_success');
Route::get('cart/paypal/status-cancel', 'CartController@paypal_cancel');


Route::post('cart/payu/status-success','CartController@payu_success');
Route::post('cart/payu/status-cancel', 'CartController@payu_cancel');
Route::post('cart/offline-payment/update', 'CartController@updateOfflinePayment');
Route::get('cart/checkout', 'CartController@checkout');
Route::get('cart/purchase-confirm', 'CartController@purchaseConfirm');
Route::get('cart/offline-payment/update', 'CartController@updateOfflinePayment');
Route::get('mycart/payment-success', 'CartController@paymentsuccess');

Route::get('user/my-dashboard/{tab?}', 'CustomerController@index');
Route::post('user/my-dashboard/{tab?}', 'CustomerController@update');
Route::get('download/{payment}/{price?}', 'CartController@download');

Route::get('vendor/my-dashboard/{tab?}', 'VendorController@index');
Route::post('vendor/my-dashboard/{tab?}', 'VendorController@update');

//Licences
Route::get('licence/dashboard', 'LicenceController@dashborad');
Route::get('licence/index', 'LicenceController@index');
Route::get('licence/index/{slug}', 'LicenceController@index');
Route::get('licence/add', 'LicenceController@create');
Route::post('licence/add', 'LicenceController@store');
Route::get('licence/edit/{slug}', 'LicenceController@edit');
Route::patch('licence/edit/{slug}', 'LicenceController@update');
Route::get('licence/view/{slug}', 'LicenceController@show');
Route::get('licence/get-list', 'LicenceController@getDatatable');
Route::get('licence/get-list/{slug}', 'LicenceController@getDatatable');
Route::delete('licence/delete/{slug}', 'LicenceController@delete');

                        /////////////////////
                        // MESSAGES MODULE //
                        /////////////////////


Route::group(['prefix' => 'messages'], function () {
    Route::get('/', ['as' => 'messages', 'uses' => 'MessagesController@index']);
    Route::get('create', ['as' => 'messages.create', 'uses' => 'MessagesController@create']);
    Route::post('/', ['as' => 'messages.store', 'uses' => 'MessagesController@store']);
    Route::get('{id}', ['as' => 'messages.show', 'uses' => 'MessagesController@show']);
    Route::put('{id}', ['as' => 'messages.update', 'uses' => 'MessagesController@update']);
});

Route::post('coupon/apply', 'CartController@applycoupon');
Route::get('coupon/remove', 'CartController@removecoupon');
Route::post('home/search-product', 'IndexController@searchProduct');

// Offers
Route::get('offers/index', 'OffersController@index');
Route::get('offers/add', 'OffersController@create');
Route::post('offers/add', 'OffersController@store');
Route::get('offers/edit/{slug}', 'OffersController@edit');
Route::patch('offers/edit/{slug}', 'OffersController@update');
Route::get('offers/view/{slug}', 'OffersController@show');
Route::get('offers/get-list', 'OffersController@getDatatable');
Route::delete('offers/delete/{slug}', 'OffersController@delete');

// Payment Reports
Route::get('payments/dashborad', 'PaymentsController@paymentsDashboard');
Route::get('payments-report/online/', 'PaymentsController@onlinePaymentsReport');
Route::get('payments-report/online/{slug}', 'PaymentsController@listOnlinePaymentsReport');
Route::get('payments-report/online/getList/{slug}', 'PaymentsController@getOnlinePaymentReportsDatatable');
Route::get('free-bies/reports', 'PaymentsController@freeBiesReport');
Route::get('free-bies/reports/getList', 'PaymentsController@freeBiesReportList');

Route::post('payments-report/getRecord', 'PaymentsController@getPaymentRecord');
Route::post('payment/product-details', 'PaymentsController@getPaymentProductDetalis');

Route::get('payments-report/offline/', 'PaymentsController@offlinePaymentsReport');
Route::get('payments-report/offline/{slug}', 'PaymentsController@listOfflinePaymentsReport');
Route::get('payments-report/offline/getList/{slug}', 'PaymentsController@getOfflinePaymentReportsDatatable');
Route::post('payments/approve-reject-offline-request', 'PaymentsController@approveOfflinePayment');

Route::get('payments-report/export', 'PaymentsController@exportPayments');
Route::post('payments-report/export', 'PaymentsController@doExportPayments');
Route::get('total/sales', 'PaymentsController@allPayments');
Route::get('total/sales/getlist', 'PaymentsController@allPaymentsList');

Route::post('home/subscribe', 'IndexController@subscribe');
Route::post('product/free-bies', 'IndexController@freeBiesDownload');


// Menu
Route::get('menu/index', 'MenuController@index');
Route::get('menu/add', 'MenuController@create');
Route::post('menu/add', 'MenuController@store');
Route::get('menu/edit/{slug}', 'MenuController@edit');
Route::patch('menu/edit/{slug}', 'MenuController@update');
Route::get('menu/view/{slug}', 'MenuController@show');
Route::get('menu/get-list', 'MenuController@getDatatable');
Route::get('menu/get-list/{slug}', 'MenuController@getDatatable');
Route::delete('menu/delete/{slug}', 'MenuController@delete');

// Menu Items
Route::get('menu-items/index/{menu_slug}', 'MenuItemsController@index');
Route::get('menu-items/add/{menu_slug}', 'MenuItemsController@create');
Route::post('menu-items/add/{menu_slug}', 'MenuItemsController@store');
Route::get('menu-items/edit/{slug}', 'MenuItemsController@edit');
Route::patch('menu-items/edit/{slug}', 'MenuItemsController@update');
Route::get('menu-items/view/{slug}', 'MenuItemsController@show');
Route::get('menu-items/get-list', 'MenuItemsController@getDatatable');
Route::get('menu-items/get-list/{slug}', 'MenuItemsController@getDatatable');
Route::delete('menu-items/delete/{slug}', 'MenuItemsController@delete');

// Page
Route::get('page/{slug}', 'IndexController@page');
Route::post('menu/contactus', 'IndexController@contactus');
Route::post('menu/contactus/productowner', 'IndexController@productOwnerContact');
Route::get('faqs', 'IndexController@faqs');

// FAQs
Route::get('faq/dashboard', 'FaqController@dashborad');
Route::get('faq/index', 'FaqController@index');
Route::get('faq/index/{slug}', 'FaqController@index');
Route::get('faq/add', 'FaqController@create');
Route::post('faq/add', 'FaqController@store');
Route::get('faq/edit/{slug}', 'FaqController@edit');
Route::patch('faq/edit/{slug}', 'FaqController@update');
Route::get('faq/view/{slug}', 'FaqController@show');
Route::get('faq/get-list', 'FaqController@getDatatable');
Route::get('faq/get-list/{slug}', 'FaqController@getDatatable');
Route::delete('faq/delete/{slug}', 'FaqController@delete');

////////////////////////////
// MODULE HELPERS  MODULE //
///////////////////////////
Route::get('mastersettings/module-helpers', 'ModuleHelperController@index');
Route::get('mastersettings/module-helpers/index', 'ModuleHelperController@index');
Route::get('mastersettings/module-helpers/add', 'ModuleHelperController@create');
Route::post('mastersettings/module-helpers/add', 'ModuleHelperController@store');
Route::get('mastersettings/module-helpers/edit/{slug}', 'ModuleHelperController@edit');
Route::patch('mastersettings/module-helpers/edit/{slug}', 'ModuleHelperController@update');
Route::get('mastersettings/module-helpers/view/{slug}', 'ModuleHelperController@viewSettings');
Route::get('mastersettings/module-helpers/add-sub-settings/{slug}', 'ModuleHelperController@addSubSettings');
// Route::post('mastersettings/module-helpers/add-sub-settings/{slug}', 'ModuleHelperController@storeSubSettings');
Route::patch('mastersettings/module-helpers/add-steps/{slug}', 'ModuleHelperController@updateSteps');
 
Route::get('mastersettings/module-helpers/getList', [ 'as'   => 'mastersettings.module-helper.dataTable',
     'uses' => 'ModuleHelperController@getDatatable']);

Route::get('refresh-csrf', function(){
    return csrf_token();
});

// Fake Data
Route::get('adiyya/add-fakeuser', 'FakeDataController@addFakeUser');
Route::get('adiyya/add-fakeproduct/{page?}', 'FakeDataController@addFakeProduct');

Route::post('get-products', 'CartController@getProductsOnSearch');