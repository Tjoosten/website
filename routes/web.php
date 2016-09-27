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

// Authencation routes.

Auth::routes();

// Home routes.
Route::get('/', 'HomeController@homeFront')->name('home');
Route::get('/home', 'Homecontroller@homeBackend')->name('home.backend');

// Rental routes
Route::get('/rental', 'RentalController@indexFrontEnd')->name('rental.frontend.index');
Route::get('/rental/insert', 'RentalController@insertViewFrontEnd')->name('rental.frontend.insert');
Route::get('/rental/calendar', 'RentalController@calendar')->name('rental.frontend-calendar');
Route::post('/rental/insert','RentalController@insert')->name('rental.store');

// User management routes.
Route::get('backend/users/create', 'UserManagementController@create')->name('users.create');
Route::get('backend/users', 'UserManagementController@overview')->name('users.index');
Route::get('backend/users/destroy/{id}', 'UserManagementController@destroy')->name('users.destroy');
Route::post('backend/users', 'UserManagementController@store')->name('auth.new');

// Settings routes.
Route::get('settings', 'SettingsController@index')->name('settings.index');

// Profile seetings routes 
Route::get('settings/profile', 'Auth\AccountController@index')->name('settings.profile');

// Activity routes
Route::get('backend/activity', 'ActivityController@index')->name('activity.index');
Route::post('backend/activity/update/{id}', 'ActivityController@update')->name('activity.update');
Route::get('backend/activity/destroy/{id}', 'ActivityController@destroy')->name('activity.destroy');
Route::post('backend/activity', 'ActivityController@store')->name('activity.store');

// Rental module routes.
Route::get('/rental/destroy/{id}', 'RentalController@destroy')->name('rental.destroy');