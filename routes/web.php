<?php

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
    Route::get('/admin/property/get-state-list', 'PropertyController@getStateList');
    Route::get('/admin/property/get-city-list', 'PropertyController@getCityList');
    Route::get('/admin/edit-user/get-state-list', 'PropertyController@getStateList');
    Route::get('/admin/edit-user/get-city-list', 'PropertyController@getCityList');
    Route::get('/admin/property/{id}/edit/get-state-list', 'PropertyController@getStateList');
    Route::get('/admin/property/{id}/edit/get-city-list', 'PropertyController@getCityList');
    Route::get('/admin/page/{id}/edit/get-state-list', 'PropertyController@getStateList');
    Route::get('/admin/page/{id}/edit/get-city-list', 'PropertyController@getCityList');

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
    Route::get('/admin/home-loan-application', 'HomeLoanController@homeLoanQuery');
    Route::match(['get', 'post'], '/admin/resolved/{id}', 'HomeLoanController@applicationResolved');
    Route::match(['get', 'post'], '/admin/pending/{id}', 'HomeLoanController@applicationPending');

    // Property Query Routes
    Route::get('/admin/property-query', 'PropertyController@propertyQuery');
    Route::match(['get', 'post'], '/admin/done/{id}', 'PropertyController@queryDone');
    Route::match(['get', 'post'], '/admin/pending/{id}', 'PropertyController@queryPending');

    // Service Requests Query
    Route::get('/admin/service-requests', 'RepairServiceController@requestService');
    Route::match(['get', 'post'], '/admin/service/request/{id}/done', 'RepairServiceController@statusDone');
    Route::match(['get', 'post'], '/admin/service/request/{id}/pending', 'RepairServiceController@statusPending');

    // Assign Vendor to the Service Request
    Route::match(['get', 'post'], '/admin/service/request/{id}/assign', 'RepairServiceController@assignVendorService');

    // Requested Quotes
    Route::get('/admin/requested-quote', 'AdminController@requestedQuotes');

    // Add Missing City/State
    Route::match(['get', 'post'], '/admin/add-city', 'AdminController@addCity');
    Route::match(['get', 'post'], '/admin/add-state', 'AdminController@addState');

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
    Route::match(['get', 'post'], '/admin/add-phone-query', 'HomeController@addPhoneQuery');
    Route::match(['get', 'post'], '/admin/phone-queries', 'HomeController@phoneQueryData');

    // Add new agent
    // Route::match(['get', 'post'], '/admin/add-new-agent', 'PropertyController@addNewPropertyUser');
});

Route::group(['middleware' => ['auth', 'admin:0']], function () {
    Route::match(['get', 'post'], '/user/account', 'AdminController@userAccount');
});

// Check Password
Route::get('/admin/check-pwd', 'AdminController@chkpassword');
Route::match(['get', 'post'], '/admin/update-pwd', 'AdminController@changePassword');

// User Login/Register Functionality
Route::match(['get', 'post'], '/login', 'AdminController@login');
Route::match(['get', 'post'], '/register', 'AdminController@register');
Route::match(['get', 'post'], '/password/reset', 'AdminController@resetPassword');
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
Route::match(['get','post'], '/list-your-business', 'HomeController@listBusiness');

// Routes for Getting State List and City List Dynamically
Route::get('/get-state-list', 'PropertyController@getStateList');
Route::get('/get-city-list', 'PropertyController@getCityList');

// Request Service Page
Route::match(['get', 'post'], '/service/request', 'RepairServiceController@serviceRequest')->name('service-request');
Route::post('/city_list', 'RepairServiceController@search')->name('cityname.search');
Route::match(['get', 'post'], '/service/get-services-list', 'RepairServiceController@getSubServices');
Route::match(['get', 'post'], '/services/{url}/get-services-list', 'RepairServiceController@getSubServices');
Route::match(['get', 'post'], '/services/{url}/get-state-list', 'PropertyController@getStateList');
Route::match(['get', 'post'], '/service/get-state-list', 'PropertyController@getStateList');

// Thank you Page
Route::match(['get', 'post'], '/list-property/thank-you', 'PropertyController@thankYou');

// CMS Pages Route
Route::match(['get', 'post'], '/{url}', 'PageController@singlePage');