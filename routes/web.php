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
use App\Http\Controllers\PropertyController;

Route::match(['get', 'post'], '/admin', 'AdminController@adminLogin');

// Route::get('/admin/dashboard', 'AdminController@dashboard');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/admin/dashboard', 'AdminController@dashboard');
    Route::get('/admin/profile', 'AdminController@adminProfile');
    Route::get('/admin/settings', 'AdminController@settings');
    Route::get('/admin/check-pwd', 'AdminController@chkpassword');
    Route::match(['get', 'post'], '/admin/update-pwd', 'AdminController@updatePassword');

    // Admin Property Module (Add/Update/View/Delete)
    Route::match(['get', 'post'], '/admin/add-new-property', 'PropertyController@addProperty');
    Route::get('/admin/properties', 'PropertyController@viewProperty');
    Route::match(['get', 'post'], '/admin/edit-property/{id}', 'PropertyController@editProperty');
    Route::match(['get', 'post'], '/add-new-property/check_slug', 'PropertyController@checkSlug');
    Route::match(['get', 'post'], '/admin/delete-property/{id}', 'PropertyController@deleteProperty');

    // Routes for Getting State List and City List Dynamically
    Route::get('/admin/get-state-list', 'PropertyController@getStateList');
    Route::get('/admin/get-city-list', 'PropertyController@getCityList');
    Route::get('/admin/edit-user/get-state-list', 'PropertyController@getStateList');
    Route::get('/admin/edit-user/get-city-list', 'PropertyController@getCityList');

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
    Route::match(['get', 'post'], '/admin/edit-user/{id}', 'AdminController@editUser');
    Route::get('/admin/users', 'AdminController@viewUser');
    Route::match(['get', 'post'], '/admin/udisable/{id}', 'AdminController@disableUser');
    Route::match(['get', 'post'], '/admin/uenable/{id}', 'AdminController@enableUser');
    Route::match(['get', 'post'], '/checkemail', 'AdminController@checkEmail');

    // Home Loan Applications
    Route::get('/admin/home-loan-application', 'HomeLoanController@homeLoanQuery');
    Route::match(['get', 'post'], '/admin/resolved/{id}', 'HomeLoanController@applicationResolved');
    Route::match(['get', 'post'], '/admin/pending/{id}', 'HomeLoanController@applicationPending');

    // Property Query Routes
    Route::get('/admin/property-query', 'PropertyController@propertyQuery');
    Route::match(['get', 'post'], '/admin/done/{id}', 'PropertyController@queryDone');
    Route::match(['get', 'post'], '/admin/pending/{id}', 'PropertyController@queryPending');

    // Add Missing City
    Route::match(['get', 'post'], '/admin/add-city', 'AdminController@addCity');

    // Admin Logout Function
    Route::get('/get-out', 'AdminController@getOut');

});

Auth::routes();

Route::group(['middleware' => ['userlogin']], function () {
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
Route::get('/view-properties/state_id={state_id}', 'PropertyController@searchByState');
Route::get('/view-properties/country_id={country_id}', 'PropertyController@searchByCountry');
Route::get('/view-properties/city_id={city_id}', 'PropertyController@searchByCity');
Route::get('/view-properties/for={id}', 'PropertyController@searchByService');

Route::get('/logout', 'AdminController@logout');

//homepage search start
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