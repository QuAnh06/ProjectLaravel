<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        if($request->filled('search')){
            $query->where(function ($sub) use ($request) {
                $sub->where('name', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('role', 'LIKE', '%' . $request->search . '%')
                    ->orWhere('email', "LIKE", "%{$request->search}%");
            });
        }

        if($request->filled('status') && in_array($request->status, [0, 1])){
            $query->where('status', $request->status);
        }

        $users = $query->paginate(10)->withQueryString(); // ->appends($request->all()); 
        return view('Users.user-lists', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
            'role' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => 1
        ]);

        return redirect()->route('user-lists')->with('message', 'Create user successfully!');
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
        $user = DB::table('users') -> where('id', $id) -> first();

        return view('Users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email',
            'role' => 'required',
        ]);

        // DB::table('users') -> where('id', $id) -> update([
        //     'name' => $request->get('name'),
        //     'email' => $request->get('email'),
        //     // 'password' => Hash::make($request->get('password')),
        //     'role' => $request->get('role'),
        //     'updated_at' => now()
        // ]);

        User::findOrFail($id)->update($request->only('name', 'email', 'role', 'updated_at'));
        
        return redirect() -> route('user-lists') -> with('message', 'Update user succeessfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table('users') -> where('id', $id) -> delete();
        return back() -> with('message', "Delete user successfully!");
    }
}
