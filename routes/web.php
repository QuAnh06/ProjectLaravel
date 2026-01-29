<?php

use App\Http\Controllers\AppController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Models\User;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentSubscriptionsController;
use App\Models\Payment;
use App\Models\PaymentSubscriptions;

Route::get('/', function(){
    return redirect()->route('login');
});

// Route::middleware('guest') -> group(function(){
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('register.post');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
// });
 
Route::middleware(['auth', 'prevent'])->group(function () {
    Route::get('/index', function(){
        return view('pages.index');
    })->name('index');

    Route::prefix('/home') -> group(function (){
        
        Route::get('/', function(){
            return view('pages.home');
        })->name('home');
        
        Route::get('/{UserId}', function($UserId) {
            return 'User ' . $UserId;
        });
    });
    // ->middleware('AuthMiddleware::class');

});

Route::middleware(['auth', 'prevent']) -> group(function(){
    Route::prefix('/user-lists') -> controller(UserController::class) -> group(function (){
        Route::get('/', 'index') -> name('user-lists');
        Route::get('/create', 'create') -> name('user-lists.create') -> middleware(['admin']);
        Route::post('/', 'store') -> name('user-lists.store');
        Route::get('/edit/{id}', 'edit') -> name('user-lists.edit') -> middleware(['admin']);
        Route::put('/{id}', 'update') -> name('user-lists.update');
        Route::delete('/{id}', 'destroy')
        ->name('user-lists.destroy') -> middleware(['admin']);
    });


    Route::prefix('/apps') -> controller(AppController::class) -> group(function (){
        Route::get('/', 'index') -> name('apps') -> middleware(['admin']);
        Route::get('/create', 'create') -> name('apps.create') -> middleware(['admin']);
        Route::post('/', 'store') -> name('apps.store');
        Route::get('/edit/{id}', 'edit') -> name('apps.edit') -> middleware(['admin']);
        Route::put('/{id}', 'update') -> name('apps.update');
        Route::delete('/{id}', 'destroy')
        ->name('apps.destroy') -> middleware(['admin']);
    });

    Route::prefix('/payments') -> controller(PaymentController::class) -> group(function (){
        Route::get('/', 'index') -> name('payments')->middleware(['admin']);
        Route::get('/create', 'create') -> name('payments.create') -> middleware(['admin']);
        Route::post('/', 'store') -> name('payments.store');
        Route::get('/edit/{id}', 'edit') -> name('payments.edit') -> middleware(['admin']);
        Route::put('/{id}', 'update') -> name('payments.update');
        Route::delete('/{id}', 'destroy')
        ->name('payments.destroy') -> middleware(['admin']);
    });

    Route::prefix('/payment-subscriptions') -> controller(PaymentSubscriptionsController::class) -> group(function (){
        Route::get('/', 'index') -> name('payment-subscriptions')->middleware(['admin']);
        Route::get('/create', 'create') -> name('payment-subscriptions.create') -> middleware(['admin']);
        Route::post('/', 'store') -> name('payment-subscriptions.store');
        Route::get('/edit/{id}', 'edit') -> name('payment-subscriptions.edit') -> middleware(['admin']);
        Route::put('/{id}', 'update') -> name('payment-subscriptions.update');
        Route::delete('/{id}', 'destroy')
        ->name('payment-subscriptions.destroy') -> middleware(['admin']);
    });
});

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['vi', 'en', 'jp'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang');



