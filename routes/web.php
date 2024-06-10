<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Admin\AdminprofileController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\CustomerController as CustomersController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Astrologer\AstrologerController;
use App\Http\Controllers\Astrologer\Auth\LoginController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test', function () {
    event(new App\Events\WebappfixTest());
    dd('fired ...');
});

Route::get('/about-us', [WebController::class, 'about_us'])->name('about-us');
Route::get('/blog', [WebController::class, 'blog'])->name('blog');
Route::get('/contact', [WebController::class, 'contact'])->name('contact');
Route::get('/services', [WebController::class, 'services'])->name('services');
Route::get('/service-details/{id}', [WebController::class, 'service_details'])->name('service-details');
Route::get('/shop', [WebController::class, 'shop'])->name('shop');
Route::get('/product-details/{id}', [WebController::class, 'product_details'])->name('product-details');
Route::get('/cart', [CartController::class, 'cart'])->name('cart');
Route::get('/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('addToCart');
Route::post('update-nav-cart', [CartController::class, 'updateNavCart'])->name('update-nav-cart');
Route::delete('remove-from-cart', [CartController::class, 'remove'])->name('remove.from.cart');
Route::post('/check-stock', [CartController::class, 'checkStock'])->name('check.stock');
Route::get('/cart-content', [CartController::class, 'cartContent'])->name('cart-content');
Route::get('/zodiac-sign', 'HoroScopeController@submitForm')->name('zodiac-sign');
Route::get('/astrologer', 'ChatController@astrologer')->name('astrologer');
Route::group(['prefix' => 'horoscope', 'as' => 'horoscope.'], function () {
    Route::get('today', 'HoroScopeController@today')->name('today');
    Route::get('yesterday', 'HoroScopeController@yesterday')->name('yesterday');
    Route::get('tomorrow', 'HoroScopeController@tomorrow')->name('tomorrow');
    Route::get('weekly', 'HoroScopeController@weekly')->name('weekly');
    Route::get('monthly', 'HoroScopeController@monthly')->name('monthly');
    Route::get('yearly', 'HoroScopeController@yearly')->name('yearly');
    Route::get('details', 'HoroScopeController@details')->name('details');
    Route::get('daily', 'HoroScopeController@daily_horoscope')->name('daily');
    Route::get('daily-filter', 'HoroScopeController@daily_horoscope_filter')->name('daily-filter');
Route::get('/get', 'HoroScopeController@getHoroscope')->name('get');
Route::get('/daily-horo/{zodiacSignId}/{type}', 'HoroScopeController@fetchHoroscope');
    Route::get('create', 'CategoryController@create')->name('create'); // Show create item form
    Route::post('store', 'CategoryController@store')->name('store'); // Store new item
    Route::post('status-update', 'CategoryController@status_update')->name('status-update');
    Route::delete('destroy/{id}', 'CategoryController@destroy')->name('destroy');
    Route::get('view/{id}', 'CategoryController@view')->name('view');
    Route::get('edit/{id}', 'CategoryController@edit')->name('edit');
    Route::post('update/{id}', 'CategoryController@update')->name('update');
});
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/schedulling-notifications', [CustomersController::class, 'getNotifications']);
    Route::get('cart', [CartController::class, 'cart'])->name('cart');
    Route::patch('update-cart', [CartController::class, 'update'])->name('update.cart');
    Route::get('remove-cart', [CartController::class, 'remove_cart'])->name('remove.cart');
    Route::get('checkout', [CartController::class, 'checkout'])->name('checkout');
    Route::post('store-address', [CartController::class, 'store_address'])->name('store-address');
    Route::get('address', [CustomersController::class, 'address'])->name('address');
    Route::get('payment', [CartController::class, 'payment'])->name('payment');
    Route::get('delete_billing_address/{id}', [CustomersController::class, 'delete_billing_address'])->name('delete_billing_address');
    Route::post('billing_address_add', [CustomersController::class, 'billing_address_add'])->name('billing_address_add');
    Route::post('billing_address_update/{id}', [CustomersController::class, 'billing_address_update'])->name('billing_address_update');
    Route::get('delete_shipping_address/{id}', [CustomersController::class, 'delete_shipping_address'])->name('delete_shipping_address');
    Route::post('shipping_address_add', [CustomersController::class, 'shipping_address_add'])->name('shipping_address_add');
    Route::post('shipping_address_update/{id}', [CustomersController::class, 'shipping_address_update'])->name('shipping_address_update');
    Route::get('order-by-cash', [WebController::class, 'order_by_cash'])->name('order-by-cash');
    Route::get('order-by-wallet', [WebController::class, 'order_by_wallet'])->name('order-by-wallet');
    Route::get('checkout-complete', [WebController::class, 'checkout_complete'])->name('checkout-complete');
    Route::get('order', [WebController::class, 'order'])->name('order');
    Route::get('order-details/{id}', [WebController::class, 'order_details'])->name('order-details');
    Route::get('wallet', [CustomersController::class, 'wallet'])->name('wallet');
    Route::get('generate-invoice/{id}', [WebController::class, 'generate_invoice'])->name('generate-invoice');
    // Route::post('service', [CustomersController::class, 'wallet'])->name('service');
    Route::post('/book-now', [CustomersController::class, 'bookNow'])->name('bookNow');
    Route::get('/razorpay-payment', [CustomersController::class, 'razorpayPaymentPage'])->name('razorpayPaymentPage');
    Route::post('/razorpay-payment', [CustomersController::class, 'razorpayPayment'])->name('razorpayPayment'); // Define the route for processing Razorpay payment
    Route::post('/payment-callback', [CustomersController::class, 'handlePaymentCallback'])->name('paymentCallback');
    Route::get('/bookingSuccess', [CustomersController::class, 'bookingSuccess'])->name('bookingSuccess');
    Route::post('/payment/success', [CustomersController::class, 'success']);
    Route::get('booking-list', [CustomersController::class, 'booking'])->name('booking-list');
    Route::get('/chat-request-add/{id}', 'ChatController@chat_request_add')->name('chat-request-add');
    Route::delete('/cancelChatRequest/{id}', 'ChatController@cancelChatRequest')->name('cancelChatRequest');
    Route::get('/wallet-recharge', 'ChatController@wallet_recharge')->name('wallet-recharge');
    Route::post('/store-wallet-rechage', 'ChatController@store_wallet_recharge')->name('store-wallet-recharge');
    Route::get('/success', 'ChatController@success')->name('success');
    Route::get('/chat-history', 'ChatController@chat_history')->name('chat-history');
    // Route::get('/chat/{id}', 'ChatController@chat')->name('chat');
    Route::get('/chat', 'ChatController@chat')->name('chat');

    Route::get('/notify', 'ChatController@notify')->name('notify');
    Route::post('/save-chat', 'ChatController@savechat');
    Route::post('/load-chats', 'ChatController@loadchats');

});

require __DIR__.'/auth.php';
// Admin

Route::middleware('admin')->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin_dashboard');
    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
        Route::get('view', [AdminprofileController::class, 'view'])->name('view');
        Route::get('update/{id}', [AdminprofileController::class, 'edit'])->name('admin_update');
        Route::post('update/{id}', [AdminprofileController::class,'update'])->name('admin_update');
        Route::post('settings-password', [AdminprofileController::class,'settings_password_update'])->name('admin-settings-password');
    });
    Route::get('/setting', [SettingController::class, 'setting'])->name('setting');
    Route::put('/setting_save', [SettingController::class, 'setting_save'])->name('setting_save');
    Route::group(['prefix' => 'customer', 'as' => 'customer.'], function () {
        Route::get('list', [CustomerController::class,'customer_list'])->name('list');
        Route::post('status-update', [CustomerController::class,'status_update'])->name('status-update');
        Route::delete('destroy/{id}', [CustomerController::class,'destroy'])->name('destroy');
        Route::get('view/{user_id}', [CustomerController::class,'view'])->name('view');
        Route::get('export', [CustomerController::class,'export'])->name('export');
    });
    Route::group(['namespace' => 'Admin','prefix' => 'category', 'as' => 'category.'], function () {
        Route::get('list', 'CategoryController@list')->name('list');
        Route::get('create', 'CategoryController@create')->name('create'); // Show create item form
        Route::post('store', 'CategoryController@store')->name('store'); // Store new item
        Route::post('status-update', 'CategoryController@status_update')->name('status-update');
        Route::delete('destroy/{id}', 'CategoryController@destroy')->name('destroy');
        Route::get('view/{id}', 'CategoryController@view')->name('view');
        Route::get('edit/{id}', 'CategoryController@edit')->name('edit');
        Route::post('update/{id}', 'CategoryController@update')->name('update');
    });
    Route::group(['namespace' => 'Admin','prefix' => 'skill', 'as' => 'skill.'], function () {
        Route::get('list', 'SkillController@list')->name('list');
        Route::post('store', 'SkillController@store')->name('store'); // Store new item
        Route::post('status-update', 'SkillController@status_update')->name('status-update');
        Route::delete('destroy/{id}', 'SkillController@destroy')->name('destroy');
        Route::post('update/{id}', 'SkillController@update')->name('update');
    });
    Route::group(['namespace' => 'Admin','prefix' => 'product', 'as' => 'product.'], function () {
        Route::get('list', 'ProductController@list')->name('list');
        Route::get('create', 'ProductController@create')->name('create'); // Show create item form
        Route::post('store', 'ProductController@store')->name('store'); // Store new item
        Route::post('status-update', 'ProductController@status_update')->name('status-update');
        Route::delete('destroy/{id}', 'ProductController@destroy')->name('destroy');
        Route::get('view/{id}', 'ProductController@view')->name('view');
        Route::get('edit/{id}', 'ProductController@edit')->name('edit');
        Route::post('update/{id}', 'ProductController@update')->name('update');
    });
    Route::group(['namespace' => 'Admin','prefix' => 'astrologer', 'as' => 'astrologer.'], function () {
        Route::get('list', 'AstrologerController@list')->name('list');
        Route::post('status-update/{id}', 'AstrologerController@status_update')->name('status-update');
        Route::delete('destroy/{id}', 'AstrologerController@destroy')->name('destroy');
        Route::get('view/{id}', 'AstrologerController@view')->name('view');
        
    });
    Route::group(['namespace' => 'Admin','prefix' => 'order', 'as' => 'order.'], function () {
        Route::get('list', 'OrderController@list')->name('list');
        Route::get('details/{id}', 'OrderController@details')->name('details');
        Route::post('update-order-status', 'OrderController@updateOrderStatus')->name('update-order-status');
        Route::post('update-payment-status', 'OrderController@updatePaymentStatus')->name('update-payment-status');
        Route::get('generate-invoice/{id}', 'OrderController@generate_invoice')->name('generate-invoice');
    });
    Route::group(['namespace' => 'Admin','prefix' => 'service', 'as' => 'service.'], function () {
        Route::get('list', 'ServiceController@list')->name('list');
        Route::get('create', 'ServiceController@create')->name('create'); // Show create item form
        Route::post('store', 'ServiceController@store')->name('store'); // Store new item
        Route::post('status-update', 'ServiceController@status_update')->name('status-update');
        Route::delete('destroy/{id}', 'ServiceController@destroy')->name('destroy');
        Route::get('view/{id}', 'ServiceController@view')->name('view');
        Route::get('edit/{id}', 'ServiceController@edit')->name('edit');
        Route::post('update/{id}', 'ServiceController@update')->name('update');
    });
    Route::group(['namespace' => 'Admin','prefix' => 'horoscope', 'as' => 'horoscope.'], function () {
        Route::group(['prefix' => 'zodiac', 'as' => 'zodiac.'], function () {
            Route::get('list', 'HoroscopeController@list')->name('list');
            Route::post('store', 'HoroscopeController@store')->name('store'); // Store new item
            Route::post('status-update', 'HoroscopeController@status_update')->name('status-update');
            Route::delete('destroy/{id}', 'HoroscopeController@destroy')->name('destroy');
            Route::post('update/{id}', 'HoroscopeController@update')->name('update');
        });
        Route::get('view', 'HoroscopeController@view')->name('view');
        Route::post('view', 'HoroscopeController@view')->name('view');
        Route::post('store', 'HoroscopeController@store_horoscope')->name('store');
        Route::post('update', 'HoroscopeController@update_horoscope')->name('update');
        Route::get('edit', 'HoroscopeController@edit_horoscope')->name('edit');
        Route::delete('destroy', 'HoroscopeController@delete_horoscope')->name('destroy');
        Route::get('dailyHoroscope', 'DailyHoroScopeController@getDailyHoroscope')->name('dailyHoroscope');
        Route::post('dailyHoroscope', 'DailyHoroScopeController@getDailyHoroscope')->name('dailyHoroscope');
        Route::get('edit_daily', 'DailyHoroScopeController@edit_daily')->name('edit_daily');
        Route::post('store_daily', 'DailyHoroScopeController@store_horoscope_daily')->name('store_daily');
        Route::post('update_daily', 'DailyHoroScopeController@upadateDailyHoroscope')->name('update_daily');
        Route::delete('destroy-daily', 'DailyHoroScopeController@delete_horoscope_daily')->name('destroy-daily');

    });
    
});

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminController::class, 'login'])->name('admin_login');
    Route::post('/login-submit', [AdminController::class, 'login_submit'])->name('admin_login_submit');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin_logout');
    Route::get('/forget-password', [AdminController::class, 'forget_password'])->name('admin_forget_password');
    Route::post('/forget-password-submit', [AdminController::class, 'forget_password_submit'])->name('admin_forget_password_submit');
    Route::get('/reset-password/{token}/{email}', [AdminController::class, 'reset_password'])->name('admin_reset_password');
    Route::post('/reset-password-submit', [AdminController::class, 'reset_password_submit'])->name('admin_reset_password_submit');
    
});
Route::group(['namespace' => 'Astrologer','prefix' => 'astrologer', 'as' => 'astrologer.'], function () {
      Route::get('/login', [LoginController::class, 'login'])->name('login');
      Route::get('/register', [LoginController::class, 'register'])->name('register');
      Route::post('/register-submit', [LoginController::class, 'register_submit'])->name('register_submit');
      Route::post('/login-submit', [LoginController::class, 'login_submit'])->name('login_submit');
      Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::middleware('astrologer')->group(function () {
        Route::group(['prefix' => 'profile', 'as' => 'profile.'], function () {
            Route::get('view', [AstrologerController::class, 'view'])->name('view');
            Route::get('update/{id}', [AstrologerController::class, 'edit'])->name('update');
            Route::post('update/{id}', [AstrologerController::class,'update'])->name('update');
            Route::post('settings-password', [AstrologerController::class,'settings_password_update'])->name('settings-password');
            Route::post('availability/{id}', [AstrologerController::class,'availability'])->name('availability');
        });
        Route::get('/dashboard', [AstrologerController::class, 'dashboard'])->name('dashboard');
        Route::group(['prefix' => 'chat', 'as' => 'chat.'], function () {
            Route::get('chat-requests', 'ChatController@chat_requests')->name('chat-requests');
            Route::get('accept-chat-request/{id}', 'ChatController@accept_chat_request')->name('accept-chat-request'); // Show create item form
            Route::get('reject-chat-request/{id}', 'ChatController@reject_chat_request')->name('reject-chat-request'); // Show create item form
            Route::post('store', 'CategoryController@store')->name('store'); // Store new item
            Route::post('status-update', 'CategoryController@status_update')->name('status-update');
            Route::delete('destroy/{id}', 'CategoryController@destroy')->name('destroy');
            Route::get('view/{id}', 'CategoryController@view')->name('view');
            Route::get('edit/{id}', 'CategoryController@edit')->name('edit');
            Route::post('update/{id}', 'CategoryController@update')->name('update');
        });
    });

});