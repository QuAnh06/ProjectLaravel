<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentSubscriptions;

class PaymentSubscriptionsController extends Controller 
{
    public function index() {
        // $query = PaymentSubscriptions::with(['']);
        
        $subscriptions = PaymentSubscriptions::with(['user', 'app', 'plan']) -> latest() -> paginate(10);

        return view('pages.payment-subscriptions', compact('subscriptions'));
    }

    
}
