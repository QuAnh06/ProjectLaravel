<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function showIndex() {
        return view('pages.index');
    }

    public function showAppList() {
        return view('pages.application-lists');
    }
}
