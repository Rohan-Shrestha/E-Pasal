<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::prefix('/admin')->namespace('App\Http\Controllers\Admin')->group(function(){
    
    // Admin Login Route
    Route::match(['get','post'], 'login','AdminController@login');

    Route::group(['middleware'=>['admin']], function(){
        // Admin Dashboard Route
        Route::get('dashboard','AdminController@dashboard');

        // Update Admin Password
        Route::match(['get', 'post'], 'update-admin-password', 'AdminController@updateAdminPassword');
        
        // Check Admin Password
        Route::post('check-admin-password', 'AdminController@checkAdminPassword');

        // Update Admin Details
        Route::match(['get', 'post'], 'update-admin-details', 'AdminController@updateAdminDetails');

        // Update Vendors Details
        Route::match(['get', 'post'], 'update-vendor-details/{slug}', 'AdminController@updateVendorDetails');

        // View Admins, Subadmins and Vendors
        Route::get('admins/{type?}', 'AdminController@admins');

        //View Vendor Details
        Route::get('view-vendor-details/{id}', 'AdminController@viewVendorDetails');

        // Update Admin Status
        Route::post('update-admin-status', 'AdminController@updateAdminStatus');

        // Admin Logout
        Route::get('logout', 'AdminController@logout');

        // START of SECTIONS
        Route::get('sections', 'SectionController@sections');
        // Update section Status
        Route::post('update-section-status', 'SectionController@updateSectionStatus');
        // Delete Section
        Route::get('delete-section/{id}', 'SectionController@deleteSection');
        // Add/ Edit section in admin page
        Route::match(['get', 'post'], 'add-edit-section/{id?}', 'SectionController@addEditSection');
        // END of SECTIONS

        // START of CATEGORIES
        Route::get('categories', 'CategoryController@categories');
        // Update Categories Status
        Route::post('update-category-status', 'CategoryController@updateCategoryStatus');
        // Add  and Edit Categories
        Route::match(['get', 'post'], 'add-edit-category/{id?}', 'CategoryController@addEditCategory');
        // Admin can appen sub category inside a category.
        Route::get('append-categories-level','CategoryController@appendCategoryLevel');
        // Delete Category
        Route::get('delete-category/{id}','CategoryController@deleteCategory');
        // Delete Image
        Route::get('delete-category-image/{id}','CategoryController@deleteCategoryImage');
        // END of CATEGORIES

        // START of BRANDS
        Route::get('brands', 'BrandController@brands');
        // Update Brand Status
        Route::post('update-brand-status', 'BrandController@updateBrandStatus');
        // Delete Brand
        Route::get('delete-brand/{id}', 'BrandController@deleteBrand');
        // Add/ Edit Brand in admin page
        Route::match(['get', 'post'], 'add-edit-brand/{id?}', 'BrandController@addEditBrand');
        // END of BRANDS

        // START of PRODUCTS
        // END of PRODUCTS
    });
    
    
});

Route::namespace('App\Http\Controllers\Front')->group(function(){
    Route::get('/', 'IndexController@index');
});