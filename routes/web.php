<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Models\User;

Route::get('/', function(){
    return view('pages.index');
})->name('index');

Route::prefix('/home') -> group(function (){
    
    Route::get('/', function(){
        return view('pages.home');
        // return 'Home Page';
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

Route::get('/user-lists', [PageController::class, 'user'])->name('user-lists'); 


Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['vi', 'en', 'jp'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');