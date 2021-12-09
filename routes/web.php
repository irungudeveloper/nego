<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\BillController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DeliveryController;
use App\Http\Controllers\MpesaController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\Auth\CustomAuthController;
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
    return redirect()->route('store.index');
})->name('/');

Route::resource('/store',StoreController::class);
Route::get('product/{id}/details',[StoreController::class,'single'])->name('product.single');

// Auth::routes();

// Route::get('/home', function() {
//     return view('home');
// })->name('home')->middleware('auth');


// Auth::routes();



Route::get('/home', function() {
    return view('home');
})->name('home')->middleware('auth');



Route::middleware(['auth'])->group(function () 
{
    Route::resource('/category',CategoryController::class);
    Route::resource('/brand',BrandController::class);
    Route::resource('/product',ProductController::class);
    Route::resource('/cart',CartController::class);
    Route::post('/update/cart',[CartController::class,'cartUpdate'])->name('update.cart');
    Route::get('merchant',[MerchantController::class,'index'])->name('merchant');
    Route::post('merchant/store',[MerchantController::class,'store'])->name('merchant.store');
    Route::get('customer',[CustomerController::class,'index'])->name('customer');
    Route::post('customer/store',[CustomerController::class,'store'])->name('customer.store');
    Route::resource('delivery',DeliveryController::class);
    Route::resource('bill',BillController::class);
    Route::resource('checkout',CheckoutController::class);
    Route::resource('pay/mpesa',MpesaController::class);
    Route::resource('order',OrderController::class);
    Route::resource('discount',DiscountController::class);

    Route::get('customer/order',[OrderController::class,'customer'])->name('customer.order');

    Route::post('/mpesa/confirm',[MpesaController::class,'transactionConfirmation'])->name('mpesa.confirm');
});

Route::get('register',[CustomAuthController::class,'registration'])->name('register');
Route::get('merchant/create',[CustomAuthController::class,'merchant'])->name('merchant.create');
Route::get('customer/create',[CustomAuthController::class,'customer'])->name('customer.create');

Route::get('/mpesa',[CheckoutController::class,'mpesa'])->name('mpesa');

Route::post('register',[CustomAuthController::class,'customRegistration'])->name('register.create'); 
Route::get('login',[CustomAuthController::class,'index'])->name('login');
Route::post('login',[CustomAuthController::class,'customLogin'])->name('login.create');
Route::get('dashboard',[CustomAuthController::class,'dashboard'])->name('dashboard');
Route::get('logout',[CustomAuthController::class,'signOut'])->name('logout');