<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use Illuminate\Routing\Controllers\HasMiddleware;

class PageController extends Controller // implements HasMiddleware
{
    // public static function middleware(){
    //     return [
    //         AuthMiddleware::class,
    //         ...
    //     ];
    // }

    public function Index() {
        return view('pages.index');
    }

    public function showAppList() {
        return view('pages.application-lists');
    }
  
    // public function Users() {
    //     $users = User::latest()->paginate(15); 
    //     return view('pages.user-lists', compact('users'));
    // }
}
