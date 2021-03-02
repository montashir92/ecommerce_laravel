<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\PagesController;
use App\Http\Controllers\Frontend\ProductController;
use App\Http\Controllers\Frontend\CartsController;
use App\Http\Controllers\Frontend\CheckoutsController;
use App\Http\Controllers\Frontend\DashboardsController;

//Backend
use App\Http\Controllers\Backend\UsersController;
use App\Http\Controllers\Backend\ProfilesController;
use App\Http\Controllers\Backend\CategoriesController;
use App\Http\Controllers\Backend\BrandsController;
use App\Http\Controllers\Backend\ColorsController;
use App\Http\Controllers\Backend\SizesController;
use App\Http\Controllers\Backend\ProductsController;
use App\Http\Controllers\Backend\SlidersController;
use App\Http\Controllers\Backend\OrdersController;
use App\Http\Controllers\Backend\CustomersController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

Route::get('/', [PagesController::class, 'index'])->name('index');
Route::get('/contact', [PagesController::class, 'contact'])->name('contacts');


//Product Routes for Frontend
Route::prefix(md5('products'))->group(function(){
    Route::get('/', [ProductController::class, 'index'])->name('products');
    Route::get('/show/{slug}', [ProductController::class, 'show'])->name('product.show');
    Route::post('/product/search', [ProductController::class, 'search'])->name('product.search');
    Route::get('/product-get', [ProductController::class, 'productGet'])->name('product.get');
    
    //category Routes.. Category Product
    Route::get('/categories/{category_id}', [ProductController::class, 'categoryProduct'])->name('categories.show');
    //brand Routes.. brand Product
    Route::get('/brands/{brand_id}', [ProductController::class, 'brandProduct'])->name('brands.show');
});

//Carts Routes
Route::prefix(md5('carts'))->group(function(){
    Route::get('/', [CartsController::class, 'index'])->name('carts');
    Route::post('/store', [CartsController::class, 'store'])->name('cart.store');
    Route::post('/update', [CartsController::class, 'update'])->name('cart.update');
    Route::get('/delete/{id}', [CartsController::class, 'delete'])->name('cart.delete');
});

//Customer Signup Process Routes
Route::get('/customer-login', [CheckoutsController::class, 'index'])->name('customer.login');
Route::get('/customer-signup', [CheckoutsController::class, 'signup'])->name('customer.signup');
Route::post('/signup-store', [CheckoutsController::class, 'store'])->name('customer.signup.store');
Route::get('/email-verify', [CheckoutsController::class, 'emailVerify'])->name('email.verify');
Route::post('/verify-store', [CheckoutsController::class, 'verifyStore'])->name('verify.store');
Route::get('/checkouts', [CheckoutsController::class, 'checkOut'])->name('customer.checkouts');
Route::post('/checkout/store', [CheckoutsController::class, 'checkStore'])->name('customer.checkout.store');

Auth::routes();

//Customer Dashboard
Route::group(['middleware' => ['auth', 'customer']], function(){
    Route::get('/dashboard', [DashboardsController::class, 'dashboard'])->name('customer.dashboard');
    Route::get('/edit-profile', [DashboardsController::class, 'edit'])->name('customer.edit.profile');
    Route::post('/update-profile', [DashboardsController::class, 'update'])->name('customer.update.profile');
    Route::get('/customer-change-password', [DashboardsController::class, 'changePassword'])->name('customer.change.password');
    Route::post('/customer-update-password', [DashboardsController::class, 'updatePassword'])->name('customer.update.password');
    
    
        Route::get('/payment', [DashboardsController::class, 'payment'])->name('customer.payment');
        Route::post('/payment-store', [DashboardsController::class, 'paymentStore'])->name('customer.payment.store');
        Route::get('/order-list', [DashboardsController::class, 'orderList'])->name('customer.order.list');
        Route::get('/order-details/{id}', [DashboardsController::class, 'orderDetails'])->name('customer.order.details');
        Route::get('/order-print/{id}', [DashboardsController::class, 'orderPrint'])->name('customer.order.print');
});

//Admin Routes
Route::group(['middleware' => ['auth', 'admin']], function(){
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
    //User routes
    Route::prefix('users')->group(function(){
        Route::get('/', [UsersController::class, 'index'])->name('user.index');
        Route::get('/create', [UsersController::class, 'create'])->name('user.create');
        Route::post('/store', [UsersController::class, 'store'])->name('user.store');
        Route::get('/edit/{id}', [UsersController::class, 'edit'])->name('user.edit');
        Route::post('/update/{id}', [UsersController::class, 'update'])->name('user.update');
        Route::post('/user/delete', [UsersController::class, 'delete'])->name('user.delete');
    });
    
    //User Profile routes
    Route::prefix('profiles')->group(function(){
        Route::get('/', [ProfilesController::class, 'index'])->name('user.profiles');
        Route::get('/edit', [ProfilesController::class, 'edit'])->name('user.profile.edit');
        Route::post('/update', [ProfilesController::class, 'update'])->name('user.profile.update');
        Route::get('/user/change-password', [ProfilesController::class, 'changePassword'])->name('user.change.password');
        Route::post('/user/update-password', [ProfilesController::class, 'updatePassword'])->name('user.update.password');
    });
    
    //Customer routes
    Route::prefix('customers')->group(function(){
        Route::get('/', [CustomersController::class, 'index'])->name('customer.show');
        Route::get('/draft/view', [CustomersController::class, 'draftShow'])->name('customer.draft.show');
        Route::post('/customer/delete', [CustomersController::class, 'delete'])->name('customer.draft.delete');
    });
    
    //Category routes
    Route::prefix('categories')->group(function(){
        Route::get('/', [CategoriesController::class, 'index'])->name('admin.categories');
        Route::get('/create', [CategoriesController::class, 'create'])->name('admin.category.create');
        Route::post('/store', [CategoriesController::class, 'store'])->name('admin.category.store');
        Route::get('/edit/{id}', [CategoriesController::class, 'edit'])->name('admin.category.edit');
        Route::post('/category/update/{id}', [CategoriesController::class, 'update'])->name('admin.category.update');
        Route::post('/category/delete', [CategoriesController::class, 'delete'])->name('admin.category.delete');
    });
    
    //Brand routes
    Route::prefix('brands')->group(function(){
        Route::get('/', [BrandsController::class, 'index'])->name('admin.brands');
        Route::get('/create', [BrandsController::class, 'create'])->name('admin.brand.create');
        Route::post('/store', [BrandsController::class, 'store'])->name('admin.brand.store');
        Route::get('/edit/{id}', [BrandsController::class, 'edit'])->name('admin.brand.edit');
        Route::post('/brand/update/{id}', [BrandsController::class, 'update'])->name('admin.brand.update');
        Route::post('/brand/delete', [BrandsController::class, 'delete'])->name('admin.brand.delete');
    });
    
    //Color routes
    Route::prefix('colors')->group(function(){
        Route::get('/', [ColorsController::class, 'index'])->name('admin.colors');
        Route::get('/create', [ColorsController::class, 'create'])->name('admin.color.create');
        Route::post('/store', [ColorsController::class, 'store'])->name('admin.color.store');
        Route::get('/edit/{id}', [ColorsController::class, 'edit'])->name('admin.color.edit');
        Route::post('/color/update/{id}', [ColorsController::class, 'update'])->name('admin.color.update');
        Route::post('/color/delete', [ColorsController::class, 'delete'])->name('admin.color.delete');
    });
    
    //Size routes
    Route::prefix('sizes')->group(function(){
        Route::get('/', [SizesController::class, 'index'])->name('admin.sizes');
        Route::get('/create', [SizesController::class, 'create'])->name('admin.size.create');
        Route::post('/store', [SizesController::class, 'store'])->name('admin.size.store');
        Route::get('/edit/{id}', [SizesController::class, 'edit'])->name('admin.size.edit');
        Route::post('/size/update/{id}', [SizesController::class, 'update'])->name('admin.size.update');
        Route::post('/size/delete', [SizesController::class, 'delete'])->name('admin.size.delete');
    });
    
    //Product routes
    Route::prefix('products')->group(function(){
        Route::get('/', [ProductsController::class, 'index'])->name('admin.products');
        Route::get('/create', [ProductsController::class, 'create'])->name('admin.product.create');
        Route::post('/store', [ProductsController::class, 'store'])->name('admin.product.store');
        Route::get('/show/{id}', [ProductsController::class, 'show'])->name('admin.product.show');
        Route::get('/edit/{id}', [ProductsController::class, 'edit'])->name('admin.product.edit');
        Route::post('/product/update/{id}', [ProductsController::class, 'update'])->name('admin.product.update');
        Route::post('/product/delete', [ProductsController::class, 'delete'])->name('admin.product.delete');
    });
    
    //Slider routes
    Route::prefix('sliders')->group(function(){
        Route::get('/', [SlidersController::class, 'index'])->name('admin.sliders');
        Route::post('/store', [SlidersController::class, 'store'])->name('admin.slider.store');
        Route::post('/slider/update/{id}', [SlidersController::class, 'update'])->name('admin.slider.update');
        Route::post('/slider/delete', [SlidersController::class, 'delete'])->name('admin.slider.delete');
    });
    
    //Order routes
    Route::prefix('orders')->group(function(){
        Route::get('/pending/view', [OrdersController::class, 'pendingList'])->name('admin.order.pending');
        Route::get('/approved/view', [OrdersController::class, 'approvedList'])->name('admin.order.approved');
        Route::get('/details/{id}', [OrdersController::class, 'details'])->name('admin.order.details');
        Route::post('/approved', [OrdersController::class, 'approved'])->name('order.approved');
    });
    
    
});

