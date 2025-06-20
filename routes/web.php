<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\MenuController as AdminMenuController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\TableController;
use App\Http\Controllers\Frontend\CategoryController as FrontendCategoryController;
use App\Http\Controllers\Frontend\MenuController as FrontendMenuController;
use App\Http\Controllers\Frontend\ReservationController as FrontendReservationController;
use App\Http\Controllers\Frontend\WelcomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\MenuController;



Route::get('/', [WelcomeController::class, 'index']);
Route::get('/categories', [FrontendCategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{category}', [FrontendCategoryController::class, 'show'])->name('categories.show');
Route::get('/menus', [FrontendMenuController::class, 'index'])->name('menus.index');
Route::get('/test', function () {
    return [
        'APP_BASE_PATH' => $_ENV['APP_BASE_PATH'] ?? null,
        'dirname(__DIR__)' => dirname(__DIR__)
    ];
});

// ROUTE CART PAKAI FRONTEND CONTROLLER
Route::get('/cart', [FrontendMenuController::class, 'cart'])->name('cart.index');
Route::post('/cart/add/{id}', [FrontendMenuController::class, 'addToCart'])->name('cart.add');
Route::post('/cart/remove/{id}', [FrontendMenuController::class, 'removeFromCart'])->name('cart.remove');
Route::post('/cart/update/{id}/{action}', [FrontendMenuController::class, 'updateQuantity'])->name('cart.update');
Route::get('/reservation/step-one', [FrontendReservationController::class, 'stepOne'])->name('reservations.step.one');
Route::post('/reservation/step-one', [FrontendReservationController::class, 'storeStepOne'])->name('reservations.store.step.one');
Route::get('/reservation/step-two', [FrontendReservationController::class, 'stepTwo'])->name('reservations.step.two');
Route::post('/reservation/step-two', [FrontendReservationController::class, 'storeStepTwo'])->name('reservations.store.step.two');
Route::get('/thankyou', [WelcomeController::class, 'thankyou'])->name('thankyou');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth', 'admin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('index');
    Route::resource('/categories', CategoryController::class);
    Route::resource('/menus', AdminMenuController::class);
    Route::resource('/tables', TableController::class);
    Route::resource('/reservations', ReservationController::class);
    Route::resource('/orders', OrderController::class)->only(['index', 'show']);
    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

Route::post('/midtrans/token', [\App\Http\Controllers\PaymentController::class, 'getSnapToken'])->name('midtrans.token');
Route::post('/payment/success', [\App\Http\Controllers\PaymentController::class, 'handlePaymentSuccess'])->name('payment.success');

require __DIR__ . '/auth.php';
