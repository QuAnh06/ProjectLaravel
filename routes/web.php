<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [PageController::class, 'showIndex']);
Route::get('/application-lists', [PageController::class, 'showAppList']);

Route::get('lang/{locale}', function ($locale) {
    if (in_array($locale, ['vi', 'en', 'jp'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
})->name('lang.switch');