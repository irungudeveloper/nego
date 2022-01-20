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
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TasksController;
use App\Http\Controllers\ProductChartController;
use App\Http\Controllers\SalesChartController;
use App\Http\Controllers\Auth\CustomAuthController;
use App\Http\Controllers\BotManController;
use App\BotMan\NegotiationConversation;
use App\Http\Controllers\StripeController;
use App\Http\Controllers\TestNotification;

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
Route::get('/store/category/{id}',[StoreController::class,'categoryProducts'])->name('store.category');
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
    Route::get('/delete/cart/{id}',[CartController::class,'deleteItem'])->name('delete.cart');
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
    Route::resource('merchant/tasks',TasksController::class);

    Route::get('customer/order',[OrderController::class,'customer'])->name('customer.order');
    Route::post('/mpesa/confirm',[MpesaController::class,'transactionConfirmation'])->name('mpesa.confirm');
    Route::post('/cart/discount',[DiscountController::class,'applyDiscount'])->name('cart.discount');

    Route::get('pay/stripe',[StripeController::class,'index'])->name('stripe.get');
    Route::post('pay/stripe',[StripeController::class,'pay'])->name('stripe.post');

    Route::get('/order/confirm',[OrderController::class,'confirmDelivery'])->name('confirm.order');
    Route::get('/order/{id}/confirm',[OrderController::class,'deliveryConfirm'])->name('delivery.confirm');
    Route::get('/order/{id}/cancel',[OrderController::class,'cancelOrder'])->name('order.cancel');

    Route::get('/dashboard/merchant',[HomeController::class,'index'])->name('dashboard.merchant');
    Route::get('/dashboard/client',[HomeController::class,'customer'])->name('dashboard.client');
    Route::get('/chart/product',[ProductChartController::class,'productChart'])->name('chart.product');
    Route::get('/chart/sales',[SalesChartController::class,'index'])->name('sales.index');

    Route::get('/notification',[TestNotification::class,'index'])->name('notification.index');
    Route::get('/notification/{id}/update/{status}',[TestNotification::class,'updateStatus'])->name('notification.update');
    Route::post('/notification',[TestNotification::class,'store'])->name('notification.create');


});

Route::get('/chart/product',[ProductChartController::class,'productChart'])->name('chart.product');
Route::get('/chart/product/stock',[ProductChartController::class,'productStock'])->name('chart.product.stock');
Route::get('/chart/product/sale',[ProductChartController::class,'productSale'])->name('chart.sale');

Route::get('/chart/product/sale',[ProductChartController::class,'productSale'])->name('chart.product.sale');

Route::get('/chart/sales/total',[SalesChartController::class,'totalSales'])->name('sales.total');
Route::get('/chart/sales/product',[SalesChartController::class,'salesByProduct'])->name('sales.product');
Route::get('/chart/sales/discount',[SalesChartController::class,'productDiscount'])->name('sales.discount');

Route::get('register',[CustomAuthController::class,'registration'])->name('register');
Route::get('merchant/create',[CustomAuthController::class,'merchant'])->name('merchant.create');
Route::get('customer/create',[CustomAuthController::class,'customer'])->name('customer.create');

Route::get('/mpesa',[CheckoutController::class,'mpesa'])->name('mpesa');

Route::post('register',[CustomAuthController::class,'customRegistration'])->name('register.create'); 
Route::get('login',[CustomAuthController::class,'index'])->name('login');
Route::post('login',[CustomAuthController::class,'customLogin'])->name('login.create');
Route::get('dashboard',[CustomAuthController::class,'dashboard'])->name('dashboard');
Route::get('logout',[CustomAuthController::class,'signOut'])->name('logout');

Route::match(['get', 'post'], 'botman', [BotManController::class, 'handle']);


Route::get('nego',[NegotiationConversation::class,'getProduct'])->name('nego.data');
Route::get('nego/validity',[NegotiationConversation::class,'checkValidity'])->name('nego.validity');
Route::get('nego/discount',[NegotiationConversation::class,'generateDiscountCode'])->name('nego.discount');
Route::get('nego/auth',[NegotiationConversation::class,'checkAuth'])->name('nego.auth');

Route::get('/notify',[TestNotification::class,'test'])->name('test.get');
