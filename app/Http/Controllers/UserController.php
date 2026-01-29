<?php

namespace App\Http\Controllers;

use App\Models\AppModel;
use App\Models\Payment;
use App\Models\PaymentSubscriptions;
use Illuminate\Http\Request;
use App\Models\UserList;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = UserList::query();

        if($request->filled('search')){
            $query->where(function ($sub) use ($request) {
                $sub->where('name', 'LIKE', '%' . $request->search . '%')
                    // ->orWhere('role', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('email', "LIKE", "%{$request->search}%");
            });
        }

        // if($request->filled('status') && in_array($request->status, [0, 1])){
        //     $query->where('status', $request->status);
        // }

        $users = $query->paginate(10); // ->appends($request->all()); 
        return view('Users.user-lists', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $apps = AppModel::all();
        $packages = Payment::all();

        return view('Users.create', compact('apps', 'packages'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => __('messages.name_required'),
            'name.regex' => __('messages.name_regex'),
            'email.required' => __('messages.email_required'),
            'email.unique' => __('messages.email_unique'),
            'password.required' => __('messages.password_required'),
            'password.min' => __('messages.password_min'),
            'password.confirmed' => __('messages.password_confirmed'),
            'app_id.required_if' => __('messages.app_required'),
            'package_id.required_if' => __('messages.package_required'),
            'phone.numeric' => __('messages.phone_numeric'),
        ];

        $request->validate([
            'name'     => 'required|string|max:200|regex:/^[a-zA-Z0-9_\[\]\s-]+$/', 
            'email'    => 'required|email|unique:user_list,email',
            'phone'    => 'nullable|numeric|digits_between:9,10',
            'password' => 'required|min:8|confirmed',
            'app_id'   => 'required_if:create_service,on,1,true', 
            'package_id' => 'required_if:create_service,on,1,true',
        ], $messages);
        
        DB::transaction(function () use ($request) {
            $user = UserList::create([
                'name'  => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'password' => Hash::make($request->password),
            ]);

            Log::info('User created', [
                'user_id' => $user->id,
                'action' => 'create_user',
                'by' => Auth::user()->name
            ]);

            if ($request->boolean('create_service')) {

                $validPackage = Payment::where('id', $request->package_id)
                    ->where('app_id', $request->app_id)
                    ->exists();

                if (!$validPackage) {
                    return back() -> withErrors(['error' => 'Người dùng đã đăng kí gói này'])
                            ->withInput(); 
                }

                $exists = PaymentSubscriptions::where('user_id', $user->id)
                    ->where('app_id', $request->app_id)
                    ->where('plan_id', $request->package_id)
                    ->exists();

                if($exists){
                    return back() -> withErrors(['error' => 'Người dùng đã đăng kí gói này'])
                            ->withInput(); 
                }

                $subscription = $user->subscriptions()->create([
                    'app_id'  => $request->app_id,
                    'plan_id' => $request->package_id,
                    'status'  => 'active',
                ]);

                Log::info('Subscription created', [
                    'subscription_id' => $subscription->id,
                    'user_id' => $user->id,
                    'app_id' => $subscription->app_id,
                    'plan_id' => $subscription->plan_id,
                ]);
            }

        });
        return redirect()->route('user-lists')->with('message', 'Tạo người dùng thành công!');
    }

       

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $user = DB::table('user_list') -> where('id', $id) -> first();

        return view('Users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => [
                'required',
                'email',
                Rule::unique('user-list', 'email')
            ],
            'phone' => 'nullable|numeric|digits_between:10,11',
        ]);

        UserList::findOrFail($id)->update($request->only('name', 'email', 'phone', 'updated_at'));
        
        return redirect() -> route('user-lists') -> with('message', 'Update user succeessfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table('user_list') -> where('id', $id) -> delete();
        return back() -> with('message', "Delete user successfully!");
    }
}
