<?php

use Spatie\Sitemap\SitemapGenerator;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
 */

Auth::routes();

Route::match(['get', 'post'], '/admin', 'AdminController@adminLogin');

Route::get('/admin/dashboard', 'AdminController@dashboard');

Route::group(['middleware' => ['auth', 'admin']], function () {
    Route::get('/admin/dashboard', 'AdminController@dashboard');
    Route::get('/admin/profile', 'AdminController@adminProfile');
    // Route::get('/admin/settings', 'AdminController@settings');
    Route::get('/admin/check-pwd', 'AdminController@chkpassword');
    Route::match(['get', 'post'], '/admin/update-pwd', 'AdminController@updatePassword');

    // Admin Property Module (Add/Update/View/Delete)
    Route::match(['get', 'post'], '/admin/property/new', 'PropertyController@addProperty');
    Route::get('/admin/properties', 'PropertyController@viewProperty');
    Route::match(['get', 'post'], '/admin/property/{id}/edit', 'PropertyController@editProperty');
    Route::match(['get', 'post'], '/add-new-property/check_slug', 'PropertyController@checkSlug');
    Route::match(['get', 'post'], '/admin/property/{id}/delete', 'PropertyController@deleteProperty');
    Route::get('/admin/delete-property-image/{id}', 'PropertyController@deletePropertyImage');

    // Amenity Routes
    Route::match(['get', 'post'], '/admin/property/amenity/new', 'AmenityController@addAmenity');
    Route::get('/admin/property/amenities', 'AmenityController@viewAmenity');
    Route::match(['get', 'post'], '/admin/property/amenity/{id}/edit', 'AmenityController@editAmenity');
    Route::match(['get', 'post'], '/admin/property/amenity/{id}/enable', 'AmenityController@enableAmenity');
    Route::match(['get', 'post'], '/admin/property/amenity/{id}/disable', 'AmenityController@disableAmenity');
    Route::match(['get', 'post'], '/admin/property/amenity/{id}/delete', 'AmenityController@deleteAmenity');

    // Routes for Getting State List and City List Dynamically
    Route::get('/admin/get-state-list', 'PropertyController@getStateList');
    Route::get('/admin/get-city-list', 'PropertyController@getCityList');
    Route::get('/admin/user/get-state-list', 'PropertyController@getStateList');
    Route::get('/admin/user/get-city-list', 'PropertyController@getCityList');
    Route::get('/admin/property/get-state-list', 'PropertyController@getStateList');
    Route::get('/admin/property/get-city-list', 'PropertyController@getCityList');
    Route::get('/admin/csc/city/get-state-list', 'PropertyController@getStateList');
    Route::get('/admin/queries/phone-query/get-state-list', 'PropertyController@getStateList');
    Route::get('/admin/queries/phone-query/get-city-list', 'PropertyController@getCityList');
    Route::get('/admin/user/{id}/get-state-list', 'PropertyController@getStateList');
    Route::get('/admin/user/{id}/get-city-list', 'PropertyController@getCityList');
    Route::get('/admin/property/{id}/edit/get-state-list', 'PropertyController@getStateList');
    Route::get('/admin/property/{id}/edit/get-city-list', 'PropertyController@getCityList');
    Route::get('/admin/pages/get-state-list', 'PropertyController@getStateList');
    Route::get('/admin/pages/get-city-list', 'PropertyController@getCityList');
    Route::get('/admin/page/{id}/edit/get-state-list', 'PropertyController@getStateList');
    Route::get('/admin/page/{id}/edit/get-city-list', 'PropertyController@getCityList');
    Route::get('/admin/ppc/page/get-state-list', 'PropertyController@getStateList');
    Route::get('/admin/ppc/page/get-city-list', 'PropertyController@getCityList');
    Route::get('/admin/ppc/page/{id}/get-state-list', 'PropertyController@getStateList');
    Route::get('/admin/ppc/page/{id}/get-city-list', 'PropertyController@getCityList');

    // Admin Services Module (Add/Update/View/Disable)
    Route::match(['get', 'post'], '/admin/service/new', 'ServiceController@addService');
    Route::get('/admin/services', 'ServiceController@viewService');
    Route::match(['get', 'post'], '/admin/sdisable/{id}', 'ServiceController@disableService');
    Route::match(['get', 'post'], '/admin/senable/{id}', 'ServiceController@enableService');

    // Repair Services Module (Add/Update/View/Disable)
    Route::match(['get', 'post'], '/admin/repair-service/new', 'RepairServiceController@addRService');
    Route::get('/admin/repair-services', 'RepairServiceController@viewRService');
    Route::match(['get', 'post'], '/admin/repair-service/{id}/edit', 'RepairServiceController@editRService');
    Route::match(['get', 'post'], '/admin/rdisable/{id}', 'RepairServiceController@disableService');
    Route::match(['get', 'post'], '/admin/renable/{id}', 'RepairServiceController@enableService');
    Route::match(['get', 'post'], '/repair-services/check_slug', 'RepairServiceController@checkSlug');

    // User Module by Admin (Add/Update/View/Disable)
    Route::match(['get', 'post'], '/admin/user/new', 'AdminController@addUser');
    Route::match(['get', 'post'], '/admin/user/{id}/edit', 'AdminController@editUser')->name('edituser');
    Route::get('/admin/users', 'AdminController@viewUser');
    Route::match(['get', 'post'], '/admin/udisable/{id}', 'AdminController@disableUser');
    Route::match(['get', 'post'], '/admin/uenable/{id}', 'AdminController@enableUser');
    Route::match(['get', 'post'], '/admin/user/{id}/delete', 'AdminController@deleteUser');
    Route::match(['get', 'post'], '/checkemail', 'AdminController@checkEmail');
    Route::match(['get', 'post'], '/checkuserphone', 'AdminController@checkPhone');

    // Home Loan Applications
    Route::get('/admin/queries/home-loan', 'HomeLoanController@homeLoanQuery');
    Route::match(['get', 'post'], '/admin/resolved/{id}', 'HomeLoanController@applicationResolved');
    Route::match(['get', 'post'], '/admin/pending/{id}', 'HomeLoanController@applicationPending');

    // Property Query Routes
    Route::get('/admin/queries/property', 'PropertyController@propertyQuery');
    Route::match(['get', 'post'], '/admin/done/{id}', 'PropertyController@queryDone');
    Route::match(['get', 'post'], '/admin/pending/{id}', 'PropertyController@queryPending');

    // Service Requests Query
    Route::get('/admin/queries/service-requests', 'RepairServiceController@requestService');
    Route::match(['get', 'post'], '/admin/service/request/{id}/done', 'RepairServiceController@statusDone');
    Route::match(['get', 'post'], '/admin/service/request/{id}/pending', 'RepairServiceController@statusPending');

    // Assign Vendor to the Service Request
    Route::match(['get', 'post'], '/admin/service/request/{id}/assign', 'RepairServiceController@assignVendorService');

    // Requested Quotes
    Route::get('/admin/queries/requested-quote', 'AdminController@requestedQuotes');

    // Add Missing City/State
    Route::match(['get', 'post'], '/admin/csc/city/add', 'AdminController@addCity');
    Route::match(['get', 'post'], '/admin/csc/state/add', 'AdminController@addState');

    // System Options Routes
    Route::get('/admin/system/options', 'SystemController@getOptions');
    Route::post('/admin/system/options','SystemController@postOption');
    Route::get('/admin/system/robots.txt','SystemController@getRobot');
    Route::post('/admin/system/robots.txt','SystemController@postRobot');
    Route::get('/admin/system/htaccess','SystemController@getHtaccess');
    Route::post('/admin/system/htaccess','SystemController@postHtaccess');
    Route::get('/admin/system/custom-code','SystemController@getCode');
    Route::post('/admin/system/custom-code','SystemController@postCodes');
    Route::get('/admin/system/editor','SystemController@getStyle');
    Route::post('/admin/system/editor','SystemController@postStyle');
    Route::get('/admin/sitemap', 'SystemController@getSitemap');
    Route::post('/admin/sitemap', 'SystemController@postSitemap');
    Route::match(['get','post'], '/admin/contacts/new', 'SystemController@newContact');
    Route::get('/admin/contacts', 'SystemController@contactList');
    
    // Update Home Page Content
    Route::get('/admin/system/homepage-content','HomeController@getHomeContent');
    Route::post('/admin/system/homepage-content','HomeController@postHomeContent');

    // Website Contact Details
    Route::get('/admin/system/contact-info', 'SystemController@getContactInfo');
    Route::post('/admin/system/contact-info','SystemController@postContactInfo');


    // Admin Logout Function
    Route::get('/get-out', 'AdminController@getOut');

    // Getting property images from Property Images table and uploading to Property table
    // Route::match(['get', 'post'], '/admin/update-pimages', 'SystemController@pImages');

    // CMS Routes Management
    Route::match(['get', 'post'], '/admin/pages/new', 'PageController@newPage');
    Route::match(['get', 'post'], '/admin/pages', 'PageController@allPages');
    Route::match(['get', 'post'], '/admin/pages/{id}/edit', 'PageController@editPage');
    Route::match(['get', 'post'], '/admin/page/{id}/disable', 'PageController@disablePage');
    Route::match(['get', 'post'], '/admin/page/{id}/enable', 'PageController@enablePage');
    Route::match(['get', 'post'], '/admin/page/{id}/delete', 'PageController@deletePage');
    Route::match(['get', 'post'], '/cms-page-url/check_slug', 'PageController@checkSlug');
    
    // Phone Query
    Route::match(['get', 'post'], '/admin/queries/phone-query/add', 'HomeController@addPhoneQuery');
    Route::match(['get', 'post'], '/admin/queries/phone-queries', 'HomeController@phoneQueryData');
    
    // Google Ads Management
    Route::get('/admin/ads/ads-script', 'AdsController@getAdsCode');
    Route::post('/admin/ads/ads-script','AdsController@postAdsCode');
    
    Route::match(['get', 'post'], '/admin/ppc/page/new', 'PpcController@addPpcPage');
    Route::match(['get', 'post'], '/add-new-ppc-page/check_slug', 'PpcController@checkSlug');
    Route::match(['get', 'post'], '/admin/ppc/page/get-services-list', 'RepairServiceController@getSubServices');
    Route::get('/admin/ppc/pages', 'PpcController@returnPpcPages');
    Route::get('/admin/queries/ppc-queries', 'PpcController@returnPpcQuery');
    Route::match(['get', 'post'], '/admin/ppc/page/{id}/edit', 'PpcController@editPpcPage');
});

Route::group(['middleware' => ['auth', 'admin'], 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
	Route::get('categories', 'CategoriesController@index')->name('admin.categories');
	Route::any('categories/add', 'CategoriesController@add')->name('admin.categories.add');
	Route::any('categories/edit/{id}', 'CategoriesController@edit')->name('admin.categories.edit');
    Route::any('categories/delete/{id}', 'CategoriesController@delete')->name('admin.categories.delete');
    Route::get('categories/change-status/{id}', 'CategoriesController@changeStatus')->name('admin.categories.change-status');
    Route::post('categories/get-slug', 'CategoriesController@getSlug')->name('admin.categories.get-slug');
    Route::get('categories/restore/{id}', 'CategoriesController@restore')->name('admin.categories.restore');
    Route::get('categories/force-delete/{id}', 'CategoriesController@forceDelete')->name('admin.categories.force-delete');
});

Route::group(['middleware' => ['auth', 'admin:0']], function () {
    Route::match(['get', 'post'], '/user/account', 'AdminController@userAccount');
});

// Get State, City List
Route::get('/ipc/get-state-list', 'PropertyController@getStateList');
Route::get('/ipc/get-city-list', 'PropertyController@getCityList');

// Check Password
Route::get('/admin/check-pwd', 'AdminController@chkpassword');
Route::match(['get', 'post'], '/admin/update-pwd', 'AdminController@changePassword');

// User Login/Register Functionality
Route::match(['get', 'post'], '/login', 'AdminController@login');
Route::match(['get', 'post'], '/register', 'AdminController@register');
Route::match(['get', 'post'], '/password/reset', 'AdminController@resetPassword');
Route::match(['get', 'post'], '/password/verify/email', 'AdminController@verifyEmailResetPassword');
Route::match(['get', 'post'], '/checkuseremail', 'AdminController@checkEmail');
Route::match(['get', 'post'], '/checkphone', 'AdminController@checkPhone');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/properties', 'HomeController@viewAll');
Route::match(['get', 'post'], '/properties/{url}', 'PropertyController@viewSingleProperty');
Route::get('/services/{url}', 'RepairServiceController@SingleRepairService')->name('repair-services');

// Search by City, State and Country
Route::get('/state/{state_id}/properties', 'PropertyController@searchByState');
Route::get('/city/{city_id}/properties', 'PropertyController@searchByCity');
Route::get('/properties/{id}/{name}', 'PropertyController@searchByService');
Route::get('/country/{country_id}/properties', 'PropertyController@searchByCountry');

Route::get('/state/real-estate-for-sale-{state_id}', 'PropertyController@searchByState');
Route::get('/city/real-estate-for-sale-{city_id}', 'PropertyController@searchByCity');
Route::get('/country/real-estate-for-sale-{country_id}', 'PropertyController@searchByCountry');

Route::get('/country_property/properties-for-sale-in-{country_name}', 'PropertyController@searchByCountryName');
Route::get('/country/{property_type}-for-sale-in-{country_name}', 'PropertyController@searchByCountryPropertyType');
Route::get('/state/{property_type}-for-sale-in-{state_name}', 'PropertyController@searchByStatePropertyType');
Route::get('/city/{property_type}-for-sale-in-{city_name}', 'PropertyController@searchByCityPropertyType');


Route::get('/user/logout', 'AdminController@logout');

// Homepage search start
Route::post('/search', 'HomeController@search')->name('autocomplete.search');
Route::post('/search-result', 'HomeController@searchresult');

// Apply for Home Loan and EMI Calculator
Route::match(['get', 'post'], '/Apply-Home-Loan', 'HomeLoanController@applyHomeLoan');

// User Login/Register Functionality
Route::match(['get', 'post'], '/login', 'AdminController@login');
Route::match(['get', 'post'], '/register', 'AdminController@register');
Route::match(['get', 'post'], '/password/reset', 'AdminController@resetPassword');
Route::match(['get', 'post'], '/password/verify/email', 'AdminController@verifyEmailResetPassword');

// Email Verification Routes
Route::match(['get', 'post'], '/verify/{code}', 'AdminController@verifyEmail');

// Login via Twitter
Route::get('/twitter', function () {
    return view('twitterAuth');
});
Route::get('/auth/redirect/{provider}', 'AdminController@redirect');
Route::get('/auth/callback/{provider}', 'AdminController@callback');

// User Page Routes
Route::match(['get', 'post'], '/profile/{id}/user', 'AdminController@viewuserPage');
Route::match(['get', 'post'], '/admin/req_quote/{id}/close', 'AdminController@closeReqQuote');
Route::match(['get', 'post'], '/admin/req_quote/{id}/open', 'AdminController@openReqQuote');

// Sidebar filter
Route::get('/properties_filter', 'HomeController@filter');

// List Your Property
Route::match(['get','post'], '/list-property', 'PropertyController@listProperty');
Route::match(['get', 'post'], '/list-property/check_slug', 'PropertyController@checkListSlug');

// List Your Business
Route::match(['get','post'], '/list-your-business', 'BusinessController@listBusiness');

// Routes for Getting State List and City List Dynamically
Route::get('/get-state-list', 'PropertyController@getStateList');
Route::get('/get-city-list', 'PropertyController@getCityList');
Route::get('/country/get-state-list', 'PropertyController@getStateList');
Route::get('/country/get-city-list', 'PropertyController@getCityList');

// Request Service Page
Route::match(['get', 'post'], '/service/request', 'RepairServiceController@serviceRequest')->name('service-request');
Route::post('/city_list', 'RepairServiceController@search')->name('cityname.search');
Route::match(['get', 'post'], '/service/get-services-list', 'RepairServiceController@getSubServices');
Route::match(['get', 'post'], '/services/{url}/get-services-list', 'RepairServiceController@getSubServices');
Route::match(['get', 'post'], '/services/{url}/get-state-list', 'PropertyController@getStateList');
Route::match(['get', 'post'], '/service/get-state-list', 'PropertyController@getStateList');
Route::match(['get', 'post'], '/ipc/get-services-list', 'RepairServiceController@getSubServices');
Route::match(['get', 'post'], '/ipc/get-state-list', 'PropertyController@getStateList');

// Thank you Page
Route::match(['get', 'post'], '/list-property/thank-you', 'PropertyController@thankYou');

// CMS Pages Route
Route::match(['get', 'post'], '/{url}', 'PageController@singlePage');


// Custom PPC URL
Route::match(['get', 'post'], '/ipc/plumbing-services', 'PageController@ppcPages');
// PPC Pages Module
Route::match(['get', 'post'], '/ipc/{url}', 'PpcController@ppcPages');

// Generate Sitemap Manual
Route::match(['get','post'], '/property/sitemap.xml', 'SitemapController@index');
Route::match(['get','post'], '/csc/sitemap.xml', 'SitemapController@cscSitemap');
Route::match(['get','post'], '/service/sitemap.xml', 'SitemapController@serviceSitemap');
Route::match(['get','post'], '/city/sitemap.xml', 'SitemapController@citySitemap');

Route::group(['prefix' => 'blog'], function () {
    Route::get('categories', 'BlogController@categories')->name('blog-categories');
    Route::get('all', 'BlogController@blog')->name('blog');
    Route::get('single-blog', 'BlogController@singleBlog')->name('single-blog');
});

// Builders List
Route::match(['get','post'],'/country/builders/real-estate-builders-{country}', 'HomeController@countryBuilders');
Route::match(['get','post'],'/state/builders/real-estate-builders-{state}', 'HomeController@stateBuilders');
Route::match(['get','post'],'/city/builders/real-estate-builders-{city}', 'HomeController@cityBuilders');
Route::match(['get','post'],'/country/builders/search', 'HomeController@searchBuilders');