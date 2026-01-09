<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Models\User;
use App\Http\Controllers\AuthController;

Route::get('/', function(){
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
 
Route::middleware(['auth'])->group(function () {
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


    Route::get('/application-lists', function(){
        return view('pages.application-lists');
    })->name('app-lists');


    Route::get('/service-lists', function(){
        return view('pages.service-lists');
    })->name('service-lists');

    Route::get('/payment-lists', function(){
        return view('pages.payment-lists');
    })->name('payment-lists');

});

// Route::get('/user-lists', function(){
//     $users = User::latest()->paginate(10); 
//     return view('pages.user-lists', compact('users'));
// })->name('user-lists');

// Route::get('/user-lists', [PageController::class, 'Users'])->name('user-lists'); 

Route::middleware(['auth']) -> prefix('/user-lists') -> controller(UserController::class) -> group(function (){
    Route::get('/', 'index') -> name('user-lists');
    Route::get('/create', 'create') -> name('user-lists.create') -> middleware(['admin']);
    Route::post('/', 'store') -> name('user-lists.store');
    Route::get('/edit/{id}', 'edit') -> name('user-lists.edit') -> middleware(['admin']);
    Route::put('/{id}', 'update') -> name('user-lists.update');
    Route::delete('/{id}', 'destroy')
    ->name('user-lists.destroy') -> middleware(['admin']);
});


Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['vi', 'en', 'jp'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');



