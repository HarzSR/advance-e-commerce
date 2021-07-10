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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// All Admin Route Function will be Defined Here

Route::prefix('/admin')->namespace('Admin')->group(function (){

    Route::match(['get', 'post'], '/' , 'AdminController@login');

    Route::group(['middleware' => ['admin']], function ()
    {
        Route::get('dashboard', 'AdminController@dashboard')->name('Dashboard');
        Route::get('settings', 'AdminController@settings')->name('Settings');
        Route::get('logout', 'AdminController@logout');
        Route::post('check-current-password', 'AdminController@checkCurrentPassword');
        Route::post('update-settings', 'AdminController@updateSettings');
        Route::match(['get', 'post'], 'update-admin-details', 'AdminController@updateAdminDetails')->name('Update Details');

        Route::get('sections', 'SectionController@sections')->name('Sections');
    });
});
