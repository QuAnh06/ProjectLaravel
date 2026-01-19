<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\AppModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;


class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payments = Payment::paginate(10);

        return view('pages.payment-lists', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $apps = AppModel::all();

        return view('Payment.create', compact('apps'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:payments,name',
            'package' => [
                'required', 
                'string',
                'max:400',

                'regex: /^[a-zA-Z0-9_\[\]\s-]+$/',
                Rule::unique('payments', 'package'),            
            ],
            'price' => 'required|numeric|gt:0' // greater-than
                    
        ]);

        Payment::create($request->only('name', 'package', 'price'));

        return redirect() -> route('payments');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // dd($id);
        $payment = Payment::find($id);
        $apps = AppModel::all();

        return view('Payment.edit', compact('payment', 'apps'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $payment = Payment::find($id);

        $request -> validate([
            'name' => [
                'required',
                'string',
                'max:200',
                'regex: /^[a-zA-Z0-9_\[\]\s-]+$/',
                Rule::unique('payments', 'name')->ignore($payment->id),
        ],
        'package' => [
            'required',
            'string',
            'max:200',
            'regex: /^[a-zA-Z0-9_\[\]\s-]+$/',
            Rule::unique('payments', 'package')->ignore($payment->id),
        ],
        'price' => 'required|numeric|gt:0'
        ]);

        if (!$payment) {
        return redirect()
            ->route('payments')
            ->with('alert', 'Gói đã bị xóa trước đó!');
        }
        
        $payment -> update($request -> only('name', 'package', 'price', 'updated_at'));
        return redirect() -> route('payments') -> with('success', 'Update app successfully!');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $payment = Payment::find($id);

        if (!$payment) {
        return redirect()
            ->route('payments')
            ->with('alert', 'Gói đã được xóa trước đó');
        }
        
        $payment -> delete();
        return redirect() -> route('payments') -> with('success', 'Delete package successfully!');
    }
}
