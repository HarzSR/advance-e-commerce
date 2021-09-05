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

        // Sections

        Route::get('view-sections', 'SectionController@viewSections')->name('View Sections');
        Route::post('update-section-status', 'SectionController@updateSectionStatus');

        // Categories
        Route::get('view-categories', 'CategoryController@viewCategories')->name('View Categories');
        Route::post('update-category-status', 'CategoryController@updateCategoryStatus');
        // Route::match(['get', 'post'], 'add-edit-category/{id?}', 'CategoryController@addEditCategory')->name('Add/Edit Category');
        Route::match(['get', 'post'], 'add-edit-category', 'CategoryController@addEditCategory')->name('Add Category');
        Route::match(['get', 'post'], 'add-edit-category/{id}', 'CategoryController@addEditCategory')->name('Edit Category');
        Route::post('append-categories-level', 'CategoryController@appendCategoryLevel');
        Route::get('delete-category-image/{id}', 'CategoryController@deleteCategoryImage');
        Route::get('delete-category/{id}', 'CategoryController@deleteCategory');

        // Products
        Route::get('view-products', 'ProductController@viewProducts')->name('View Products');
        Route::post('update-product-status', 'ProductController@updateProductStatus');
        Route::match(['get', 'post'], 'add-edit-product', 'ProductController@addEditProduct')->name('Add Category');
        Route::match(['get', 'post'], 'add-edit-product/{id}', 'ProductController@addEditProduct')->name('Edit Category');
        Route::get('delete-product-image/{id}', 'ProductController@deleteProductImage');
        Route::get('delete-product-video/{id}', 'ProductController@deleteProductVideo');
        Route::get('delete-product/{id}', 'ProductController@deleteProduct');

        // Product Attributes
        Route::match(['get', 'post'], 'add-attributes/{id}', 'ProductController@addAttributes')->name('Add/Edit Product Attributes');
        Route::post('update-attributes/{id}', 'ProductController@updateAttributes');
    });
});
