<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Models\User;

Route::get('/', function(){
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

// Route::get('/user-lists', function(){
//     $users = User::latest()->paginate(10); 
//     return view('pages.user-lists', compact('users'));
// })->name('user-lists');

// Route::get('/user-lists', [PageController::class, 'Users'])->name('user-lists'); 

Route::prefix('/user-lists') -> controller(UserController::class) -> group(function (){
    Route::get('/', 'index') -> name('user-lists');
    Route::get('/create', 'create') -> name('user-lists.create');
    Route::post('/store', 'store') -> name('user-lists.store');
    // Route::delete('/', '')
});


Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['vi', 'en', 'jp'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');



