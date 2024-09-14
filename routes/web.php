<?php


use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PartsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MachineController;

use App\Http\Controllers\ReportController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\Frontend\HomeController as FrontendHomeController;
use App\Http\Controllers\Frontend\PartsController as FrontendPartsController;
use App\Http\Controllers\Frontend\CustomerController as FrontendCustomerController;

use Illuminate\Support\Facades\Route;


//for website frontend site

Route::get('/',[FrontendHomeController::class,'home'])->name('home');
Route::get('/new',[FrontendHomeController::class,'new'])->name('new');

Route::get('/all-parts',[FrontendPartsController::class,'allParts'])->name('frontend.parts');
Route::post('/registration',[FrontendCustomerController::class,'registration'])->name('customer.registration');
Route::post('/do-login',[FrontendCustomerController::class,'customerLogin'])->name('customer.login');

Route::get('/show-parts/{partsId}',[FrontendPartsController::class,'showParts'])->name('show.parts');
//add cart
Route::get('/add-to-cart/{partsId}',[OrderController::class, 'addToCart'])->name('add.to.cart');
Route::get('/view-cart',[OrderController::class, 'viewCart'])->name('view.cart');
Route::post('/update-cart/{partsid}',[OrderController::class,'updateCart'])->name('update.cart');
Route::get('/clear-cart',[OrderController::class, 'clearCart'])->name('cart.clear');
Route::get('/cart/item/delete/{id}',[OrderController::class, 'cartItemDelete'])->name('cart.item.delete');
Route::get('/search',[FrontendPartsController::class,'search'])->name('search');
Route::get('/products-under-category/{category_id}',[FrontendHomeController::class,'productsUnderCategory'])->name('products.under.category');

//authentication for user login for frontend
Route::group(['middleware'=>'customer_auth'],function (){
Route::get('/logout',[FrontendCustomerController::class,'customerLogout'])->name('customer.logout');
Route::get('/checkout',[OrderController::class, 'checkout'])->name('checkout');
Route::post('/place-order',[OrderController::class, 'placeOrder'])->name('order.place');
Route::get('/view-profile',[FrontendCustomerController::class,'viewProfile'])->name('view.profile');
Route::get('/order-cancel/{order_id}',[FrontendCustomerController::class,'cancelOrder'])->name('cancel.order');

Route::get('/view-invoice/{id}',[OrderController::class,'viewInvoice'])->name('view.invoice');
Route::post('/success', [PaymentController::class, 'success']);
});

 
//admin panel backend
Route::group(['prefix' => 'admin'], function () {

Route::get('/login',[AuthenticationController::class,'login'])->name('login');
Route::post('/dologin',[AuthenticationController::class,'dologin'])->name('dologin');

Route::Group(['middleware'=>'auth'],function(){
    
    Route::get('/',[HomeController::class,'home'])->name('dashboard');
    Route::get('/logout',[AuthenticationController::class, 'logout'])->name('logout');

    //customer route
    Route::get('/customer',[CustomerController::class,'customer'])->name('customer.list');
    Route::get('/customer-form',[CustomerController::class,'form'])->name('customer.form');
    Route::post('/customer-store',[CustomerController::class,'store'])->name('customer.store');

    //order route

    Route::get('/order',[OrderController::class,'order'])->name('order.list');
    Route::get('/order-view/{o_id}',[OrderController::class,'orderView'])->name('order.View');
    Route::post('/order-status/{o_id}',[OrderController::class,'orderStatus'])->name('order.status');
   
//admin parts all route
    Route::get('/parts',[PartsController::class,'parts'])->name('parts.list');
    Route::get('/parts-form',[PartsController::class,'form'])->name('parts.form');
    Route::post('/parts-store',[PartsController::class,'store'])->name('parts.store');
    Route::get('/parts/delete/{p_id}',[PartsController::class,'delete'])->name('parts.delete');
    Route::get('/parts/view/{p_id}',[PartsController::class,'viewParts'])->name('parts.view');
    //parts edit and update
    Route::get('/parts/edit/{p_id}',[PartsController::class, 'edit'])->name('parts.edit');
    Route::post('/parts/update/{p_id}',[PartsController::class, 'update'])->name('parts.update');

    //stock alart
    Route::post('/set-alert-stock',[PartsController::class,'setAlertStock'])->name('set.alert.stock');

    //category
    Route::get('/category',[CategoryController::class,'category'])->name('category.list');
    Route::get('/category-form',[CategoryController::class,'form'])->name('category.form');
    Route::post('/category-store',[CategoryController::class,'store'])->name('category.store');

    //update and delate
    Route::get('/category/delete/{c_id}',[CategoryController::class,'delete'])->name('category.delete');
      Route::get('/category/edit/{c_id}',[CategoryController::class, 'edit'])->name('category.edit');
    Route::post('/category/update/{c_id}',[CategoryController::class, 'update'])->name('category.update');
//report
    Route::get('/report',[ReportController::class,'report'])->name('report.list');
   

    Route::get('/admin',[AdminController::class,'admin'])->name('admin.list');
 
});
});