<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Models\Category;

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
        // Admin can append sub category inside a category.
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
        Route::get('products', 'ProductsController@products');
        Route::post('update-product-status', 'ProductsController@updateProductStatus');
        Route::get('delete-product/{id}','ProductsController@deleteProduct');
        Route::match(['get','post'], 'add-edit-product/{id?}','ProductsController@addEditProduct');
        Route::get('delete-product-image/{id}','ProductsController@deleteProductImage');
        Route::get('delete-product-video/{id}','ProductsController@deleteProductVideo');
        // END of PRODUCTS

        // ATTRIBUTES
        Route::match(['get', 'post'], 'add-edit-attributes/{id}', 'AttributesController@addAttributes');
        Route::post('update-attribute-status', 'AttributesController@updateAttributeStatus');
        Route::get('delete-attribute/{id}', 'AttributesController@deleteAttribute');
        Route::match(['get', 'post'], 'edit-attributes/{id}','AttributesController@editAttributes');

        // PRODUCT FILTERS
        Route::get('filters','FilterController@filters');
        Route::get('filters-values','FilterController@filtersValues');
        Route::post('update-filter-status', 'FilterController@updateFilterStatus');
        Route::post('update-filter-value-status', 'FilterController@updateFilterValueStatus');
        Route::match(['get','post'], 'add-edit-filter/{id?}','FilterController@addEditFilter');
        Route::match(['get','post'], 'add-edit-filter-value/{id?}','FilterController@addEditFilterValue');
        Route::post('category-filters', 'FilterController@categoryFilters');

        // IMAGES
        Route::match(['get', 'post'], 'add-images/{id}','ProductsController@addImages');
        Route::post('update-image-status', 'ProductsController@updateImageStatus');
        Route::get('delete-image/{id}', 'ProductsController@deleteImage');

        // BANNERS
        Route::get('banners','BannersController@banners');
        Route::post('update-banner-status', 'BannersController@updateBannerStatus');
        Route::get('delete-banner/{id}','BannersController@deleteBanner');
        Route::match(['get','post'],'add-edit-banner/{id?}','BannersController@addEditBanner');
    });
    
    
});

Route::namespace('App\Http\Controllers\Front')->group(function(){
    Route::get('/', 'IndexController@index');

    // Listing/Categories Routes
    $catUrls = Category::select('url')->where('status',1)->get()->pluck('url')->toArray();
    // dd($catUrls); die;
    foreach ($catUrls as $key => $url){
        Route::match(['get','post'], '/'.$url,'ProductsController@listing');
    }

    // Vendor's Products
    Route::get('/products/{vendorid}','ProductsController@vendorListing');

    // Product Detail Page
    Route::get('/product/{id}','ProductsController@detail');

    // Get Product Attribute Price
    Route::post('get-product-price', 'ProductsController@getProductPrice');

    // Vendor Login/Register Routes
    Route::get('vendor/login-register','VendorController@loginRegister');

    // Vendor Register
    Route::post('vendor/register','VendorController@vendorRegister');

    // Confirm Vendor Account
    Route::get('vendor/confirm/{code}', 'VendorController@confirmVendor');

    // Route for Add to Cart
    Route::post('cart/add','ProductsController@cartAdd');

    // Cart Route
    Route::get('cart','ProductsController@cart');

    // Update cart item quantity
    Route::post('cart/update','ProductsController@cartUpdate');
    
    // Delete cart item
    Route::post('cart/delete','ProductsController@cartDelete');

    // User Login Register
    Route::get('user/login-register','UserController@loginRegister');

    // Register Users
    Route::post('user/register','UserController@userRegister');
});