<?php

use App\Http\Controllers\Front\ProductsController;
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

        // COUPONS
        Route::get('coupons', 'CouponsController@coupons');
        Route::post('update-coupon-status', 'CouponsController@updateCouponStatus');
        Route::get('delete-coupon/{id}','CouponsController@deleteCoupon');
        Route::match(['get','post'], 'add-edit-coupon/{id?}','CouponsController@addEditCoupon');

        // USERS
        Route::get('users', 'UserController@users');
        Route::post('update-user-status', 'UserController@updateUserStatus');

        // ORDERS
        Route::get('orders', 'OrderController@orders');
        Route::get('orders/{id}', 'OrderController@orderDetails');
        Route::post('update-order-status', 'OrderController@updateOrderStatus');
        Route::post('update-order-item-status', 'OrderController@updateOrderItemStatus');

        // ORDER INVOICE
        Route::get('orders/invoice/{id}', 'OrderController@viewOrderInvoice');
        Route::get('orders/invoice/pdf/{id}', 'OrderController@viewPDFInvoice');
    });
    
    
});

Route::get('orders/invoice/download/{id}', 'App\Http\Controllers\Admin\OrderController@viewPDFInvoice');

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
    Route::get('user/login-register',['as'=>'login', 'uses'=>'UserController@loginRegister']);

    // Register Users
    Route::post('user/register','UserController@userRegister');

    // SEARCH PRODUCTS
    Route::get('search-products', 'ProductsController@listing');

    // Protecting the account routes with middleware
    Route::group(['middleware'=>['auth']],function(){
        // User Account
        Route::match(['GET','POST'], 'user/account','UserController@userAccount');

        // Update User Password
        Route::post('user/update-password', 'UserController@userUpdatePassword');

        // Apply Coupon
        Route::post('/apply-coupon', 'ProductsController@applyCoupon');

        // Checkout
        Route::match(['GET', 'POST'], '/checkout', 'ProductsController@checkout');

        // Get Delivery Address
        Route::post('get-delivery-address', 'AddressController@getDeliveryAddress');

        // Save Delivery Address
        Route::post('save-delivery-address', 'AddressController@saveDeliveryAddress');
        
        // Remove Delivery Address
        Route::post('remove-delivery-address', 'AddressController@removeDeliveryAddress');

        // Thanks Page after customer places an order
        Route::get('thanks', 'ProductsController@thanks');

        // Orders as well as Order Details of Customers
        Route::get('user/orders/{id?}', 'OrderController@orders');

        // PAYPAL
        Route::get('/paypal', 'PaypalController@paypal');
        Route::post('/pay', 'PaypalController@pay')->name('payment');
        Route::get('/success', 'PaypalController@success');
        Route::get('/error', 'PaypalController@error');

        // KHALTI
        Route::get('/khalti', 'KhaltiController@khalti');
    });
    
    // User Forgot Password (update password)
    Route::match(['get','post'], 'user/forgot-password', 'UserController@forgotPassword');
    
    // Login Users
    Route::post('user/login','UserController@userLogin');
    
    // User Logout
    Route::get('user/logout', 'UserController@userLogout');

    // Confirm User Account
    Route::get('user/confirm/{code}', 'UserController@confirmAccount');


});