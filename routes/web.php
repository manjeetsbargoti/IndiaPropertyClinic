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

Route::group(['middleware' => ['admin', 'admin:1']], function () {
    Route::get('/admin/dashboard', 'AdminController@dashboard');
    Route::get('/admin/profile', 'AdminController@adminProfile');
    // Route::get('/admin/settings', 'AdminController@settings');
    Route::get('/admin/check-pwd', 'AdminController@chkpassword');
    Route::match(['get', 'post'], '/admin/update-pwd', 'AdminController@updatePassword');

    // Admin Property Module (Add/Update/View/Delete)
    Route::match(['get', 'post'], '/admin/add-new-property', 'PropertyController@addProperty');
    Route::get('/admin/properties', 'PropertyController@viewProperty');
    Route::match(['get', 'post'], '/admin/property/{id}/edit', 'PropertyController@editProperty');
    Route::match(['get', 'post'], '/add-new-property/check_slug', 'PropertyController@checkSlug');
    Route::match(['get', 'post'], '/admin/property/{id}/delete', 'PropertyController@deleteProperty');
    Route::get('/admin/delete-property-image/{id}', 'PropertyController@deletePropertyImage');

    // Routes for Getting State List and City List Dynamically
    Route::get('/admin/get-state-list', 'PropertyController@getStateList');
    Route::get('/admin/get-city-list', 'PropertyController@getCityList');
    Route::get('/admin/edit-user/get-state-list', 'PropertyController@getStateList');
    Route::get('/admin/edit-user/get-city-list', 'PropertyController@getCityList');
    Route::get('/admin/edit-property/get-state-list', 'PropertyController@getStateList');
    Route::get('/admin/edit-property/get-city-list', 'PropertyController@getCityList');

    // Admin Services Module (Add/Update/View/Disable)
    Route::match(['get', 'post'], '/admin/add-new-service', 'ServiceController@addService');
    Route::get('/admin/services', 'ServiceController@viewService');
    Route::match(['get', 'post'], '/admin/sdisable/{id}', 'ServiceController@disableService');
    Route::match(['get', 'post'], '/admin/senable/{id}', 'ServiceController@enableService');

    // Repair Services Module (Add/Update/View/Disable)
    Route::match(['get', 'post'], '/admin/add-repair-service', 'RepairServiceController@addRService');
    Route::get('/admin/repair-services', 'RepairServiceController@viewRService');
    Route::match(['get', 'post'], '/admin/edit-repair-services/{id}', 'RepairServiceController@editRService');
    Route::match(['get', 'post'], '/admin/rdisable/{id}', 'RepairServiceController@disableService');
    Route::match(['get', 'post'], '/admin/renable/{id}', 'RepairServiceController@enableService');
    Route::match(['get', 'post'], '/repair-services/check_slug', 'RepairServiceController@checkSlug');

    // User Module by Admin (Add/Update/View/Disable)
    Route::match(['get', 'post'], '/admin/add-new-user', 'AdminController@addUser');
    Route::match(['get', 'post'], '/admin/edit-user/{id}', 'AdminController@editUser')->name('edituser');
    Route::get('/admin/users', 'AdminController@viewUser');
    Route::match(['get', 'post'], '/admin/udisable/{id}', 'AdminController@disableUser');
    Route::match(['get', 'post'], '/admin/uenable/{id}', 'AdminController@enableUser');
    Route::match(['get', 'post'], '/admin/delete-user/{id}', 'AdminController@deleteUser');
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

    // Add Missing City/State
    Route::match(['get', 'post'], '/admin/add-city', 'AdminController@addCity');
    Route::match(['get', 'post'], '/admin/add-state', 'AdminController@addState');

    // System Options Routes
    Route::get('/admin/options', 'SystemController@getOptions');
    Route::post('/admin/options','SystemController@postOption');
    Route::get('/admin/robots.txt','SystemController@getRobot');
    Route::post('/admin/robots.txt','SystemController@postRobot');
    Route::get('/admin/htaccess','SystemController@getHtaccess');
    Route::post('/admin/htaccess','SystemController@postHtaccess');
    Route::get('/admin/custom-code','SystemController@getCode');
    Route::post('/admin/custom-code','SystemController@postCodes');
    Route::get('/admin/editor','SystemController@getStyle');
    Route::post('/admin/editor','SystemController@postStyle');
    Route::get('/admin/sitemap', 'SystemController@getSitemap');
    Route::post('/admin/sitemap', 'SystemController@postSitemap');
    Route::match(['get','post'], '/admin/new-contact', 'SystemController@newContact');
    Route::get('/admin/contacts', 'SystemController@contactList');


    // Admin Logout Function
    Route::get('/get-out', 'AdminController@getOut');

    // Getting property images from Property Images table and uploading to Property table
    Route::match(['get', 'post'], '/admin/update-pimages', 'SystemController@pImages');

});

Route::group(['middleware' => ['auth', 'admin:0']], function () {
    Route::match(['get', 'post'], '/My-Account', 'AdminController@userAccount');

});

// Check Password
Route::get('/admin/check-pwd', 'AdminController@chkpassword');
Route::match(['get', 'post'], '/admin/update-pwd', 'AdminController@changePassword');

// User Login/Register Functionality
Route::match(['get', 'post'], '/login', 'AdminController@login');
Route::match(['get', 'post'], '/register', 'AdminController@register');
Route::match(['get', 'post'], '/password/reset', 'AdminController@resetPassword');
Route::match(['get', 'post'], '/checkuseremail', 'AdminController@checkEmail');

Route::get('/', 'HomeController@index');
Route::get('/properties', 'HomeController@viewAll');
Route::match(['get', 'post'], '/properties/{url}', 'PropertyController@viewSingleProperty');
Route::get('/services/{url}', 'RepairServiceController@SingleRepairService');

// Search by City, State and Country
Route::get('/state/{state_id}/properties', 'PropertyController@searchByState');
Route::get('/city/{city_id}/properties', 'PropertyController@searchByCity');
Route::get('/properties/{id}/{name}', 'PropertyController@searchByService');
Route::get('/country/{country_id}/properties', 'PropertyController@searchByCountry');

Route::get('/logout', 'AdminController@logout');

// Homepage search start
Route::post('/search', 'HomeController@search')->name('autocomplete.search');
Route::post('/search-result', 'HomeController@searchresult');

// Apply for Home Loan and EMI Calculator
Route::match(['get', 'post'], '/Apply-Home-Loan', 'HomeLoanController@applyHomeLoan');

// User Login/Register Functionality
Route::match(['get', 'post'], '/login', 'AdminController@login');
Route::match(['get', 'post'], '/register', 'AdminController@register');
Route::match(['get', 'post'], '/password/reset', 'AdminController@resetPassword');

// Email Verification Routes
Route::match(['get', 'post'], '/verify/{code}', 'AdminController@verifyEmail');

// Login via Twitter
Route::get('/twitter', function () {
    return view('twitterAuth');
});
Route::get('/auth/redirect/{provider}', 'AdminController@redirect');
Route::get('/auth/callback/{provider}', 'AdminController@callback');

// User Page Routes
Route::match(['get', 'post'], '/user-profile/{id}', 'AdminController@viewuserPage');

// Sidebar filter
Route::get('/properties_filter', 'HomeController@filter');